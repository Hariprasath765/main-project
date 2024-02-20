<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            width:100vw;
            height:100vh;
        
        }
        table{
            border-collapse:collapse;
            width:70%;
            margin:100px;
            border-color:black;
        }
        th{
            font-size:20px;
            padding:8px;
        }
        tr,td{
            padding:8px;
        }
    </style>
</head>
<body>
<?php
// Connect to your database (replace placeholders)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "data2";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the table (replace "bus_info" with your table name)
$sql = "SELECT * FROM busstop";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<table border="1" cellspacing="2">
            <tr>
                <th>ID</th>
                <th>Bus Stop Name</th>
                <th>QR Code</th>
                <th>Download</th>
            </tr>';

    while ($row = $result->fetch_assoc()) {
        echo '<tr>
                <td>' . $row['ID'] . '</td>
                <td>' . $row['busStopName'] . '</td>
                <td></td>
                <td></td>
              </tr>';
    }

    echo '</table>';
} else {
    echo "No records found";
}

// Close the database connection
$conn->close();
?>    
</body>
</html>
