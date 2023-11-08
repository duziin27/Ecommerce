<?php
class Mysql{
    public const SERVER_NAME = "localhost";
    public const USER_NAME = "root";
    public const PASSWORD = "";
    public const DB_NAME = "ecommerce";

    public static function conexao(){
        return new mysqli(self::SERVER_NAME, self::USER_NAME, self::PASSWORD, self::DB_NAME);
    }

}

