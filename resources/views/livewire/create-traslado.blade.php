<div>
    {{-- The Master doesn't talk, he acts. --}}
    <x-jet-danger-button wire:click="$set('open',true)">
        Nuevo 
    </x-jet-danger-button>  
    <x-jet-dialog-modal wire:model='open'>
        <x-slot name="title">
            Crear un nuevo traslado
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label value="Nro. de documento" />
                <x-jet-input type="text" wire:model.defer="nombre"/>
                <x-jet-input-error for="nombre"/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Descripción" />
                <x-jet-input type="text" wire:model.defer="descripcion" class="w-full"/>
                <x-jet-input-error for="descripcion"/>
            </div>

            
            
            <div class="mb-4">
                <x-jet-label value="Origen" />
                <select name="origen_id" id="origen_id"  wire:model="origen_id" class="shadow appearance-none w-full border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline"><option value="" selected>Seleccione una ciudad</option>
                    @foreach ($ciudades as $ciudad)
                    <option value="{{ $ciudad->id }}">{{ $ciudad->nombre }}</option>
                    @endforeach
                    </select>                
            </div> 

            <div class="mb-4">
                <x-jet-label value="Destino" />
                <select name="destino_id" id="destino_id"  wire:model="destino_id" class="shadow appearance-none w-full border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline"><option value="" selected>Seleccione una ciudad</option>
                    @foreach ($ciudades as $ciudad)
                    <option value="{{ $ciudad->id }}">{{ $ciudad->nombre }}</option>
                    @endforeach
                    </select>                
            </div> 
            @if ($bloqueo==0)
            <div class="mb-4">
                <table>
                    <tr>
                        <td>
                            <th>
                                <x-jet-label value="Código de producto" />
                                <x-jet-input type="text" wire:model="producto" style="width: 140px"/>
                            </th>
                            <th>
                                <x-jet-label value="Cantidad" class="px-10"/>max: {{$disponible}}
                                
                                <x-jet-input type="text" wire:model.defer="cantidad" style="width: 100px"/></p>
                                <x-jet-input-error for="cantidad"/>
                            </th>
                            <th>
                                <br>
                                <x-jet-secondary-button 
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
                                wire:click="add()"
                                >
                                    Agregar
                                </x-jet-secondary-button>
                            </th>
                        </td>
                    </tr>
                    <tr>
                    <td>
                        <th style="font-size:12px" colspan="3">
                           {{$nombre_producto}}
                        </th>
                    </td>
                    </tr>
                </table>                
            </div>                 
            @endif
          
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
                        @foreach ($orderProduct as $key =>$item)    
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"> {{ $key +1 }}</div>

                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"> {{ $item['producto_id'] }}</div>

                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"> {{ $item['producto_nombre'] }}</div>

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"> {{ $item['cantidad'] }}</div>

                                </td>
                                
                               
                                
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </x-table>
                
      
             
        </x-slot>
        <x-slot name="footer">    
            <x-jet-secondary-button wire:click="$set('open',false)">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save" class="disabled:pacity-25">
                Crear Traslado
            </x-jet-danger-button>     
            
        </x-slot>

    </x-jet-dialog-modal>
</div>