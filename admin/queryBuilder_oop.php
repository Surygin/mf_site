<?php

var_dump('ОТКЛЮЧИЛ ЭТОТ СКРИПТ');
die();

class queryBuilder{

    protected $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function get_all($table){
        #dd($this->pdo);
        $sql = "SELECT * FROM {$table}";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_all_docs($table, $id){
        #dd($this->pdo);
        $sql = "SELECT * FROM {$table} WHERE kids_id = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_one($table, $id){
        $sql = "SELECT * FROM {$table} WHERE id = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function create($table, $data){

        $keys = implode(', ', array_keys($data));
        $tags = ':' . implode(', :', array_keys($data));

        $sql = "INSERT INTO {$table} ({$keys}) VALUES ({$tags})";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($data);
    }

    public function update($table, $data, $id){

        $keys = array_keys($data);

//        echo "<pre>";
//        print_r($data);
//        echo "</pre>";
//        die();

        $string = '';

        foreach ($keys as $key) {
            $string .= $key . '=:' . $key . ',';
        }
        $keys = rtrim($string, ',');

        $data['id'] = $id;

        $sql = "UPDATE {$table} SET {$keys} WHERE id = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute($data);

    }

    public function delete($table, $id){
        $sql = "DELETE FROM {$table} WHERE id = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
    }

};