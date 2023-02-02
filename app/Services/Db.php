<?php

namespace App\Services;

class Db
{

    private $pdo;
    private static $instance;

    private function __construct()
    {
        $dbOptions = (require __DIR__ . '/../../dbSettings.php')['db'];
        try {

            $this->pdo = new \PDO(
                'mysql:host=' . $dbOptions['host'] . ';dbname=' . $dbOptions['dbname'],
                $dbOptions['user'],
                $dbOptions['password']
            );
            $this->pdo->exec('SET NAMES UTF8');
        } catch (\PDOException $e) {
            throw new \Exception('Ошибка при подключении к базе данных: ' . $e->getMessage());
        }
    }
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
    public function query(string $sql, array $params = []): ?array
    {
        $sth = $this->pdo->prepare($sql);
        $result = $sth->execute($params);

        if (false === $result) {
            return null;
        }

        return $sth->fetchAll();
    }

}
