<?php
namespace App;
use PDO;
use PDOException;
class DataBase
{
    const HOST = 'localhost';
    const USER = 'root';
    const PASSWORD = '';
    const DBNAME = 'consultorio';

    private $connection;
    private $table;

    public function __construct($table = null)
    {
        $this->table = $table;
        $this->setConnection();
    }

    private function setConnection()
    {
        try {

            $this->connection = new PDO(
                'mysql:host=' . self::HOST .
                ';dbname=' . self::DBNAME .
                ';charset=utf8mb4',
                self::USER,
                self::PASSWORD
            );

            $this->connection->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

        } catch (PDOException $e) {

            die('Erro na conexão com o banco: ' . $e->getMessage());

        }
    }

    public function execute($query, $values = [])
    {
        try {

            $statement = $this->connection->prepare($query);
            $statement->execute($values);

            return $statement;

        } catch (PDOException $e) {

            die('Erro na consulta: ' . $e->getMessage());

        }
    }

    public function insert($array)
    {
        $fields = array_keys($array);

        $binds = array_pad(
            [],
            count($array),
            '?'
        );

        $query = 'INSERT INTO ' . $this->table .
            ' (' . implode(', ', $fields) . ')
            VALUES (' . implode(', ', $binds) . ')';

        $this->execute($query, array_values($array));

        return $this->connection->lastInsertId();
    }

    public function select(
        $where = null,
        $order = null,
        $limit = null,
        $fields = '*'
    ) {

        $where = !empty($where) ? ' WHERE ' . $where : '';
        $order = !empty($order) ? ' ORDER BY ' . $order : '';
        $limit = !empty($limit) ? ' LIMIT ' . $limit : '';

        $query = 'SELECT ' . $fields .
            ' FROM ' . $this->table .
            $where . $order . $limit;

        return $this->execute($query);
    }

    public function update($where, $array)
    {
        $fields = array_keys($array);

        $query = 'UPDATE ' . $this->table .
            ' SET ' . implode(' = ?, ', $fields) .
            ' = ? WHERE ' . $where;

        return $this->execute(
            $query,
            array_values($array)
        );
    }

    public function delete($where)
    {
        $query = 'DELETE FROM ' . $this->table .
            ' WHERE ' . $where;

        return $this->execute($query);
    }
}
