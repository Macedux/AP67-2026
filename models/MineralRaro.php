<?php
class MineralRaro extends EntidadEstelar {
    protected $dureza; // Escala numérica de "Mohs"

    public function reaccionar(): string {
        return "Brilla con intensidad azulada  y unos Mohs de {$this->dureza}";
    }
    public function __construct($dureza,$idUnico,$nombre,$planetaOrigen,$nivelEstabilidad){
        parent:: __construct($idUnico,$nombre,$planetaOrigen,$nivelEstabilidad);
        
       $this->dureza=$dureza;
    }
            public function setDureza ($dureza){
                $this->dureza=$dureza;
                
            }


            public function getDureza() {
                return $this->dureza;
            }

    }

?>