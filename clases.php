<?php

require_once __DIR__ . '/vendor/autoload.php';

use NNV\RestCountries;

interface iInformacion{
    public function MostrarDatosJson();
}

abstract class EntidadGeografica implements iInformacion{
    public $nombre;
    public $poblacion=0;     

}

class Continente extends EntidadGeografica{
    public $paises;

    public function __construct($nombre){
        $restCountries = new RestCountries;
        $continente=$restCountries->byRegion(self::Traduccion(strtolower($nombre)));
        $this->nombre=ucfirst(strtolower($nombre));
        $this->paises= array();
        foreach($continente as $pais){
            array_push($this->paises,new Pais($pais->translations->es));
            $this->poblacion+=$pais->population;
        }
    }

    public function MostrarDatosHtml(){
        $retorno="<ul><li>Continente: $this->nombre</li><li>Poblacion: $this->poblacion</li>";
        $retorno.="<li>Paises:<ul>";
        foreach($this->paises as $pais){
            $retorno.="<li>$pais->nombre</li>";
        }

        return $retorno.="</ul></li></ul>";
    }

    public function MostrarDatosJson(){
        return json_encode($this);
    }

    private function Traduccion($nombre){       //Africa, Americas, Asia, Europe, Oceania
        if($nombre=="europa")
            return "europe";
        elseif($nombre=="america")
            return "americas";
        else
            return $nombre;
    }
}

class Pais extends EntidadGeografica{
    public $capital;
    public $continente;    
    public $idioma;
    public $bandera;

    public function __construct($nombre){
        $pais= self::GetPais($nombre);
        if($pais){
            $this->nombre=$pais->translations->es;
            $this->poblacion=$pais->population;
            $this->capital=$pais->capital;
            $this->continente=$pais->region;
            $this->idioma=$pais->languages[0]->name;
            $this->bandera=$pais->flag;        

        }
        else
            echo "Pais no encontrado";
      
    }
    public function MostrarDatosHtml(){
        $retorno="<ul>";
        $retorno.="<li>Nombre: $this->nombre</li>";
        $retorno.="<li>Poblacion: $this->poblacion</li>";
        $retorno.="<li>Capital: $this->capital</li>";
        $retorno.="<li>Continente: $this->continente</li>";
        $retorno.="<li>Idioma: $this->idioma</li>";
        $retorno.="<li>Bandera: $this->bandera</li>";
        return $retorno.="</ul>";
    }

    public function MostrarDatosJson(){
        return json_encode($this);
    }

    private static function GetPais($nombre){
        $restCountries = new RestCountries;
        $paises=$restCountries->all();
        foreach($paises as $index => $pais){
            if(strtolower($pais->translations->es)==strtolower($nombre)){
                return $paises[$index];
            }
        }
        return 0;
    }
}



