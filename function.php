<?php

include "db.php";


$name = $_POST["name"] ?? null;
$email = $_POST["email"] ?? null;
$get_id = $_GET["id"] ?? null;


// CREATE
if (isset($_POST["add"])) {
    $sql = ("INSERT INTO users_1 (name, email) VALUES (?,?)");
    $query = $pdo->prepare($sql);
    $query->execute([$name, $email]);
    if ($query) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}

// READ
$sql = $pdo->prepare("SELECT * FROM users_1 WHERE flag =0");
$sql->execute();
$result = $sql->fetchAll(PDO::FETCH_OBJ);

// Edit
if(isset($_POST["edit"])){
    $sql = ("UPDATE users_1 SET name=?, email=? WHERE id=?");
    $query = $pdo->prepare($sql);
    $query->execute([$name, $email,$get_id]);
    if ($query) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}

// DELETE

if(isset($_POST["delete"])){
    $sql = ("UPDATE users_1 SET flag = 1 WHERE id = ?");
    $query = $pdo->prepare($sql);
    $query->execute([$get_id]);
    if ($query) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}