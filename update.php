<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Page</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    require "connection/connection.php";

    if (isset($_GET['update_id'])) {

        $id = $_GET['update_id'];
        $data = $conn->query("SELECT * FROM tasks WHERE id = '$id'");
        $rows = $data->fetch(PDO::FETCH_OBJ);

        if (isset($_POST["submit"])) {
            $task = $_POST['mytask'];
            $update = $conn->prepare("UPDATE tasks SET task_name = :name WHERE id = '$id'");
            $update->execute([':name' => $task]);
            header("location: index.php");
        }
    }

    ?>


    <form method="POST" action="update.php?update_id=<?php echo $id; ?>">
        <label for="task" style="cursor: pointer; font-size: 20px; font-weight: bold; margin-left: 10px; margin-top: 10px;">Update the Task: </label>
        <input name="mytask" type="text" class="form-control" id="task" placeholder="Enter Task" value="<?php echo $rows->task_name; ?>">
        <input type="submit" name="submit" class="btn btn-primary" value="update" />
    </form>


</body>

</html>