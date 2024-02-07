<?php
    session_start();
    include("db.php");
    $id = $_SESSION['uid'];

    $moveQuery = "INSERT INTO paid_fine SELECT * FROM traffic_fine WHERE id = $id";
    $deleteQuery = "DELETE FROM traffic_fine WHERE id = $id";

    $moveResult = $conn->query($moveQuery);
    $deleteResult = $conn->query($deleteQuery);

    header("Location: ../payment.html");