<div>
    {{-- The Master doesn't talk, he acts. --}}
    <x-jet-danger-button wire:click="$set('open',true)">
        Nuevo 
    </x-jet-danger-button>  
    <x-jet-dialog-modal wire:model='open'>
        <x-slot name="title">
            Crear nuevo producto
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
                <x-jet-label value="Decripción" />
                <x-jet-input type="text" class="w-full" wire:model.defer="descripcion"/>
                <x-jet-input-error for="descripcion"/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Stock" />
                <x-jet-input type="text" wire:model.defer="stock"/>
                <x-jet-input-error for="stock"/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Stock Mínimo" />
                <x-jet-input type="text" wire:model.defer="stock_minimo" />
                <x-jet-input-error for="stock_minimo"/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Precio 1" />
                <x-jet-input type="text" wire:model.defer="precio_1" />
                <x-jet-input-error for="precio_1"/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Precio 2" />
                <x-jet-input type="text" wire:model.defer="precio_2" />
                <x-jet-input-error for="precio_2"/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Precio 3" />
                <x-jet-input type="text" wire:model.defer="precio_3" />
                <x-jet-input-error for="precio_3"/>
            </div>
        </x-slot>
        <x-slot name="footer">    
            <x-jet-secondary-button wire:click="$set('open',false)">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save" class="disabled:pacity-25">
                Crear producto
            </x-jet-danger-button>     
            
        </x-slot>

    </x-jet-dialog-modal>
</div>
