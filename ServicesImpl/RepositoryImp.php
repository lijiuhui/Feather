<?php
/**
 * Created by PhpStorm.
 * User: D.Y
 * Date: 2018/6/1
 * Time: 15:27
 */

namespace Feather\ServicesImpl;
use Feather\Services\Repository;
use Feather\Factory\PDOFactory;
use PDO;
use PDOStatement;
use PDOException;
use Exception;

class RepositoryImp implements Repository
{
    protected $connection = null;
    private static $instance = null;

    protected function __construct()
    {
        $this->connection = PDOFactory::instance();
    }

    public static function instance()
    {
        if(is_null(self::$instance))
        {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function add(string $query)
    {
        try
        {
            $this->connection->beginTransaction();
            $this->connection->exec($query);
            $this->connection->commit();
        }
        catch (PDOException $e)
        {
            $this->connection->rollBack();
            throw $e;
        }
    }

    public function query(string $query) : array
    {
        $statement = $this->get_statement($query);
        if($statement->columnCount() !== 1)
        {
            throw new Exception("查询结果存在多条");
        }
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function query_all(string $query) : array
    {
        $statement = $this->get_statement($query);
        return $statement->fetchAll();
    }

    private function get_statement(string $query) : PDOStatement
    {
        return $this->connection->query($query);
    }
}