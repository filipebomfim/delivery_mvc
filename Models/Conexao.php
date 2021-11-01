<?php 
    class Conexao {
        private static $pdo;
        private function __construct(){}

        
        /*
        - Função: getConexao
        - Parâmetros: Sem parâmetros
        - Objetivo: Função estática que realiza a conexão com o banco de dados.
        */
        public static function getConexao(){
            if(!isset(self::$pdo)){
                try {
                    self::$pdo=new PDO('mysql:host='.HOST.';dbname='.DATABASE,USER,PASSWORD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
                    self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
                } catch (Exception $e) {
                    echo    '<div class="alert alert-danger" role="alert">
                                Erro :'.$e.'
                            </div>';
                }
            }

            return self::$pdo;
        }

    }
?>