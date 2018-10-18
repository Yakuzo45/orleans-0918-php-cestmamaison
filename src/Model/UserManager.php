<?php
/**
 * Created by PhpStorm.
 * User: billyvivant
 * Date: 17/10/18
 * Time: 10:31
 */

namespace Model;


class UserManager extends AbstractManager
{
    public function __construct(\PDO $pdo)
    {
        parent::__construct(self::TABLE, $pdo);
    }
}