<?php

    use NNV\RestCountries;

    require_once "IPaises.php";

    class Rest implements IPaises
    {
        protected $rest;
        protected $paises;

        public function __construct()
        {
            $this->rest = new RestCountries;
            $paisesAuxiliar = $this->rest->all();
            $this->paises = $paisesAuxiliar;
        }

        public function Mostrar()
        {
            echo json_encode($this->paises);
        }

    }


?>