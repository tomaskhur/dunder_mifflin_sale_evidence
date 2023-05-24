<?php
require 'db.php';

if(isset($_GET['id']))
{
    $stmt = $pdo -> prepare("DELETE from tbSalesEvidence WHERE id = :id");
    $stmt -> execute(['id' => $_GET['id']]);

    header('Location: salesEvidence.php');
}