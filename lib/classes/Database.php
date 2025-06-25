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

    /**
     * Obtiene una conexión a la base de datos utilizando PDO.
     *
     * @return PDO Instancia de la conexión PDO.
     * @throws Exception Si no se puede establecer la conexión.
     */
    public static function getConnection(): PDO
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

    /**
     * Ejecuta una consulta SQL en la base de datos.
     *
     * @param string $query Consulta SQL a ejecutar.
     * @param array $params Parámetros para la consulta preparada (opcional).
     * @param string $entity Nombre de la clase para mapear resultados (opcional, usado en consultas SELECT).
     * @return mixed Resultado de la consulta: array para SELECT, int para INSERT (ID insertado), true para otras consultas.
     * @throws Exception Si ocurre un error en la consulta.
     */
    public static function execute(string $query, array $params = [], string $entity = ''): mixed
    {
        try {
            $conn = self::getConnection();
            $statement = $conn->prepare($query);

            if (!empty($params)) {
                $statement->execute($params);
            } else {
                $statement->execute();
            }

            $tipe = strtoupper(substr($query, 0, strpos($query, ' ')));

            if ($tipe == 'SELECT') {
                if ($entity != '') {
                    return $statement->fetchAll(PDO::FETCH_CLASS, $entity);
                } else {
                    return $statement->fetchAll(PDO::FETCH_ASSOC);
                }
            }

            if ($tipe == 'INSERT') {
                return $conn->lastInsertId();
            }

            return true;
        } catch (PDOException $error) {
            // die("Error al ejecutar la consulta: " . $error->getMessage());
            throw $error;
        }
    }
}
