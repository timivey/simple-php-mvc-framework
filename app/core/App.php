<?php

class App {
    
    // default controller
    protected $controller = 'home';
    
    // default method
    protected $method = 'index';
    
    protected $params = array();
    
    public function __construct() {
        
        $url = $this -> parseURL();
        //print_r( $url );
        
        if ( file_exists( '../app/controllers/' . $url[0] . '.php' ) ) {
            
            $this -> controller = $url[0];
            unset( $url[0] );
        }
        
        // include the controller we found in the URL or the default one
        require_once '../app/controllers/' . $this -> controller . '.php';
        
        // create an object and set it to the controler property
        $this -> controller = new $this -> controller;
        
        // check if a method is set in the URL
        if ( isset( $url[1] ) ) {
            
            if ( method_exists( $this -> controller, $url[1] ) ) {
                
                $this -> method = $url[1];
                unset( $url[1] );                
                
            }
        }
        
        // Set $params property
        // array_values reindexs the array.
        $this -> params = $url ? array_values($url) : array();
        
        //print_r( $this -> params );
        
        // Call the controller and method
        call_user_func_array( array( $this -> controller, $this->method ), $this -> params );
        
        
    }
    
    public function parseUrl() {
        
        if(isset($_GET['url'])) {
            
            // remove any whitespace or a trailing slash from right.
            return $url = explode( '/', filter_var( rtrim($_GET['url'], '/' ), FILTER_SANITIZE_URL ) );
            
        }
        
    }

}

?>