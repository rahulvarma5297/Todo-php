<?php

require "connection/connection.php";

if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];

    $delete = $conn->prepare("DELETE FROM tasks WHERE id=:id");
    $delete->execute([':id' => $id]);

    header("location: index.php");
}
