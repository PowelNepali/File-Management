<?php
require 'config.php';

if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];
    
    if (!filter_var($deleteId, FILTER_VALIDATE_INT)) {
        echo "Invalid input for deletion.";
    } else {
        $deleteSql = "DELETE FROM public_feedback WHERE feedback_id = ?";
        $stmt = $conn->prepare($deleteSql);
        
        if ($stmt) {
            $stmt->bind_param("i", $deleteId);
            $stmt->execute();
            $stmt->close();
        } else {
           
            echo "Error while preparing the delete statement.";
        }
    }
}


$sql = "SELECT * FROM public_feedback ORDER BY submission_date DESC";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Feedback</title>
    <style>

body, h1, table {
    margin: 0;
    padding: 0;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    color: #333;
    text-align: center;
    padding: 20px;
}

h1 {
    background-color: #333;
    color: #fff;
    padding: 20px;
}

table {
    width: 80%;
    margin: 20px auto;
    background-color: #fff;
    border-collapse: collapse;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

table, th, td {
    border: 1px solid #e6e6e6;
}

th, td {
    padding: 10px;
    text-align: center;
    color: #333;
}

th {
    background-color: #333;
    color: #fff;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

td:nth-child(4) {
    text-align: left;
}

td:nth-child(6) a {
    text-decoration: none;
    color: #fff;
    background-color: #ff3333;
    padding: 5px 10px;
    border-radius: 3px;
    cursor: pointer;
    transition: background-color 0.3s;
}

td:nth-child(6) a:hover {
    background-color: #cc0000;
}

    </style>
</head>
<body>
    <h1>Feedback Entries</h1>
    <a href="admin_page.php">Admin Panel</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Feedback Text</th>
            <th>Submission Date</th>
            <th>Action</th>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['feedback_id'] . "</td>";
            echo "<td>" . $row['full_name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['feedback_text'] . "</td>";
            echo "<td>" . $row['submission_date'] . "</td>";
            echo '<td><a href="?delete_id=' . $row['feedback_id'] . '">Delete</a></td>';
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
<?php
} else {
  
    echo "No feedback entries found.";
}
?>
