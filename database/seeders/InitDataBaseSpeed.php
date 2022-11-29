<?php

namespace Database\Seeders;

use App\Models\Catalogo;
use App\Models\Edad;
use App\Models\Estudio;
use App\Models\Etnia;
use App\Models\Funcionario;
use App\Models\Genero;
use App\Models\Grupo;
use App\Models\Institucion;
use App\Models\Jurisdiccion;
use App\Models\Proyecto;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use CreateEdadesTable;



class InitDataBaseSpeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genero1= Genero::create(['nombre'=>'Femenino']);
        $genero2= Genero::create(['nombre'=>'Masculino']);
        $genero3= Genero::create(['nombre'=>'GLBTI']);

        $edad1=Edad::create(['nombre'=>'Menor a 12']);
        $edad2=Edad::create(['nombre'=>'12 a 15']);
        $edad3=Edad::create(['nombre'=>'16 a 17']);
        $edad4=Edad::create(['nombre'=>'18 a 29']);
        $edad5=Edad::create(['nombre'=>'30 a 64']);
        $edad6=Edad::create(['nombre'=>'65 en adelante']);

        $estudios1=Estudio::create(['nombre'=>'Educación General Básica (Primeria)']);
        $estudios2=Estudio::create(['nombre'=>'Bachillerato General Unificado (Secundaria)']);
        $estudios3=Estudio::create(['nombre'=>'Tercer Nivel']);
        $estudios4=Estudio::create(['nombre'=>'Cuarto Nivel']);
        $estudios5=Estudio::create(['nombre'=>'Ninguno']);

        $etnia1=Etnia::create(['nombre'=>'Indígena']);
        $etnia2=Etnia::create(['nombre'=>'Montubio']);
        $etnia3=Etnia::create(['nombre'=>'Mestizo']);
        $etnia4=Etnia::create(['nombre'=>'Afroecuatoriano']);
        $etnia5=Etnia::create(['nombre'=>'Blanco']);
        $etnia6=Etnia::create(['nombre'=>'Prefiero no decirlo']);

        $grupo1=Grupo::create(['nombre'=>'Persona con discapacidad']);
        $grupo2=Grupo::create(['nombre'=>'Persona en situación de Movilidad Humana']);
        $grupo3=Grupo::create(['nombre'=>'Otra']);
        $grupo4=Grupo::create(['nombre'=>'Ninguno']);
        
        $funcionario1=Funcionario::create(['nombre'=>'Autoridad']);
        $funcionario2=Funcionario::create(['nombre'=>'Funcionario']);
        $funcionario3=Funcionario::create(['nombre'=>'Ninguno']);

        $catalogo1=Catalogo::create(['nombre'=>'Si','tipo'=>'sino']);
        $catalogo2=Catalogo::create(['nombre'=>'No','tipo'=>'sino']);
        $catalogo3=Catalogo::create(['nombre'=>'Si/No','tipo'=>'sino']);
        
        $catalogoC1=Catalogo::create(['nombre'=>'CONGOPE','tipo'=>'consorcio']);
        $catalogoC2=Catalogo::create(['nombre'=>'AME','tipo'=>'consorcio']);
        $catalogoC3=Catalogo::create(['nombre'=>'CONAGOPARE','tipo'=>'consorcio']);
        $catalogoC4=Catalogo::create(['nombre'=>'CONGA','tipo'=>'consorcio']);
        $catalogoC5=Catalogo::create(['nombre'=>'Ninguno','tipo'=>'consorcio']);
        $catalogoC6=Catalogo::create(['nombre'=>'Cat-Consorcio','tipo'=>'consorcio']);

        $catalogoF1=Catalogo::create(['nombre'=>'Prefecta/o','tipo'=>'cargo']);
        $catalogoF2=Catalogo::create(['nombre'=>'Alcalde / Alcadesa','tipo'=>'cargo']);
        $catalogoF3=Catalogo::create(['nombre'=>'Concejal / Concejala','tipo'=>'cargo']);
        $catalogoF4=Catalogo::create(['nombre'=>'Gobierno Parroquial Rural','tipo'=>'cargo']);
        $catalogoF5=Catalogo::create(['nombre'=>'Ninguno','tipo'=>'cargo']);
        $catalogoF6=Catalogo::create(['nombre'=>'Cat-cargo','tipo'=>'cargo']);

        $proyecto1=Proyecto::create(['nombre'=>'1. Escuela de Formación Democrática para jóvenes y adolescentes líderes']);
        $proyecto2=Proyecto::create(['nombre'=>'2. Escuela de formación en "Género y Liderazgo Participación Política de la Mujer"']);
        $proyecto3=Proyecto::create(['nombre'=>'3. Táctica y Estrategia para Actores Políticos']);
        $proyecto3=Proyecto::create(['nombre'=>'4. ABC de la Democracia Ciudadanía']);
        $proyecto4=Proyecto::create(['nombre'=>'5. ABC de la Democracia Ruralidad']);
        $proyecto5=Proyecto::create(['nombre'=>'6. ABC de la Democracia Estudiantes']);
        $proyecto6=Proyecto::create(['nombre'=>'7. Gobernanza, Democracia y Descentralización']);
        $proyecto7=Proyecto::create(['nombre'=>'8. Laboratorio de la Democracia']);
        $proyecto9=Proyecto::create(['nombre'=>'9. Fortalecimiento Institucional de la Función Electoral']);
        $proyecto10=Proyecto::create(['nombre'=>'10. Consejos Consultivos']);
        $proyecto10=Proyecto::create(['nombre'=>'11. Academia Diplomática "Ecuatorianos en el Exterior"']);

        $jurisdiccionJ1=Jurisdiccion::create(['nombre'=>'Provincial']);
        $jurisdiccionJ2=Jurisdiccion::create(['nombre'=>'Cantonal']);
        $jurisdiccionJ3=Jurisdiccion::create(['nombre'=>'Parroquial']);
        $jurisdiccionJ4=Jurisdiccion::create(['nombre'=>'No']);
        $jurisdiccionJ5=Jurisdiccion::create(['nombre'=>'CatlJuris']);


        $instituciones1=Institucion::create(['nombre'=>'Autoridad del Ejecutivo']);
        $instituciones2=Institucion::create(['nombre'=>'Autoridad del Legislativo']);
        $instituciones3=Institucion::create(['nombre'=>'Autoridad del Judicial']);
        $instituciones4=Institucion::create(['nombre'=>'Autoridad de Transparencia y Control Social']);
        $instituciones5=Institucion::create(['nombre'=>'Autoridad de la Funcion Electoral']);
        $instituciones6=Institucion::create(['nombre'=>'Autoridad de GAD']);
        $instituciones7=Institucion::create(['nombre'=>'Funcionaria/o del Ejecutivo']);
        $instituciones8=Institucion::create(['nombre'=>'Funcionaria/o del Legislativo']);
        $instituciones9=Institucion::create(['nombre'=>'Funcionaria/o del Judicial']);
        $instituciones10=Institucion::create(['nombre'=>'Funcionaria/o de Transparencia y Control Social']);
        $instituciones11=Institucion::create(['nombre'=>'Funcionaria/o de La Función Electoral']);
        $instituciones12=Institucion::create(['nombre'=>'Funcionaria/o de GAD']);
        $instituciones13=Institucion::create(['nombre'=>'Otro']);
    }
}
