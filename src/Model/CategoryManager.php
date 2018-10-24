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
        $statement = $this->pdo->prepare("INSERT INTO $this->table (`name`,`picture`) VALUES (:name, :picture)");
        $statement->bindValue('name', $category->getName(), \PDO::PARAM_STR);
        $statement->bindValue('picture', $category->getPicture(), \PDO::PARAM_STR);


        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }
    }
    public function update(Category $category): int
    {
        // prepared request
        $statement = $this->pdo->prepare("UPDATE $this->table SET `name` = :name, `picture`= :picture  WHERE id=:id");
        $statement->bindValue('id', $category->getId(), \PDO::PARAM_INT);
        $statement->bindValue('name', $category->getName(), \PDO::PARAM_STR);
        $statement->bindValue('picture', $category->getPicture(), \PDO::PARAM_STR);

        return $statement->execute();

    }
}