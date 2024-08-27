<?php

namespace Database\PDO;

class Connection {

    private static $instance;
    private $connection;

    private function __construct() {
        $this->make_connection();
    }

    public static function getInstance() {
        if (!self::$instance instanceof self)
            self::$instance = new self();

        return self::$instance;
    }

    public function get_database_instance() {
        return $this->connection;
    }

    private function make_connection() {
        $server = "localhost";
        $database = "finanzas_personales";
        $username = "root";
        $password = "1234";

        // Aquí se mantiene el uso de PDO
        $this->connection = new \PDO("mysql:host=$server;dbname=$database", $username, $password);

        // Establece el juego de caracteres
        $setnames = $this->connection->prepare("SET NAMES 'utf8'");
        $setnames->execute();
    }
}