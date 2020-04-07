<?php

require_once "./clases.php";

if(isset($_GET['continente'])){
    $busqueda= new Continente($_GET['continente']);
    echo $busqueda->MostrarDatosJson();
}elseif(isset($_GET['idioma'])){
    $busqueda = new Idioma($_GET['idioma']);
    echo $busqueda->MostrarDatosJson();
}elseif(isset($_GET['capital'])){
    $busqueda = new Capital($_GET['capital']);
    echo $busqueda->MostrarDatosJson();
}elseif(isset($_GET['subregion'])){
    $busqueda = new SubRegion($_GET['subregion']);
    echo $busqueda->MostrarDatosJson();
}else{
    echo "Ingrese param continente, subregion, idioma o capital";
}
