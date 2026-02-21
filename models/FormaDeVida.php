<?php
class FormaDeVida extends EntidadEstelar {
    protected $dieta; // carbono silicio energia
    public function reaccionar(): string {
        return "Emite un pulso electromagnético  y se alimenta de {$this->dieta} en grandes cantidades";
    }
    public function __construct($dieta,$idUnico,$nombre,$planetaOrigen,$nivelEstabilidad){
        parent:: __construct($idUnico,$nombre,$planetaOrigen,$nivelEstabilidad);
        
       $this->dieta = $dieta;
    }
            public function setDieta ($dieta){
                $this->dieta = $dieta;
                
            }


            public function getDieta() {
                return $this->dieta;
            }

    }

?>