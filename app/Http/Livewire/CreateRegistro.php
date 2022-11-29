<?php

namespace App\Http\Livewire;

use App\Models\Catalogo;
use App\Models\Edad;
use App\Models\Estudio;
use App\Models\Etnia;
use App\Models\Funcionario;
use App\Models\Grupo;
use App\Models\Institucion;
use App\Models\Jurisdiccion;
use App\Models\Proyecto;
use Livewire\Component;
use Ramsey\Uuid\Type\Integer;

class CreateRegistro extends Component
{
    public $openNacional=false;
    public $openExtranjero=false;

    public $openGeneralNacional=false;
    public $openGeneralExtranjero=false;

    public $openFuncionarioElectoral=false;
    public $openPertenencia=false;

    public $openProyectos=false;

    public $openLideres=false;
    public $openEscuelas=false;
    public $openTactica=false;
    public $openGobernanza=false;

    public $openFin=false;


    public $nacionalidad;


    public $nombresExtranjero='';
    public $apellidosExtranjero='';
    public $pasaporte='';
    public $pais='';
    public $ubicacion='';
    public $grupoExtranjero='';

    public $cedula='';
    public $fechaNacimiento='';
    public $telefono='';
    public $nivelEducacion='';
    public $nivelEducacionE='';
    public $email='';
    public $genero='';
    public $edad='';
    public $etnia='';
    public $grupo='';
    public $generoE='';
    public $edadE='';
    public $etniaE='';
    public $grupoE='';
    public $funcionarioElectoral='';
    public $funcionarioGad='';
    public $perteneceOp='';
    public $perteneceOpT='';
    public $perteneceOs='';
    public $proyectos='';



    public $institucion='';
    public $organizacionJovenes='';
    public $escuelaJovenes='';
    public $escuelaFormacion='';
    public $pertemeceEscuelaMujeres='';
    public $escuelaMujeres='';


    public $consorcio='';
    public $funciones='';
    public $perteneceOP='';
    public $nombreOrganizacionPolitica='';

    public $perteneceGad ='';
    public $nombreGad='';
    public $consorcioGobernanza='';
    public $jurisdiccion='';

    protected $rules=[
        'cedula'=>'required|max:10|min:10|unique:clientes',
        'fechaNacimiento'=>'required',       
        'email'=>'required|max:50|email|unique:clientes',
        'telefono'=>'required|max:10',
        'user_id'=>'required',
        'tipo_id'=>'required'  
    ];
    

    public function render()
    {        
        $edades = Edad::all();  
        $estudios = Estudio::all();
        $etnias= Etnia::all();
        $grupos= Grupo::all();
        $funcionarios=Funcionario::all();
        $catalogoSiNo= Catalogo::where('tipo','=','sino')->get();
        $proyectost=Proyecto::all();
        $instituciones=Institucion::all();
        $catalogoCargo=Catalogo::where('tipo','=','cargo')->get();
        $catalogoConsorcio=Catalogo::where('tipo','=','consorcio')->get();
        $gads=Jurisdiccion::all();
        
        switch ($this->perteneceGad)
        {
            case 1: 
                $this->jurisdiccion='PROVINCIAL';
                break;
            case 2:
                $this->jurisdiccion='CANTONAL';
                break;
            case 3:
                $this->jurisdiccion='PARROQUIAL';
                break;
            default:
                $this->jurisdiccion='';
                break;
        }

        return view('livewire.create-registro',compact('edades','estudios','etnias','grupos','catalogoSiNo','funcionarios','proyectost','instituciones','catalogoCargo','catalogoConsorcio','gads') );
    }

    public function seleccionaNacionalidad(int $nacionalidad)
    {
       if ($nacionalidad==1)
       {
         $this->openNacional=true;
         $this->openExtranjero=false;
       }
       else
       {
        $this->openNacional=false;
        $this->openExtranjero=true;
       }
    }

    public function ingresoCedula()
    {
        $this->validate(
            $rules=[
            'cedula'=>'required|max:10|min:10|unique:registros',
            'fechaNacimiento'=>'required',]
        );
        $this->openGeneralNacional=true;
        $this->openNacional=false;
    }

    

    public function ingresoGeneralExtranjero()
    {
        $this->validate(
            $rules=[
            'nombresExtranjero'=>'required|min:10|max:100',
            'apellidosExtranjero'=>'required|min:10|max:100',
            'pasaporte'=>'required|min:4|max:100',
            'pais'=>'required|min:4|max:100',
            'ubicacion'=>'required|min:1',
            'grupoExtranjero'=>'required|min:1',
            'telefono'=>'required|max:13|min:10',
            'email'=>'required|email',
            'genero'=>'required|min:1',
            'edad'=>'required|min:1',
            'etnia'=>'required|min:1',
            'grupo'=>'required|min:1',
            'nivelEducacion'=>'required|min:1',
            ]
        );      
        $this->openExtranjero=false; 
        $this->openProyectos=true;       
    }



    public function ingresoGeneralNacional()
    {
        $this->validate(
            $rules=[
            'telefono'=>'required|max:13|min:10',
            'email'=>'required|email|unique:registros',
            'genero'=>'required|min:1',
            'edad'=>'required|min:1',
            'etnia'=>'required|min:1',
            'grupo'=>'required|min:1',
            'nivelEducacion'=>'required|min:1',
            ]
        );      
        $this->openGeneralNacional=false; 
        $this->openFuncionarioElectoral=true;       
    }

    public function ingresoFuncionarioElectoral()
    {
        $this->validate(
            $rules=[
            'funcionarioElectoral'=>'required',            
            ]
        );       
          
        if ($this->funcionarioElectoral==3)
            $this->openPertenencia=true;        
        else
            $this->openProyectos=true;        
        $this->openFuncionarioElectoral=false;   
    }

    public function ingresoPertenencia()
    {
        $this->validate(
            $rules=[
            'funcionarioGad'=>'required', 
            'perteneceOp'=>'required', 
            'perteneceOs'=>'required',            
            ]
        );       
              
        $this->openPertenencia=false;   
        $this->openProyectos=true;

    }
    public function ingresoProyectos()
    {
        $this->validate(
            $rules=[
            'proyectos'=>'required',                   
            ]
        );       
      switch($this->proyectos)
        {
            case 1:
                $this->openLideres=true;
                break;
            case 2:
                $this->openEscuelas=true;
                break;
            case 3:
                $this->openTactica=true;
                break;           
            case 7:
                $this->openGobernanza=true;
                break;
            default  :
                $this->openFin=true;
                break;  
        }  
        $this->openProyectos=false;
    }

    public function ingresoLideres()
    {        
        $this->validate(
            $rules=[
            'institucion'=>'required|min:10|max:300',
            'organizacionJovenes'=>'required|min:1'                   
            ]
        );  

        if ($this->organizacionJovenes==1)
        $this->validate(
            $rules=[
            'escuelaJovenes'=>'required|min:10|max:300',                           
            ]
        );  
        $this->openLideres=false;
        $this->openFin=true;    
       //$this->emit('alert','resultado','--'.$this->openFin.'--');    
    }


    public function ingresoEscuelas()
    {
        
        $this->validate(
            $rules=[           
            'escuelaFormacion'=>'required|min:1'                   
            ]
        );  


        if ($this->pertemeceEscuelaMujeres==1)
        $this->validate(
            $rules=[
            'escuelaMujeres'=>'required|min:10|max:300',                           
            ]
        );  
        $this->openEscuelas=false;
        $this->openFin=true;     
    }

    public function ingresoTactica()
    {
        
        $this->validate(
            $rules=[           
            'consorcio'=>'required|min:1',
            'funciones'=>'required|min:1',
            'perteneceOpT'=>'required|min:1'                             
            ]
        );  


        if ($this->perteneceOP==1)
        $this->validate(
            $rules=[
            'nombreOrganizacionPolitica'=>'required|min:10|max:300',                           
            ]
        );  
        $this->openTactica=false;
        $this->openFin=true;        
    }

  public function ingresoGobernanza()
  {
      
      $this->validate(
          $rules=[           
          'consorcioGobernanza'=>'required|min:1',
          'perteneceGad'=>'required|min:1'                                      
          ]
      );  


      if ($this->perteneceGad==1)
      $this->validate(
          $rules=[
          'nombreGad'=>'required|min:10|max:300',                           
          ]
      );  
      $this->openGobernanza=false;
      $this->openFin=true;        
  }
}
