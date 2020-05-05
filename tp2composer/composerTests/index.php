<?php

    include 'vendor/autoload.php';
    use \Firebase\JWT\JWT;
    require_once "../Entidades/response.php";
    require_once "../Entidades/auth.php";

    $path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : "";
    $request_method = $_SERVER['REQUEST_METHOD'];
    $response = new Response();
    
    switch($request_method)
    {
        case "POST":
            if($path_info == "/signin")
            {
                if(isset($_POST['email']) && isset($_POST['clave']) && isset($_POST['nombre']) 
                && isset($_POST['apellido']) && isset($_POST['telefono']) && isset($_POST['tipo']))
                {
                    $email = $_POST['email'];
                    $key = $_POST['clave'];
                    $nombre = $_POST['nombre'];
                    $apellido = $_POST['apellido'];
                    $telefono = $_POST['telefono'];
                    $tipo = $_POST['tipo'];
                    $payload = new auth($email, $key, $nombre, $apellido, $telefono, $tipo);
                    $rta = $payload->guardar();
                    $response->data = $rta;
                    echo json_encode($response);

                }
                else{
                    $response->data = "Faltan datos";
                    $response->status = "fail";
                    echo json_encode($response);
                }

                
            }
            else if($path_info == "/login")
            {

                if(isset($_POST['email']) && isset($_POST['clave']))
                {
                    $email = $_POST['email'];
                    $key = $_POST['clave'];
                    $clave = auth::find($email, $key);
                    if($clave != null)
                    {
                        $payload = auth::get_payload($clave);
                        if($payload != null)
                        {
                            $jwt = JWT::encode($payload, $clave);
                            $response->data = $jwt;
                            echo json_encode($response);
                        }
                   
                    }
                    else
                    {
                        $response->data = "Usuario no encontrado";
                        $response->status = "fail";
                        echo json_encode($response);
                    }
                   
                }
                else
                {
                    $response->data = "Faltan datos";
                    $response->status = "fail";
                    echo json_encode($response);
                }
            }
            else
            {
                echo "Path no reconocido";
            }
            break;
        case "GET":
            if($path_info == "/detalle")
            {
                $headers = getallheaders();
                $miToken = $headers['token'] ?? '';
                
                $key = auth::buscarClavePorTipo("user");
            
                try
                {
                    $decoded = JWT::decode($miToken, $key, array('HS256'));
                    $response->data = $decoded;
                    echo json_encode($response);  
                }
                catch(\Throwable $th)
                {
                    echo $th->getMessage();
                }

            }
            else if ($path_info == "/lista")
            {
                $headers = getallheaders();
                $miToken = $headers['token'] ?? '';
                
                $key = auth::buscarClavePorTipo("user");
            
                try
                {
                    $decoded = JWT::decode($miToken, $key, array('HS256'));
                    $datos = auth::mostrarUsuarioPorKey($key);
                    $response->data = $datos;
                    echo json_encode($response);
                       
                }
                catch(\Throwable $th)
                {
                    echo $th->getMessage();
                }
               
            }
            else
            {
                echo "Path no reconocido";
            }
            break;

    }

?>