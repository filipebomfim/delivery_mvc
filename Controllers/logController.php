<?php

    class logController extends Controller{

        /*
        - Função: visualizarLog
        - Parâmetros: INTEIRO - filtro
        - Objetivo: Realiza uma filtragem e exibe os registros de log referente ao filtro selecionado.
        Os registros são exibidos de forma ordenada, baseado no horário de registro mais recente.
        */
        public function visualizarLog($filtro=0){
            $dados = array();
            $log = new Log();
            $dados['tipoLog'] = $log->getTipoLog();
            $col = array_column($dados['tipoLog'],"log_tipo_nome");
            array_multisort($col,SORT_ASC,$dados['tipoLog']);
            if($filtro==0){
                $dados['log'] = $log->getRegistros();
                $dados['titulo'] = 'Todos os Registros';
            } else {
                $dados['log'] = $log->getRegistro($filtro);
                $dados['titulo'] = 'Registros - ' .$log->getRegistroNome($filtro)['log_tipo_nome'];
            }   
            $this->carregarTemplate('painel/visualizarLog',$dados,'painel/templates/header','painel/templates/footer');
        }
    }
?>