<?php
    class Log{
        private $conexao;
        private $tipo,$item,$data;

        public function __construct()
        {
            $this->conexao = Conexao::getConexao();
        }

        public function getTipoLog(){
            $dados = array();
                $sql = $this->conexao->prepare(
                    "SELECT * FROM tb_log_tipo"
                );
                $sql->execute();
                $dados = $sql->fetchall(PDO::FETCH_ASSOC);
                return $dados;
        }

        public function setRegistro($registro){
            try {
                $sql = $this->conexao->prepare(
                    "INSERT INTO tb_log
                    VALUES (null,?,?,?)"
                );
                $sql->execute(array($registro['tipo'],$registro['descricao'],date('Y-m-d H:i:s')));
                return true;
            } catch (\Throwable $th) {
                $_SESSION['status'] = 'erro';
                $_SESSION['status_msg'] = $th;
                return false;
            }  
        }

        public function getRegistros(){
                $dados = array();
                $sql = $this->conexao->prepare(
                    "SELECT * FROM tb_log 
                     INNER JOIN tb_log_tipo
                     ON log_tipo = log_tipo_id
                     ORDER BY log_registro DESC
                    "
                );
                $sql->execute();
                $dados = $sql->fetchall(PDO::FETCH_ASSOC);
                return $dados;
        }

        public function getRegistro($filtro){
            $dados = array();
            $sql = $this->conexao->prepare(
                "SELECT * FROM tb_log 
                 INNER JOIN tb_log_tipo
                 ON log_tipo = log_tipo_id
                 WHERE log_tipo_id = ?
                 ORDER BY log_registro DESC
                "
            );
            $sql->execute(array(intval($filtro)));
            $dados = $sql->fetchall(PDO::FETCH_ASSOC);
            return $dados;
    }
    }
?>