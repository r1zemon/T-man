<!-- admin_dashboard.php -->
<?php
include 'connect.php';
session_start();

// Check if user is logged in as admin
if(!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - T-Man</title>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" type="text/css" href="css/admin.css">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">T-Man Admin</div>
        <ul class="nav-links">
            <li><a href="admin_dashboard.php"><i class='bx bxs-dashboard'></i> Dashboard</a></li>
            <li><a href="admin_users.php"><i class='bx bxs-user'></i> Users</a></li>
            <li><a href="admin_destinations.php"><i class='bx bxs-map'></i> Destinations</a></li>
            <li><a href="admin_tickets.php"><i class='bx bxs-ticket'></i> Tickets</a></li>
            <li><a href="logout.php"><i class='bx bxs-log-out'></i> Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h1>Dashboard</h1>
        </div>
        
        <div class="overview-cards">
            <div class="card">
                <h3>Total Users</h3>
                <?php
                $query = "SELECT COUNT(*) as total FROM users";
                $result = $conn->query($query);
                $row = $result->fetch_assoc();
                echo "<p>" . $row['total'] . "</p>";
                ?>
            </div>
            <div class="card">
                <h3>Total Destinations</h3>
                <?php
                $query = "SELECT COUNT(*) as total FROM destinations";
                $result = $conn->query($query);
                $row = $result->fetch_assoc();
                echo "<p>" . $row['total'] . "</p>";
                ?>
            </div>
            <div class="card">
                <h3>Total Tickets</h3>
                <?php
                $query = "SELECT COUNT(*) as total FROM tickets";
                $result = $conn->query($query);
                $row = $result->fetch_assoc();
                echo "<p>" . $row['total'] . "</p>";
                ?>
            </div>
        </div>
    </div>
</body>
</html>