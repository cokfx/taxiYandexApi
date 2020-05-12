<?php


namespace Data;


class Db
{
    private $pdo;

    public function __construct()
    {
        $dbSett = include __DIR__ . '/settings.php';
        $dbOptions=$dbSett['db'];
        $this->pdo = new \PDO(
            'mysql:host=' . $dbOptions['DBHost'] . ';dbname=' . $dbOptions['DBName'],
            $dbOptions['DBLogin'],
            $dbOptions['DBPassword']
        );
        $this->pdo->exec('SET NAMES UTF8');
    }

    public function query(string $sql, $params = []): ?array
    {
        $sth = $this->pdo->prepare($sql);
        $result = $sth->execute($params);

        if (false === $result) {
            return null;
        }

        return $sth->fetchAll();
    }

}