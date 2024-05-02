<?php

class EmployeeController
{
    private $employee;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    public function index()
    {
        $employees = $this->employee->getAllEmployees();
        require_once 'view/employee_list.php';
    }

    public function show($id)
    {
        $employee = $this->employee->getEmployeeById($id);
        if (!$employee) {
            $this->index();
            echo "<script>alert('Employee does not exist!!')</script>";
        }
        require_once 'view/employee_show.php';
    }

    public function create()
    {
        require_once 'view/employee_create.php';
    }

    public function store()
    {
        $name = $_POST['name'];
        $age = $_POST['age'];
        $email = $_POST['email'];
        $this->employee->createEmployee($name, $age, $email);
        header('Location: index.php');
    }

    public function edit($id)
    {
        $employee = $this->employee->getEmployeeById($id);
        if (!$employee) {
            $this->index();
            echo "<script>alert('Employee does not exist!!')</script>";
        }
        require_once 'view/employee_update.php';
    }

    public function update($id)
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $age = $_POST['age'];
        $email = $_POST['email'];
        $employee = $this->employee->getEmployeeById($id);
        if (!$employee) {
            $this->edit($id);
            echo "<script>alert('Employee does not exist!!')</script>";
        } else {
            $this->employee->updateEmployee($id, $name, $age, $email);
            header('Location: index.php');
        }
    }

    public function delete($id)
    {
        $employee = $this->employee->getEmployeeById($id);
        if (!$employee) {
            $this->index();
            echo "<script>alert('Employee does not exist!!')</script>";
        } else {
            $this->employee->deleteEmployee($id);
            header('Location: index.php');
        }
    }
}