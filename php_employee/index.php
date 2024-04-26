<?php

require_once 'config/connect.php';
require_once 'model/Employee.php';
require_once 'controller/EmployeeController.php';

$employeeModel = new EmployeeModel($pdo);
$employeeController = new EmployeeController($employeeModel);

$action = isset($_GET['action']) ? $_GET['action'] : 'index';

switch ($action) {
    case 'index':
        $employeeController->index();
        break;
    case 'show':
        $id = $_GET['id'];
        $employeeController->show($id);
        break;
    case 'create':
        $employeeController->create();
        break;
    case 'store':
        $name = $_POST['name'];
        $age = $_POST['age'];
        $email = $_POST['email'];
        $employeeController->store($name, $age, $email);
        break;
    case 'edit':
        $id = $_GET['id'];
        $employeeController->edit($id);
        break;
    case 'update':
        $id = $_POST['id'];
        $name = $_POST['name'];
        $age = $_POST['age'];
        $email = $_POST['email'];
        $employeeController->update($id, $name, $age, $email);
        break;
    case 'delete':
        $id = $_GET['id'];
        $employeeController->delete($id);
        break;
    default:
        echo 'Yêu cầu không hợp lệ';
}