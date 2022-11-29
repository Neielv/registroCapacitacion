<?php

namespace App\Http\Livewire;

use App\Models\Bodega;
use App\Models\Traslado;
use App\Models\Producto;
use App\Models\Ciudad;
use App\Models\Traslado_Producto;
use Livewire\Component;
use Illuminate\Support\Str;

class CreateTraslado extends Component
{
    public $open=false;
    public $producto_id, $origen_id,$destino_id,$cantidad=1,$descripcion,$nombre;
    public $disponible=0;
    public $producto;
    public $proSeleccionado;
    public $bloqueo;

    public $nombre_producto;
    public $orderProduct=[];

   

    protected $rules=[       
        'nombre'=>'required|max:20',
        'descripcion'=>'required|max:100',
        'origen_id'=>'required|numeric',
        'origen_id'=>'required|numeric'
    ];

    public function render()
    {
     
        $productos=Producto::Where('productos.codigo','=',$this->producto)   
        ->join('bodegas', 'bodegas.producto_id', '=', 'productos.id')    
        ->where('bodegas.ciudad_id', '=', $this->origen_id)
        ->select('bodegas.existencia')        
        ->selectRaw('productos.id as id')
        ->selectRaw('productos.nombre as nombre')        
        ->get();
        if ($productos->count()==1)
        {
            $this->proSeleccionado=$productos[0];
            $this->disponible= $this->proSeleccionado->existencia;
            $this->maximo= $this->proSeleccionado->existencia;
            $this->nombre_producto= $this->proSeleccionado->nombre;
            $this->producto_id= $this->proSeleccionado->id;
        }
        else{
            $this->proSeleccionado=null;
            $this->nombre_producto='';
            $this->disponible=0;
            $this->producto_id=0;
            $this->maximo=0;
        }

        $ciudades=Ciudad::all();
        if ($this->origen_id==$this->destino_id || ($this->origen_id<1 || $this->destino_id<1 ))
        {
            $this->bloqueo=1;
        }
        else
        {
            $this->bloqueo=0;
        }
            
        
        return view('livewire.create-traslado',compact('productos','ciudades'));
    }

    public function add()
    {
               
        if ($this->producto_id==''||$this->cantidad==0||$this->cantidad=='')
        {
           $this->emit('error','Biormed','Datos incorrectos '); 
        }            
        else 
        {
            
            if ($this->cantidad>0 && $this->cantidad<=$this->maximo)
            {
                 
                    $orderProducts=array(
                    'indice'=>1,
                    'producto_id'=>$this->proSeleccionado->id, 
                    'producto_codigo'=>$this->proSeleccionado->codigo, 
                    'producto_nombre'=>$this->proSeleccionado->nombre,                    
                    'cantidad'=>$this->cantidad,
                );
                $this->orderProduct[]=$orderProducts;
                
                $this->emit('alert','Biormed','Producto agregado');     
                $this->cantidad=0;    

            }
            else{

                $this->emit('error','Biormed','La cantidad no debe ser mayor a: ' . $this->maximo);   
             
            }
            
        }   
    }

    public function save()
    {
        $this->validate();        
        if ($this->origen_id>0 && $this->destino_id>0 && $this->origen_id!= $this->destino_id) 
        {
            if ($this->orderProduct)
            {
                $traslado=Traslado::create([
                    'nombre'=>$this->nombre,
                    'descripcion'=>$this->descripcion,      
                    'origen_id'=>$this->origen_id, 
                    'destino_id'=>$this->destino_id,         
                    'estadoingresos_id'=>1     
                ]);  

                foreach ($this->orderProduct as $key =>$item)  
                    {
                    $this->pedido_producto=Traslado_Producto::create([
                        'traslado_id'=> $traslado->id,
                        'producto_id'=>$item['producto_id'],
                        'cantidad'=>$item['cantidad'],                       
                    ]);
                    
                    }  


                $this->reset(['open','origen_id','destino_id','cantidad','producto_id']);
                $this->emitTo('show-traslados','render');
                $this->emit('alert','Biormed','Traslado creado satisfactoriamente');

            }
            else{
                $this->emit('error','Biormed','No existe detalle');

            }
        }
        else
        {            
            $this->emit('error','Biormed','Información incorrecta');
        }
        
    }
    
}


