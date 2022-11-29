<?php

namespace App\Http\Livewire;

use App\Models\Bodega;
use App\Models\Estadoingresos;
use App\Models\Ingreso;
use App\Models\Traslado;
use App\Models\Traslado_Producto;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Barryvdh\DomPDF\Facade as PDF;  


class ShowTraslados extends Component
{
    use withPagination;
    public $search = ''; 
    public $editable=true;   
    public $sort = 'id';
    public $direction = 'desc';
    protected $listeners = ['render','delete'];
    public $cant=10;
    
    
    public $traslado;
    public $traslado_sel;
    public $estadoingresos;
    public $open_edit =false;

    public $nombreestadoingresos;
    public $traslado_id;
    public $estado;
    public $producto;    
    public $cantidad;
    public $origen;
    public $destino;
    public $nombre;

    Public $detalle;
    public $orderProduct=[];

    protected $rules=[
        'traslado.nombre'=>'required|max:40',
        'traslado.origen_id'=>'required|numeric' ,
        'traslado.destino_id'=>'required|numeric' , 
        'traslado.estadoingresos_id'=>'required|numeric'                      
    ];


     public function updatingsearch()
    {
        $this->resetPage();

    }

    public function render()
    {        
        $traslados = Traslado::where('id', 'like', '%' . $this->search . '%')
        ->orderBy($this->sort, $this->direction)
        ->Paginate($this->cant);
        
        return view('livewire.show-traslados', compact('traslados'));
    }

    public function edit(Traslado $traslado)
    { 
     
        if ( $traslado->estadoingresos->id==1) {
            $this->editable=true;
        }
            else
            {
                $this->editable=false;
        }
       
        $this->traslado_id=$traslado->id;
        $this->nombre=$traslado->nombre;
        $this->origen=$traslado->origen->nombre;
        $this->destino=$traslado->destino->nombre;
 
        $this->estados=Estadoingresos::all();
        $this->estadoingresos=$traslado->estadoingresos->id;
        $this->nombreestadoingresos=$traslado->estadoingresos->nombre ;        
        
        $this->traslado_sel = $traslado;

        $detalle=Traslado_Producto::where('traslado_id',$traslado->id)->get();


        //DETALLE
        foreach ($this->orderProduct as $key =>$item)    
        {
            unset ($this->orderProduct[$key]);
        }

        foreach ($detalle as $item)  
        {
            $cod=$item->id;
            
            
                $orderProducts=array(
                    'producto_id'=> $item->id,
                    'producto_codigo'=> $item->producto->codigo,
                    'producto_nombre'=>$item->producto->nombre,
                    'cantidad'=>$item->cantidad,                   
                );
                $this->orderProduct[]=$orderProducts;           
        }        

       
        $this->open_edit=true;


    }

    public function update()
    {
       
        $this->traslado_sel->estadoingresos_id=$this->estadoingresos;               
        $this->traslado_sel->save();  
        if ( $this->estadoingresos==2)
        {
            $deta=Traslado_Producto::where('traslado_id',$this->traslado_sel->id)->get();

            foreach ( $deta as $item)  
            {         
                $quitar=Bodega::where('producto_id',$item->producto_id)
                ->where('ciudad_id',$this->traslado_sel->origen_id)
                ->increment('existencia',-1*($item->cantidad));   

                $poner=Bodega::where('producto_id',$item->producto_id)
                ->where('ciudad_id',$this->traslado_sel->destino_id)
                ->increment('existencia',$item->cantidad);       
            } 

        }
        $this->reset(['open_edit']);
        $this->emitTo('show-ingresos','render');
        $this->emit('alert','Biormed','Traslado actualizado satisfactoriamente');
    }

    
    public function order($sort)
    {
        if ($this->sort = $sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }

    public function delete(Ingreso $ingreso)
    {        
        $ingreso->delete();
    }

    public function pdf()
    {

        $data = [
            'codigo'    => $this->traslado_id,
            'nombre' => $this->nombre,
            'origen'    => $this->origen,
            'destino'    => $this->destino,
            'estado' => $this->nombreestadoingresos,
            'productos' => $this->orderProduct
       ];
       
        $pdfContent = PDF::loadView('livewire.trasladopdf',$data)->output();
        return response()->streamDownload(
        fn () => print($pdfContent),
        "traslado.pdf"
            );
    }
}