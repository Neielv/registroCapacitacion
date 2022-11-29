<div>
    {{-- The Master doesn't talk, he acts. --}}
    <x-jet-danger-button wire:click="$set('open',true)">
        Nuevo 
    </x-jet-danger-button>  
    <x-jet-dialog-modal wire:model='open'>
        <x-slot name="title">
            Crear un nuevo cliente
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label value="Cédula" />
                <x-jet-input type="text" wire:model.defer="ci"/>
                <x-jet-input-error for="ci"/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Nombre" />
                <x-jet-input type="text" class="w-full" wire:model.defer="nombre"/>
                <x-jet-input-error for="nombre"/>
                               
            </div>
            <div class="mb-4">
                <x-jet-label value="Email" />
                <x-jet-input type="text" class="w-full" wire:model.defer="email"/>
                <x-jet-input-error for="email"/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Teléfono" />
                <x-jet-input type="text" wire:model.defer="telefono"/>
                <x-jet-input-error for="telefono"/>
            </div>  
            <hr/>
            <div class="mb-4">
                <x-jet-label value="Tipo de cliente" />
                <select name="tipo_id" id="tipo_id"  wire:model="tipo_id" class="shadow appearance-none w-full border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline"><option value="" selected>Seleccione un tipo </option>
                    @foreach ($tipos as $tipo)
                    <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                    @endforeach
                    </select>
            </div>  
            <div class="mb-4">
                <x-jet-label value="Asignación de vendedor" />
                <select name="user_id" id="user_id"  wire:model="user_id" class="shadow appearance-none w-full border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline"><option value="" selected>Seleccione un vendedor</option>
                    @foreach ($vendedores as $vendedor)
                    <option value="{{ $vendedor->id }}">{{ $vendedor->name }}</option>
                    @endforeach
                    </select>
            </div>  
           
        </x-slot>
        <x-slot name="footer">    
            <x-jet-secondary-button wire:click="$set('open',false)">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save" class="disabled:pacity-25">
                Crear cliente
            </x-jet-danger-button> 
        </x-slot>

    </x-jet-dialog-modal>
</div>