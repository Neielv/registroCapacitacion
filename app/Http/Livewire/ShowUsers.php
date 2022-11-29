<?php

namespace App\Http\Livewire;
use App\Models\User;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;


class ShowUsers extends Component
{
    use withPagination;
    public $search = '';    
    public $sort = 'id';
    public $direction = 'desc';
    protected $listeners = ['render','delete'];
    public $cant=10;
    
    
    public $user;
    public $roles=[];
    public $rol;
    public $open_edit =false;
    protected $rules=[
        'user.ci'=>'required|max:10|min:10',
        'user.name'=>'required|max:50',       
        'user.email'=>'required|max:50',
        'user.phone'=>'required|max:10',
        'user.rol_id'=>'required'

    ];
 
    

    public function updatingsearch()
    {
        $this->resetPage();

    }

    public function render()
    {        
        $users = User::where('name', 'like', '%' . $this->search . '%')
        ->orderBy($this->sort, $this->direction)
        ->Paginate($this->cant);
        return view('livewire.show-users', compact('users'));
    }

    public function edit(User $user)
    {       
        $this->roles=Role::all();
       
        $this->user = $user;
        $this->open_edit=true;
    }

    public function update()
    {
        $this->validate();
        $this->user->save();
        $this->user->roles()->sync($this->rol);
        $this->reset(['open_edit']);
        $this->emitTo('show-users','render');
        $this->emit('alert','Biormed','Usuario actualizado satisfactoriamente');
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

    public function delete(User $user)
    {        
        $user->delete();
    }
}
