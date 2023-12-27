<?php

class users
{
    private $email;
    private $username;
    private $pass;
    private $state;
    private $role;

    public function __construct($email, $username, $pass, $state, $role)
    {
        $this->email = $email;
        $this->username = $username;
        $this->pass = $pass;
        $this->state = $state;
        $this->role = $role;
    }
 
    public function getEmail()
    {
        return $this->email;
    }
 
    public function getUsername()
    {
        return $this->username;
    }
 
    public function getPass()
    {
        return $this->pass;
    }
 
    public function getState()
    {
        return $this->state;
    }
 
    public function getRole()
    {
        return $this->role;
    }
}

// require_once('database.php');

// function get_users()
// {
//     $conn = new database();
//     $conn = $conn->getConnection();

//     $stmt = $conn->prepare("SELECT * FROM users");
//     $stmt->execute();
//     $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
//     return $res;
// }
