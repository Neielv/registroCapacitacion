<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Usuarios') }}
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
                @livewire('create-user')
            </div>

        </div>
        @if ($users->count())
            <x-table>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Cédula
                            </th>
                            <th scope="col"
                                class=" cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                wire:click="order('name')">
                                Nombre
                                @if ($sort == 'name')
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
                                Correo
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Teléfono
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Ciudad
                            </th>

                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($users as $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"> {{ $user->ci }}</div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"> {{ $user->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $user->email }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $user->phone }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $user->ciudad->nombre }}
                                </td>


                                <td class="px-6 py-4 whitespace-nowrap ext-sm font-medium flex">
                                    <a class="btn btn-green" wire:click="edit({{ $user }})">
                                        <i class="fas fa-edit">
                                        </i>
                                    </a>


                                    <a class="btn btn-red ml-2" wire:click="$emit('borrarUser',{{ $user->id }})">
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
        @if ($users->hasPages())
            <div class="px-6 py-3">
                {{ $users->links() }}
            </div>
        @endif
    </div>

    <x-jet-dialog-modal wire:model='open_edit'>
        <x-slot name="title">
            Editar usuario:
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label value="Nombre" />
                <x-jet-input wire:model="user.name" type="text" class="w-full" />
                <x-jet-input-error for="user.name" />
            </div>
            <div class="mb-4">
                <x-jet-label value="E-mail" />
                <x-jet-input wire:model="user.email" type="text" class="w-full" />
                <x-jet-input-error for="user.email" />
            </div>
            <hr>
            <h2>Rol</h2>
          
           <select name="rol_id" wire:model="user.rol_id" class="shadow appearance-none w-full border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline"><option value="" selected>Seleccione un rol</option>
            @foreach ($roles as $rol)
            <option value="{{ $rol->id }}">{{ $rol->name }}</option>
            @endforeach
            </select>



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
            Livewire.on('borrarUser', CiudadId =>
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
                        Livewire.emitTo('show-users', 'delete', UserId);
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
