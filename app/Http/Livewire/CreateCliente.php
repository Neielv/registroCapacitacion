<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use App\Models\TipoCliente;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;

class CreateCliente extends Component
{
    public $open=false;
    public $ci,$nombre,$email,$telefono,$user_id,$tipo_id;

    protected $rules=[
        'ci'=>'required|max:10|min:10|unique:clientes',
        'nombre'=>'required|max:50',       
        'email'=>'required|max:50|email|unique:clientes',
        'telefono'=>'required|max:10',
        'user_id'=>'required',
        'tipo_id'=>'required'  
    ];

    
    public function render()
    {
        $vendedores=User::where('rol_id', 2)->get();    
        
        $tipos=TipoCliente::all();
        return view('livewire.create-cliente',compact('vendedores','tipos'));
    }

    public function save()
    {
       
        $this->validate();
        if($this->tipo_id <1 ||$this->user_id<1)
        {
            $this->emit('error','Biormed','Datos incorrectos');
        }
        else
        {
         
        Cliente::create([
            'ci'=>$this->ci,
            'nombre'=>$this->nombre,            
            'email'=>$this->email,
            'telefono'=>$this->telefono,  
            'user_id'=>$this->user_id,  
            'tipo_id'=>$this->tipo_id,
        ]);  
        $this->reset(['open','ci','nombre','email','telefono','user_id']);
        $this->emitTo('show-clientes','render');
        $this->emit('alert','Biormed','Cliente creado satisfactoriamente');
        //$this->tipo_id

        }
        
        
    }
}


