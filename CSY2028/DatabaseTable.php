<?php
namespace CSY2028;

class DatabaseTable
{
    private $pdo;
    private $table;
    private $primaryKey;
    private $entityClass;
    private $entityConstructor;
    public function __construct($pdo, $table, $primaryKey, $entityClass, $entityConstructor)
    {
        $this->pdo = $pdo;
        $this->table = $table;
        $this->primaryKey = $primaryKey;
        $this->entityClass = $entityClass;
        $this->entityConstructor = $entityConstructor;
    }
    public function find($field, $value)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE ' . $field . ' = :value');
        $stmt->setFetchMode(\PDO::FETCH_CLASS, $this->entityClass, $this->entityConstructor);
        $criteria = [
            'value' => $value
        ];
        $stmt->execute($criteria);
        return $stmt->fetchAll();
    }
    public function findAll()
    {
        $stmt = $this->pdo->prepare('SELECT * FROM ' . $this->table);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, $this->entityClass, $this->entityConstructor);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM ' . $this->table . ' WHERE ' . $this->primaryKey . ' = :id');
        $criteria = [
            'id' => $id
        ];
        $stmt->execute($criteria);
    }

    public function save($record)
    {
        try {
            echo 'Attempt Insert';
            $this->insert($record);
        } catch (\Exception $e) {
            echo 'Attempt Update';
            $this->update($record);
        }
    }

    public function insert($record)
    {
        $keys = array_keys($record);

        $values = implode(', ', $keys);
        $valuesWithColon = implode(', :', $keys);

        $query = 'INSERT INTO ' . $this->table . ' (' . $values . ') VALUES (:' . $valuesWithColon . ')';

        $stmt = $this->pdo->prepare($query);
        $stmt->execute($record);
    }

    public function update($record)
    {

        $query = 'UPDATE ' . $this->table . ' SET ';

        $parameters = [];
        foreach ($record as $key => $value) {
            $parameters[] = $key . ' = :' . $key;
        }

        $query .= implode(', ', $parameters);
        $query .= ' WHERE ' . $this->primaryKey . ' = :primaryKey';

        $record['primaryKey'] = $record[$this->primaryKey];

        $stmt = $this->pdo->prepare($query);
        $stmt->execute($record);
    }

    public function getLastInsertId()
    {
        return $this->pdo->lastInsertId();
    }

    public function findAllSearch($get)
    {
        $ConditionArray = array();
        if (isset($get['artist'])) {
            if ($get['artist'] !== '') $ConditionArray[] = "(artist LIKE :artist)";
        }
        if (isset($get['categoryID'])) {
            if ($get['categoryID'] !== 'all') $ConditionArray[] = "(categoryID = :categoryID)";
        }
        if (isset($get['yearProduced'])) {
            if ($get['yearProduced'] !== '') $ConditionArray[] = "(yearProduced = :yearProduced)";
        }
        if (isset($get['minPrice'])) {
            if ($get['minPrice'] !== '') $ConditionArray[] = "(estimatedPrice >= :minPrice)";
        }
        if (isset($get['maxPrice'])) {
            if ($get['maxPrice'] !== '') $ConditionArray[] = "(estimatedPrice <= :maxPrice)";
        }
        if (isset($get['date1']) && isset($get['date2'])) {
            if ($get['date1'] !== '' && $get['date2'] !== '') $ConditionArray[] = "(auctionDate BETWEEN :date1 AND :date2)";
        }
        if (isset($get['auctionSlot'])) {
            if ($get['auctionSlot'] !== 'all') $ConditionArray[] = "(auctionSlot = :auctionSlot)";
        }
        if (isset($get['subjectClassification'])) {
            if ($get['subjectClassification']  !== '') $ConditionArray[] = "(subjectClassification = :subjectClassification)";
        }

        if (count($ConditionArray) > 0) {
            $query = "SELECT *
                    FROM auctionLots
                    WHERE " . implode(' AND ', $ConditionArray) . "ORDER BY estimatedPrice DESC";
        } else {
            $query = "SELECT *
                    FROM auctionLots ORDER BY estimatedPrice DESC";
        }
        $stmt = $this->pdo->prepare($query);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, $this->entityClass, $this->entityConstructor);
        if (isset($get['artist'])) {
            if ($get['artist'] !== '') {
                $artist = "%" . $get['artist'] . "%";
                $stmt->bindparam(":artist", $artist);
            }
        }
        if (isset($get['categoryID'])) {
            if ($get['categoryID'] !== 'all') {
                $categoryID = $get['categoryID'];
                $stmt->bindparam(":categoryID", $categoryID);
            }
        }
        if (isset($get['minPrice'])) {
            if ($get['minPrice'] !== '') {
                $maxPrice = $get['minPrice'];
                $stmt->bindparam(":minPrice", $maxPrice);
            }
        }
        if (isset($get['maxPrice'])) {
            if ($get['maxPrice'] !== '') {
                $maxPrice = $get['maxPrice'];
                $stmt->bindparam(":maxPrice", $maxPrice);
            }
        }
        if (isset($get['date1']) && isset($get['date2'])) {
            if ($get['date1'] !== '' && $get['date2'] !== '') {
                $date1 = date("Y-m-d H:i:s", strtotime(str_replace('/', '-', $get['date1'])));
                $date2 = date("Y-m-d H:i:s", strtotime(str_replace('/', '-', $get['date2'])));
                $stmt->bindparam(":date1", $date1);
                $stmt->bindparam(":date2", $date2);
            }
        }
        if (isset($get['subjectClassification'])) {
            if ($get['subjectClassification'] !== '') {
                $subjectClassification = $get['subjectClassification'];
                $stmt->bindparam(":subjectClassification", $subjectClassification);
            }
        }
        if (isset($get['auctionSlot'])) {
            if ($get['auctionSlot'] !== 'all') {
                $subjectClassification = $get['auctionSlot'];
                $stmt->bindparam(":auctionSlot", $subjectClassification);
            }
        }
        if (isset($get['yearProduced'])) {
            if ($get['yearProduced'] !== '') {
                $yearProduced = $get['yearProduced'];
                $stmt->bindparam(":yearProduced", $yearProduced);
            }
        }
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
