<?php
    class ControladorInicial {
        private static $pagina = 'inicial.php';

        public static function dashboard() {
            $db = DB::conectar();

            if (JoaoArtur::logado()) {
                if (file_exists('config/view/paginas/'.self::$pagina)) {
                    include_once 'config/view/paginas/'.self::$pagina;
                } else {
                    echo 'View nao encontrada';
                }
            } else {
                header('Location:./login');
            }
        }

    }
?>