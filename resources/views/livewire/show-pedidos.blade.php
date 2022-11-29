<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ingreso de pedidos') }}
            
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="px-6  py-6 flex items-center">
            <div class="flex items-center px-2">
                <samp>
                    <x-jet-label class="px-2">
                        Mostrar 
                    </x-jet-label>                    
                </samp>

                <select wire:model="cant" class="relative w-full bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <x-jet-label class="mx-2">
                    Ordenes
                </x-jet-label>
            </div>
            <x-jet-label>
                <x-jet-input class="mx-4" type="text" wire:model="search" placeholder="Ingrese un nombre">
                    </x-input>
            </x-jet-label>
            <div class="min-w-min px-2">
                <x-jet-danger-button wire:click="irAcrearPedido()">
                    Nuevo 
                </x-jet-danger-button> 

               
            </div>
        </div>
        @if ($pedidos->count())
            <x-table>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                         
                            <th scope="col"
                                class=" cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                wire:click="order('id')">
                                Código
                                @if ($sort == 'id')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Cliente
                                @if ($sort == 'cliente_id')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right mt-1"></i>
                                @endif
                                
                            </th>                            
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Fecha
                            </th>
                           <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Total
                            </th> 
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Factura
                            </th> 
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Estado
                            </th> 
                           
                           
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($pedidos as $pedido)
                            <tr>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"> {{ $pedido->id }}</div>

                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"> {{ $pedido->cliente->nombre }}</div>

                                </td>
                                
                               
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ date('d-m-Y', strtotime($pedido->created_at)) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"> {{ $pedido->total }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"> {{ $pedido->factura }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"> {{ $pedido->estadopedido->nombre }}</div>
                                </td>

                                

                                <td class="px-6 py-4 whitespace-nowrap ext-sm font-medium flex">
                                    <a class="btn btn-green" wire:click="edit({{ $pedido }})">
                                        <i class="fas fa-edit">
                                        </i>
                                    </a>
                                    @if ($pedido->estadopedido_id==1)
                                        @if (auth()->user()->rol_id==1)
                                        <!--   
                                        <a class="btn btn-blue ml-2"  wire:click="$emit('cambiarEstado',{{ $pedido->id }})">
                                                <i class="fas fa-calendar">    
                                                </i>
                                            </a> 
                                        -->
                                        <a class="btn btn-blue ml-2"   wire:click="preClose({{ $pedido }})">
                                            <i class="fas fa-calendar">    
                                            </i>
                                        </a> 
                                                  
                                    
                                    <a class="btn btn-red ml-2" wire:click="undo({{ $pedido }})">
                                        <i class="fas fa-undo">    
                                        </i>
                                    </a>
                                    @endif   
                                    @endif   
                                </td>
                                
                            </tr>
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
        @if ($pedidos->hasPages())
            <div class="px-6 py-3">
                {{ $pedidos->links() }}
            </div>
        @endif
    </div>
    <!--MODAL PARA EDITAR / IMPRIMIR-->
        <x-jet-dialog-modal wire:model='open_edit'>
            
            <x-slot name="title">
                
                    Pedido Nº: {{$pedido_id}}
                
            </x-slot>       
            <x-slot name="content">
                @if ($pedidos->count())
                <div class="mb-4">
                    <strong>Cédula: </strong> {{$cliente_ci}}                
                </div>  
                <div class="mb-4">
                    <strong>Nombre: </strong> {{$cliente_nombre}}                
                </div>              
                <div class="mb-4">
                    <strong>Teléfono: </strong> {{$cliente_telefono}}                
                </div>  
                <div class="mb-4">
                    <strong>e-mail: </strong> {{$cliente_email}}                
                
                </div> 
                <div class="mb-4">
                    <strong>Nota de devolución: </strong> {{$numDevolucion}}                
                
                </div> 
                <div class="mb-4">
                    <strong>Factura: </strong> {{$numFactura}}                
                
                </div> 
                <x-table>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <td>
                                <strong>CANT.<strong>
                                </td>
                                <td>
                                <strong> PRODUCTO</strong>
                                </td>
                                <td>
                                <strong> PRECIO</strong>
                                </td>
                                <td>
                                    <strong> SUB TOTAL</strong>
                                </td>                            
                            </tr>
                        </thead>
                        <tbody>
                        
                            @foreach ($orderProduct as $key =>$item)                                                    
                                                
                                                    <tr>
                                                        <td>{{$item['cantidad']}}</td>
                                                        <td>{{$item['nombre']}}</td>
                                                        <td>{{$item['precio']}}</td>
                                                        <td>{{$item['subtotal']}}</td>
                                                        
                                                    </tr>
                                                
                                                    @endforeach
                            <tr>
                                <td colspan="3" style="text-align:right; padding-right: 22px;"><strong> Subtotal</strong></td>
                                <td style="text-align:left; margin-right: 8px;">USD {{$subtotal}}</td>
                            </tr>
                            <tr>
                                <td colspan="3" style="text-align:right; padding-right: 22px;"><strong>Iva</strong></td>
                                <td style="text-align:left; margin-right: 8px;">USD {{$iva}}</td>
                            </tr>
                            <tr>
                                <td colspan="3" style="text-align:right; padding-right: 22px;"><strong>Total</strong></td>
                                <td style="text-align:left; margin-right: 8px;">USD {{$total}}</td>
                            </tr>
                        </tbody>
                    </table>
                </x-table>            
                @endif
            </x-slot>
            <x-slot name="footer">
                @if ($pedidos->count())
                    <x-jet-secondary-button wire:click="$set('open_edit',false)">
                        Cancelar
                    </x-jet-secondary-button>                
                    
                    <x-jet-danger-button wire:click="pdf({{$pedido}})" class="disabled:pacity-25">
                            Imprimir
                    </x-jet-danger-button> 
                @endif
            </x-slot>
        </x-jet-dialog-modal>
    <!--FIN MODAL PARA EDITAR-->
    <!--MODAL DE DEVOLUCIÓN-->
        <x-jet-dialog-modal wire:model='open_undo'>
            
            <x-slot name="title">
                
                    Devolución de Pedido Nº: {{$pedido_id}}
                
            </x-slot>       
            <x-slot name="content">
                @if ($pedidos->count())
                <div class="mb-4">
                    <strong>Cédula: </strong> {{$cliente_ci}}                
                </div>  
                <div class="mb-4">
                    <strong>Nombre: </strong> {{$cliente_nombre}}                
                </div>              
                <div class="mb-4">
                    <strong>Teléfono: </strong> {{$cliente_telefono}}                
                </div>  
                <div class="mb-4">
                    <strong>e-mail: </strong> {{$cliente_email}}   
                </div> 
                <div class="mb-4">
                    <strong>Nota de devolucón: </strong> 
                    <x-jet-input class="mx-4 w-2" style="width:80px;" type="text" wire:model.defer="nota_devolucion" placeholder="00000">
                                                                                                                                                                                            
                    </x-input>  
                </div> 
                <x-table>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <td>
                                <strong>CANT.<strong>
                                </td>
                                <td>
                                    <strong>DEV.<strong>
                                </td>                            
                                <td>
                                <strong> PRODUCTO</strong>
                                </td>
                                <td>
                                <strong> PRECIO</strong>
                                </td>
                                <td>
                                    <strong> SUB TOTAL</strong>
                                </td>                            
                            </tr>
                        </thead>
                        <tbody>
                        
                            @foreach ($orderProduct as $key =>$item)                                                   
                                                
                                                    <tr>
                                                        <td>{{$item['cantidad']}}</td>
                                                        <td>
                                                            <x-jet-input class="mx-4 w-2" style="width:60px;" type="text" wire:model.defer="orderProduct.{{$key}}.undo" placeholder="0" >
                                                                                                                                                                                            
                                                            </x-input>
                                                        </td>
                                                        <td>{{$item['nombre']}}</td>
                                                        <td>{{$item['precio']}}</td>
                                                        <td>{{$item['subtotal']}}</td>                                                     
                                                    </tr>
                                                
                                                    @endforeach
                            <tr>
                                <td colspan="4" style="text-align:right; padding-right: 22px;"><strong> Subtotal</strong></td>
                                <td style="text-align:left; margin-right: 8px;">USD {{$subtotal}}</td>
                            </tr>
                            <tr>
                                <td colspan="4" style="text-align:right; padding-right: 22px;"><strong>Iva</strong></td>
                                <td style="text-align:left; margin-right: 8px;">USD {{$iva}}</td>
                            </tr>
                            <tr>
                                <td colspan="4" style="text-align:right; padding-right: 22px;"><strong>Total</strong></td>
                                <td style="text-align:left; margin-right: 8px;">USD {{$total}}</td>
                            </tr>
                        </tbody>
                    </table>
                </x-table>            
                @endif
            </x-slot>
            <x-slot name="footer">
                @if ($pedidos->count())
                    <x-jet-secondary-button wire:click="$set('open_undo',false)">
                        Cancelar
                    </x-jet-secondary-button>
                    @if ($editable)
                            <x-jet-danger-button wire:click="saveUndo()" wire:loading.attr="disabled" wire:target="save"
                            class="disabled:pacity-25">
                            Guardar
                            </x-jet-danger-button>               
                    @endif
                @endif
            </x-slot>
        </x-jet-dialog-modal>
    <!--FIN DE MODAL DE DEVOCLUCIÓN-->
    <!--MODAL DE CERRAR-->
    <x-jet-dialog-modal wire:model='open_close'>            
        <x-slot name="title">            
                Cerrar el pedido de Pedido Nº: {{$pedido_id}}            
        </x-slot>       
        <x-slot name="content">
            @if ($pedidos->count())
            <div class="mb-4">
                <strong>Cédula: </strong> {{$cliente_ci}}                
            </div>  
            <div class="mb-4">
                <strong>Nombre: </strong> {{$cliente_nombre}}                
            </div>              
            <div class="mb-4">
                <strong>Teléfono: </strong> {{$cliente_telefono}}                
            </div>  
            <div class="mb-4">
                <strong>e-mail: </strong> {{$cliente_email}}   
            </div> 
            <div class="mb-4">
                <strong>Factura: </strong> 
                <x-jet-input class="mx-4 w-2" style="width:80px;" type="text" wire:model.defer="nota_devolucion" placeholder="00000">
                                                                                                                                                                                        
                </x-input>  
            </div> 
            <x-table>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <td>
                            <strong>CANT.<strong>
                            </td>                                                        
                            <td>
                            <strong> PRODUCTO</strong>
                            </td>
                            <td>
                            <strong> PRECIO</strong>
                            </td>
                            <td>
                                <strong> SUB TOTAL</strong>
                            </td>                            
                        </tr>
                    </thead>
                    <tbody>
                    
                        @foreach ($orderProduct as $key =>$item)   
                                                <tr>
                                                    <td>{{$item['cantidad']}}</td>                                                    
                                                    <td>{{$item['nombre']}}</td>
                                                    <td>{{$item['precio']}}</td>
                                                    <td>{{$item['subtotal']}}</td>                                                     
                                                </tr>                                            
                                                @endforeach
                        <tr>
                            <td colspan="4" style="text-align:right; padding-right: 22px;"><strong> Subtotal</strong></td>
                            <td style="text-align:left; margin-right: 8px;">USD {{$subtotal}}</td>
                        </tr>
                        <tr>
                            <td colspan="4" style="text-align:right; padding-right: 22px;"><strong>Iva</strong></td>
                            <td style="text-align:left; margin-right: 8px;">USD {{$iva}}</td>
                        </tr>
                        <tr>
                            <td colspan="4" style="text-align:right; padding-right: 22px;"><strong>Total</strong></td>
                            <td style="text-align:left; margin-right: 8px;">USD {{$total}}</td>
                        </tr>
                    </tbody>
                </table>
            </x-table>            
            @endif
        </x-slot>
        <x-slot name="footer">
            @if ($pedidos->count())
                <x-jet-secondary-button wire:click="$set('open_close',false)">
                    Cancelar
                </x-jet-secondary-button>
                @if ($editable)
                        <x-jet-danger-button wire:click="saveClose()" wire:loading.attr="disabled" wire:target="save"
                        class="disabled:pacity-25">
                        Guardar
                        </x-jet-danger-button>               
                @endif
            @endif
        </x-slot>
    </x-jet-dialog-modal>
    <!--FIN DE MODAL DE CERRAR-->
    @push('js')
        <script src="sweetalert2.all.min.js"></script>
        <script>
            Livewire.on('cambiarEstado', PedidoId =>
                Swal.fire({ 
                title: 'Está seguro de cerrar el pedido?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, cerrar el pedido'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emitTo('show-pedidos', 'cerrarPedido', PedidoId);
                        Swal.fire(
                        'Biormed!',
                        'Pedido cerrado.',
                        'success'
                        )
                    }
                })
            )
        </script>
    @endpush

</div>
