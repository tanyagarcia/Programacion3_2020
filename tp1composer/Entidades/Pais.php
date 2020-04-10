<?php

    require_once "Rest.php";

    class Pais extends Rest
    {
        protected $capital;

        public function __construct($name)
        {
            parent:: __construct();
            $paisAuxiliar = $this->rest->byName($name);
            $this->capital = $paisAuxiliar[0]->capital;
        }

        public function MostrarCapital()
        {
            echo "Capital: ".$this->capital. PHP_EOL;
        }

    }


?>