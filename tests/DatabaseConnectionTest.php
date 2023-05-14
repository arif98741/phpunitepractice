<?php

use App\Calculator;
use App\Database;

class DatabaseConnectionTest extends \PHPUnit\Framework\TestCase
{
    private array $config = array(
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database' => 'blog',
    );

    /**
     * @test
     * @return void
     */
    public function database_connection_error_test()
    {
        $this->expectException(mysqli_sql_exception::class);
        new Database(array(
            'host' => 'localhost',
            'username' => 'root1',
            'password' => '',
            'database' => 'blog',
        ));

    }

    /**
     * @test
     * @return void
     */
    public function database_connection_success()
    {

        $connection = new Database($this->config);
        $this->assertObjectHasProperty('connection', $connection);
    }

    /**
     * @test
     * @return void
     */
    public function select_query_argument_exception()
    {
        $connection = new Database($this->config);
        $this->expectException(ArgumentCountError::class);
        $connection->select();
    }


    /**
     * @test
     * @return void
     */
    public function select_argument_type_exception()
    {
        $connection = new Database($this->config);
        $calculator = new Calculator();
        $this->expectException(TypeError::class);
        $connection->select($calculator);
    }


    /**
     * @test
     * @return void
     */
    public function select_sql_exception_error()
    {
        $connection = new Database($this->config);
        $this->expectException(\RuntimeException::class);
        $connection->select("select * fst");
    }

    /**
     * @test
     * @return void
     */
    public function user_table_does_not_exist()
    {
        $connection = new Database($this->config);
        $this->expectException(\RuntimeException::class);
        $connection->select("select * from user");
    }

    /**
     * @test
     * @return void
     */
    public function get_like_data()
    {
        $connection = new Database($this->config);
        $data = $connection->select("select * from users where name like '%u%'");
        $this->assertIsArray($data);
    }

    /**
     * @test
     * @return void
     */
    public function duplicate_mail_check()
    {
        $connection = new Database($this->config);
        $statement = $connection->connection->prepare("delete from users");
        $statement->execute();
        echo 'hi';
    }

    /**
     * @test
     * @return void
     */
    public function insert_data()
    {
        $connection = new Database($this->config);
        $data = $connection->insert([
            'name' => 'Ariful Islam',
            'email' => 'arif@gmail.com',
            'password' => 123,
        ]);
        echo '<pre>';
        print_r($data);
        exit;

    }
}