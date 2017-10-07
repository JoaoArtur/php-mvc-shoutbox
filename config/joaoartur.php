<?php
    class JoaoArtur extends DB {
        private static $rota;

        public static function logado() {
            $db  = DB::conectar();
            $dados = (isset($_SESSION['dados']) ? $_SESSION['dados'] : false);
            if ($dados != false) {
                $sql = "SELECT * FROM usuarios WHERE (usuario=:usuario and senha=:senha)"; 
                $qr  = $db->prepare($sql);
                $qr->bindParam(':usuario',$dados['usuario']);
                $qr->bindParam(':senha',$dados['senha']);
                $qr->execute();

                if ($qr->rowCount() > 0) {
                    return $qr->fetch(PDO::FETCH_ASSOC);
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
        public static function carregarArquivo($arquivo) {
            return 'config/view/assets/'.$arquivo;
        }
        public static function logar() {
            if (isset($_POST['dados'])) {
                $dados = $_POST['dados'];
                $dados['senha'] = md5($dados['senha']);
                $db = DB::conectar();
                $sql = "SELECT * FROM usuarios WHERE (usuario=:usuario and senha=:senha)";
                $qr = $db->prepare($sql);
                $qr->bindParam(':usuario',$dados['usuario']);
                $qr->bindParam(':senha',$dados['senha']);
                $qr->execute();

                if ($qr->rowCount() > 0) {
                    $_SESSION['dados'] = array();
                    $_SESSION['dados']['usuario'] = $_POST['dados']['usuario'];
                    $_SESSION['dados']['senha'] = md5($_POST['dados']['senha']);
                    return $qr->fetch(PDO::FETCH_ASSOC);
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public static function setarRota() {
            self::$rota           = array();
            self::$rota['/']      = array('controlador'=>'ControladorInicial','acao'=>'dashboard');
            self::$rota['/login'] = array('controlador'=>'ControladorLogin','acao'=>'login');
            self::$rota['/api/enviar'] = array('controlador'=>'ControladorChat','acao'=>'enviar');
            self::$rota['/api/listar'] = array('controlador'=>'ControladorChat','acao'=>'listar');
        }
        public static function usarRota() {
            self::setarRota();
            
            session_start();
            Seguranca::proteger();


            foreach (self::$rota as $chave=>$valor) {
                if (self::obterUrl() == $chave) {
                    if (file_exists('config/controller/'.$valor['controlador'].'.php')) {
                        include_once 'config/controller/'.$valor['controlador'].'.php';

                        $c = new $valor['controlador'];
                        $c::$valor['acao']();
                    } else {
                        echo "Controlador nao encontrado";
                    }
                }
            }

        }

        private static function obterUrl() {
            return $_SERVER['REQUEST_URI'];
        }

    }

    abstract class DB {
        private static $host = 'HOST';
        private static $user = 'USUARIO';
        private static $pass = 'SENHA';
        private static $name = 'BANCO';

        public static function conectar() {
            try {
                $con = new PDO('mysql:host='.self::$host.';dbname='.self::$name,self::$user,self::$pass);
                return $con;
            } catch (PDOException $pdo) {
                echo $pdo->getMessage();
            }
        }
    }

    abstract class Seguranca {
        private static $anti = true;
        
        public static function proteger() {
            if (isset($_POST)) {
                foreach ($_POST as $chave=>$valor) {
                    if (self::$anti) {
                        $_POST[$chave] = self::antisql($valor);
                    }
                }
            }
            if (isset($_GET)) {
                foreach ($_GET as $chave=>$valor) {
                    if (self::$anti) {
                        $_GET[$chave] = self::antisql($valor);
                    }
                }
            }
            if (isset($_SESSION)) {
                foreach ($_SESSION as $chave=>$valor) {
                    if (self::$anti) {
                        $_SESSION[$chave] = self::antisql($valor);
                    }
                }
            }
        }

        public static function antisql($valor) {
            $valor = str_replace(array('"',"'",';','='),'',$valor);
            if (is_array($valor)) {
                foreach ($valor as $chave=>$v) {
                    $valor[$chave] = htmlspecialchars($v);
                }
            } else {
                $valor = htmlspecialchars($valor);
            }
            return $valor;
        }
    }
?>