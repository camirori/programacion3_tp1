<?php

require_once __DIR__ . '/vendor/autoload.php';

use NNV\RestCountries;

interface iInformacion{
    public function MostrarDatosJson();
    public static function ObtenerDatos($nombre);
}

abstract class CriterioBusqueda implements iInformacion{
    public $paises;
    public function __construct($datos){
        $this->paises= $datos;
    }

    public function MostrarDatosJson(){
        return json_encode($this);
    }
}

class Continente extends CriterioBusqueda{
    public function __construct($nombre){
        parent::__construct(self::ObtenerDatos($nombre));
    }

    public static function ObtenerDatos($nombre){
        $restCountries = new RestCountries;
        return $restCountries->byRegion($nombre);
    }
}

class Idioma extends CriterioBusqueda{
    public function __construct($nombre){
        parent::__construct(self::ObtenerDatos($nombre));
    }

    public static function ObtenerDatos($nombre){
        $restCountries = new RestCountries;
        return $restCountries->byLanguage($nombre);  
    }
}

class Capital extends CriterioBusqueda{
    public function __construct($nombre){
        parent::__construct(self::ObtenerDatos($nombre));
    }

    public static function ObtenerDatos($nombre){
        $restCountries = new RestCountries;
        return $restCountries->byCapitalCity($nombre);  
    }
}

class SubRegion extends CriterioBusqueda{
    public function __construct($nombre){
        parent::__construct(self::ObtenerDatos($nombre));
    }

    public static function ObtenerDatos($nombre){
        $restCountries = new RestCountries;
        return $restCountries->byRegionalBloc($nombre);
    }
}