<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ingreso de productos') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="px-6  py-6 flex items-center">
            <div class="flex items-center ">
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
                <x-jet-label class="px-2">
                    Ingresos
                </x-jet-label>
            </div>
            <x-jet-label class="px-2">
                <x-jet-input class="mx-1" type="text" wire:model="search" placeholder="Ingrese un código">
                    </x-input>
            </x-jet-label>
            <div class="min-w-min">
                @livewire('create-ingreso')
            </div>

        </div>
        @if ($ingresos->count())
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
                                Factura
                            </th>                            
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Descripción
                            </th>
                           <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                FECHA
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
                        @foreach ($ingresos as $ingreso)
                            <tr>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"> {{ $ingreso->id }}</div>

                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"> {{ $ingreso->nombre }}</div>

                                </td>
                                
                               
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $ingreso->descripcion }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"> {{ date('d-m-Y', strtotime($ingreso->created_at)) }}</div>

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"> {{ $ingreso->estadoingresos->nombre }}</div>

                                </td>

                                
                                <td class="px-6 py-4 whitespace-nowrap ext-sm font-medium flex">
                                    <a class="btn btn-green" wire:click="edit({{ $ingreso }})">
                                        <i class="fas fa-edit">
                                        </i>
                                    </a>
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
        @if ($ingresos->hasPages())
            <div class="px-6 py-3">
                {{ $ingresos->links() }}
            </div>
        @endif
    </div>

    <x-jet-dialog-modal wire:model='open_edit'>
        <x-slot name="title">
            Editar ingreso:
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label value="Documento" />
                <x-jet-input wire:model="ingreso.nombre" type="text"  />
                <x-jet-input-error for="ingreso.nombre" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Descripcion" />
                <x-jet-input wire:model="ingreso.descripcion" type="text" class="w-full" />
                <x-jet-input-error for="ingreso.descripcion" />
            </div>                     
           
            <div class="mb-4">
                <x-jet-label value="Estado" />
            <select   wire:model="estadoingresos" readonly="true" class="shadow appearance-none w-full border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline">
                @foreach ($estados as $estado)
                <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
                @endforeach
                </select>
            </div>

            <x-table>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class=" cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                #
                               
                            </th>
                         
                            <th scope="col"
                                class=" cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                Código
                               
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Producto
                            </th>  
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Cantidad
                            </th>                          
                                                         
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($ingreso_producto as $ingreso)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"> {{ $ingreso['indice'] }}</div>

                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"> {{ $ingreso['producto_id'] }}</div>

                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"> {{ $ingreso['producto_nombre'] }}</div>

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"> {{ $ingreso['cantidad'] }}</div>
                                </td>
                               </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </x-table>
         

        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open_edit',false)">
                Cancelar
            </x-jet-secondary-button>
           @if ($editable)
                <x-jet-danger-button wire:click="update" wire:loading.attr="disabled" wire:target="save"
                class="disabled:pacity-25">
                 Actualizar
                </x-jet-danger-button>               
           @endif

        </x-slot>

    </x-jet-dialog-modal>
   

</div>
