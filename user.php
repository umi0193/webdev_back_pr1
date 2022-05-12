<?php

class User
{

    private $conn;
    private $table_name = "Users";

    public $id;
    public $name;
    public $city_id;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function get()
    {
        if (isset($_GET['page'])){
            $page = $_GET['page'];
        }else {$page = 1;}

        $kol = 2;
        $art = ($page * $kol) - $kol;

        $query = "SELECT * FROM " . $this->table_name . " LIMIT $art, $kol";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    function getid()
    {
        $usl = $_GET['id'];

        $query = "SELECT * FROM " . $this->table_name . " WHERE City_id = $usl";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    function create()
    {

        $query = "INSERT INTO " . $this->table_name . " SET name=:name, city_id=:city_id";

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->city_id = htmlspecialchars(strip_tags($this->city_id));

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":city_id", $this->city_id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function update(){

        $query = "UPDATE
                " . $this->table_name . "
            SET
                name = :name,
                city_id = :city_id
            WHERE
                id = :id";

        $stmt = $this->conn->prepare($query);

        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->city_id=htmlspecialchars(strip_tags($this->city_id));
        $this->id=htmlspecialchars(strip_tags($this->id));


        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':city_id', $this->city_id);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function delete(){

        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        $stmt = $this->conn->prepare($query);

        $this->id=htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

}


