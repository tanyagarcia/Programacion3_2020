<?php

    require_once "Rest.php";

    class Capital extends Rest
    {
        protected static $pais;

        public function __construct($name)
        {
            parent:: __construct();
            $paisAuxiliar = $this->rest->byCapitalCity($name);
            self::$pais = $paisAuxiliar[0]->name;
        }


        public static function MostrarPais()
        {
            echo "Pais: ".self::$pais. PHP_EOL;
        }

    }


?>