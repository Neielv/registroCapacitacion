<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div>
       <h1>REGISTRO DE USUARIOS PARA LA PLATAFORMA DE EDUCACIÓN</h1>
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <x-table>
            <table class="min-w-full divide-y divide-gray-200">
                <thead >
                    <tr>
                         <th scope="col" style="background-color:cornflowerblue" class=" cursor-pointer px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">
                            INDIQUE SU NACIONALIDAD                            
                        </th>
                        
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr class="text-left p-7">
                        <th style="padding: 12px;">
                            <input wire:model="nacionalidad" name="nacionalidad" type="radio" wire:click="seleccionaNacionalidad(1) " /> Ecuatoriana<br>
                            <input wire:model="nacionalidad" name="nacionalidad" type="radio" wire:click="seleccionaNacionalidad(0) "/> Extranjera
                    </tr>
                </tbody>
            </table>
        </x-table>
    </div>

<!--PASO 1 INGRESO DE CEDULA-->
 <x-jet-dialog-modal wire:model='openNacional'>
        <x-slot name="title">
            INGRESA LOS DATOS SOLICITADOS
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label value="Cédula" />
                <x-jet-input type="text" wire:model.defer="cedula"/>
                <x-jet-input-error for="cedula"/>
            </div>
            <div class="mb-4">
                <x-jet-label for="date_of_birth" value="Fecha de Nacimiento" />
                <x-jet-input id="date_of_birth" type="date"  wire:model.defer="fechaNacimiento" />
                <x-jet-input-error for="fechaNacimiento"/>
                               
            </div> 
        </x-slot>
        <x-slot name="footer">    
            <x-jet-secondary-button wire:click="$set('openNacional',false)">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="ingresoCedula" wire:loading.attr="disabled" wire:target="save" class="disabled:pacity-25">
                Siguiente
            </x-jet-danger-button>                
        </x-slot>
    </x-jet-dialog-modal>


<!--PASO 2 INGRESO DE CEDULA-->
<x-jet-dialog-modal wire:model='openGeneralNacional'>
    <x-slot name="title">
        NOMBRE DE LA PERSONA
    </x-slot>
    <x-slot name="content">        
        <div class="mb-4">
            <x-jet-label value="Telefono:" />
            <x-jet-input type="text" wire:model.defer="telefono"/>
            <x-jet-input-error for="telefono"/>
        </div>
        <div class="mb-4">
            <x-jet-label value="Correo electrónico:" />
            <x-jet-input type="text" wire:model.defer="email"/>
            <x-jet-input-error for="email"/>                           
        </div> 
        <div class="mb-4">
            <x-jet-label value="Genero:" />
            <input wire:model.defer="genero" name="genero" type="radio"  value=1/> 1.- Femenino<br>
            <input wire:model.defer="genero" name="genero" type="radio" value=2/> 2.- Masculino <br>
            <input wire:model.defer="genero" name="genero" type="radio"value=3/> 2.- LGBTI <br>
            <x-jet-input-error for="genero"/>
        </div> 
        
         <div class="mb-4">
            <x-jet-label value="Edad:" />
            <select name="edad" id="edad"  wire:model.defer="edad" class="shadow appearance-none w-full border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline"><option value="" selected>Seleccione una opción </option>
                @foreach ($edades as $edad)
                <option value="{{ $edad->id }}">{{ $edad->nombre }}</option>
                @endforeach
                </select>
            <x-jet-input-error for="edad"/>
         </div>
         <div class="mb-4">
            <x-jet-label value="Nivel de Educación:" />
            <select name="nivelEducacion" id="nivelEducacion"  wire:model.defer="nivelEducacion" class="shadow appearance-none w-full border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline"><option value="" selected>Seleccione una opción </option>
                @foreach ($estudios as $estudio)
                <option value="{{ $estudio->id }}">{{ $estudio->nombre }}</option>
                @endforeach
            </select>
            <x-jet-input-error for="nivelEducacion"/>
         </div> 

         <div class="mb-4">
            <x-jet-label value="Con que etnia te identificas:" />
            <select name="etnia" id="etnia"  wire:model.defer="etnia" class="shadow appearance-none w-full border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline"><option value="" selected>Seleccione una opción </option>
                @foreach ($etnias as $etnia)
                <option value="{{ $etnia->id }}">{{ $etnia->nombre }}</option>
                @endforeach
            </select>
            <x-jet-input-error for="etnia"/>
         </div> 
         <div class="mb-4">
            <x-jet-label value=" ¿Perteneces a uno de los siguientes grupos?" />
            <select name="grupo" id="grupo"  wire:model.defer="grupo" class="shadow appearance-none w-full border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline"><option value="" selected>Seleccione una opción </option>
                @foreach ($grupos as $grupo)
                <option value="{{ $grupo->id }}">{{ $grupo->nombre }}</option>
                @endforeach
            </select>
            <x-jet-input-error for="grupo"/>
         </div> 

    </x-slot>
    <x-slot name="footer">    
        <x-jet-secondary-button wire:click="$set('openGeneralNacional',false)">
            Cancelar
        </x-jet-secondary-button>
        <x-jet-danger-button wire:click="ingresoGeneralNacional" wire:loading.attr="disabled" wire:target="save" class="disabled:pacity-25">
            Siguiente
        </x-jet-danger-button>                
    </x-slot>
</x-jet-dialog-modal>

<!--PASO 3 FUNCIONARIO ELECTORAL DE CEDULA-->
<x-jet-dialog-modal wire:model='openFuncionarioElectoral'>
    <x-slot name="title">
        FUNCIONARIO ELECTORAL
    </x-slot>
    <x-slot name="content">
        <div class="mb-4">
            <x-jet-label value="Si eres Funcionario Electoral, elige tu cargo, caso contrario elige
           * NINGUNO *" />
        </div>
        <div class="mb-4">
        @foreach ($funcionarios as $funcionario)
            <input wire:model="funcionarioElectoral" name="funcionarioElectoral" type="radio" value="{{ $funcionario->id }}" /> {{ $funcionario->nombre }}<br>
        @endforeach    
        
        </div> 
        <x-jet-input-error for="funcionarioElectoral"/>       
    </x-slot>
    <x-slot name="footer">    
        <x-jet-secondary-button wire:click="$set('openFuncionarioElectoral',false)">
            Cancelar
        </x-jet-secondary-button>
        <x-jet-danger-button wire:click="ingresoFuncionarioElectoral" wire:loading.attr="disabled" wire:target="save" class="disabled:pacity-25">
            Siguiente
        </x-jet-danger-button>                
    </x-slot>
</x-jet-dialog-modal>

<!--PASO 4 FUNCIONARIO ELECTORAL DE CEDULA-->
<x-jet-dialog-modal wire:model='openPertenencia'>
    <x-slot name="title">
        INFORMACIÓN GENERAL
    </x-slot>
    <x-slot name="content">
        <div class="mb-4">
            <x-jet-label value="GOBIERNOS AUTÓNOMOS DESCENTRALIZADOS"/>
        </div>
        <div class="mb-4">
            <x-jet-label value="Si eres Miembro de un GAD, elige tu cargo, caso contrario elige
            NINGUNO"/>                
            @foreach ($funcionarios as $funcionario)
                <input wire:model="funcionarioGad" name="funcionarioGad" type="radio" value="{{ $funcionario->id }}" /> {{ $funcionario->nombre }}<br>
            @endforeach        
        
        </div> 
        <x-jet-input-error for="funcionarioGad"/>   
        <div class="mb-4">
            <x-jet-label value="ORGANIZACIONES POLÍTICAS"/>
        </div>
        <div class="mb-4">
            <x-jet-label value="¿ Eres Miembro de una Organización Política?"/>            
            @foreach ($catalogoSiNo as $sino)
                <input wire:model="perteneceOp" name="perteneceOp" type="radio" value="{{ $sino->id }}" /> {{ $sino->nombre }}<br>
            @endforeach
        
        </div> 
        <x-jet-input-error for="perteneceOp"/>   

        <div class="mb-4">
            <x-jet-label value="ORGANIZACIONES SOCIALES"/>
        </div>
        <div class="mb-4">
            <x-jet-label value="¿ Eres Miembro de una Organización Social?"/>            
            @foreach ($catalogoSiNo as $sino)
                <input wire:model="perteneceOs" name="perteneceOs" type="radio" value="{{ $sino->id }}" /> {{ $sino->nombre }}<br>
            @endforeach
        </div> 
        <x-jet-input-error for="perteneceOs"/>   
        
        

    </x-slot>
    <x-slot name="footer">    
        <x-jet-secondary-button wire:click="$set('openPertenencia',false)">
            Cancelar
        </x-jet-secondary-button>
        <x-jet-danger-button wire:click="ingresoPertenencia" wire:loading.attr="disabled" wire:target="save" class="disabled:pacity-25">
            Siguiente
        </x-jet-danger-button>                
    </x-slot>
</x-jet-dialog-modal>

<!--PASO 5 INGRESO DE PROYECTO-->
<x-jet-dialog-modal wire:model='openProyectos'>
    <x-slot name="title">
        PROYECTOS
    </x-slot>
    <x-slot name="content">
        <div class="mb-4">
            <x-jet-label value="Seleccione in proyecto:" />
            @foreach ($proyectost as $proyecto)
                 <input wire:model="proyectos" name="proyectos" type="radio" value="{{ $proyecto->id }}" /> {{ $proyecto->nombre }}<br>
            @endforeach  
            <x-jet-input-error for="proyectos"/>
        </div> 
    </x-slot>
    <x-slot name="footer">    
        <x-jet-secondary-button wire:click="$set('openProyectos',false)">
            Cancelar
        </x-jet-secondary-button>
        <x-jet-danger-button wire:click="ingresoProyectos" wire:loading.attr="disabled" wire:target="save" class="disabled:pacity-25">
            Siguiente
        </x-jet-danger-button>                
    </x-slot>
</x-jet-dialog-modal>

<!--PASO 5.1 FORMACION DE LIDERES-->
<x-jet-dialog-modal wire:model='openLideres'>
    <x-slot name="title">
        Escuela de Formación Democrática para jóvenes y adolescentes líderes
    </x-slot>
    <x-slot name="content">
        <div class="mb-4">
            <x-jet-label value="Indique el nombre de la Institución Educativa a la que pertenece, en caso de
            no tener una respuesta colocar NINGUNO - Escuela de Jóvenes" />
            <x-jet-label value="Institución" />
            <x-jet-input type="text" wire:model.defer="institucion"/>
            <x-jet-input-error for="institucion"/>

            <x-jet-label value="¿Pertenece a alguna organización? - Escuela de Jóvenes" />
             @foreach ($catalogoSiNo as $sino)
                <input wire:model="organizacionJovenes" name="organizacionJovenes" type="radio" value="{{ $sino->id }}" /> {{ $sino->nombre }}<br>
            @endforeach

            <x-jet-input-error for="organizacionJovenes"/>
            @if ($organizacionJovenes==1)
                <div>
                    <x-jet-label value="ORGANIZACIÓN - Escuela de Jóvenes" />
                    <x-jet-input type="text" wire:model.defer="escuelaJovenes"/>
                    <x-jet-input-error for="escuelaJovenes"/>
                </div>
            @endif                           
        </div> 
    </x-slot>
    <x-slot name="footer">    
        <x-jet-secondary-button wire:click="$set('openLideres',false)">
            Cancelar
        </x-jet-secondary-button>
        <x-jet-danger-button wire:click="ingresoLideres" wire:loading.attr="disabled" wire:target="save" class="disabled:pacity-25">
            Siguiente
        </x-jet-danger-button>                
    </x-slot>
</x-jet-dialog-modal>

<!--PASO 5.1 FORMACION DE LIDERES-->
<x-jet-dialog-modal wire:model='openEscuelas'>
    <x-slot name="title">
        Escuela de formación en "Género y Liderazgo Participación Política de
la Mujer"
    </x-slot>
    <x-slot name="content">
        <div class="mb-4">
            <x-jet-label value="¿Indique si es parte de una de estas funciones ? - Escuela de Mujeres" />
            
            @foreach ($instituciones as $institucion)
                <input wire:model="escuelaFormacion" name="escuelaFormacion" type="radio" value="{{ $institucion->id }}" /> {{ $institucion->nombre }}<br>
            @endforeach

            <x-jet-input-error for="escuelaFormacion"/>

            <x-jet-label value="¿Pertenece a alguna organización? - Escuela de Mujeres?" />
            
            @foreach ($catalogoSiNo as $sino)
                <input wire:model="pertemeceEscuelaMujeres" name="pertemeceEscuelaMujeres" type="radio" value="{{ $sino->id }}" /> {{ $sino->nombre }}<br>
            @endforeach

            
            @if ($pertemeceEscuelaMujeres==1)
            
                <x-jet-label value="Indique la organización a la que pertenece - Escuela de Mujeres. " />
                <x-jet-input type="text" wire:model.defer="escuelaMujeres"/>
                <x-jet-input-error for="escuelaMujeres"/>
            @endif

                           
        </div> 
    </x-slot>
    <x-slot name="footer">    
        <x-jet-secondary-button wire:click="$set('openLideres',false)">
            Cancelar
        </x-jet-secondary-button>
        <x-jet-danger-button wire:click="ingresoEscuelas" wire:loading.attr="disabled" wire:target="save" class="disabled:pacity-25">
            Siguiente
        </x-jet-danger-button>                
    </x-slot>
</x-jet-dialog-modal>




<!--PASO 5.2 TACTICA Y ESTRATEGIA POLÍTICA-->
<x-jet-dialog-modal wire:model='openTactica'>
    <x-slot name="title">
        Táctica y Estrategia para Actores Políticos
    </x-slot>
    <x-slot name="content">
        <div class="mb-4">
            <x-jet-label value="¿Funcionario de Consorcio / Asociación? - Táctica y Estrategia" />
            

            @foreach ($catalogoConsorcio as $consorcio)
                <input wire:model="consorcio" name="consorcio" type="radio" value="{{ $consorcio->id }}" /> {{ $consorcio->nombre }}<br>
            @endforeach
 
            <x-jet-input-error for="consorcio"/>


            <x-jet-label value="¿Indique si cumple estas funciones? - Táctica y Estrategia" />
                @foreach ($catalogoCargo as $cargo)
                    <input wire:model="funciones" name="funciones" type="radio" value="{{ $cargo->id }}" /> {{ $cargo->nombre }}<br>
                @endforeach


            <x-jet-input-error for="funciones"/>


            <x-jet-label value="¿Pertenece a alguna Organización Política? - Táctica y Estrategia" />
            
            @foreach ($catalogoSiNo as $sino)
                <input wire:model="perteneceOpT" name="perteneceOpT" type="radio" value="{{ $sino->id }}" /> {{ $sino->nombre }}<br>
            @endforeach        
                
            <x-jet-input-error for="perteneceOP"/>
            @if ($perteneceOP==1)
                <x-jet-label value="Indique la organización política a la que pertenece - Táctica y Estrategia" />
                <x-jet-input type="text" wire:model.defer="nombreOrganizacionPolitica"/>
                <x-jet-input-error for="nombreOrganizacionPolitica"/>
            @endif
        </div> 
    </x-slot>
    <x-slot name="footer">    
        <x-jet-secondary-button wire:click="$set('openTactica',false)">
            Cancelar
        </x-jet-secondary-button>
        <x-jet-danger-button wire:click="ingresoTactica" wire:loading.attr="disabled" wire:target="save" class="disabled:pacity-25">
            Siguiente
        </x-jet-danger-button>                
    </x-slot>
</x-jet-dialog-modal>





<!--PASO 5.2 GOBERNANZA-->
<x-jet-dialog-modal wire:model='openGobernanza'>
    <x-slot name="title">
        Gobernanza, Democracia y Descentralización
    </x-slot>
    <x-slot name="content">
        <div class="mb-4">
            <x-jet-label value="Funcionario de Consorcio / Asociación - Gobernanza, Democracia y Descentralización" />
            
            @foreach ($catalogoConsorcio as $consorcio)
                <input wire:model="consorcioGobernanza" name="consorcioGobernanza" type="radio" value="{{ $consorcio->id }}" /> {{ $consorcio->nombre }}<br>
            @endforeach
            <x-jet-input-error for="consorcioGobernanza"/>


            <x-jet-label value="¿Pertenece algun GAD? - Gobernanza, Democracia y Descentralización" />
            
                @foreach ($gads as $gad)
                    <input wire:model="perteneceGad" name="perteneceGad" type="radio" value="{{ $gad->id }}" /> {{ $gad->nombre }}<br>
                @endforeach
            
            <x-jet-input-error for="perteneceGad"/>

            @if ($perteneceGad<4)

            <x-jet-label value="¿Indique a cuál GAD {{$jurisdiccion}}? - Gobernanza, Democracia y Descentralización" />

            <x-jet-input type="text" wire:model.defer="nombreGad"/>
            <x-jet-input-error for="nombreGad"/>
            @endif
        </div> 
    </x-slot>
    <x-slot name="footer">    
        <x-jet-secondary-button wire:click="$set('openGobernanza',false)">
            Cancelar
        </x-jet-secondary-button>
        <x-jet-danger-button wire:click="ingresoGobernanza" wire:loading.attr="disabled" wire:target="save" class="disabled:pacity-25">
            Siguiente
        </x-jet-danger-button>                
    </x-slot>
</x-jet-dialog-modal>






<!--PASO 1. EXT INGRESO DE CEDULA-->
<x-jet-dialog-modal wire:model='openExtranjero'>
    <x-slot name="title">
        INFORMACIÓN DE PERSONAS EXTRANJERAS
    </x-slot>
    <x-slot name="content">   
        <div class="mb-4">
            <x-jet-label value="Nombre Completos:" />
            <x-jet-input type="text" wire:model.defer="nombresExtranjero"/>
            <x-jet-input-error for="nombresExtranjero"/>
        </div>   
        
        <div class="mb-4">
            <x-jet-label value="Apellidos Completos:" />
            <x-jet-input type="text" wire:model.defer="apellidosExtranjero"/>
            <x-jet-input-error for="apellidosExtranjero"/>
        </div> 
        <div class="mb-4">
            <x-jet-label value="Ingrese su Número de Pasaporte o DNI:" />
            <x-jet-input type="text" wire:model.defer="pasaporte"/>
            <x-jet-input-error for="pasaporte"/>
        </div> 
        

        <div class="mb-4">
            <x-jet-label value="Telefono:" />
            <x-jet-input type="text" wire:model.defer="telefono"/>
            <x-jet-input-error for="telefono"/>
        </div>
        <div class="mb-4">
            <x-jet-label value="Correo electrónico:" />
            <x-jet-input type="text" wire:model.defer="email"/>
            <x-jet-input-error for="email"/>                           
        </div> 
        <div class="mb-4">
            <x-jet-label value="Indique su País de Residencia:" />
            <x-jet-input type="text" wire:model.defer="pais"/>
            <x-jet-input-error for="pais"/>                           
        </div>
        <div class="mb-4">
            <x-jet-label value="Seleccione su ubicación en el País de Residencia:" />
                <select name="ubicacion" id="ubicacion"  wire:model="ubicacion" class="shadow appearance-none w-full border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline">
                    <option value="" selected>Seleccione una opción </option>
                    <option value=1>Estado</option>
                    <option value=2>Región</option>
                    <option value=3>Distrito</option>
                    <option value=4>Municipio</option>
                    <option value=5>Gobernación</option>
                    <option value=6>Departamento</option>
                </select>
            <x-jet-input-error for="ubicacion"/>
        </div> 

        <div class="mb-4">
            <x-jet-label value="Indique si pertenece a uno de estos grupos:" />
                <select name="grupoExtranjero" id="grupoExtranjero"  wire:model="grupoExtranjero" class="shadow appearance-none w-full border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline">
                    <option value="" selected>Seleccione una opción </option>
                    <option value=1>Estado</option>
                    <option value=2>Región</option>
                    <option value=3>Distrito</option>
                    <option value=4>Municipio</option>
                    <option value=5>Gobernación</option>
                    <option value=6>Departamento</option>
                </select>
            <x-jet-input-error for="grupoExtranjero"/>
        </div> 
        <div class="mb-4">
            <x-jet-label value="Genero:" />            
            <input wire:model="genero" name="genero" type="radio"  value=1/> 1.- Femenino<br>
            <input wire:model="genero" name="genero" type="radio" value=2/> 2.- Masculino <br>
            <input wire:model="genero" name="genero" type="radio"value=3/> 2.- LGBTI <br>
            <x-jet-input-error for="genero"/>
        </div> 
         <div class="mb-4">
            <x-jet-label value="Edad:" />
            <select name="edadE" id="edadE"  wire:model="edadE" class="shadow appearance-none w-full border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline"><option value="" selected>Seleccione una opción </option>
                @foreach ($edades as $edad)
                <option value="{{ $edad->codigo }}">{{ $edad->nombre }}</option>
                @endforeach
                </select>
            <x-jet-input-error for="edad"/>
         </div>
         <div class="mb-4">
            <x-jet-label value="Nivel de Educación:" />
            <select name="nivelEducacionE" id="nivelEducacionE"  wire:model="nivelEducacionE" class="shadow appearance-none w-full border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline"><option value="" selected>Seleccione una opción </option>
                @foreach ($estudios as $estudio)
                <option value="{{ $estudio->codigo }}">{{ $estudio->nombre }}</option>
                @endforeach
            </select>
            <x-jet-input-error for="nivelEducacion"/>
         </div> 

         <div class="mb-4">
            <x-jet-label value="Con que etnia te identificas:" />
            <select name="etniaE" id="etniaE"  wire:model="etniaE" class="shadow appearance-none w-full border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline"><option value="" selected>Seleccione una opción </option>
                @foreach ($etnias as $etnia)
                <option value="{{ $etnia->codigo }}">{{ $etnia->nombre }}</option>
                @endforeach
            </select>
            <x-jet-input-error for="etnia"/>
         </div> 
         <div class="mb-4">
            <x-jet-label value=" ¿Perteneces a uno de los siguientes grupos?" />
            <select name="grupo" id="grupoE"  wire:model="grupoE" class="shadow appearance-none w-full border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline"><option value="" selected>Seleccione una opción </option>
                @foreach ($grupos as $grupo)
                <option value="{{ $grupo->codigo }}">{{ $grupo->nombre }}</option>
                @endforeach
            </select>
            <x-jet-input-error for="grupo"/>
         </div> 
    </x-slot>
    <x-slot name="footer">    
        <x-jet-secondary-button wire:click="$set('openGeneralExtranjero',false)">
            Cancelar
        </x-jet-secondary-button>
        <x-jet-danger-button wire:click="ingresoGeneralExtranjero" wire:loading.attr="disabled" wire:target="save" class="disabled:pacity-25">
            Siguiente
        </x-jet-danger-button>                
    </x-slot>
</x-jet-dialog-modal>








<!--FINAL-->
<x-jet-dialog-modal wire:model='openFin'>
    <x-slot name="title">
        GRACIAS POR SU REGISTRO
    </x-slot>
    <x-slot name="content">
        <div class="mb-4">
            <x-jet-label value="Instituto de Investigación, Capacitación y
            Promoción Político Electoral - Instituto de la Democracia."/>
        </div>
        <div class="mb-4">           
        </div> 
    </x-slot>
    <x-slot name="footer">            
        <x-jet-danger-button wire:click="$set('openFin',false)" wire:loading.attr="disabled" wire:target="save" class="disabled:pacity-25">
            Finalizar
        </x-jet-danger-button>                
    </x-slot>
</x-jet-dialog-modal>

</div>
