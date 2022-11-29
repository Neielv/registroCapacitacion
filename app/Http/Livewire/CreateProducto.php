<?php

namespace App\Http\Livewire;

use App\Models\Producto;
use Livewire\Component;
use Illuminate\Support\Str;

class CreateProducto extends Component
{
    public $open=false;
    public $codigo,$nombre,$descripcion,$stock=0,$stock_minimo=0,$precio_1=0,$precio_2=0,$precio_3=0;
    protected $rules=[        
        'codigo'=>'required|max:20|unique:productos',
        'nombre'=>'required|max:50|unique:productos',
        'descripcion'=>'required|max:200',
        'stock'=>'required|min:1|numeric',
        'stock_minimo'=>'required|min:1|numeric',
        'precio_1'=>'required|numeric|min:0|max:99999.99',
        'precio_2'=>'required|numeric|min:0|max:99999.99',
        'precio_3'=>'required|numeric|min:0|max:99999.99'
    ];

    public function save()
    {

        $this->validate();
        Producto::create([
            'codigo'=>$this->codigo,
            'nombre'=>$this->nombre,
            'slug'=> Str::slug($this->nombre,'-'),
            'descripcion'=>$this->descripcion,
            'stock'=>$this->stock,
            'stock_minimo'=>$this->stock_minimo,
            'precio_1'=>$this->precio_1,
            'precio_2'=>$this->precio_2,
            'precio_3'=>$this->precio_3
        ]);  
        $this->reset(['open','nombre','codigo','descripcion','stock','stock_minimo','precio_1','precio_2','precio_3']);
        $this->emitTo('show-productos','render');
        $this->emit('alert','Biormed','Producto creado satisfactoriamente');
    }
    public function render()
    {
        return view('livewire.create-producto');
    }

   
}
