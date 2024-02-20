<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Information</title>
    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }
        body{
            width:100vw;
            height:100vh;
            background:url(./img3.jpg);
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;  
            font-weight:bolder;
        }
        h1{
            color:darkred;
            position: relative;
            top:-30px;
            text-align:center;
        }
        .form{
            border:5px solid aliceblue;
            margin:35px auto;
            width:500px;
            height:550px;
            padding:50px;
            background:teal;
        }
        .form label{
            font-size:20px;
            font-weight:bolder;
        }
        .form input{          
            outline:none;
            margin:10px;
            padding:8px;
            width:100%;
            font-size:16px;
        }
      .form .submit{
            font-size:17px;
            margin-top:40px;
        }
        .form .submit:hover{
            outline:none;
            border:none;
            background-color:crimson;
            color:aliceblue;
            font-size:18px;
            letter-spacing:2px;
            transition:.5s;
        }
        .form .submit:not(:hover){
            transition:.5s;
        }
    </style>
</head>
<body>
 
    <form action="" method="post" class="form">
    <h1>Enter Bus Information</h1>
        <label for="busNumber">Bus Number:</label><br>
        <input type="text" name="busNumber" required class="bus"><br>

        <label for="route">Route:</label><br>
        <input type="text" name="route" class="route" required><br>

        <label for="timing">Timing:</label><br>
        <input type="text" name="timing" class="time" required><br>

        <label for="timing">Bus Stop Name:</label><br>
        <input type="text" name="busStopName" class="time" required><br>

        <input type="submit" value="SUBMIT" class="submit">

    
</form>
    
</body>
</html>
<?php
// Process form data and store it
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $busNumber = $_POST['busNumber'];
    $route = $_POST['route'];
    $timing = $_POST['timing'];
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
    $sql = "INSERT INTO bus (busNumber, route, timing, busStopName) VALUES ('$busNumber', '$route', '$timing', '$busStopName')";

    if ($conn->query($sql) === TRUE) {
        echo "Record added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

       // Close the database connection
    $conn->close();
}