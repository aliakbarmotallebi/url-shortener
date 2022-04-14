<?php namespace Aliakbar\UrlShortener\Helper;


class Database {

    protected $pdo;

    protected $table;

    protected $selectables;

    protected $whereClause = [];

    protected $limit;

    protected $stmt;

    protected $bind = [];

    protected $fetchType = 'fetchAll';

    protected $fetchMode = \PDO::FETCH_OBJ;

    public function __construct()
    {
        $DB_HOST     = getenv('DB_HOST');
        $DB_DATABASE = getenv('DB_DATABASE');
        $DB_USERNAME = getenv('DB_USERNAME');
        $DB_PASSWORD = getenv('DB_PASSWORD');

        try {
            $this->pdo = new \PDO("mysql:host={$DB_HOST};dbname={$DB_DATABASE};charset=utf8",$DB_USERNAME , $DB_PASSWORD);

        } catch (\Exception $e) {
           die('Error : ' . $e->getMessage());
        }
    }

    public function select()
    {
        $this->selectables = func_get_args();
        return $this;
    }

    public function from($table)
    {
        $this->table = $table;
        return $this;
    }


    public function where($name , $value , $operator = '=')
    {
        $this->wheres("$name $operator :$name");

        if($operator == 'LIKE')
            $this->bind[$name] = '%' . $value . '%';
        else
            $this->bind[$name] = $value;

        return $this;
    }

    public function wheres($where)
    {
        $this->whereClause[] = $where;
        return $this;
    }

    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }

    public function result()
    {

        $query[] = "SELECT";

        if(empty($this->selectables))
            $query[] = "*";
        elseif (in_array("count", $this->selectables))
            $query[] = "count(*)";
        else
            $query[] = join(', ' , $this->selectables);


        $query[] = "FROM";
        $query[] = $this->table;

        if(! empty($this->lasted)) {
            $query[] = "ORDER BY ";
            $query[] = "`$this->table`.`$this->lasted` DESC";
        }

        $this->stmt = $this->pdo->prepare(join(' ',$query));
        $this->bindValue();
        $this->stmt->execute();
        return $this;
    }

    public function lasted($colmun="id")
    {
        $this->lasted = $colmun;
        return $this;
    }

    public function limit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    public function find($name , $value)
    {
        return $this->select()->where($name ,$value)->first();
    }

    public function first()
    {
        $this->limit(1)->result();
        $this->fetchType = 'fetch';
        return $this->fetch();
    }

    public function get()
    {
        $this->result();
        return $this->fetch();
    }

    public function all()
    {
        return $this->select()->get();
    }


    protected function fetch()
    {
        return  $this->stmt->{($this->fetchType == 'fetchAll') ? 'fetchAll' : 'fetch'}($this->fetchMode);
    }

    private function bindValue()
    {
        foreach ($this->bind as $key => $value) {
            $this->stmt->bindValue(":$key" , $value);
        }
    }

    public function update($id , $data)
    {
        $object = $this->find('id' , $id);
        if(!$object)
            throw new \Exception("this id not exist in $this->table table");

        $fieldForUpdate = $this->fieldForUpdate($data);
        $this->stmt = $this->pdo->prepare("UPDATE {$this->table} SET {$fieldForUpdate} WHERE id = :id");
        $this->bind = array_merge($data , ['id'=> $id]);
        $this->bindValue();

        return $this->stmt->execute();
    }

    public function delete($id)
    {
        $object = $this->find('id' , $id);
        if(!$object)
            throw new \Exception("this id not exist in $this->table table");

        $this->stmt = $this->pdo->prepare("DELETE FROM $this->table WHERE id = :id");
        $this->stmt->bindValue(':id' , $id);

        return $this->stmt->execute();
    }

    private function fieldForUpdate($data)
    {
        $field = [];
        foreach (array_keys($data) as $name) {
            $field[] = "$name = :$name";
        }
        return join(', ' , $field);
    }
}

