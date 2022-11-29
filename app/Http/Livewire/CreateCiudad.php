<?php

namespace App\Http\Livewire;

use App\Models\Ciudad;
use Livewire\Component;
use Illuminate\Support\Str;

class CreateCiudad extends Component
{
    public $open=false;
    public $codigo,$nombre,$contacto,$telefono;

    protected $rules=[
        'codigo'=>'required|max:5',
        'nombre'=>'required|max:50',       
        'contacto'=>'required|max:200',
        'telefono'=>'required|max:10'       
    ];

    public function save()
    {
        $this->validate();
        Ciudad::create([
            'codigo'=>$this->codigo,
            'nombre'=>$this->nombre,
            'slug'=> Str::slug($this->nombre,'-'),
            'contacto'=>$this->contacto,
            'telefono'=>$this->telefono            
        ]);  
        $this->reset(['open','nombre','codigo','contacto','telefono']);
        $this->emitTo('show-ciudades','render');
        $this->emit('alert','Biormed','Ciudad-Bodega creado satisfactoriamente');
    }
    public function render()
    {
        return view('livewire.create-ciudad');
    }
}
