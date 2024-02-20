<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Information</title>
</head>
<body>
    <h2>Enter Bus Information</h2>
    <form action="" method="post">
        <label for="busNumber">Bus Stop Name:</label>
        <input type="text" name="busStopName" required class="bus"><br>

        <input type="submit" value="Submit" class="submit">

    
</form>
    
</body>
</html>
<?php
// Process form data and store it
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $busStopName = $_POST['busStopName'];

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

    // Insert data into the table (replace "bus_info" with your table name)
    $sql = "INSERT INTO busstop (busStopName) VALUES ('$busStopName')";

    if ($conn->query($sql) === TRUE) {
        echo "Record added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}

// Display the bus information table
//include 'tabledetail.php';
?>