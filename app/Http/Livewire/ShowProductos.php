<?php

namespace App\Http\Livewire;

use App\Models\Producto;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade as PDF;  

class ShowProductos extends Component
{
    use withPagination;
    public $search = '';    
    public $sort = 'id';
    public $direction = 'desc';
    protected $listeners = ['render','delete'];
    public $cant=10;
    public $reporte;
    public $orderProduct=[];
    
    public $produc;
    public $open_edit =false;
    protected $rules=[
        'producto.codigo'=>'required|max:20',
        'producto.nombre'=>'required|max:50',        
        'producto.descripcion'=>'required|max:200',
        'producto.stock'=>'required|min:1|numeric',
        'producto.stock_minimo'=>'required|min:1|numeric',
        'producto.precio_1'=>'required|numeric|min:0|max:99999.99',
        'producto.precio_2'=>'required|numeric|min:0|max:99999.99',
        'producto.precio_3'=>'required|numeric|min:0|max:99999.99'
    ];

    public function updatingsearch()
    {
        $this->resetPage();

    }
    public function render()
    {
        $productos = Producto::where('codigo', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->Paginate($this->cant);
        
        return view('livewire.show-productos', compact('productos'));
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

    public function edit(Producto $producto)
    {
        $this->producto = $producto;
        $this->open_edit=true;
    }

    public function update()
    {        
        $this->validate();
        $this->producto->save();
        $this->reset(['open_edit']);
        $this->emitTo('show-productos','render');
        $this->emit('alert','Biormed','Producto actualizado satisfactoriamente');

        
    }

    public function delete(Producto $producto)
    {        
        $producto->delete();
    }

    public function pdf()
    {
        $productos = Producto::where('codigo', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->get();

        $secuencia=0;
         //DETALLE
         foreach ($this->orderProduct as $key =>$item)    
         {
             unset ($this->orderProduct[$key]);
         }
 
         foreach ($productos as $item)  
         {
                $secuencia=$secuencia+1;
                 $orderProducts=array(
                     'secuencia'=>$secuencia,
                     'codigo'=> $item->codigo,
                     'nombre'=> $item->nombre,
                     'descripcion'=>$item->descripcion,
                     'existencia'=>$item->stock,
                     'precio_1'=> $item->precio_1,
                     'precio_2'=> $item->precio_2,
                     'precio_3'=> $item->precio_3,                     
                 );
                 $this->orderProduct[]=$orderProducts;           
         }       


        

        $data = [
            'datos'    => 'o',
            'productos' => $this->orderProduct
       ];
       
        $pdfContent = PDF::loadView('livewire.productospdf',$data)->output();
        return response()->streamDownload(
        fn () => print($pdfContent),
        "productos.pdf"
            );
    }

}
