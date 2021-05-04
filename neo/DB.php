<?php

/**
 * Class DB
 */
class DB
{
    /**
     * PDO object
     * @var PDO
     */
    private $pdo;

    /**
     * DB constructor.
     */
    public function __construct()
    {
        $this->pdo = new PDO('mysql:host='. MYSQL_HOST .';dbname=' . MYSQL_DB, MYSQL_USER, MYSQL_PASS);
    }

    /**
     * Make sql query
     *
     * @param $sql
     * @return array
     */
    public function query($sql)
    {
        $prepare = $this->pdo->prepare($sql);
        $prepare->execute();

        return $prepare->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Close connection
     */
    public function close()
    {
        $this->pdo = null;
    }
}