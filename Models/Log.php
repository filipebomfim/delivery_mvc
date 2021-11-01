<?php
class Log
{
    private $conexao;
    private $id, $tipo, $descricao, $data;

    public function __construct()
    {
        $this->conexao = Conexao::getConexao();
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getTipo(){
        return $this->tipo;
    }

    public function setTipo($tipo){
        $this->tipo = $tipo;
    }

    public function getDescricao(){
        return $this->descricao;
    }

    public function setDescricao($descricao){
        $this->descricao = $descricao;
    }

    public function getData(){
        return $this->data;
    }

    public function setData($data){
        $this->data = $data;
    }


     /*
        - Função: getTipoLog
        - Parâmetros: Sem parâmetros
        - Objetivo: Conecta-se ao banco de dados e retorna todos os tipos de log cadastrados.
        */
    public function getTipoLog()
    {
        $dados = array();
        $sql = $this->conexao->prepare(
            "SELECT * FROM tb_log_tipo"
        );
        $sql->execute();
        $dados = $sql->fetchall(PDO::FETCH_ASSOC);
        return $dados;
    }

        /*
        - Função: setRegistro
        - Parâmetros: Sem parâmetros
        - Objetivo: Conecta-se ao banco de dados e armazena um log realizado, seja de cadastro ou alteração.
        */
    public function setRegistro()
    {
        try {
            $sql = $this->conexao->prepare(
                "INSERT INTO tb_log
                    VALUES (null,?,?,?)"
            );
            $sql->execute(array($this->tipo, $this->descricao, $this->data));
            return true;
        } catch (\Throwable $th) {
            $_SESSION['status'] = 'erro';
            $_SESSION['status_msg'] = $th;
            return false;
        }
    }

    /*
        - Função: getRegistros
        - Parâmetros: Sem parâmetros
        - Objetivo: Conecta-se ao banco de dados e retorna todos os logs cadastrados.
    */
    public function getRegistros()
    {
        $dados = array();
        $sql = $this->conexao->prepare(
            "SELECT * FROM tb_log
                     INNER JOIN tb_log_tipo
                     ON log_tipo = log_tipo_id
                    "
        );
        $sql->execute();
        $dados = $sql->fetchall(PDO::FETCH_ASSOC);
        return $dados;
    }

    /*
        - Função: getRegistro
        - Parâmetros: INTEIRO - filtro
        - Objetivo: Conecta-se ao banco de dados e retorna todos os logs armazenados referente a um tipo específico de log.
    */
    public function getRegistro($filtro)
    {
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


    /*
        - Função: getRegistroNome
        - Parâmetros: Sem parâmetros
        - Objetivo: Conecta-se ao banco de dados e retorna um tipo específico de log.
        */
    public function getRegistroNome(){
        $dados = array();
        $sql = $this->conexao->prepare(
            "SELECT log_tipo_nome FROM tb_log_tipo
                WHERE log_tipo_id = ?"
        );
        $sql->execute(array(intval($this->id)));
        $dados = $sql->fetch(PDO::FETCH_ASSOC);
        return $dados;
    }

}
