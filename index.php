<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do App</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php

    require "connection/connection.php";

    $data = $conn->query("SELECT * FROM tasks");
    $data->execute();
    $rows = $data->fetchAll(PDO::FETCH_OBJ);

    $completed = $conn->query("SELECT * FROM Tasks_completed");
    $completed->execute();
    $completed_rows = $completed->fetchAll(PDO::FETCH_OBJ);

    ?>

    <div class="container">
        <form method="POST" action="insert.php">
            <input name="mytask" type="text" id="task" placeholder="Enter Task" />
            <input type="submit" name="submit" class="btn" value="Add Task" />
        </form>
        <h3>ToDo Tasks</h3>
        <table class="table-style">
            <thead>
                <tr>
                    <th>SNo.</th>
                    <th>Task Name</th>
                    <th>Time</th>
                    <th>Done</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $row) : ?>
                    <tr>
                        <td><?php echo $row->id; ?></td>
                        <td><?php echo $row->task_name; ?></td>
                        <td><?php echo $row->created_at; ?></td>
                        <td><a href="done.php?delete_id=<?php echo $row->id; ?>" class="btn-table done">Done</a></td>
                        <td><a href="update.php?update_id=<?php echo $row->id; ?>" class="btn-table update">Update</a></td>
                        <td><a href="delete.php?delete_id=<?php echo $row->id; ?>" class="btn-table delete">Delete</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h3>Completed Tasks</h3>
        <table class="table-style" style="width: 50%;">
            <thead>
                <tr>
                    <th>SNo.</th>
                    <th>Task Name</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($completed_rows as $r) : ?>
                    <tr>
                        <td><?php echo $r->id; ?></td>
                        <td><?php echo $r->task_name; ?></td>
                    </tr>
                <?php endforeach; ?>


            </tbody>
        </table>
    </div>
</body>

</html>