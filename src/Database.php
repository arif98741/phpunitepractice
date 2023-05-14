<?php

namespace App;

use mysqli;

class Database
{
    private array $config;
    public mysqli $connection;

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->connect();
    }

    /**
     * @return void
     */
    private function connect()
    {

        $this->connection = new mysqli($this->config['host'],
            $this->config['username'],
            $this->config['password'],
            $this->config['database']
        );

    }

    /**
     * @param string $query
     * @return array
     */
    public function select(string $query): array
    {
        try {
            return $this->connection->query($query)->fetch_all(MYSQLI_ASSOC);
        } catch (\Exception $exception) {
            throw new \RuntimeException("Mysql error. ".$exception->getMessage());
        }
    }


    /**
     * @param array $data
     * @return bool
     */
    public function insert(array $data)
    {
        $statement = $this->connection->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $statement->bind_param('sss',$data['name'], $data['email'],$data['password']);
        return $statement->execute();
    }
}