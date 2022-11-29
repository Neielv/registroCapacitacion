<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <a class="btn btn-green" wire:click="$set('open',true)">
        <i class="fas fa-edit">
        </i>
    </a>
    <x-jet-dialog-modal wire:model='open'>
        <x-slot name="title">         
            Editar el producto:   {{$producto->codigo}}
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label value="Código" />
                <x-jet-input wire:model="producto.codigo" type="text" />
                <x-jet-input-error for="producto.codigo"/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Nombre" />
                <x-jet-input wire:model="producto.nombre" type="text" class="w-full" />
                <x-jet-input-error for="producto.nombre"/>
                               
            </div>
            <div class="mb-4">
                <x-jet-label value="Decripción" />
                <x-jet-input wire:model="producto.descripcion" type="text" class="w-full" />
                <x-jet-input-error for="producto.descripcion"/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Stock" />
                <x-jet-input wire:model="producto.stock" type="text" />
                <x-jet-input-error for="producto.stock"/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Stock Mínimo" />
                <x-jet-input wire:model="producto.stock_minimo" type="text"  />
                <x-jet-input-error for="producto.stock_minimo"/>
            </div>
        

        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open',false)">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-danger-button  wire:click="save" wire:loading.attr="disabled" wire:target="save" class="disabled:pacity-25">
                Actualizar
            </x-jet-danger-button>

        </x-slot>

    </x-jet-dialog-modal>
</div>
