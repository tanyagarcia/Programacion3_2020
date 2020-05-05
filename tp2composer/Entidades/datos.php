<?php

    class datos
    {
        public $archivo;

        public static function guardar($archivo, $instancia)
        {
            $file = fopen($archivo, "a");
            $rta = fwrite($file, serialize($instancia). PHP_EOL);
            fclose($file);

            return $rta;
        }

        public static function leer($archivo)
        {
            $file = fopen($archivo, "r");
            $array = array();

            while(!feof($file))
            {
                $linea = fgets($file);
                if($linea != "")
                {
                    array_push($array, unserialize($linea));
                }
                
            }

            fclose($file);
            return $array;
        }
        

    }


?>