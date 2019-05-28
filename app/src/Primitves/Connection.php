<?php

namespace App\Primitives;

class Connection{

    protected $database;

    public function __construct($database){

        $this->database=$database;

    }
    
}

?>