<?php
  class App{
    public $mensaje, $http;
    public function __construct()
    {
      $this->Vista($this->Route()[0]);
    }

    private function Vista($file)
    {
      $path = "./Vista/contents/$file.php";
      if(strpos($file,"View_") !== false){
        if(file_exists($path)) require_once $path; else header("Location: ./View_index");;
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