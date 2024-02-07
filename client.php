<?php
    session_start();
    include("include/db.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Futura:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/client_style.css">
    <script src="js/login_script.js"></script>
    <title>Traffic Fine Portal - Client</title>
</head>
<body>
    <?php
        if (isset($_SESSION["id"])==false) {
            header("Location: index.php");
        }

        if($_SESSION["username"] == "admin"){
            header("Location: index.php");
        }
        $activeId = $_SESSION["uid"];
        $result = $conn->query("SELECT traffic_fine.id as id, traffic_fine.time, users.uname as user_name, vehicle_detail.vehicle_id, vehicle_detail.license, traffic_fine.fine, traffic_fine.speed
        FROM traffic_fine
        JOIN users ON traffic_fine.id = users.id
        JOIN vehicle_detail ON traffic_fine.id = vehicle_detail.id WHERE users.id = $activeId");
    ?>
    <nav class="client-nav">
        <div class="logo">
            <a href="index.php" class="hyperlink">
                <img src="Assets/Traffic management.jpeg" alt="Client Logo">
                <span class="navbar-heading">Fine Portal</span>
            </a>
        </div>
        <div>
            <form action="include/logout.php">
                <button class="logout-btn">Log Out</button>
            </form>
        </div>
    </nav>

    <div class="client-bg">
        <div class="overlay"></div>
        <div class="client-content">
            <h2>Fine Information</h2>

            <div class="card">
                <table class="card-content">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Timestamp</th>
                            <th>User Name</th>
                            <th>Vehicle Number</th>
                            <th>License Number</th>
                            <th>Speed</th>
                            <th>Fine Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        while($row = $result->fetch_assoc()){
                            $id = $row['id'];
                            $time = $row['time'];
                            $user = $row['user_name'];
                            $vehicle_id = $row['vehicle_id'];
                            $license = $row['license'];
                            $fine = $row['fine'];
                            $speed = $row['speed'];
                    ?>
                        <tr>
                            <td><?php echo $id?></td>
                            <td><?php echo $time?></td>
                            <td><?php echo $user?></td>
                            <td><?php echo $vehicle_id?></td>
                            <td><?php echo $license?></td>
                            <td><?php echo $speed?></td>
                            <td><?php echo $fine?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <?php 
                            $total = $conn->query("SELECT SUM(fine) as total_sum FROM traffic_fine WHERE id = $activeId");
                        ?>
                        <td colspan="6">Total</td>
                        <td><?php while($sum = $total->fetch_assoc()){echo $sum['total_sum'];}?></td>
                    </tr>
                    </tbody>
                </table>
                <button class="card-content pay-button" onclick="pay()">Pay Now</button>
            </div>
        </div>
    </div>
</body>
</html>
