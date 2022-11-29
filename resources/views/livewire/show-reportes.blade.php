<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reportes') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
        <!-- This example requires Tailwind CSS v2.0+ -->
        
            <!--Fechas-->
  
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
                <div  style="float: left; ">
                    <x-jet-label for="date_of_birth" value="Desde" />
                    <x-jet-input id="date_of_birth" type="date"  wire:model.defer="fecha_desde" />
                </div>
                <div style="float: left; padding-left: 12px ">
                    <x-jet-label for="date_of_birth" value="Hasta" />
                    <x-jet-input id="date_of_birth" type="date"  wire:model.defer="fecha_hasta" />
                </div>
            </div>
             <!--Opciones-->
             
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12" >
                <br/>
                <hr/>
                <x-jet-label>Opciones</x-jet-label>
                <input wire:model.defer="tipo_reporte" name="generall" type="radio" value="1" /> Resumen por Vendedor<br>
                <input wire:model.defer="tipo_reporte" name="general1" type="radio" value="2" /> Resumen por Cliente<br>
                <input wire:model.defer="tipo_reporte" name="general2" type="radio" value="3" /> Resumen por Producto<br>
                <input wire:model.defer="tipo_reporte" name="general3" type="radio" value="4" /> Pedidos pendientes <br>

            </div>
            <div class="max-w-7xl mx-auto px-1 sm:px-6 lg:px-8 py-1" >
                <x-jet-danger-button wire:click="generarReporte()">
                    Generar 
                </x-jet-danger-button> 
                @if ($datos->count())
                <x-jet-secondary-button  wire:click="" class='form-input rounded-md shadow-sm bg-blue-600'>
                    Exportar..
                </x-jet-secondary-button> 
                @endif
               
            </div>
         

            <!--Cuerpo del reporte-->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
                <!-- This example requires Tailwind CSS v2.0+ -->
                
                @if ($datos->count())
                    <x-table>
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                @if ($tipo_reporte<4)
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        @if ($tipo_reporte==1)
                                        Vendedor 
                                        @endif
                                        @if ($tipo_reporte==2)
                                        Cliente 
                                        @endif
                                        @if ($tipo_reporte==3)
                                        Producto 
                                        @endif
                                        
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Pedidos
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        @if ($tipo_reporte!=3)(usd)@endif  Confirmador
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        @if ($tipo_reporte!=3)(usd)@endif Pendiente
                                    </th>
                                    @if ($tipo_reporte!=3)
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Total pedidos sin iva
                                            
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Total pedidos con iva
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            detalle
                                        </th>
                                    @endif
                                    
                                </tr>
                                <!--REPORTE PENDIENTES-->
                                @else
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        
                                        Cliente 
                                        
                                        
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Pedido
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Producto
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                         Cantidad
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                         Fecha
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                         Vendedor
                                    </th>
                                                                       
                                </tr>
                                    
                                @endif
                                
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($datos as $dato)
                                @if ($tipo_reporte<4)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900"> {{ $dato->name }}</div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900"> {{ $dato->cantidad }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900"> {{ $dato->subtotal_cerrado }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900"> {{ $dato->subtotal_abierto }}</div>
                                        </td>
                                        @if ($tipo_reporte!=3)
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900"> {{ $dato->subtotal }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900"> {{ $dato->total }}</div>
                                            </td>
                                        @endif
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($tipo_reporte==1)
                                                <a class="btn btn-green" wire:click="detalle_vendedor( {{$dato->user_id}})">
                                                    <i class="fas fa-edit">
                                                    </i>
                                                </a>                                                    
                                            @endif
                                            @if ($tipo_reporte==2)
                                                <a class="btn btn-green" wire:click="detalle_cliente({{$dato->cliente_id}})">
                                                    <i class="fas fa-edit">
                                                    </i>
                                                </a>                                                    
                                            @endif
                                            @if ($tipo_reporte==3)
                                                <a class="btn btn-green" wire:click="detalle_producto({{$dato->producto_id}})">
                                                    <i class="fas fa-edit">
                                                    </i>
                                                </a>                                                    
                                            @endif
                                            
                                        </td>
                                        
                                    </tr>
                               @else
                               <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"> {{ $dato->cliente }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"> {{ $dato->pedido }}</div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"> {{ $dato->producto }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"> {{ $dato->cantidad }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"> {{ $dato->fecha }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"> {{ $dato->vendedor }}</div>
                                </td>
                                
                               
                                
                            </tr>
                                    
                                @endif
                                   
                                @endforeach
                                <!-- More people... -->
                            </tbody>
                        </table>
                    </x-table>
                @else
                    <div class="px-6 py-4">
                        <br>
                        No se encontraron coincidencias
                    </div>
                @endif
               
            </div>
             
    </div>

    <x-jet-dialog-modal wire:model='open_vendedor'>
        <x-slot name="title">
            Resumen por vendedor:
        </x-slot>
        <x-slot name="content">

            <strong>Desde: </strong> {{$fecha_desde}}<br>
            <strong>Hasta: </strong>{{$fecha_hasta}}
        
        @if ($datos_detalle)
        <x-table>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <strong>
                        <th>id</th>
                        <th>Cliente</th>
                        <th>Subtotal</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Nota devolución</th>
                        <th>Factura</th>
                        </strong>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @if ($datos_detalle->count())
                        @foreach ($datos_detalle as $pedido)
                            <tr>
                            
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"> {{ $pedido->id }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"> {{ $pedido->cliente->nombre }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"> {{ $pedido->subtotal }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"> {{ $pedido->total }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"> {{ $pedido->estadopedido->nombre }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"> {{ $pedido->devolucion }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"> {{ $pedido->factura }}</div>
                                </td>
                                
                            </tr>
                        @endforeach
                    @endif
                    <!-- More people... -->
                </tbody>
            </table>
        </x-table>
    @else
        <div class="px-6 py-4">
            <br>
            No se encontraron coincidencias
        </div>
        @endif
            


        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="cerrarModal_venderos()">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="imprimir(1)" wire:loading.attr="disabled" wire:target="save"
                class="disabled:pacity-25">
                Imprirmir
            </x-jet-danger-button>

        </x-slot>

    </x-jet-dialog-modal>

<!--MODAD DE DETALLE POR CLIENTE-->

    <x-jet-dialog-modal wire:model='open_cliente'>
        <x-slot name="title">
            Resumen por cliente
        </x-slot>
        <x-slot name="content">
        <strong>Desde: </strong> {{$fecha_desde}}<br>
        <strong>Hasta: </strong>{{$fecha_hasta}}
        @if ($datos_detalle)
        <x-table>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <strong>
                        <th>id</th>
                        <th>Cliente</th>
                        <th>Subtotal</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Nota devolución</th>
                        <th>Factura</th>
                        </strong>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @if ($datos_detalle->count())
                        @foreach ($datos_detalle as $pedido)
                            <tr>
                            
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"> {{ $pedido->id }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"> {{ $pedido->cliente->nombre }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"> {{ $pedido->subtotal }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"> {{ $pedido->total }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"> {{ $pedido->estadopedido->nombre }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"> {{ $pedido->devolucion }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"> {{ $pedido->factura }}</div>
                                </td>
                                
                            </tr>
                        @endforeach
                    @endif
                    <!-- More people... -->
                </tbody>
            </table>
        </x-table>
    @else
        <div class="px-6 py-4">
            <br>
            No se encontraron coincidencias
        </div>
        @endif
            


        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="cerrarModal_cliente()">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="imprimir(2)" wire:loading.attr="disabled" wire:target="save"
                class="disabled:pacity-25">
                Imprimir
            </x-jet-danger-button>

        </x-slot>

    </x-jet-dialog-modal>


<!--MODAL DE DETALLE POR PRODUCTO-->

<x-jet-dialog-modal wire:model='open_producto'>
    <x-slot name="title">
        Resumen por producto
    </x-slot>
    <x-slot name="content">
    <strong>Desde: </strong> {{$fecha_desde}}<br>
    <strong>Hasta: </strong>{{$fecha_hasta}}
    @if ($datos_detalle_p)
    <x-table>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <strong>
                    <th>id</th>
                    <th>Cliente</th>
                    <th>Subtotal</th>
                    <th>Total</th>
                    <th>Estado</th>                    
                    <th>Cantidad</th>
                    </strong>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">               
                @if ($datos_detalle_p->count())
                    @foreach ($datos_detalle_p as $pedido)
                        <tr>
                        
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900"> {{ $pedido->id }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900"> {{ $pedido->nombre}}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900"> {{ $pedido->subtotal }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900"> {{ $pedido->total }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900"> {{ $pedido->nombre_estado }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900"> {{ $pedido->cantidad }}</div>
                            </td>
                            
                            
                        </tr>
                    @endforeach
                @endif
                <!-- More people... -->
            </tbody>
        </table>
    </x-table>
@else
    <div class="px-6 py-4">
        <br>
        No se encontraron coincidencias
    </div>
    @endif
        


    </x-slot>
    <x-slot name="footer">
        <x-jet-secondary-button wire:click="cerrarModal_producto()">
            Cancelar
        </x-jet-secondary-button>
        <x-jet-danger-button wire:click="imprimir(3)" wire:loading.attr="disabled" wire:target="save"
            class="disabled:pacity-25">
            Imprimir
        </x-jet-danger-button>

    </x-slot>

</x-jet-dialog-modal>

</div>
