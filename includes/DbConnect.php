<?php

class DbConnect
{
    private $con;
    
    function _construct()
    {
        
    }
    function connect()
    {
        include_once dirname(__FILE__) .'/Constants.php';
        $this->con =new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        
        if(mysqli_connect_errno())
        {
            echo "FAILED TO CONNECT TO MYSQL :" . mysqli_connect_errno();
            return null;
        }
        
        return $this->con;
        
    }
    
    
    
    
    
}