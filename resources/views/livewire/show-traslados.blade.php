<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Traslado de productos') }}
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
                <select wire:model="cant"
                    class="relative w-full bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <x-jet-label class="px-2">
                    Traslados
                </x-jet-label>
            </div>
            <x-jet-label class="px-2">
                <x-jet-input class="mx-1" type="text" wire:model="search" placeholder="Ingrese un código">
                    </x-input>
            </x-jet-label>
            <div class="min-w-min">
                @livewire('create-traslado')
            </div>

        </div>
        @if ($traslados->count())
            <x-table>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>

                            <th scope="col"
                                class=" cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                wire:click="order('id')">
                                Código

                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nombre
                            </th>

                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Desde
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Hasta
                            </th>

                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Fecha
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
                        @foreach ($traslados as $traslado)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"> {{ $traslado->id }}</div>

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ $traslado->nombre }}
                                    </div>

                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $traslado->origen->nombre }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $traslado->destino->nombre }}
                                </td>


                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ date('d-m-Y', strtotime($traslado->created_at)) }}</div>

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $traslado->estadoingresos->nombre }}
                                </td>


                                <td class="px-6 py-4 whitespace-nowrap ext-sm font-medium flex">
                                    <a class="btn btn-green" wire:click="edit({{ $traslado }})">
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
        @if ($traslados->hasPages())
            <div class="px-6 py-3">
                {{ $traslados->links() }}
            </div>
        @endif
    </div>

    <x-jet-dialog-modal wire:model='open_edit'>
        <x-slot name="title">
            Editar traslado:
        </x-slot>
        <x-slot name="content">
            @if ($traslado_sel)
                <table>
                    <tr>
                        <td>
                        <th>
                            <div class="mb-4">
                                <x-jet-label value="Código" />
                                <x-jet-input wire:model="traslado_id" type="text" class="w-full"
                                    disabled="disabled" />

                            </div>
                        </th>
                        <th>
                            <div class="mb-4">
                                <x-jet-label value="Nombre" />
                                <x-jet-input wire:model="nombre" type="text" class="w-full"
                                    disabled="disabled" />

                            </div>
                        </th>
                        </td>
                    </tr>
                    <tr>
                        <th>
                        <td>
                            <div class="mb-4">
                                <x-jet-label value="Origen" />
                                <x-jet-input wire:model="origen" type="text" class="w-full"
                                    disabled="disabled" />

                            </div>
                        </td>
                        <td>
                            <div class="mb-4">
                                <x-jet-label value="Destino" />
                                <x-jet-input wire:model="destino" type="text" class="w-full"
                                    disabled="disabled" />

                            </div>
                        </td>
                        </th>
                        <th>
                        </th>
                    </tr>
                </table>


                <div class="mb-4">
                    <x-jet-label value="Estado" />
                    <select wire:model="estadoingresos" readonly="true"
                        class="shadow appearance-none w-full border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline">
                        @foreach ($estados as $estado)
                            <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
                        @endforeach
                    </select>
                </div>


            @endif

            <x-table>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <td>
                                <strong>CODIGO.<strong>
                            </td>

                            <td>
                                <strong>PRODUCTO</strong>
                            </td>
                            <td>
                                <strong> CANTIDAD</strong>
                            </td>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($orderProduct as $key => $item)

                            <tr>

                                <td>{{ $item['producto_codigo'] }}</td>
                                <td>{{ $item['producto_nombre'] }}</td>
                                <td>{{ $item['cantidad'] }}</td>
                            </tr>

                        @endforeach

                    </tbody>
                </table>
            </x-table>

        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="pdf()">
                Imprimir 
            </x-jet-secondary-button>
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
    @push('js')
        <script src="sweetalert2.all.min.js"></script>
        <script>
            Livewire.on('borrarUser', CiudadId =>
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emitTo('show-users', 'delete', UserId);
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            )
        </script>
    @endpush

</div>
