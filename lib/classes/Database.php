<?php

class Database
{
    private const DB_HOST = 'localhost';
    private const DB_USER = 'root';
    private const DB_PASS = '';
    private const DB_NAME = 'p2tienda';

    private const DB_DSN = 'mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME . ';charset=utf8mb4';

    private static $db = null;

    /**
     * Maneja errores de conexión con mensajes personalizados según el tipo de fallo.
     *
     * @param PDOException $error Excepción capturada.
     */
    private static function handleConnectionError(PDOException $error): void
    {
        $errorCode = $error->getCode();
        $message = match ($errorCode) {
            '1045' => 'Credenciales de base de datos incorrectas.',
            '2002' => 'No se pudo conectar con el servidor de base de datos.',
            'HY000' => 'Conexión perdida con la base de datos.',
            default => 'Error inesperado al conectar con la base de datos.',
        };
        // Registrar el error completo para depuración (en producción)
        error_log("Error de conexión [{$errorCode}]: {$error->getMessage()}", 3, '/var/log/db_errors.log');
        die($message);
    }

    /**
     * Obtiene una conexión a la base de datos utilizando PDO.
     *
     * @return PDO Instancia de la conexión PDO.
     * @throws PDOException Si no se puede establecer la conexión.
     */
    public static function getConnection(): PDO
    {
        if (self::$db === null) {
            try {
                self::$db = new PDO(
                    self::DB_DSN,
                    self::DB_USER,
                    self::DB_PASS,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES => false,
                    ]
                );
            } catch (PDOException $error) {
                self::handleConnectionError($error);
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
     * @throws PDOException Si ocurre un error en la consulta (no conexión).
     */
    public static function execute(string $query, array $params = [], string $entity = ''): mixed
    {
        try {
            $conn = self::getConnection();
            // Verificar si la conexión está activa
            if (!$conn->getAttribute(PDO::ATTR_CONNECTION_STATUS)) {
                throw new PDOException('Conexión perdida con la base de datos.', 'HY000');
            }
            $statement = $conn->prepare($query);
            $statement->execute($params);

            $type = strtoupper(substr($query, 0, strpos($query, ' ') ?: strlen($query)));

            if ($type === 'SELECT') {
                return $entity ? $statement->fetchAll(PDO::FETCH_CLASS, $entity) : $statement->fetchAll();
            }

            if ($type === 'INSERT') {
                return $conn->lastInsertId();
            }

            return true;
        } catch (PDOException $error) {
            // Verificar si el error es de conexión
            if (in_array($error->getCode(), ['1045', '2002', 'HY000'])) {
                self::handleConnectionError($error);
            }
            // Re-lanzar para errores de SQL (consultas erróneas)
            throw $error;
        }
    }
}
