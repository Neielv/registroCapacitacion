<div>
    {{-- The Master doesn't talk, he acts. --}}
    <x-jet-danger-button wire:click="$set('open',true)">
        Nuevo 
    </x-jet-danger-button>  
    <x-jet-dialog-modal wire:model='open'>
        <x-slot name="title">
            Crear un nuevo usuario
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label value="Cédula" />
                <x-jet-input type="text" wire:model.defer="ci"/>
                <x-jet-input-error for="ci"/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Nombre" />
                <x-jet-input type="text" class="w-full" wire:model.defer="name"/>
                <x-jet-input-error for="name"/>
                               
            </div>
            <div class="mb-4">
                <x-jet-label value="Email" />
                <x-jet-input type="text" class="w-full" wire:model.defer="email"/>
                <x-jet-input-error for="email"/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Teléfono" />
                <x-jet-input type="text" wire:model.defer="phone"/>
                <x-jet-input-error for="phone"/>
            </div>  
            
            <h2>Ciudad</h2>
          
           <select name="ciudad_id" id="ciudad_id"  wire:model="ciudad_id" class="shadow appearance-none w-full border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline"><option value="" selected>Seleccione una ciudad</option>
            @foreach ($ciudades as $ciudad)
            <option value="{{ $ciudad->id }}">{{ $ciudad->nombre }}</option>
            @endforeach
            </select>
            <h2>Rol</h2>
            <select name="rol_id" id="rol_id"  wire:model="rol_id" class="shadow appearance-none w-full border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline"><option value="" selected>Seleccione un rol</option>
            @foreach ($roles as $rol)
            <option value="{{ $rol->id }}">{{ $rol->name }}</option>
            @endforeach
            </select>
        </x-slot>
        <x-slot name="footer">    
            <x-jet-secondary-button wire:click="$set('open',false)">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save" class="disabled:pacity-25">
                Crear usuario
            </x-jet-danger-button>     
            
        </x-slot>

    </x-jet-dialog-modal>
</div>