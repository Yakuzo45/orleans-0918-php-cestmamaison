<?php

namespace Model;

/**
 *
 */
class CategoryManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'category';

    /**
     *  Initialise la classe
     */
    public function __construct(\PDO $pdo)
    {
        parent::__construct(self::TABLE, $pdo);
    }

    /**
     * @param Category $category
     * @return int
     */
    public function insert(Category $category): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO $this->table (`name`,`image`) VALUES (:name, :image)");
        $statement->bindValue('name', $category->getName(), \PDO::PARAM_STR);
        $statement->bindValue('image', $category->getImage(), \PDO::PARAM_STR);


        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }
    }
}