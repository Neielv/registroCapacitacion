<?php

namespace App\Http\Livewire;

use App\Imports\Ingreso_ProductoImport;
use App\Imports\Pedido_ProdictoImport;
use App\Models\Ingreso;
use App\Models\Ingreso_Producto;
use App\Models\Pedido_Producto;
use App\Models\Producto;
use Exception;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads; 
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Facades\Excel;

class CreateIngreso extends Component
{
    use WithFileUploads;

    public $open=false;
    public $nombre,$producto_id,$cantidad=1;
    public $precio;
    public $descripcion;
    public $ingreso=null;
    public $detalle_guardado=0;
    public $ingreso_producto=[];
    public $ingresoProduct;

    public $archivo;

    protected $listeners = ['render','save'];

    protected $rules=[
        'nombre'=>'required|max:50',         
        'descripcion'=>'required|max:100' ,
        'archivo'=> 'required|mimes:xlsx, csv, xls'           
    ];

    public function readFile()
    {     
        try
        {
            $ingreso_id = session('ingreso_id');
            if ($ingreso_id==0) 
            {
                $this->emit('error','Biormed','Primero debe crear el ingreso'); 
                $this->detalle_guardado=0;
            }
            else{
                Excel::import(new  Ingreso_ProductoImport, $this->archivo);
                $this->emit('alert','Biormed','Ingreso realizado con éxito');
                session(['ingreso_id' => 0]);  
                $this->detalle_guardado=1;
                
                $this->ingresoProduct=Ingreso_Producto::where('ingreso_id',$ingreso_id)->get();

                //DETALLE
        
                $indice=0;
                foreach ( $this->ingresoProduct as $item)  
                {         $indice=$indice+1;
                        $ingreso_producto=array(
                            'indice'=>$indice,
                            'producto_id'=> $item->id,
                            'producto_nombre'=> $item->producto->codigo,
                            'cantidad'=>$item->cantidad,                    
                        );
                        $this->ingreso_producto[]=$ingreso_producto;           
                }    

    
            }

        } 
        catch (Exception $e)
        {
            $this->detalle_guardado=0;
            $this->emit('error','Biormed','Estructura o códigos incorrectos' ); 
        }
       
          
        
    }
    public function save()
    {
        session(['ingreso_id' => 0]);
        $this->validate();
       
           $this->ingreso=Ingreso::create([
                'nombre'=>$this->nombre,
                'descripcion'=>$this->descripcion, 
                'estadoingresos_id'=>1
            ]);   
            
         session(['ingreso_id' => $this->ingreso->id]);
           
        
    }
    public function render()
    {
        $productos=Producto::all();
        return view('livewire.create-ingreso',compact('productos'));
    }

    public function cancel()
    {
        $this->archivo=null;       
        $this->reset(['open','nombre','descripcion','producto_id','archivo','ingreso','detalle_guardado','ingreso_producto']);
    }
   
}


