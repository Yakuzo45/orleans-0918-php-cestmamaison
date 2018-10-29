<?php
/**
 * Created by PhpStorm.
 * User: wilder19
 * Date: 10/10/18
 * Time: 15:05
 */

namespace Model;

class BrandManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'brand';

    /**
     *  Initializes this class.
     */
    public function __construct(\PDO $pdo)
    {
        parent::__construct(self::TABLE, $pdo);
    }


    /**
     * @param Brand $brand
     * @return int
     */
    public function insert(Brand $brand): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO $this->table (`name`,`picture`) VALUES (:name,:picture)");
        $statement->bindValue('name', $brand->getName(), \PDO::PARAM_STR);
        $statement->bindValue('picture', $brand->getPicture(), \PDO::PARAM_STR);


        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }
    }

    /**
     * @param Brand $brand
     * @return int
     */
    public function updateHighlightedBrandById(Brand $brand): int
    {
        $statement = $this->pdo->prepare("UPDATE $this->table SET `highlightedBrand` = :highlightedBrand WHERE id= :id");
        $statement->bindValue('id', $brand->getId(), \PDO::PARAM_INT);
        $statement->bindValue('highlightedBrand', !$brand->isHighlightedBrand(), \PDO::PARAM_BOOL);
        return $statement->execute();
    }


    /**
     * @return array
     */
    public function selectHighlightedBrand(): array
    {
        $statement = $this->pdo->query("SELECT * FROM $this->table WHERE highlightedBrand = 1");
        $statement->setFetchMode(\PDO::FETCH_CLASS, $this->className);
        return $statement->fetchAll();
    }
}
