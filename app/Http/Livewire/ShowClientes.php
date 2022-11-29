<?php

namespace App\Http\Livewire;
use App\Models\Cliente;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;


class ShowClientes extends Component
{
    use withPagination;
    public $search = '';    
    public $sort = 'id';
    public $direction = 'desc';
    protected $listeners = ['render','delete'];
    public $cant=10;
    
    
    public $cliente;
    public $roles=[];
    public $rol;
    public $open_edit =false;
    protected $rules=[
        'cliente.ci'=>'required|max:10|min:10',
        'cliente.nombre'=>'required|max:50',       
        'cliente.email'=>'required|max:50',
        'cliente.telefono'=>'required|max:10'              
    ];
 
    

    public function updatingsearch()
    {
        $this->resetPage();

    }

    public function render()
    {   
        if (auth()->user()->rol_id==1)  
        {
            $clientes = Cliente::where('nombre', 'like', '%' . $this->search . '%')
      
        ->orderBy($this->sort, $this->direction)
        ->Paginate($this->cant);
            

        }
        else
        {
            $clientes = Cliente::where('nombre', 'like', '%' . $this->search . '%')
        ->where('user_id',auth()->user()->id)
        ->orderBy($this->sort, $this->direction)
        ->Paginate($this->cant);
            

        }
        
        return view('livewire.show-clientes', compact('clientes'));
    }

    public function edit(Cliente $cliente)
    {                      
        $this->cliente = $cliente;
        $this->open_edit=true;
    }

    public function update()
    {
        $this->validate();
        $this->cliente->save();     
        $this->reset(['open_edit']);
        $this->emitTo('show-clientes','render');
        $this->emit('alert','Biormed','Cliente actualizado satisfactoriamente');
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

    public function delete(Cliente $cliente)
    {        
        $cliente->delete();
    }
}
