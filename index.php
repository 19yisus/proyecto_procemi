<?php
  class App{
    public $mensaje, $http;
    private $vistas_publicas = ['View_Login-romanero','View_Login-laboratorio'];
    public function __construct()
    {
      session_start();
      $this->Vista($this->Route()[0]);
    }

    private function Vista($file)
    {
      if(strpos($file,"View_") !== false){
        $path = "./Vista/contents/$file.php";
        if(!file_exists($path)) header("Location: ./View_index");;

        if(isset($_SESSION['rol_id'])){
          if(strpos($file,"View_Login-") !== false){
            header("Location: ./View_index");
          }else require_once $path;
        }

        if(!isset($_SESSION['rol_id'])){
          if(strpos($file,"View_Login-") !== false){
            require_once $path;
          }else header("Location: ./View_Login-laboratorio");
        }        
      } 
    }

    private function Route()
    {
      $url = isset($_GET['url']) ? $_GET['url'] : 'View_index';
      $url = rtrim($url, "/");
      $url = explode("/", $url);
            
      if(isset($url['mensaje'])) $this->mensaje = $url['mensaje'];
      return  $url;
    }

    private function Assets($path_file){
      $path_file = "./Vista/$path_file";
      if(file_exists($path_file)) echo $path_file;
    }
    private function Component($file){
      $path_file = "./Vista/includes/$file.php";
      if(file_exists($path_file)) require_once($path_file);
    }
    
  }

  $app = new App();