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
        $statement = $this->pdo->prepare("INSERT INTO $this->table (`name`) VALUES (:name)");
        $statement->bindValue('name', $category->getName(), \PDO::PARAM_STR);


        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }
    }
}