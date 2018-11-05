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
     * @return int
     */


    public function insert(product $product):int
    {
        $statement = $this->pdo->prepare("INSERT INTO $this->table (`name`,`description`,`price`,`picture`,`brand_id`,`category_id`) VALUES (:name, :description, :price, :picture, :brand_id, :category_id)");
        $statement->bindValue('name', $product->getName(), \PDO::PARAM_STR);
        $statement->bindValue('description', $product->getDescription(), \PDO::PARAM_STR);
        $statement->bindValue('price', $product->getPrice(), \PDO::PARAM_STR);
        $statement->bindValue('picture', $product->getPicture(), \PDO::PARAM_STR);
        $statement->bindValue('brand_id', $product->getBrandId(), \PDO::PARAM_INT);
        $statement->bindValue('category_id', $product->getCategoryId(), \PDO::PARAM_INT);


        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }
    }
  

    public function selectAllProductsByOneCategory(int $id): array
    {
        $statement = $this->pdo->prepare("SELECT category.id as idCategory, category.name as nameCategory, 
                                          category.picture as pictureCategory,product.id, product.name, product.picture
                                          FROM $this->table LEFT JOIN category
                                          ON product.category_id = category.id WHERE category_id = :id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->setFetchMode(\PDO::FETCH_ASSOC);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function selectAllProductsByOneBrand(int $id): array
    {
        $statement = $this->pdo->prepare("SELECT brand.id as idBrand, brand.name as nameBrand, 
                                          brand.picture as pictureBrand,product.id, product.name, product.picture
                                          FROM brand LEFT JOIN $this->table
                                          ON product.brand_id = brand.id WHERE brand_id = :id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
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
