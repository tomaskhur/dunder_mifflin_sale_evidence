<?php
require 'db.php';

    if(isset($_GET['id']))
    {
        $stmt = $pdo -> prepare("DELETE from tbProducts WHERE id = :id");
        $stmt -> execute(['id' => $_GET['id']]);

        header('Location: products.php');
    }