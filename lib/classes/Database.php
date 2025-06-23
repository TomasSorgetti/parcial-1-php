<?php

class Database
{
    private const DB_HOST = 'localhost';
    private const DB_USER = 'root';
    private const DB_PASS = '';
    private const DB_NAME = 'p2tienda';

    private const DB_DSN = 'mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME . ';charset=utf8mb4';

    private static $db = null;

    public static function ping()
    {
        echo ("pong");
    }

    public static function getConnection()
    {
        if (self::$db == null) {
            try {
                self::$db = new PDO(self::DB_DSN, self::DB_USER, self::DB_PASS);
            } catch (Exception $error) {
                die("Error al conectar: " . $error->getMessage());
            }
        }
        return self::$db;
    }

    public static function execute($query, $params = [], $entity = '')
    {
        try {
            $conn = self::getConnection();
            $stmt = $conn->prepare($query);

            if (!empty($params)) {
                $stmt->execute($params);
            } else {
                $stmt->execute();
            }

            $tipe = strtoupper(substr($query, 0, strpos($query, ' ')));

            if ($tipe == 'SELECT') {
                if ($entity != '') {
                    return $stmt->fetchAll(PDO::FETCH_CLASS, $entity);
                } else {
                    return $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
            }

            if ($tipe == 'INSERT') {
                return $conn->lastInsertId();
            }

            return true;
        } catch (Exception $error) {
            die("Error en la consulta: " . $error->getMessage());
        }
    }
}
