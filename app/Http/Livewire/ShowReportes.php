<?php

namespace App\Http\Livewire;

use App\Models\Pedido;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade as PDF;  


class ShowReportes extends Component
{

    use withPagination;
    public $search = '';    
    public $sort = 'id';
    public $direction = 'desc';
    protected $listeners = ['render','generarReporte','downloadReporte'];
    public $cant=10;

    public $open_vendedor =false;
    public $open_cliente =false;
    public $open_producto =false;

    public $tipo_reporte=0;
    public $fecha_desde='01/01/2021';
    public $fecha_hasta='31/12/2021';

    public $datos_detalle;
    public $datos_detalle_p;
    
    public $parametro;

    public function render()
    {    
        $datos=Pedido::Where('pedidos.created_at','>=',$this->fecha_desde)
                ->where('pedidos.created_at','<=',$this->fecha_hasta)
                ->join('users', 'users.id', '=', 'pedidos.user_id')
                ->select('users.name')
                ->selectRaw("user_id as user_id")
                ->selectRaw("SUM(subtotal) as subtotal")
                ->selectRaw("SUM(total) as total")
                ->groupBy('users.name','user_id')
                ->get();
        if ($this->tipo_reporte==1)
        {
            $datos=Pedido::Where('pedidos.created_at','>=',$this->fecha_desde)
                ->where('pedidos.created_at','<=',$this->fecha_hasta)
                ->join('users', 'users.id', '=', 'pedidos.user_id')
                ->select('users.name')
                ->selectRaw("user_id as user_id")
                ->selectRaw("SUM(1) as cantidad")

                ->selectRaw("SUM((CASE WHEN pedidos.estadopedido_id = 2 THEN subtotal ELSE 0 END)) as subtotal_cerrado")
                ->selectRaw("SUM((CASE WHEN pedidos.estadopedido_id = 1 THEN subtotal ELSE 0 END)) as subtotal_abierto")

                ->selectRaw("SUM(subtotal) as subtotal")
                ->selectRaw("SUM(total) as total")
                ->groupBy('users.name','user_id')
                ->get();
        }
        if ($this->tipo_reporte==2)
        {
            $datos=Pedido::Where('pedidos.created_at','>=',$this->fecha_desde)
                ->where('pedidos.created_at','<=',$this->fecha_hasta)
                ->join('clientes', 'clientes.id', '=', 'pedidos.cliente_id')
                ->select('clientes.nombre as name')
                ->selectRaw("cliente_id as cliente_id")
                ->selectRaw("SUM(1) as cantidad")
                

                ->selectRaw("SUM((CASE WHEN pedidos.estadopedido_id = 2 THEN subtotal ELSE 0 END)) as subtotal_cerrado")
                ->selectRaw("SUM((CASE WHEN pedidos.estadopedido_id = 1 THEN subtotal ELSE 0 END)) as subtotal_abierto")

                ->selectRaw("SUM(subtotal) as subtotal")
                ->selectRaw("SUM(total) as total")
                ->groupBy('clientes.nombre','cliente_id')
                ->get();
        }
        if ($this->tipo_reporte==3)
        {
            $datos=Pedido::Where('pedidos.created_at','>=',$this->fecha_desde)
                ->where('pedidos.created_at','<=',$this->fecha_hasta)
                ->join('pedido_producto', 'pedido_producto.pedido_id', '=', 'pedidos.id')
                ->join('productos', 'productos.id', '=', 'pedido_producto.producto_id')
                ->select('productos.nombre as name')
                ->selectRaw("productos.id as producto_id")
                ->selectRaw("SUM( pedido_producto.cantidad) as cantidad")              

                ->selectRaw("SUM((CASE WHEN pedidos.estadopedido_id = 2 THEN pedido_producto.cantidad ELSE 0 END)) as subtotal_cerrado")
                ->selectRaw("SUM((CASE WHEN pedidos.estadopedido_id = 1 THEN pedido_producto.cantidad ELSE 0 END)) as subtotal_abierto")

                ->selectRaw("0 as subtotal")
                ->selectRaw("0 as total")
                ->groupBy('productos.nombre','productos.id')
                ->get();
        }

        if ($this->tipo_reporte==4)
        {
            $datos=Pedido::Where('pedidos.created_at','>=',$this->fecha_desde)
                ->where('pedidos.created_at','<=',$this->fecha_hasta)
                ->where('estadopedido_id',1)
                ->join('pedido_producto', 'pedido_producto.pedido_id', '=', 'pedidos.id')
                ->join('productos', 'productos.id', '=', 'pedido_producto.producto_id')
                ->join('clientes','clientes.id','=','pedidos.cliente_id')
                ->join('users','users.id','=','pedidos.user_id')
                ->select('productos.codigo as producto')
                ->selectRaw("pedidos.id as pedido")
                ->selectRaw("clientes.nombre as cliente")
                ->selectRaw("productos.id as producto_id")
                ->selectRaw("pedido_producto.cantidad as cantidad")
                ->selectRaw("pedidos.created_at as fecha")
                ->selectRaw("users.name as vendedor")

                ->selectRaw("SUM( pedido_producto.cantidad) as cantidades") 
                             

                ->selectRaw("SUM((CASE WHEN pedidos.estadopedido_id = 2 THEN pedido_producto.cantidad ELSE 0 END)) as subtotal_cerrado")
                ->selectRaw("SUM((CASE WHEN pedidos.estadopedido_id = 1 THEN pedido_producto.cantidad ELSE 0 END)) as subtotal_abierto")

                ->selectRaw("0 as subtotal")
                ->selectRaw("0 as total")
                ->groupBy('users.name','pedidos.created_at','pedido_producto.cantidad','pedidos.id','clientes.nombre','productos.codigo','productos.id')
                ->get();
        }
        
        

         
        return view('livewire.show-reportes',compact('datos'));
    }

    public function generarReporte()
    {
        if ($this->tipo_reporte==0)
        {
            $this->emit('error','Biormed','Seleccione un tipo de reporte');
        }
        else
        {
            if($this->fecha_desde==''||$this->fecha_hasta=='' or date($this->fecha_desde)> date($this->fecha_hasta))
            {
                $this->emit('error','Biormed','Fechas incorrectas');
            }
            else
            {
                

            }
        }
        
    
    }

    
    public function detalle_vendedor(int $vendedor_id)
    {     
        $this->parametro=$vendedor_id;
        $pedidos= Pedido::Where('pedidos.created_at','>=',$this->fecha_desde)
        ->where('pedidos.created_at','<=',$this->fecha_hasta)
        ->where('user_id','=',$vendedor_id)
        ->orderBy('pedidos.created_at', 'asc')
        ->Paginate($this->cant);  
         $links = $pedidos->links();   

        $this->datos_detalle= collect($pedidos->items())     ; 
        $this->open_vendedor=true;
    }
    public function cerrarModal_venderos()
    {
         $this->datos_detalle= null; 
        $this->open_vendedor=false;
    }

    public function detalle_cliente(int $cliente_id)
    {     
        $this->parametro=$cliente_id;
        $pedidos= Pedido::Where('pedidos.created_at','>=',$this->fecha_desde)
        ->where('pedidos.created_at','<=',$this->fecha_hasta)
        ->where('cliente_id','=',$cliente_id)
        ->orderBy('pedidos.created_at', 'asc')
        ->Paginate($this->cant);  
         $links = $pedidos->links(); 
        $this->datos_detalle= collect($pedidos->items()) ; 
        $this->open_cliente=true;
    }
    public function cerrarModal_cliente()
    {
         $this->datos_detalle= null; 
        $this->open_cliente=false;
    }
    public function detalle_producto(int $producto_id)
    {     
        $this->parametro=$producto_id;
        $pedidos= Pedido::Where('pedidos.created_at','>=',$this->fecha_desde)
        ->where('pedidos.created_at','<=',$this->fecha_hasta)
        ->join('clientes', 'clientes.id', '=', 'pedidos.cliente_id')
        ->join('pedido_producto', 'pedido_producto.pedido_id', '=', 'pedidos.id')
        ->join('estadopedidos','estadopedidos.id','=','pedidos.estadopedido_id')
       
        ->select('estadopedidos.nombre as nombre_estado')   
        ->selectRaw('pedidos.id as id')
        ->selectRaw('clientes.nombre as nombre')
        ->selectRaw('pedidos.subtotal as subtotal')
        ->selectRaw('pedidos.total as total')     
        ->selectRaw("SUM(pedido_producto.cantidad) as cantidad")
        
        ->where('pedido_producto.producto_id','=',$producto_id)
        ->groupBy('pedidos.id','clientes.nombre','estadopedidos.nombre','pedido_producto.producto_id','subtotal','total')
        ->orderBy('pedidos.created_at', 'asc')
        ->Paginate($this->cant);  
         
        $this->datos_detalle_p= collect($pedidos->items()) ; 
        $this->open_producto=true;
    }
    public function cerrarModal_producto()
    {
         $this->datos_detalle_p= null; 
        $this->open_producto=false;
    }


    public function imprimir(Int $tipo)
    {
        if($tipo==1)
        {               
                $pedidos= Pedido::Where('pedidos.created_at','>=',$this->fecha_desde)
                ->where('pedidos.created_at','<=',$this->fecha_hasta)
                ->where('pedidos.user_id','=',$this->parametro)
                ->join('users','users.id','=','pedidos.user_id')                
                ->join('clientes','clientes.id','=','pedidos.cliente_id')
                ->join('estadopedidos','estadopedidos.id','=','pedidos.estadopedido_id')
                ->select ('pedidos.id as id')
                ->selectRaw ('clientes.nombre as cliente')
                ->selectRaw ('pedidos.subtotal as subtotal')
                ->selectRaw ('pedidos.total as total')
                ->selectRaw ('estadopedidos.nombre as estado')  
                ->selectRaw ('pedidos.devolucion as devolucion')              
                ->selectRaw ('pedidos.factura as factura')  
                ->orderBy('pedidos.created_at', 'asc')
                ->Paginate($this->cant);  
                $links = $pedidos->links();   
            $data = [
                'datos'=> $pedidos,
                'tipo'=>'VENDEDOR'               
             ];
        
     
        $pdfContent = PDF::loadView('livewire.consolidadoVendedor',$data)->output();
        return response()->streamDownload(
        fn () => print($pdfContent),
        "DetalleVendedor.pdf"
            );
        }

        if($tipo==2)
        {               
                $pedidos= Pedido::Where('pedidos.created_at','>=',$this->fecha_desde)
                ->where('pedidos.created_at','<=',$this->fecha_hasta)
                ->where('pedidos.cliente_id','=',$this->parametro)                       
                ->join('clientes','clientes.id','=','pedidos.cliente_id')
                ->join('estadopedidos','estadopedidos.id','=','pedidos.estadopedido_id')
                ->select ('pedidos.id as id')
                ->selectRaw ('clientes.nombre as cliente')
                ->selectRaw ('pedidos.subtotal as subtotal')
                ->selectRaw ('pedidos.total as total')
                ->selectRaw ('estadopedidos.nombre as estado')  
                ->selectRaw ('pedidos.devolucion as devolucion')              
                ->selectRaw ('pedidos.factura as factura')  
                ->orderBy('pedidos.created_at', 'asc')
                ->Paginate($this->cant);  
                $links = $pedidos->links();   
            $data = [
                'datos'=> $pedidos,
                'tipo'=>'CLIENTE'               
             ];
        
     
        $pdfContent = PDF::loadView('livewire.consolidadoVendedor',$data)->output();
        return response()->streamDownload(
        fn () => print($pdfContent),
        "DetalleCliente.pdf"
            );
        }
        if($tipo==3)
        { 
            $data = [
                'datos'=> $this->datos_detalle_p,
                'tipo'=>'PRODUCTO'               
             ];
        
     
        $pdfContent = PDF::loadView('livewire.consolidadoProducto',$data)->output();
        return response()->streamDownload(
        fn () => print($pdfContent),
        "DetalleProducto.pdf"
            );
        }

    }


   
}
