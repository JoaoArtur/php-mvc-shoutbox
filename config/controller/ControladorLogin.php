<?php
    class ControladorLogin {
        private static $pagina = 'login.php';

        public static function login() {
            $db = DB::conectar();

            if (JoaoArtur::logado()) {
                header('Location:./');
            } else {
                if (file_exists('config/view/paginas/'.self::$pagina)) {
                    include_once 'config/view/paginas/'.self::$pagina;
                } else {
                    echo 'View nao encontrada';
                }
            }
        }    
    }
?>