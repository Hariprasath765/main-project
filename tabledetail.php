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
            background:rebeccapurple; 
        }
        table{
            margin:100px auto;
            border-collapse:collapse;
            width:80%;
            border:2px solid aliceblue;
        }
        th{
            border:2px solid aliceblue;
            padding:15px;
            font-size:24px;
        }
        tr,td{
            border:2px solid aliceblue;
            font-weight:bolder;
            padding:12px;
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
$sql = "SELECT * FROM bus";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<table border="1" cellspacing="2">
            <tr>
                <th>Bus Number</th>
                <th>Route</th>
                <th>Timing</th>
            </tr>';

    while ($row = $result->fetch_assoc()) {
        echo '<tr>
                <td>' . $row['busNumber'] . '</td>
                <td>' . $row['route'] . '</td>
                <td>' . $row['timing'] . '</td>
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
