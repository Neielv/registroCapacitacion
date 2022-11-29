<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Explorador de documentos') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
        <x-table>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <x-jet-input class="mx-1" type="text" wire:model="numero"
                                placeholder="Número de documento">
                                </x-input>
                        </th>
                        <th scope="col"
                            class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <x-jet-input class="mx-1" type="text" wire:model="nombre_tipo" placeholder="Tipo"
                                style="width: 110px">
                                </x-input>
                        </th>
                        <th scope="col"
                            class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <x-jet-input class="mx-1" type="text" wire:model="fecha" placeholder="Año"
                                style="width: 75px">
                                </x-input>
                        </th>
                        <th scope="col"
                            class=" cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <x-jet-input class="mx-1" type="text" wire:model="nombre_proceso"
                                placeholder="Proceso">
                                </x-input>

                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <x-jet-input class="mx-1" type="text" wire:model="nombre_unidad"
                                placeholder="Unidad">
                                </x-input>
                        </th>

                    </tr>
                    <tr>
                        <th colspan="5" class="px-10">
                            <x-jet-input class="mx-10 w-full " type="text" wire:model="asunto" placeholder="Asunto">
                                </x-input>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="5" class="px-10">
                            <x-jet-input class="mx-10 w-full " type="text" wire:model="resumen"
                                placeholder="Texto de referencia">
                                </x-input>
                        </th>

                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">

                    @if ($documentos->count())
                        
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>

                                        <th scope="col"
                                            class=" cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Número

                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Asunto
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tipo
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Fecha
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Proceso
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Unidad
                                        </th>

                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($documentos as $documento)
                                        <tr>

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900"> {{ $documento->numero }}</div>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900"> {{ $documento->asunto }}</div>

                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $documento->tipo }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $documento->fecha }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $documento->proceso }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $documento->unidad }}
                                            </td>                                            


                                            <td class="px-6 py-4 whitespace-nowrap ext-sm font-medium flex">
                                                <a class="btn btn-green" wire:click="viewDoc({{$documento}})"
                                                    style="margin-right: 10px">
                                                    <i class="fas fa-edit">
                                                    </i>
                                                </a>

                                                <a class="btn btn-blue" wire:click="viewPro({{ $documento->proceso_id}})">
                                                    <i class="fas fa-search">
                                                    </i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <!-- More people... -->
                                </tbody>
                            </table>
                        
                    @else
                        <div class="px-6 py-4">
                            <br>
                            No se encontraron coincidencias

                        </div>
                    @endif
                </tbody>
            </table>
        </x-table>
    </div>

    <!--MODAL DE VIEWER-->
    <x-jet-dialog-modal wire:model='open_doc' maxWidth="full" >
        <x-slot name="title">
            Visor de documentos:
        </x-slot>
        <x-slot name="content">
            <iframe src="{{asset('storage/'.$actualUrl)}}" width="100%" height="500px">
            </iframe>

        </x-slot>
        <x-slot name="footer">
            <x-jet-danger-button wire:click="$set('open_doc',false)">
                Salir
            </x-jet-danger-button>            
        </x-slot>

    </x-jet-dialog-modal>  

    <!--MODAL DE PROCESO-->
    <x-jet-dialog-modal wire:model='open_pro' maxWidth="full" >
        <x-slot name="title">
            Directorio del proceso:
        </x-slot>
        <x-slot name="content">    
            <div >   
            <table>
                <th>
                    <th  >
                        <div >
                            <table style="padding-top: 12px">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <td scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Número</td>
                                        <td scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Asunto</td>
                                        <td scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</td>
                                        <td scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Carpeta</td>
                                        <td scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Caja</td>
                                        <td scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ver</td>
                                    </tr>
                                </thead>
                                
                                @if ($documentos_proceso)
                                    @foreach ($documentos_proceso as $documento)
                                    <tr >
                                        <td class="px-6 py-2 whitespace-nowrap">{{$documento->numero}}</td>
                                        <td class="px-6 py-2 whitespace-nowrap">{{$documento->asunto}}</td>
                                        <td class="px-6 py-2 whitespace-nowrap">{{$documento->tipo}}</td>
                                        <td class="px-6 py-2 whitespace-nowrap">{{$documento->carpeta}}</td>
                                        <td class="px-6 py-2 whitespace-nowrap">{{$documento->caja}}</td>                    
                                        <td style="padding-right: 2px;">
                                            <a class="btn btn-blue" wire:click="viewDocRel({{ $documento->url}})">
                                                <i class="fas fa-search">
                                                </i>
                                            </a>
                                        </td>
                                        
                                    </tr>
                                    @endforeach
                                    

                                @endif
                                
                            </table>
                        </div>
                    </th>
                    <th style="width: 40%">
                            <iframe src="{{asset('storage/1.pdf')}}" width="500px" height="400px">
                        </iframe>
                    </th>

                </th>
            </table>
           
              </div>          
        
         
        </x-slot>
        <x-slot name="footer">
            <x-jet-danger-button wire:click="$set('open_pro',false)">
                Salir
            </x-jet-danger-button>            
        </x-slot>

    </x-jet-dialog-modal> 





</div>
