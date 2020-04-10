<?php

    require_once __DIR__.'/vendor/autoload.php';
    require_once "../Entidades/Pais.php";
    require_once "../Entidades/Capital.php";
    require_once "../Entidades/Rest.php";

    $pais = new Pais("Argentina");
    $pais->MostrarCapital();
   
    $capital = new Capital("Buenos Aires");
    Capital::MostrarPais();

    /**
     * Muestra la lista de paises
     */
    //$restCountries = new Rest;
    //$restCountries->Mostrar();
?>