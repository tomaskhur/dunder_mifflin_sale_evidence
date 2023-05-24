<?php
    require 'db.php';

    if(isset($_GET['id']))
        {
            $stmt = $pdo -> prepare("DELETE from tbEmployees WHERE id = :id");
            $stmt -> execute(['id' => $_GET['id']]);

            header('Location: employee.php');
        }