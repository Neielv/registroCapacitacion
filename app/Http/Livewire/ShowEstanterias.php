<?php

namespace App\Http\Livewire;

use App\Models\Estanteria;
use Livewire\Component;
use Livewire\WithPagination;

class ShowEstanterias extends Component
{
    use withPagination;
    public $search = '';    
    public $sort = 'id';
    public $direction = 'desc';
    protected $listeners = ['render','delete'];
    public $cant=10;
    
    public $ciudad;
    public $open_edit =false;
    protected $rules=[
        'ciudad.codigo'=>'required|max:5',
        'ciudad.nombre'=>'required|max:50',       
        'ciudad.contacto'=>'required|max:200',
        'ciudad.telefono'=>'required|max:10'       
    ];

    public function render()
    {
        $estanterias = Estanteria::where('nombre', 'like', '%' . $this->search . '%')
        ->orderBy($this->sort, $this->direction)
        ->Paginate($this->cant);
        
        return view('livewire.show-estanterias',compact('estanterias'));
    }
    public function updatingsearch()
    {
        $this->resetPage();
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
}
