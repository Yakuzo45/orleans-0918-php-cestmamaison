<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 12/10/18
 * Time: 22:07
 */

namespace Model;

class ProductManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'product';

    /**
     *  Initialise la classe
     */
    public function __construct(\PDO $pdo)
    {
        parent::__construct(self::TABLE, $pdo);
    }

    /**
     * @param int $id
     */
    public function selectAllProducts(int $id): array
    {
        $statement = $this->pdo->query("SELECT category.id as idCategory, category.name as nameCategory, 
                                          category.picture as pictureCategory,product.id, product.name, product.picture
                                          FROM category LEFT JOIN $this->table
                                          ON product.category_id = category.id WHERE category_id = $id");
        $statement->setFetchMode(\PDO::FETCH_ASSOC);
        return $statement->fetchAll();
    }
    public function delete(int $id): void
    {
        // prepared request
        $statement = $this->pdo->prepare("DELETE FROM $this->table WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }
}
