<?php
class Connection
{

    private $host, $dbname, $username, $password;

    public function __construct($host, $dbname, $username, $password)
    {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
    }

    public function getConnection()
    {
        try {
            $pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname;", $this->username, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $pde) {
            echo $pde->getMessage();
            return null;
        }
    }
}
