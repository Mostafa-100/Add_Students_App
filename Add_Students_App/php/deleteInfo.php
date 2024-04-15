<?php
include_once("dbConnect.php");

$query = "DELETE FROM `students` WHERE id = ?";

$stmt = mysqli_prepare($connect, $query);

if(!$stmt) {
    die("Error in preparing statement: " . mysqli_error($connect));
}

mysqli_stmt_bind_param($stmt, "i", $_GET["id"]);

if(!mysqli_stmt_execute($stmt)) {
    die("Error in executing statement: " . mysqli_error($connect));
}

mysqli_stmt_close($stmt);
mysqli_close($connect);

header("location: ../index.php?delete-message=The row is deleted");