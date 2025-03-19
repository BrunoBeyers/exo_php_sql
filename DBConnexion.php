<?php
$config = include('config.php');

class ConnectionDB {
    private $serverName;
    private $password;
    private $address;
    private $port;
    private $conn;

    public function __construct() {
        global $config; 
        $this->serverName = $config['NAME_DATABASE'];
        $this->password = $config['PASSWORD_DATABASE'];
        $this->address = $config['IP_DATABASE'];
        $this->port = $config['PORT_DATABASE'];

        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->address . 
                ";port=" . $this->port . 
                ";dbname=" . $this->serverName, 
                $this->serverName, 
                $this->password
            );

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}


$db = new ConnectionDB();
$conn = $db->getConnection();
