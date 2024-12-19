<!-- admin_users.php -->
<?php
include 'connect.php';
session_start();

if(!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Delete user
if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM users WHERE id=$id");
    header("Location: admin_users.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Users - T-Man Admin</title>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" type="text/css" href="css/admin.css">
</head>
<body>
    <!-- Sidebar (same as dashboard) -->
    <div class="sidebar">
        <!-- ... sidebar content ... -->
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Manage Users</h1>
            <button onclick="window.location.href='add_user.php'" class="add-btn">Add New User</button>
        </div>

        <div class="content-table">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = $conn->query("SELECT * FROM users ORDER BY id DESC");
                    while($row = $result->fetch_assoc()):
                    ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                        <td class="actions">
                            <a href="edit_user.php?id=<?php echo $row['id']; ?>" class="edit-btn">Edit</a>
                            <a href="admin_users.php?delete=<?php echo $row['id']; ?>" 
                               class="delete-btn" 
                               onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>