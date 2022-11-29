<?php

namespace App\Http\Livewire;

use App\Models\Estadoingresos;
use App\Models\Ingreso;
use App\Models\Ingreso_Producto;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;


class ShowIngresos extends Component
{
    use withPagination;
    public $search = ''; 
    public $editable=true;   
    public $sort = 'id';
    public $direction = 'desc';
    protected $listeners = ['render','delete'];
    public $cant=10;
    
    
    public $ingreso;
    public $estados=[];
    public $estadoingresos;
    public $nombreestadoingresos;
    public $producto;    
    public $open_edit =false;

    public $ingreso_producto=[];
    public $ingresoProduct;

    protected $rules=[
        'ingreso.nombre'=>'required|max:50',          
        'ingreso.descripcion'=>'required|max:100'                        
    ];


    public function updatingsearch()
    {
        $this->resetPage();

    }

    public function render()
    {        
        $ingresos = Ingreso::where('nombre', 'like', '%' . $this->search . '%')
        ->orderBy($this->sort, $this->direction)
        ->Paginate($this->cant);
        return view('livewire.show-ingresos', compact('ingresos'));
    }

    public function edit(Ingreso $ingreso)
    { 
        if ( $ingreso->estadoingresos->id==1) {
            $this->editable=true;
        }
            else
            {
                $this->editable=false;
        }
        $this->estado= $ingreso->estadoingresos;  
        $this->nombreestadoingresos=$ingreso->estadoingresos->nombre ; 
        $this->estados=Estadoingresos::all();     
        $this->ingreso = $ingreso;
        
        $this->estadoingresos=$ingreso->estadoingresos->id;



        $this->ingresoProduct=Ingreso_Producto::where('ingreso_id',$ingreso->id)->get();

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



        $this->open_edit=true;
    }

    public function update()
    {
        //$this->emit('alert','Biormed','Ingreso actualizado satisfactoriamente: ' . $this->estadoingresos .' -');
        
        $this->validate();
        $this->ingreso->estadoingresos_id=$this->estadoingresos;       
        $this->ingreso->save();        
        $this->reset(['open_edit']);
        $this->emitTo('show-ingresos','render');
        $this->emit('alert','Biormed','Ingreso actualizado satisfactoriamente');
    
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
}