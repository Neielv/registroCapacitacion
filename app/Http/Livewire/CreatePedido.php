<?php

namespace App\Http\Livewire;

use App\Models\Bodega;
use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\Pedido_Producto;
use App\Models\Producto;
use Livewire\Component;


class CreatePedido extends Component
{

    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    protected $listeners = ['render', 'delete', 'remove', 'grabar'];
    public $cant = 10;
    public $producto_id;
    public $proSeleccionado;
    public $cantidad;
    public $precio;
    public $orderProduct = [];

    public $itemtotal;
    public $subtotal;
    public $iva;
    public $tax = 12;
    public $total;

    public $pedido;
    public $cliente_id;
    public $pedido_producto;
    public $maximo;
    public $ciudad_id;

    public $codigo_producto;
    public $precio_producto;
    public $tipo_cliente;





    public function render()
    {
        $user = auth()->user();
        $clientes = Cliente::Where('user_id', $user->id)
            ->Where('nombre', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->Paginate($this->cant);

            if ($clientes->count()==1)
            {
                $this->tipo_cliente=$clientes[0]->tipo_id ;
            }
        $productos = Producto::all();


        $this->ciudad_id = $user->ciudad->id;

        /*
        if ($this->producto_id>0) 
        { 
            $this->proSeleccionado = Producto::where('id', $this->producto_id)->first();
           
        }
        else
        {
            $this->proSeleccionado = Producto::where('id',  $productos[0]->id)->first();
            $this->cantidad=0;
                    
        }
        */

        $SearchProducto = Producto::where('codigo', '=', $this->codigo_producto)->get();

        if ($SearchProducto->count() == 1) {
            $this->proSeleccionado = $SearchProducto[0];
            
            switch($this->tipo_cliente)
            {
                case 0:
                    $this->precio_producto =  0;
                    break;
                case 1:
                    $this->precio_producto =  $this->proSeleccionado->precio_1;
                    break;
                case 2:
                    $this->precio_producto =  $this->proSeleccionado->precio_2;
                    break;
                case 3:
                    $this->precio_producto =  $this->proSeleccionado->precio_3;
                    break;
            }
           
            $this->cantidad =0;



            $this->producto_id = $this->proSeleccionado->id;
            if ($this->precio != $this->proSeleccionado->precio_1)
                $this->precio = $this->proSeleccionado->precio_1;

            if ($this->ciudad_id > 0 && $this->producto_id > 0) {
                $proSeleccionado = Bodega::where('producto_id', $this->producto_id)
                    ->Where('ciudad_id', $this->ciudad_id)
                    ->get();
                if ($proSeleccionado->count()) {
                    $this->maximo = $proSeleccionado[0]->existencia;
                } else {
                    $this->maximo = 0;
                }
            } else {
                $this->maximo = 0;
            }
        } else {
            $this->precio_producto='';

            $this->maximo = 0;

        }


        return view('livewire.create-pedido', compact('clientes', 'productos'));
    }

    public function add()
    {

        if ($this->producto_id == '' || $this->cantidad == 0 || $this->cantidad == '' || $this->precio == '') {
            $this->emit('error', 'Biormed', 'Datos incorrectos ');
        } else {

            if ($this->cantidad > 0 && $this->cantidad <= $this->maximo) {
                $nombre = $this->proSeleccionado->nombre;
                $this->itemtotal = floatval($this->precio) * floatval($this->cantidad);
                $this->subtotal = floatval($this->subtotal) + floatval($this->itemtotal);
                $this->iva = floatval($this->subtotal) * floatval($this->tax) / 100;
                $this->total = floatval($this->iva) + floatval($this->subtotal);

                $orderProducts = array(
                    'producto_id' => $this->proSeleccionado->id,
                    'nombre' => $this->proSeleccionado->nombre,
                    'cantidad' => $this->cantidad,
                    'precio' => $this->precio,
                    'subtotal' => $this->itemtotal
                );
                $this->orderProduct[] = $orderProducts;

                $this->emit('alert', 'Biormed', 'Producto agregado');
                $this->cantidad = 0;
            } else {

                $this->emit('error', 'Biormed', 'La cantidad no debe ser mayor a: ' . $this->maximo);
            }
        }
    }

    public function remove($key)
    {
        $this->subtotal = $this->subtotal - $this->orderProduct[$key]['subtotal'];
        $this->iva = floatval($this->subtotal) * floatval($this->tax) / 100;
        $this->total = floatval($this->iva) + floatval($this->subtotal);
        unset($this->orderProduct[$key]);
    }
    public function grabar($cliente_id)
    {
        //$this->validate();
        $user = auth()->user();

        $this->pedido = Pedido::create([
            'cliente_id' => $cliente_id,
            'user_id' => $user->id,
            'items' => collect($this->orderProduct)->count(),
            'subtotal' => $this->subtotal,
            'devolucion' => 0,
            'factura' => 0,
            'iva' => $this->iva,
            'total' => $this->total,
            'estadopedido_id' => 1
        ]);

        foreach ($this->orderProduct as $key => $item) {
            $this->pedido_producto = Pedido_Producto::create([
                'pedido_id' => $this->pedido->id,
                'producto_id' => $item['producto_id'],
                'cantidad' => $item['cantidad'],
                'precio' => $item['precio'],
                'subtotal' => $item['subtotal']
            ]);
        }

        return redirect()->to('pedidos');
    }
}
