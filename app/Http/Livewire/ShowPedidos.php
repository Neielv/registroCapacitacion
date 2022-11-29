<?php

namespace App\Http\Livewire;

use App\Models\Estadoingresos;
use App\Models\Ingreso;
use App\Models\Pedido;
use App\Models\Pedido_Producto;
use Barryvdh\DomPDF\Facade as PDF;  
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;



class ShowPedidos extends Component
{
    use withPagination;
    public $search = ''; 
    public $editable=true;   
    public $sort = 'id';
    public $direction = 'desc';
    protected $listeners = ['render','delete','cerrarPedido','pdf'];
    public $cant=10;
    public $open_edit =false;
    public $open_undo =false;
    public $open_close =false;
    public $pedido_1;
 
    //para factura
    
    public $pedido_id;
    public $fecha;
    public $subtotal;
    public $iva;
    public $total;
    public $cliente_ci;
    public $cliente_nombre;
    public $cliente_telefono;
    public $cliente_email;
    public $orderProduct=[];
    public $numDevolucion;
    public $numFactura;
    

    public $undoProduct=[];

    public $nota_devolucion;
    public $tax=12;

   

    
    

    public function updatingsearch()
    {
        $this->resetPage();

    }

    public function render()
    {      
        $user = auth()->user();  
        if (auth()->user()->rol_id==1)  
        {
            $pedidos = Pedido::where('id', 'like', '%' . $this->search . '%')          
            ->orderBy($this->sort, $this->direction)        
            ->Paginate($this->cant);

        }
        else
        {
           
            $pedidos = Pedido::where('id', 'like', '%' . $this->search . '%')
            ->where('user_id',$user->id)
            ->orderBy($this->sort, $this->direction)        
            ->Paginate($this->cant);
        }        
        
        $this->pedido_1=$pedidos[0];       
        return view('livewire.show-pedidos', compact('pedidos'));
    }
    
    


    public function edit (Pedido $pedido)
    {     
        $this->var=$pedido->id;    
        $this->pedido_1=$pedido;
        //CABECERA
        $this->pedido_id=$pedido->id;
        $this->fecha=strtotime($pedido->created_at);
        $this->subtotal=$pedido->subtotal;
        $this->iva=$pedido->iva;
        $this->total=$pedido->total;
        $this->cliente_ci=$pedido->cliente->ci;
        $this->cliente_nombre=$pedido->cliente->nombre;
        $this->cliente_telefono=$pedido->cliente->telefono;
        $this->cliente_email=$pedido->cliente->email;
        $this->numFactura=$pedido->factura;
        $this->numDevolucion=$pedido->devolucion;


        //DETALLE
        foreach ($this->orderProduct as $key =>$item)    
        {
            unset ($this->orderProduct[$key]);
        }

        foreach ($pedido->productos as $item)  
        {
            $cod=$item->id;
            
             $productoPedido=Pedido_Producto::
                where('pedido_id', '=', $this->pedido_id)
                ->where('producto_id', '=', $cod)->first();               
                $orderProducts=array(
                    'producto_id'=> $item->id,
                    'nombre'=> $item->nombre,
                    'cantidad'=>$productoPedido->cantidad,
                    'precio'=>$productoPedido->precio,
                    'subtotal'=>$productoPedido->subtotal
                );
                $this->orderProduct[]=$orderProducts;           
        }        

        $this->open_edit=true;
    }

    public function update()
    {
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

    

    public function irAcrearPedido()
    {
        
        return redirect()->to('pedido');
    }

    public function undo (Pedido $pedido)
    {    
        $indice=0; 
        $this->var=$pedido->id;    
        $this->pedido_1=$pedido;
        //CABECERA
        $this->pedido_id=$pedido->id;
        $this->fecha=strtotime($pedido->created_at);
        $this->subtotal=$pedido->subtotal;
        $this->iva=$pedido->iva;
        $this->total=$pedido->total;
        $this->cliente_ci=$pedido->cliente->ci;
        $this->cliente_nombre=$pedido->cliente->nombre;
        $this->cliente_telefono=$pedido->cliente->telefono;
        $this->cliente_email=$pedido->cliente->email;
        $this->nota_devolucion=$pedido->devolucion;
        if ($pedido->devolucion!=0)
        {
            $this->editable=false;
        }

        //DETALLE
        foreach ($this->orderProduct as $key =>$item)    
        {
            unset ($this->orderProduct[$key]);
        }
                


        foreach ($pedido->productos as $item)  
        {
            $cod=$item->id;
            
             $productoPedido=Pedido_Producto::
                where('pedido_id', '=', $this->pedido_id)
                ->where('producto_id', '=', $cod)->first();

               
                $orderProducts=array(
                    'id'=> $productoPedido->id,
                    'pedido_id'=>$pedido->id,
                    'producto_id'=> $item->id,
                    'nombre'=> $item->nombre,
                    'cantidad'=>$productoPedido->cantidad,
                    'precio'=>$productoPedido->precio,
                    'subtotal'=>$productoPedido->subtotal,
                    'undo'=>0
                );
                

                $this->orderProduct[]=$orderProducts;  
                $this->undoProduct[$indice]=0;
                $indice++;
        }
        

        $this->open_undo=true;
    }

    public function preClose (Pedido $pedido)
    {    
        $indice=0; 
        $this->var=$pedido->id;    
        $this->pedido_1=$pedido;
        //CABECERA
        $this->pedido_id=$pedido->id;
        $this->fecha=strtotime($pedido->created_at);
        $this->subtotal=$pedido->subtotal;
        $this->iva=$pedido->iva;
        $this->total=$pedido->total;
        $this->cliente_ci=$pedido->cliente->ci;
        $this->cliente_nombre=$pedido->cliente->nombre;
        $this->cliente_telefono=$pedido->cliente->telefono;
        $this->cliente_email=$pedido->cliente->email;
        $this->nota_devolucion=$pedido->devolucion;
        if ($pedido->devolucion!=0)
        {
            $this->editable=false;
        }

        //DETALLE
        foreach ($this->orderProduct as $key =>$item)    
        {
            unset ($this->orderProduct[$key]);
        }
                


        foreach ($pedido->productos as $item)  
        {
            $cod=$item->id;
            
             $productoPedido=Pedido_Producto::
                where('pedido_id', '=', $this->pedido_id)
                ->where('producto_id', '=', $cod)->first();

               
                $orderProducts=array(
                    'id'=> $productoPedido->id,
                    'pedido_id'=>$pedido->id,
                    'producto_id'=> $item->id,
                    'nombre'=> $item->nombre,
                    'cantidad'=>$productoPedido->cantidad,
                    'precio'=>$productoPedido->precio,
                    'subtotal'=>$productoPedido->subtotal,
                    'undo'=>0
                );
                

                $this->orderProduct[]=$orderProducts;  
                $this->undoProduct[$indice]=0;
                $indice++;
        }
        

        $this->open_close=true;
    }

    public function saveUndo ()
    { 
        $ped=0;
        $subtotal=0;
                
        if($this->nota_devolucion=='0' || $this->nota_devolucion=='')
        {
             $this->emit('error','Biormed','Número de devolución incorrecta');
            
            return;
        }
        else
        {         
            foreach ($this->orderProduct as $key =>$item)  
            {
            $registro= Pedido_Producto::where('id', $item['id'])            
            ->firstOrFail();

            $registro->cantidad=$item['cantidad']-$item['undo'];
            $registro->subtotal=$item['precio']*($item['cantidad']-$item['undo']);

            $registro->save();
            $ped=$item['pedido_id'];
            $subtotal+=$registro->subtotal;
             }    
             
             $pedido= Pedido::where('id', $ped)            
            ->firstOrFail();
            $pedido->devolucion=$this->nota_devolucion;
            $pedido->subtotal=$subtotal;
            $pedido->iva=floatval($pedido->subtotal)*floatval($this->tax)/100;
            $pedido->total=$subtotal + $pedido->iva;
            $pedido->save();

             $this->emit('alert','Biormed','Devolución realizada con éxito:');

        }
        $this->open_undo=false;
    }
    public function saveClose ()
    { 
        $ped=0;
        $subtotal=0;
                
        if($this->nota_devolucion=='0' || $this->nota_devolucion=='')
        {
             $this->emit('error','Biormed','Número de devolución incorrecta');
            
            return;
        }
        else
        {        
            foreach ($this->orderProduct as $key =>$item)  
            {            
                 $ped=$item['pedido_id'];
           
             }    
            $pedido= Pedido::where('id', $ped)            
            ->firstOrFail();
            $pedido->estadopedido_id=2;            
            $pedido->factura=$this->nota_devolucion;
           
            $pedido->save();

             $this->emit('alert','Biormed','Le pedido se cerró correctamente');

        }
        $this->open_undo=false;
    }
    public function cerrarPedido(Pedido $pedido)
    { 
        $pedido->estadopedido_id=2;
        $pedido->save();

    }

    
    public function pdf(Pedido $pedido)
    {
       
        
        $data = [
            'datos'    => $this->pedido_1,
            'subtotal' =>$this->subtotal,
            'fecha' => $this->fecha,
            'cedula' =>  $this->cliente_ci,
            'cliente' => $this->cliente_nombre,
            'telefono'=> $this->cliente_telefono,
            'devolucion'=> $this->nota_devolucion,
            'factura'=> $this->numFactura,
            'email'=>$this->cliente_email,
            'iva' => $this->iva,
            'total' =>$this->total,
            'orderProduct' => $this->orderProduct
       ];
       
        $pdfContent = PDF::loadView('livewire.pdf',$data)->output();
        return response()->streamDownload(
        fn () => print($pdfContent),
        "notadepedido.pdf"
            );
    }
    

   


}