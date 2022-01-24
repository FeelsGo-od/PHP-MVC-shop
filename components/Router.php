<?php 

    class Router {
        private $routes;

        public function __construct() {
            $routesPath= ROOT.'/config/routes.php';
            $this->routes = include($routesPath);
        }      

        // Returns request string
        private function getURI() {
            if(!empty($_SERVER['REQUEST_URI'])) {
                return trim($_SERVER['REQUEST_URI'], '/');
            }
        }

        public function run() {

            // Get request string
            $uri = $this->getURI();
            // echo $uri;

            foreach ($this->routes as $uriPattern => $path) {
                // echo "<br>$uriPattern -> $path";

                if (preg_match("~$uriPattern~", $uri)) {

                    // echo '<br>Где ищем (запрос, который набрал пользователь): '.$uri;
                    // echo '<br>Что ищем (совпадение из правила): '.$uriPattern; 
                    // echo '<br>Кто обрабатывает: '.$path;

                    $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

                    // echo '<br><br>Нужно сформировать: '.$internalRoute;
                    // echo '<br><br>';



                    $segments = explode('/', $internalRoute);
                    
                    $controllerName = array_shift($segments).'Controller';
                    $controllerName = ucfirst($controllerName);

                    $actionName = 'action'.ucfirst(array_shift($segments));
                    // echo '<br>controller name: '.$controllerName;
                    // echo '<br>action name: '.$actionName;
                    $parameters = $segments;
                    // echo '<pre>';
                    // print_r($parameters);

                    // die;

                    $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';

                    if (file_exists($controllerFile)) {
                        include_once($controllerFile);
                    }

                    $controllerObject = new $controllerName;
                    $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
                    if($result != null) {
                        break;
                    }
                }
            }
        }
    }

?>