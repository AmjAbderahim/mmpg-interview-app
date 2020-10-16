<?php

// singleton database class
class Database
{

    private $connection;

    private static $_instance;
 // The single instance
   
       private $host='mysql:unix_socket=/cloudsql/mmpg-app-292419:us-central1:db-mmpg';
       private $dbName='db_app';
       private $username='root';
       private $password='admin90';
   

    // Constructor
    private function __construct()
    {
        try {
            $this->connection = new PDO($this->host . '; dbname=' . $this->dbName, $this->username, $this->password);
            // Error handling
        } catch (PDOException $e) {
            echo 'Database Error: ' . $e->getMessage();
        }
    }

    public static function getInstance()
    {
        if (! self::$_instance) { // If no instance then make one
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    // clone is empty to prevent duplication of connection
    private function __clone()
    {}

    // Get connection
    public function getConnection()
    {
        return $this->connection;
    }

    // DB operations
    // SELECT
    public function getData($table, $params = array())
    {
        // add seleted fields automaticly (select parametr)
        $sql = 'SELECT ';
        if (array_key_exists("select", $params) and ! empty($params['select'])) {
            $j = 0;
            foreach ($params['select'] as $value) {
                // exclude last field from adding ','
                $pre = ($j < count($params['select']) - 1) ? ',' : '';
                $sql .= $value . $pre;
                $j ++;
            }
        } else {
            $sql .= " * ";
        }
        $sql .= ' FROM ' . $table . " ";
        // add conditions automaticly (WHERE parametr)
        if (array_key_exists("where", $params)) {
            $sql .= ' WHERE ';
            $i = 0;
            foreach ($params['where'] as $key => $value) {
                // exclude first condition from adding 'AND'
                $pre = ($i > 0) ? ' AND ' : '';
                $sql .= $pre . $key . " = '" . $value . "'";
                $i ++;
            }
        }
        
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetchAll();
        }
        return ! empty($data) ? $data : false;
    }

    // INSERT
    public function insert($table, $data)
    {
        if (! empty($data) && is_array($data)) {
            $columns = '';
            $values = '';
            $i = 0;
            $columnString = implode(',', array_keys($data));
            $valueString = ":" . implode(',:', array_keys($data));
            $sql = "INSERT INTO " . $table . " (" . $columnString . ") VALUES (" . $valueString . ")";
            $query = $this->connection->prepare($sql);
            foreach ($data as $key => $val) {
                $query->bindValue(':' . $key, $val);
            }
            $insert = $query->execute();
            return $insert ? $this->connection->lastInsertId() : false;
        } else {
            return false;
        }
    }

    // UPDATE
    public function update($table, $data, $params)
    {
        if (! empty($data) && is_array($data)) {
            $colsToChange = '';
            $whereSql = '';
            $i = 0;
            // add fields to change automaticly with their new values (keys and values of array data provided as parametr)
            foreach ($data as $key => $val) {
                $pre = ($i > 0) ? ', ' : '';
                $colsToChange .= $pre . $key . "='" . $val . "'";
                $i ++;
            }
            // add conditions automaticly (keys and values of array params provided as parametr)
            if (! empty($params) && is_array($params)) {
                $whereSql .= ' WHERE ';
                $i = 0;
                foreach ($params as $key => $value) {
                    $pre = ($i > 0) ? ' AND ' : '';
                    $whereSql .= $pre . $key . " = '" . $value . "'";
                    $i ++;
                }
            }
            $sql = "UPDATE " . $table . " SET " . $colsToChange . $whereSql;
            $query = $this->connection->prepare($sql);
            $update = $query->execute();
           return $update ? $query->rowCount() : false;
        } else {
            return false;
        }
    }

    // DELETE
    public function delete($table, $params)
    {
        $whereSql = '';
        if (! empty($params) && is_array($params)) {
            $whereSql .= ' WHERE ';
            $i = 0;
            foreach ($params as $key => $value) {
                $pre = ($i > 0) ? ' AND ' : '';
                $whereSql .= $pre . $key . " = '" . $value . "'";
                $i ++;
            }
        }
        $sql = "DELETE FROM " . $table . $whereSql;
        $delete = $this->connection->exec($sql);
        return $delete ? $delete : false;
    }
}
?>
