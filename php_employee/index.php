<?php

require_once 'config/connect.php';
require_once 'model/Employee.php';
require_once 'controller/EmployeeController.php';

// Connect database
$host = 'localhost';
$dbName = 'employee';
$username = 'root';
$password = '';

$databaseConnection = new DatabaseConnection($host, $dbName, $username, $password);
$databaseConnection->connect();
$pdo = $databaseConnection->getPdo();


$employee = new Employee($pdo);
$employeeController = new EmployeeController($employee);

// action (route)
// Ánh xạ các hành động với các phương thức tương ứng
$actionMappings = [
    'index' => 'index',
    'show' => 'show',
    'create' => 'create',
    'store' => 'store',
    'edit' => 'edit',
    'update' => 'update',
    'delete' => 'delete',
];

$action = isset($_GET['action']) ? $_GET['action'] : 'index';

if (isset($actionMappings[$action])) {

    $methodName = $actionMappings[$action];
    
    // Kiểm tra phương thức có tồn tại trong EmployeeController hay không
    if (method_exists($employeeController, $methodName)) {
        $employeeController->$methodName($_GET['id']??'');
    } else {
        echo 'Phương thức không hợp lệ';
    }
} else {
    echo 'Yêu cầu không hợp lệ';
}