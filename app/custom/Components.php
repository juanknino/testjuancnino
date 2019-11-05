<?php

namespace App\Custom;

// use Illuminate\Foundation\Bus\DispatchesJobs;
// use Illuminate\Routing\Controller as BaseController;
// use Illuminate\Foundation\Validation\ValidatesRequests;
// use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Components
{
    public $components='';
    public $path = '';

    public function __construct() {
        $this->path=base_path('components');
        $newarray=array_diff(scandir($this->path), array('..', '.'));
        $newarray=array_values($newarray);
        foreach($newarray as $valid){
            if(file_exists($this->path.'/'.$valid.'/Class.php')){
                require_once $this->path.'/'.$valid.'/Class.php';
            }else{
                throw new Exception('Archivo "Class.php" no encontrado.');
            }

        }
        $this->components = $newarray;
    }

    function formsgenerate($contador,$formulario,$namecomponent){
        $html='';
        $html .='<!--texto-->';
        $html .='<div class="card">';
            $html .='<div class="card-header" id="heading'.$contador.'">';
            $html .='<h2 class="mb-0">';
            $html .='<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse'.$contador.'" aria-expanded="false" aria-controls="collapse'.$contador.'">';
            $html .='<i class="fas fa-chevron-circle-down"></i>&nbsp;&nbsp;';
            $html .= strtoupper($namecomponent);

            $html .='</button>';
            $html .='</h2>';
            $html .='</div>';
            $show=($contador==1)?'show':'';
            $html .='<div id="collapse'.$contador.'" class="collapse multi-collapse" aria-labelledby="headingOne" data-parent="#accordionComponent">';
            $html .='<div class="card-body">';

            $html .= $formulario;

            $html .='</div>';
            $html .='</div>';
            $html .='</div>';
            return $html;
    }
    public function componentsform(){
        $i=1;
        $html ='';
        $html .='<hr>';
        $html .='<button id="expand" class="btn btn-sm btn-outline-primary mr-0" type="button" data-toggle="collapse" data-target=".multi-collapse" aria-expanded="true" aria-controls="collapse1 collapse2 collapse3"> Expandir todo </button>';
        $html .='<div class="accordion" id="accordionComponent">';
        foreach($this->components as $componente)
        {
            $classname='Class_'.$componente;
            $infocompo= new $classname;

            $formulario=$infocompo->form;
            $html .='<input type="hidden" name="components['.$i.']" value="'.$componente.'"/>';
            $html .= $this->formsgenerate($i,$formulario,$componente);
            $i++;
        }
        $html .='</div>';
        return $html;
    }

}
