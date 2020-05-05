<?php

    include_once "../Entidades/datos.php";

    class auth
    {
        public $email;
        public $key;
        public $nombre;
        public $apellido;
        public $telefono;
        public $tipo;
        
        public function __construct($email, $key, $nombre, $apellido, $telefono, $tipo)
        {
            $this->email = $email;
            $this->key = $key;
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->telefono = $telefono;
            $this->tipo = $tipo;
        }

        public function guardar()
        {
            return Datos::guardar("usuarios.json", $this);
        }

        public function leer()
        {
            $lista = Datos::leer("usuarios.json");
            return $lista;
        }

        public static function find($email, $key)
        {
            $lista = auth::leer();

            $keyEncontrada = "";

            foreach($lista as $auth)
            {
                if($auth->key == $key && $auth->email == $email)
                {
                    $keyEncontrada = $auth->key;
                    break;

                }
            }

            return $keyEncontrada;
            
        }

        public static function get_payload($key)
        {
            $usuario = auth::buscarUsuarioPorKey($key);
            if($usuario != null)
            {
                $hora = time();
                $payload = array(
                "iat" => $hora,
                "nbf" => $hora + 50,
                "id" => $usuario->email,
                "nombre" => $usuario->nombre,
                "dni" => $usuario->apellido,
                "obra_social" => $usuario->telefono,
                "tipo" => $usuario->tipo,
                "clave" => $usuario->key
                );
            }
           return $payload;

        }

        public static function buscarUsuarioPorKey($key)
        {
            $lista = auth::leer();
            $userEncontrado = "";

            foreach($lista as $value)
            {
                if($value->key == $key)
                {
                    $userEncontrado = $value;
                    break;
                }
            }

            return $userEncontrado;
            
        }

        public static function buscarClavePorTipo($tipo)
        {
            $lista = auth::leer();
            $keyEncontrada = "";

            foreach($lista as $value)
            {
                if($value->tipo == $tipo)
                {
                    $keyEncontrada = $value->key;
                    break;
                }
            }

            return $keyEncontrada;
            
        }

        public static function mostrarUsuarioPorKey($key)
        {
            $lista = auth::leer();
            $userEncontrado = "";

            foreach($lista as $value)
            {
                if($value->key == $key)
                {
                    if($value->tipo == "admin")
                    {
                        $userEncontrado = $lista;
                    }
                    else
                    {
                        $userEncontrado = $value;
                    }
                }
            }

            return $userEncontrado;
            
        }
       




    }

?>