<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nuevo Pedido') }}
        </h2>
    </x-slot>



    <div class="min-h-screen  items-center justify-center bg-gray-50 py-1 px-4 sm:px-6 lg:px-8">



        <div class="shadow sm:rounded-md sm:overflow-hidden">
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                <div class="grid grid-cols-3 gap-6">
                    <div class="col-span-3 sm:col-span-2">
                        <label for="company-website" class="block text-sm font-medium text-gray-700">
                            Cliente
                        </label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <span
                                class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                CI.
                            </span>
                            <input wire:model="search" type="text" name="company-website" id="company-website"
                                class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                                placeholder="Cédula o nombre">

                            <span class="inline-flex items-center px-3 rounded-l-md   text-gray-500 text-sm">
                                @livewire('create-cliente')
                            </span>
                        </div>
                    </div>

                </div>

                <!--PEDIDO-->
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <!--CABECERA-->
                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                        <div class="grid grid-cols-3 gap-6">
                            <div class="col-span-3 sm:col-span-2">
                                <label for="company-website" class="block text-sm font-medium text-gray-700">
                                    Cliente
                                </label>
                                @if ($clientes->count() == 1 && $search != '')
                                    <div class="shadow sm:rounded-md sm:overflow-hidden">
                                        <div class="px-2  flex items-center ">
                                            <div class="px-2  py-1 flex items-center">
                                                Cédula: {{ $clientes[0]->ci }}
                                                {{ $clientes_id=$clientes[0]->id }}
                                               
                                            </div>
                                        </div>
                                        

                                        <div class="px-2  flex items-center ">
                                            <div class="px-2  py-1 flex items-center">
                                                Nombre: {{ $clientes[0]->nombre }}
                                            </div>
                                        </div>

                                        <div class="px-2  flex items-center ">
                                            <div class="px-2  py-1 flex items-center">
                                                Teléfono: {{ $clientes[0]->telefono }}
                                            </div>
                                        </div>
                                        <div class="px-2  flex items-center ">
                                            <div class="px-2  py-1 flex items-center">
                                                Tipo: {{ $clientes[0]->tipo->nombre }}
                                            </div>
                                        </div>
                                        


                                    </div>
                                @else
                                    <div class="px-2  flex items-center ">
                                        <div class="px-2  py-1 flex items-center">
                                            @if ($search == '')
                                                Ingrese el número de cédula o le nombre
                                            @else
                                                Cliente no encontrado
                                            @endif
                                        </div>
                                    </div>
                                @endif

                            </div>

                        </div>


                        <!--SECCION PRODUCTOS-->

                        <div>
                            <label for="about" class="block text-sm font-medium text-gray-700">
                                Producto
                            </label>
                            <div class="shadow sm:rounded-md sm:overflow-hidden ">
                                <div class="px-4 py-5 bg-white space-y-6 sm:p-6 ">
                                    <div class="grid grid-cols-3 gap-6 ">
                                        <div class="col-span-3 sm:col-span-2 ">
                                            <div class="sm:col-span-3 ">
                                                <table>
                                                    <tr>
                                                        <th>
                                                            <td>
                                                                <x-jet-label value="Código" />
                                                                 <x-jet-input type="text" wire:model="codigo_producto" style="width: 140px"/>
                                                
                                                            </td>
                                                            <td>
                                                                <x-jet-label value="Precio" />
                                                                 <x-jet-input type="text" wire:model="precio_producto" style="width: 80px" disabled="disabled"/>
                                                            </td>
                                                            <td>
                                                                <x-jet-label value="Cantidad" />
                                                                <input wire:model.defer="cantidad"
                                                                type="number"
                                                                class="w-12 border border-gray-300 rounded-md shadow-sm  outline-none focus:outline-none text-center w-30 bg-gray-300   items-center sm:text-sm"
                                                                name="cantidad" maxlength="2" value="0" />
                                                            </td>
                                                        </th>
                                                    </tr>
                                                </table>



                                                



                                                <samp>   

                                                    
                                                       
                                                </samp>
                                                
                                            </div>
                                            <div>
                                                {{'Cantidad disponible: '. $maximo}}
                                            </div>
                                        </div class="my-30">

                                        <x-jet-danger-button wire:click="add">
                                            Agregar 
                                        </x-jet-danger-button>  
                                        </div>
                                        </div>
                                    </div>

                                </div>

                               
                                <!--DETALLE-->

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">
                                        Detalle
                                    </label>
                                    <x-table>
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <td>
                                                        CANT.
                                                    </td>
                                                    <td>
                                                        PRODUCTO
                                                    </td>
                                                    <td>
                                                        PRECIO
                                                    </td>
                                                    <td>
                                                        SUB TOTAL
                                                    </td>
                                                    <td>
                                                        QUITAR
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
                                                     <td class="px-1 py-1 whitespace-nowrap ext-sm font-medium flex">
                                                        <a class="btn btn-red ml-2" wire:click="$emit('quitarProducto',{{ $key }})">
                                                            <i class="fas fa-trash">
                    
                                                            </i>
                                                        </a>


                                                     </td>

                                                 </tr>
                                              
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </x-table>
                                </div>
                                <div class="container-fluid mt-5 w-100">
                                    <p class="text-right mb-2">Subtotal: <strong>USD  {{$subtotal}}</strong></p>
                                    <p class="text-right mb-2">Iva: <strong>USD {{$iva}}</strong></p>
                                    <p class="text-right mb-2">Total: <strong> USD{{$total}}</strong></p>
    
                                </div>
                            </div>
                            @if ($clientes->count()==1 && $total!='' && $total!='0' )
                                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                    <button type="submit" wire:click="$emit('grabarQuestion',{{ $clientes->count()==1?  $clientes[0]->id : 0}})"
                                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Guardar
                                    </button>
                                </div>
                            @else
                                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                    <x-jet-secondary-button wire:click="">
                                        Guardar
                                    </x-jet-secondary-button>
                                </div>
                                
                            @endif
                            
                        </div>



                    </div>


                </div>


         @push('js')
        <script src="sweetalert2.all.min.js"></script>
        <script>
            Livewire.on('quitarProducto',key=>
                Swal.fire({ 
                    title: 'Está seguro de elimar el registro?',
                    text: "¡No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, borrar el registro'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emit('remove',key);                        
                        Swal.fire(
                        'Biormed!',
                        'El registro se borró.',
                        'success'
                        )
                    }
                })
            )
        </script>

<script>
    Livewire.on('grabarQuestion',val=>
        Swal.fire({
            title: 'Está seguro de guardar el pedido?',
            text: "El administrador deberá cerrar el pedido",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si guardar!'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emit('grabar',val);                        
                Swal.fire(
                    'Guardar!',
                    'Su pedido se almacenó con éxito.',
                    'success'
                )                
            }
        })
    )
</script>



    @endpush
