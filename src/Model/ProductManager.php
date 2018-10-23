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
     * @param Product $product
     * @return int
     */
    public function insert(product $product):int
    {
        $statement = $this->pdo->prepare("INSERT INTO $this->table (`name`,`image`) VALUES (:name, :image)");
        $statement->bindValue('name', $product->getName(), \PDO::PARAM_STR);
        $statement->bindValue('image', $product->getImage(), \PDO::PARAM_STR);


        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }
    }
}
