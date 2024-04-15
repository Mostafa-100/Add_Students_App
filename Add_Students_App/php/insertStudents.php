<?php
include_once("dbConnect.php");

if(isset($_POST["add-student"])) {
    $firstname = htmlspecialchars($_POST["firstname"]);
    $lastname = htmlspecialchars($_POST["lastname"]);
    $age = htmlspecialchars($_POST["age"]);

    $query = "INSERT INTO `students` (firstname, lastname, age) VALUES(?, ?, ?)";

    $stmt = mysqli_prepare($connect, $query);

    if(!$stmt) {
        die("Error in preparing statement: " . mysqli_error($connect));
    }

    mysqli_stmt_bind_param($stmt, "ssi", $firstname, $lastname, $age);

    if(!mysqli_stmt_execute($stmt)) {
        die("Error in executing statement: " . mysqli_error($connect));
    }

    mysqli_stmt_close($stmt);
    mysqli_close($connect);

    header("location: ../index.php?message=Your adding is successfully");
}