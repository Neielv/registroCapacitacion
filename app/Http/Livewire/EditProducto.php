<?php

namespace App\Http\Livewire;

use App\Models\Producto;
use Livewire\Component;

class EditProducto extends Component
{
    public $open=false;
    public $producto;
    protected $rules=[
        'producto.codigo'=>'required|max:20',
        'producto.nombre'=>'required|max:50',
        'producto.descripcion'=>'required|max:200',
        'producto.stock'=>'required|min:1|numeric',
        'producto.stock_minimo'=>'required|min:1|numeric'
    ];

    public function mount(Producto $producto){
        $this->producto=$producto;        
    }

    public function save()
    {

        $this->validate();
        $this->producto->save();
        $this->reset(['open']);
        $this->emitTo('show-productos','render');
        $this->emit('alert','Biormed','Producto actualizado satisfactoriamente');
    }

    public function render()
    {
        return view('livewire.edit-producto');
    }
}
