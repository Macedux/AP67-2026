<?php
class ArtefactoAntiguo extends EntidadEstelar
{
    protected $antiguedad; // años luz
    public function reaccionar(): string
    {
        return "Reproduce un mensaje en una lengua muerta hace  {$this->antiguedad} años";
    }
    public function __construct($antiguedad, $idUnico, $nombre, $planetaOrigen, $nivelEstabilidad)
    {
        parent::__construct($idUnico, $nombre, $planetaOrigen, $nivelEstabilidad);

        $this->antiguedad = $antiguedad;
    }
    public function setAntiguedad($antiguedad)
    {
        $this->antiguedad = $antiguedad;

    }


    public function getAntiguedad()
    {
        return $this->antiguedad;
    }

}

?>