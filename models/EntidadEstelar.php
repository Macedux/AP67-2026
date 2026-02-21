<?php
class EntidadEstelar
{
    protected $idUnico;
    protected $nombre;
    protected $planetaOrigen;

    protected $nivelEstabilidad;


    public function __construct($idUnico,$nombre,$planetaOrigen,$nivelEstabilidad)
    {
        $this->idUnico = $idUnico;
        $this->nombre = $nombre;    
        $this->planetaOrigen = $planetaOrigen;
        $this->nivelEstabilidad =$nivelEstabilidad;

    }
    public function getIdUnico()
    {
        return $this->idUnico;
    }
        public function getNombre()
    {
         return $this->nombre;
    }
        public function getPlanetaOrigen()
    {
        return $this->planetaOrigen;
    }

        public function getNivelEstabilidad()
    {
        return $this->nivelEstabilidad;
    }
    public function reaccionar()
{
    return "La entidad emite una reacción desconocida...";
}
}
