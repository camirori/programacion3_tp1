<?php

require_once "./clases.php";

if(isset($_GET['continente'])){
    $continente= new Continente($_GET['continente']);
    echo $continente->MostrarDatosJson();
}elseif(isset($_GET['pais'])){
    $pais = new Pais($_GET['pais']);
    echo $pais->MostrarDatosJson();
}else{
    echo "Ingrese param pais o continente";
}
