<?php

namespace App\Http\Livewire;

use App\Models\Documento;
use App\Models\TipoDocumento;
use Illuminate\Http\Response;
use Livewire\Component;
use Livewire\WithPagination;


class ShowDocumentos extends Component
{
    use withPagination;
    protected $listeners = ['render','viewDoc'];
    //Variables de búsqueda
    public $numero;
    public $fecha;
    public $asunto;
    public $nombre_tipo;
    public $nombre_proceso;
    public $nombre_unidad;
    public $resumen;
    public $open_doc =false;
    public $open_pro =false;
    public $documentos_proceso;
    public $actualUrl;
    public $viewDocRel;

    //
    public function render()
    {
       
        if  ($this->numero!='' || $this->fecha!=""||$this->asunto!=""|| $this->nombre_tipo!=""||$this->nombre_proceso!=""||$this->nombre_unidad!=""|| $this->resumen!="")
        {
        $documentos=Documento::Where('documentos.numero','like','%'.$this->numero.'%')
                ->where('documentos.fecha','like','%'.$this->fecha.'%')
                ->where('documentos.nombre','like','%'.$this->asunto.'%')
                ->where('documentos.resumen','like','%'.$this->resumen.'%')
                
            
                ->join('tipodocumento', 'tipodocumento.id', '=', 'documentos.tipo_id')
                ->where('tipodocumento.nombre','like','%'.$this->nombre_tipo.'%')
                            
                ->join('procesos', 'procesos.id', '=', 'documentos.proceso_id')
                ->where('procesos.nombre','like','%'.$this->nombre_proceso.'%')

                ->join('unidades', 'unidades.id', '=', 'documentos.unidad_id')
                ->where('unidades.nombre','like','%'.$this->nombre_unidad.'%')
                


                ->select('documentos.id')
                ->selectRaw("documentos.numero  as numero")                
                ->selectRaw("tipodocumento.nombre  as tipo")
                ->selectRaw("documentos.fecha  as fecha")
                ->selectRaw("documentos.nombre  as asunto")
                ->selectRaw("procesos.nombre  as proceso")
                ->selectRaw("unidades.nombre  as unidad")
                ->selectRaw("documentos.carpeta  as carpeta")
                ->selectRaw("documentos.caja_id  as caja")
                ->selectRaw("documentos.proceso_id  as proceso_id")
                ->selectRaw("documentos.url  as url")
           
                ->get();
        }
        else
        {
            $documentos=TipoDocumento::Where('id','=','999')          
       
            ->get();
        }
       
        return view('livewire.show-documentos',compact('documentos'));
    }
    public function updatingsearch()
    {
        $this->resetPage();

    }
    public function viewDoc(Documento $documento)
    {        
        $this->actualUrl=  $documento->url;      
        $this->open_doc=true;  
    } 
    public function viewDocRel(String $url)
    {        
        $this->viewDocRel=  $url;      
        $this->open_doc=true;  
    } 



    
    public function viewPro(int $proceso_id)
    {
        $this->documentos_proceso=Documento::Where('documentos.proceso_id','=',$proceso_id)    
        ->join('tipodocumento', 'tipodocumento.id', '=', 'documentos.tipo_id')
        ->where('tipodocumento.nombre','like','%'.$this->nombre_tipo.'%')
                    
        ->join('procesos', 'procesos.id', '=', 'documentos.proceso_id')
        ->where('procesos.nombre','like','%'.$this->nombre_proceso.'%')

        ->join('unidades', 'unidades.id', '=', 'documentos.unidad_id')
        ->where('unidades.nombre','like','%'.$this->nombre_unidad.'%')
        


        ->select('documentos.id')
        ->selectRaw("documentos.numero  as numero")                
        ->selectRaw("tipodocumento.nombre  as tipo")
        ->selectRaw("documentos.fecha  as fecha")
        ->selectRaw("documentos.nombre  as asunto")
        ->selectRaw("procesos.nombre  as proceso")
        ->selectRaw("unidades.nombre  as unidad")
        ->selectRaw("documentos.carpeta  as carpeta")
        ->selectRaw("documentos.caja_id  as caja")
        ->selectRaw("documentos.proceso_id  as proceso_id")
        ->selectRaw("documentos.url  as url")
   
        ->get();
        $this->open_pro=true;  

      
    }
}
