<?php

require "connection/connection.php";

if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];

    $data = $conn->query("SELECT * FROM tasks");
    $rows = $data->fetchAll(PDO::FETCH_OBJ);

    $task = "";
    foreach ($rows as $row) {
        if ($row->id == $id) {
            $task .= $row->task_name;
            break;
        }
    }

    $insert = $conn->prepare("INSERT INTO Tasks_completed (task_name, id) VALUES (:name, :id)");
    $insert->bindParam(":name", $task);
    $insert->bindParam(":id", $id);
    $insert->execute();

    $delete = $conn->prepare("DELETE FROM tasks WHERE id=:id");
    $delete->execute([':id' => $id]);

    header("location: index.php");
}
