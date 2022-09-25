<?php
class DB {
    public static function connect()  {
        $host = 'sql799.main-hosting.eu';
        $user = 'u253901924_projetouser';
        $pass = 'SenhaTemporaria@01';
        $base = 'u253901924_projeto';

        return new PDO("mysql:host={$host};dbname={$base};charset=UTF8;", $user, $pass);
    }
}