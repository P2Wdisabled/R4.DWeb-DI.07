<?php

namespace App\Service;

use App\Entity\Lego;
use PDO;

class LegoService
{
    private PDO $connection;

    public function __construct()
    {
        $host = 'tp-symfony-mysql';
        $db = 'lego_store';
        $user = 'root';
        $pass = 'root';
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->connection = new PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }


    public function getLegos(): array {
        $stmt = $this->connection->prepare("SELECT * FROM lego");
        $stmt->execute();
        $rows = $stmt->fetchAll();

        $legos = [];

        foreach ($rows as $row) {
            $lego = new Lego(
                $row['id'],
                $row['name'],
                $row['collection']
            );

            // Hydratation des propriétés
            $lego->setDescription($row['description']);
            $lego->setPrice($row['price']);
            $lego->setPieces($row['pieces']);
            $lego->setBoxImage($row['imagebox']);
            $lego->setLegoImage($row['imagebg']);

            $legos[] = $lego;
        }

        return $legos;
    }



    public function getLegosByCollection(string $collection): array {
        $stmt = $this->connection->prepare("SELECT * FROM lego WHERE collection = :collection");
        $stmt->bindParam(':collection', $collection, PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll();

        $legos = [];

        foreach ($rows as $row) {
            $lego = new Lego(
                $row['id'],
                $row['name'],
                $row['collection']
            );

            // Hydratation des propriétés
            $lego->setDescription($row['description']);
            $lego->setPrice($row['price']);
            $lego->setPieces($row['pieces']);
            $lego->setBoxImage($row['imagebox']);
            $lego->setLegoImage($row['imagebg']);

            $legos[] = $lego;
        }

        return $legos;
    }   

}
