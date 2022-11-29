<div>
    {{-- The Master doesn't talk, he acts. --}}
    <x-jet-danger-button wire:click="$set('open',true)">
        Nuevo 
    </x-jet-danger-button>  
    <x-jet-dialog-modal wire:model='open'>
        <x-slot name="title">
            Crear una nueva ciudad
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label value="Código" />
                <x-jet-input type="text" wire:model.defer="codigo"/>
                <x-jet-input-error for="codigo"/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Nombre" />
                <x-jet-input type="text" class="w-full" wire:model.defer="nombre"/>
                <x-jet-input-error for="nombre"/>
                               
            </div>
            <div class="mb-4">
                <x-jet-label value="Contacto" />
                <x-jet-input type="text" class="w-full" wire:model.defer="contacto"/>
                <x-jet-input-error for="contacto"/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Teléfono" />
                <x-jet-input type="text" wire:model.defer="telefono"/>
                <x-jet-input-error for="telefono"/>
            </div>            
        </x-slot>
        <x-slot name="footer">    
            <x-jet-secondary-button wire:click="$set('open',false)">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save" class="disabled:pacity-25">
                Crear ciudad
            </x-jet-danger-button>     
            
        </x-slot>

    </x-jet-dialog-modal>
</div>