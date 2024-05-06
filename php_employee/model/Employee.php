<?php

class Employee
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllEmployees()
    {
        $query = "SELECT * FROM employees ORDER BY id DESC";
        $statement = $this->pdo->prepare($query);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEmployeeById($id)
    {
        $query = "SELECT * FROM employees WHERE id = :id";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function createEmployee($name, $age, $email)
    {
        $query = "INSERT INTO employees (name, age, email) VALUES (:name, :age, :email)";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(':name', $name, PDO::PARAM_STR);
        $statement->bindParam(':age', $age, PDO::PARAM_INT);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->execute();
    }

    public function updateEmployee($id, $name, $age, $email)
    {
        $query = "UPDATE employees SET";
        $params = [];
        
        if (!empty($name)) {
            $query .= " name = :name,";
            $params[':name'] = $name;
        }
        
        if (!empty($age)) {
            $query .= " age = :age,";
            $params[':age'] = $age;
        }
        
        if (!empty($email)) {
            $query .= " email = :email,";
            $params[':email'] = $email;
        }
        
        $query = rtrim($query, ',');
        $query .= " WHERE id = :id";
        $params[':id'] = $id;
        
        $statement = $this->pdo->prepare($query);
        $statement->execute($params);
    }

    public function deleteEmployee($id)
    {
        $query = "DELETE FROM employees WHERE id = :id";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    }
}