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
}
