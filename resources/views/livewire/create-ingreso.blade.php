<div>
    {{-- The Master doesn't talk, he acts. --}}
    <x-jet-danger-button wire:click="$set('open',true)">
        Nuevo 
    </x-jet-danger-button>  
    <x-jet-dialog-modal wire:model='open'>
        <x-slot name="title">
            Crear un nuevo ingreso de productos
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
                <form wire:submit.prevent="readFile">
                    @if($detalle_guardado==0)
                    <input type="file" wire:model="archivo">                   
                    <x-jet-input-error for="archivo"/>
                      <br/><br/>
                      @endif
                      @if ($ingreso && $detalle_guardado==0)
                        <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
                        >Procesar archivo Archivo</button>                          
                      @endif
                    
                        
                   
                </form>  
                
                @if($detalle_guardado==1)

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

                @endif
                

            </div> 
        </x-slot>
        <x-slot name="footer">    
            <x-jet-secondary-button wire:click="cancel">
                Cancelar
            </x-jet-secondary-button>
            @if ($ingreso==null)
            <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save" class="disabled:pacity-25">
                Crear ingreso
            </x-jet-danger-button>  
            @endif 
           
              
            
        </x-slot>

    </x-jet-dialog-modal>
</div>