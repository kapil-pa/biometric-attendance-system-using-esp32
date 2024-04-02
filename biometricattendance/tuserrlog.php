
<?php
session_start();
if (!isset($_SESSION['Admin-name'])) {
  header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Days Present</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
        }

        .table {
            max-height: 500px;
            overflow-y: auto;
        }

        .table thead th {
            background-color: #007bff;
            color: #fff;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<?php include'header.php';?>
    <div class="container">
    
            <?php
// Perform database query
require 'connectDB.php'; // Include database connection file

$sql = "SELECT 
            username, 
            COUNT(DISTINCT checkindate) AS days_present,
            (COUNT(DISTINCT checkindate) / 10 )* 100 AS percentage_present
        FROM 
            users_logs 
        GROUP BY 
            username";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    ?>
    <div class="container">
        <h2>User Days Present</h2>
        <table class="table">
            <thead class="table-primary">
                <tr>
                    <th>Username</th>
                    <th>Days Present</th>
                    <th>Percentage Present</th>
                </tr>
            </thead>
            <tbody>
            <?php
                // Output data of each row
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row["username"]; ?></td>
                        <td><?php echo $row["days_present"]; ?></td>
                        <td><?php echo $row["percentage_present"]; ?>%</td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php
} else {
    ?>
    <div class="container">
        <h2>User Days Present</h2>
        <p>No records found.</p>
    </div>
    <?php
}

// Close database connection
mysqli_close($conn);
?>

            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and jQuery (for Bootstrap functionality) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
