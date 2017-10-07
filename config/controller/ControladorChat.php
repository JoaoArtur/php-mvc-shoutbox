<?php
    class ControladorChat {
        private static $tabela = 'shoutbox';

        public static function enviar() {
            header('Content-type: application/json');

            $logado = JoaoArtur::logado();
            if ($logado) {
                if (isset($_POST['mensagem']) && str_replace(' ','',$_POST['mensagem']) != '') {
                    $db  = DB::conectar();
                    $sql_tempo = "SELECT data FROM ".self::$tabela." WHERE id_usuario=:id_usuario ORDER BY id DESC";
                    $linha_tempo = $db->prepare($sql_tempo);
                    $linha_tempo->bindParam(':id_usuario', $logado['id']);
                    $linha_tempo->execute();
                    if ($linha_tempo->rowCount() > 0) {
                        $row = $linha_tempo->fetch(PDO::FETCH_ASSOC);
                        $tempo_anterior = $row['data'];
                        $tempo_atual    = time();
                        $calculo = $tempo_atual-$tempo_anterior;
                        if ($calculo > 3) {
                            $sql = "INSERT INTO ".self::$tabela." (id_usuario,mensagem,data,ip) VALUES (:id_usuario,:mensagem,:data,:ip)";
                            $tempo = time();
                            $qr  = $db->prepare($sql);
                            $qr->bindParam(':id_usuario', $logado['id']);
                            $qr->bindParam(':mensagem', $_POST['mensagem']);
                            $qr->bindParam(':data', $tempo);
                            $qr->bindParam(':ip', $_SERVER['REMOTE_ADDR']);
                            $qr->execute();

                            $retorno = array(
                                'status'=>true,
                                'msg'=>'Mensagem enviada com sucesso!'
                            );
                        } else {
                            $retorno = array(
                                'status'=>false,
                                'msg'=>'Voce deve fazer um intervalo de 3 segundos entre cada mensagem'
                            );
                        }
                    } else {
                        $sql = "INSERT INTO ".self::$tabela." (id_usuario,mensagem,data,ip) VALUES (:id_usuario,:mensagem,:data,:ip)";
                        $tempo = time();
                        $qr  = $db->prepare($sql);
                        $qr->bindParam(':id_usuario', $logado['id']);
                        $qr->bindParam(':mensagem', $_POST['mensagem']);
                        $qr->bindParam(':data', $tempo);
                        $qr->bindParam(':ip', $_SERVER['REMOTE_ADDR']);
                        $qr->execute();
    
                        $retorno = array(
                            'status'=>true,
                            'msg'=>'Mensagem enviada com sucesso!'
                        );
                    }

                } else {
                    $retorno = array(
                        'status'=>false,
                        'msg'=>'Mensagem nao encontrada'
                    );
                }
            } else {
                $retorno = array(
                    'status'=>false,
                    'msg'=>'Usuario nao esta logado'
                );
            }

            print_r(json_encode($retorno));
        }
        public static function listar() {
            header('Content-type: application/json');

            $db  = DB::conectar();
            $sql = "SELECT * FROM ".self::$tabela." ORDER BY id ASC LIMIT 0,300";
            

            $qr  = $db->prepare($sql);
            $qr->execute();
            
            $retorno = array(
                'total'=>$qr->rowCount(),
                'mensagens'=>array()
            );

            $arr_mensagens = array();
            while ($row = $qr->fetch(PDO::FETCH_ASSOC)) {
                $sql_nome = "SELECT nome FROM usuarios WHERE id=:id_usuario";
                $consulta_nome = $db->prepare($sql_nome);
                $consulta_nome->bindParam(":id_usuario",$row['id_usuario']);
                $consulta_nome->execute();
                if ($consulta_nome->rowCount() > 0) {
                    $row_usuario = $consulta_nome->fetch(PDO::FETCH_ASSOC);
                    $arr_mensagens[$row['id']] = $row;
                    $arr_mensagens[$row['id']]['nome'] = $row_usuario['nome'];
                } else {
                    $arr_mensagens[$row['id']] = $row;
                }
            }
            $retorno['mensagens'] = $arr_mensagens;

            print_r(json_encode($retorno));
        }
    }
?>