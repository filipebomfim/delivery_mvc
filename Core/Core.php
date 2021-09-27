<?php 
    class Core {
        private $user;
        private $perfil;

        public function __construct(){
            $this->run();
        }

        public function run(){
            $parametros = array();
            if(isset($_GET['url'])) {
                $url = explode('/',$_GET['url']);
                    if($url[0] == 'painel') $url = explode('/',$_GET['url']);   

                    $controller = $url[0].'Controller'; //classe
                    array_shift($url);
                    
                    if(isset($url[0]) && !empty($url[0])){ //Pegando a função
                        $metodo = $url[0];
                        array_shift($url);
                        
                        if(count($url)>0) $parametros = $url;
                    }else $metodo = 'index'; //Somente classe
                    
                    
               
            }else{
                $controller = 'homeController';
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
    }
?>