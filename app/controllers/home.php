<?php

/**
 * The default home controller, called when no controller/method has
 * been bassed to the application.
 */
 
class Home extends Controller {

    public function index($name = '') {

        $user = $this -> model('User');
        $user->name = $name;
        
        // the path
        $this -> view('home/index', array( 'name' => $user -> name) );

    }
    
 }
 
 
 ?>