<?php

namespace App\Http\Livewire;

use App\Models\Ciudad;
use App\Models\Estanteria;
use Livewire\Component;
use Illuminate\Support\Str;

class CreateEstanteria extends Component
{
    public $open=false;
    public $codigo,$nombre,$descripcion,$ciudad_id,$largo,$alto,$profundidad;

    protected $rules=[
        'nombre'=>'required|max:50',       
        'descripcion'=>'required|max:200',
        'ciudad_id'=>'required',
        'largo'=>'required|numeric',
        'alto'=>'required|numeric',
        'profundidad'=>'required|numeric',
    ];

   

    
    public function render()
    {
        $bodegas=Ciudad::all();     
        return view('livewire.create-estanteria',compact('bodegas'));
    }


    public function save()
    {
        $this->validate();
        Estanteria::create([
            'codigo'=>$this->codigo,
            'nombre'=>$this->nombre,
            'descripcion'=> $this->descripcion,
            'ciudad_id'=>$this->ciudad_id,
            'largo'=>$this->largo,
            'alto'=>$this->alto,
            'profundidad'=>$this->profundidad,            
        ]);  

        
        $this->reset(['open','codigo','nombre','descripcion','ciudad_id','largo','alto','profundidad']);
        $this->emitTo('show-estanterias','render');
        $this->emit('alert','Biormed','Estantería creado satisfactoriamente');
    }
}
