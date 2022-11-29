<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ciudades-Bodegas') }}
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
                    Productos
                </x-jet-label>
            </div>
            <x-jet-label class="px-2">
                <x-jet-input class="mx-1" type="text" wire:model="search" placeholder="Ingrese un código">
                    </x-input>
            </x-jet-label>
            <div class="min-w-min">
                @livewire('create-ciudad')
            </div>

        </div>
        @if ($ciudades->count())
            <x-table>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                wire:click="order('codigo')">
                                Código
                                @if ($sort == 'codigo')
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
                                class=" cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                wire:click="order('nombre')">
                                Nombre
                                @if ($sort == 'nombre')
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
                                Contacto
                            </th>
                            <th scope="col"
                                class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Teléfono
                            </th>
                            
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($ciudades as $ciudad)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $ciudad->codigo }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"> {{ $ciudad->nombre }}</div>

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $ciudad->contacto }}

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $ciudad->telefono }}
                                </td>
                                 <td class="px-6 py-4 whitespace-nowrap ext-sm font-medium flex">
                                   <a class="btn btn-green" wire:click="edit({{ $ciudad }})">
                                        <i class="fas fa-edit">
                                        </i>
                                    </a>

                                 
                                    <a class="btn btn-red ml-2" wire:click="$emit('borrarCiudad',{{ $ciudad->id }})">
                                        <i class="fas fa-trash">

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
        @if ($ciudades->hasPages())
            <div class="px-6 py-3">
                {{ $ciudades->links() }}
            </div>
        @endif
    </div>

    <x-jet-dialog-modal wire:model='open_edit'>
        <x-slot name="title">
            Editar la ciudad:
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label value="Código" />
                <x-jet-input wire:model="ciudad.codigo" type="text" />
                <x-jet-input-error for="ciudad.codigo" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Nombre" />
                <x-jet-input wire:model="ciudad.nombre" type="text" class="w-full" />
                <x-jet-input-error for="ciudad.nombre" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Dirección" />
                <x-jet-input wire:model="ciudad.contacto" type="text" class="w-full" />
                <x-jet-input-error for="ciudad.contacto" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Teléfono" />
                <x-jet-input wire:model="ciudad.telefono" type="text" />
                <x-jet-input-error for="ciudad.telefono" />
            </div>

        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open_edit',false)">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="update" wire:loading.attr="disabled" wire:target="save"
                class="disabled:pacity-25">
                Actualizar
            </x-jet-danger-button>

        </x-slot>

    </x-jet-dialog-modal>
    @push('js')
        <script src="sweetalert2.all.min.js"></script>
        <script>
            Livewire.on('borrarCiudad',CiudadId=>
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
                   Livewire.emitTo('show-ciudades','delete',CiudadId);  
                    Swal.fire(
                        'Biormed!',
                        'El registro se borró.',
                        'success'
                    )
                }
            })
            )
        </script>
    @endpush

</div>
