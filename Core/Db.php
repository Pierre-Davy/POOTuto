<?php

namespace App\Core;

//on importe PDO
use PDO;
use PDOException;


class Db extends PDO
{
    //instance unique de la class
    private static $instance;

    //Informations de connection
    private const DBHOST = 'localhost';
    private const DBNAME = 'tutopoo';
    private const DBUSER = 'root';
    private const DBPASS = '';

    private function __construct()
    {
        //dsn de construction
        $_dsn = 'mysql:host=' . self::DBHOST . ';dbname=' . self::DBNAME;

        //On appelle le constructeur de la class PDO
        try {
            parent::__construct($_dsn, self::DBUSER, self::DBPASS);

            $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}
