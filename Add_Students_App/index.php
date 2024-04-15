<?php include_once("php/dbConnect.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    </meta>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Students App</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <script src="js/main.js" defer></script>
</head>

<body>
    <header>
        <h1>All students</h1>
    </header>
    <table class="datashow">
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Age</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
        <?php
        
        $query = "SELECT * FROM `students`";
        $stmt = mysqli_prepare($connect, $query);

        if(!$stmt) {
            die("Error in preparing statement: " . mysqli_error($connect));
        }

        if(!mysqli_stmt_execute($stmt)) {
            die("Error in executing statement: " . mysqli_error($connect));
        }

        $result = mysqli_stmt_get_result($stmt);

        mysqli_stmt_close($stmt);

        mysqli_close($connect);

        while($row = mysqli_fetch_assoc($result)): ?>

            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["firstname"]; ?></td>
                <td><?php echo $row["lastname"]; ?></td>
                <td><?php echo $row["age"]; ?></td>
                <td>
                    <a href="php/updateInfo.php?id=<?php echo $row["id"] ?>&firstname=<?php echo $row["firstname"]?>&lastname=<?php echo $row["lastname"] ?>&age=<?php echo $row["age"] ?>" name="update-btn">Update</a>
                </td>
                <td><a href="php/deleteInfo.php?id=<?php echo $row["id"] ?>" name="delete-btn">Delete</a></td>
            </tr>

        <?php
        endwhile;
        ?>
    </table>
    <h2>- Insert Area -</h2>
    <form class="add-student-box" action="php/insertStudents.php" method="post">
        <label>First Name</label>
        <input type="text" name="firstname" required>
        <label>Last Name</label>
        <input type="text" name="lastname" required>
        <label>Age</label>
        <input type="text" name="age" required>
        <input type="submit" name="add-student" value="Save">
    </form>
    <span class="status-msg">
        <?php
            echo isset($_GET["message"]) ? $_GET["message"] : "";

            echo isset($_GET["delete-message"]) ? $_GET["delete-message"] : "";

            echo isset($_GET["update-message"]) ? $_GET["update-message"] : "";
        ?>
    </span>
</body>

</html>