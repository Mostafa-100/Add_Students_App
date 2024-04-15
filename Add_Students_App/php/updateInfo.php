<!DOCTYPE html>
<html lang="en">
<?php include("dbConnect.php") ?>
<head>
    <meta charset="UTF-8">
    </meta>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Students App</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <h2>- Update Area -</h2>
    <form action="<?php $_SERVER["PHP_SELF"]?>" method="post" class="add-student-box">
        <label>First Name</label>
        <input type="text" name="firstname" value="<?php echo $_GET["firstname"] ?>" required>
        <label>Last Name</label>
        <input type="text" name="lastname" value="<?php echo $_GET["lastname"] ?>" required>
        <label>Age</label>
        <input type="text" name="age" value="<?php echo $_GET["age"] ?>" required>
        <input type="submit" name="add-student" value="Update">
    </form>

    <?php

    if(isset($_POST["add-student"])) {
        $f_name = $_POST["firstname"];
        $l_name = $_POST["lastname"];
        $age = $_POST["age"];
        $id = $_GET["id"];

        if(empty($f_name) && empty($l_name) && empty($age)) {
            die("You should enter values");
        }

        $query = "UPDATE `students` SET firstname = ?, lastname = ?, age = ? WHERE id = ?";

        $stmt = mysqli_prepare($connect, $query);

        if(!$stmt) {
            die("Failed to prepare");
        }

        mysqli_stmt_bind_param($stmt, "ssii", $f_name, $l_name, $age, $id);

        if(!mysqli_stmt_execute($stmt)) {
            die("Failed to execute");
        }

        header("location: ../index.php?update-message=Update is succesfully");

        mysqli_stmt_close();
        mysqli_close();
    }
    ?>
    
</body>
</html>