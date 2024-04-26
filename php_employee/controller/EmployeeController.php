<?php

class EmployeeController
{
    private $employeeModel;

    public function __construct(EmployeeModel $employeeModel)
    {
        $this->employeeModel = $employeeModel;
    }

    public function index()
    {
        $employees = $this->employeeModel->getAllEmployees();
        require_once 'view/employee_list.php';
    }

    public function show($id)
    {
        $employee = $this->employeeModel->getEmployeeById($id);
        require_once 'view/employee_show.php';
    }

    public function create()
    {
        require_once 'view/employee_create.php';
    }

    public function store($name, $age, $email)
    {
        $this->employeeModel->createEmployee($name, $age, $email);
        header('Location: index.php');
    }

    public function edit($id)
    {
        $employee = $this->employeeModel->getEmployeeById($id);
        require_once 'view/employee_update.php';
    }

    public function update($id, $name, $age, $email)
    {
        $this->employeeModel->updateEmployee($id, $name, $age, $email);
        header('Location: index.php');
    }

    public function delete($id)
    {
        $this->employeeModel->deleteEmployee($id);
        header('Location: index.php');
    }
}