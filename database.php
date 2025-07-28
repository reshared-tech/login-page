<?php

class Database 
{
    protected $connection;
    protected $statement;

    public function __construct($config, $username = 'root', $password = '')
    {
        $dsn = 'mysql:' . http_build_query($config, '', ';');

        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function query($query, $params = []) 
    {
       
        $this->statement = $this->connection->prepare($query, $params);
        $this->statement->execute();

        return $this;
    }

    public function find() 
    {
        return $this->statement->fetch();
    }

    public function findOrFail() 
    {
        $data = $this->find();

        if (! $data) {
            abort();
        }

        return $data;
    }

    public function get()
    {
        return $this->statement->fetchAll();
    }
}