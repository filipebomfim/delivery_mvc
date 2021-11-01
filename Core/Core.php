<?php 
    class Core {

        public function __construct(){
            $this->run();
        }

        
        /*
        - Função: run
        - Parâmetros: Sem parâmetros
        - Objetivo: Função que faz o tratamento da url do projeto. A partir da quebra da String proveniente da url, são encontrados o controlador, o método e os parâmetros a serem utilizados.
        */
        public function run(){
            $parametros = array();
            if(isset($_GET['url'])) {
                $url = explode('/',$_GET['url']);
                    if($url[0] == 'painel') $principal = 'painel';
                    else if($url[0] == 'site') $principal = 'site';
                    else $principal = $url[0];
                    array_shift($url);

                    if(isset($url[0]) && !empty($url[0])){ //Pegando o controlador
                        $controller = $url[0].'Controller'; //controller
                        array_shift($url);

                        if(isset($url[0]) && !empty($url[0])){ //Pegando a função
                            $metodo = $url[0];
                            array_shift($url);
                            
                            if(count($url)>0) $parametros = $url;
                        }else $metodo = 'index'; //Somente classe
                    }else{
                        $controller = $principal.'Controller';
                        $metodo = 'index';
                    }                   
               
            }else{
                $controller = 'indexController';
                $metodo = 'index';
            }
            
            
            $caminho = 'sistema_estoque/Controller/'.$controller.'.php';
            if (!file_exists($caminho) && !method_exists($controller,$metodo)){ 
                $controller = 'erroController';
                $metodo = 'index';
            }

            $app = new $controller;
            call_user_func_array(array($app,$metodo),$parametros);
            
        }

        /*
        public function run(){
            $parametros = array();
            if(isset($_GET['url'])) {
                $url = explode('/',$_GET['url']);
                    if($url[0] == 'painel') {
                        $url = explode('/',$_GET['url']);
                        if(!(isset($url[0]))) {
                            $controller = 'painelController';
                            $metodo = 'index';
                        }  
                    }else if($url[0] == 'site') {
                        $url = explode('/',$_GET['url']);
                        if(!(isset($url[0]))) {
                            $controller = 'siteController';
                            $metodo = 'index';
                        }  
                    }
                    array_shift($url);

                    if(isset($url[0]) && !empty($url[0])){ //Pegando a classe
                        $controller = $url[0].'Controller'; //classe
                        array_shift($url);

                        if(isset($url[0]) && !empty($url[0])){ //Pegando a função
                            $metodo = $url[0];
                            array_shift($url);
                            
                            if(count($url)>0) $parametros = $url;
                        }else $metodo = 'index'; //Somente classe
                    }                   
                                        
                   
                    
                    
               
            }else{
                $controller = 'indexController';
                $metodo = 'index';
            }
            
            
            $caminho = 'sistema_estoque/Controller/'.$controller.'.php';
            if (!file_exists($caminho) && !method_exists($controller,$metodo)){ 
                $controller = 'erroController';
                $metodo = 'index';
            }

            $app = new $controller;
            call_user_func_array(array($app,$metodo),$parametros);
            
        }
        */
    }
?>