<?php

class Database {
    private $host = DB_HOST;
    private $port = DB_PORT;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;
    private $dbh; // database handler - a string containing the host, port, and database name
    private $stmt; // SQL statement or call to stored procedure
    private $error; // error message

    public function __construct() {
        // On localhost this would become
        // $dsn = "mysql:host=127.0.0.1;port=3307;dbname=shareposts_23";
        $dsn = "mysql:host=" . $this->host .
            ";port=" . $this->port .
            ";dbname=" . $this->dbname;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//            PDO::MYSQL_ATTR_SSL_CA => APPROOT . "/libraries/curl-ca-bundle.crt",
        );
//        echo "<h1>" . openssl_get_cert_locations()['ini_cafile'] . "</h1>";
//        echo "<pre>" . print_r(openssl_get_cert_locations(),1) . "</pre>";
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch(PDOException $e) {
            $this->error = $e->getMessage();
            die("Connection failed: " . $this->error);
        }
    }

    public function query($sql) {
        $this->stmt = $this->dbh->prepare($sql);
    }

    public function bind($param, $value, $type = null) {
        if(is_null($type)) {
            if(is_int($value)) {
                $type = PDO::PARAM_INT;
            } else if(is_bool($value)) {
                $type = PDO::PARAM_BOOL;
            } else if(is_null($value)) {
                $type = PDO::PARAM_NULL;
            } else {
                $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    // Run this if you don't need records back (INSERT)
    public function execute() {
        return $this->stmt->execute();
    }
    // Run this if you need one or more records back
    public function resultSet() {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }
    // Run this if you need only one record back
    public function single() {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }
    // Run this if you need to check if a single thing exists
    public function rowCount() {
        $this->execute();
        return $this->stmt->fetchColumn();
    }


}