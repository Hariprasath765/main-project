<?php
# Initialize the session
session_start();

# If user is not logged in then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== TRUE) {
  echo "<script>" . "window.location.href='./login.php';" . "</script>";
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body{
            background-image: url(./ant-rozetsky-lr9vo8mNvrc-unsplash.jpg);
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            width:100vw;
            height: 100vh;
        }
        nav{
            padding: 10px;
            width:100%;
            height:60px;
            background-color: teal;
            z-index: 5;
        }
        nav h1{
            font:900;
            font-size: xx-large;
            text-align: center;
            transform: translateY(-50px);
            animation: anim1 1s linear forwards;
        }
        @keyframes anim1 {
            to{
                transform: translateY(0px);
            }
        }
        @keyframes anim2 {
            to{
                transform: translateX(0px);
            }
        }
        .but{
            margin-right: 20px;
            position: fixed;
            top: 20px;
            right: 0;
            width:27px;
            height:25px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            transform: translateX(50px);
            animation: anim2 1s linear forwards;
            cursor: pointer;
        }
        .but1{
            width: 100%;
            height:5px;
            background-color: rgb(255, 255, 255);
        }
        .side{
            position: fixed;
            top: 0;
            left: 0;
            width:300px;
            height:100%;
            background-color: gray;
            z-index: 2;
            padding: 10px;
            transition: .5s;
            transform: translateX(-300px);
        }
        .side.bar{
            transform: translateX(0px);
        }
        .side{
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .side1 ul{
            display: block;
            padding: 5px;
            width:100%;
            
        }
       .side1 ul li{
        list-style: none;
        padding: 15px;
        border-bottom: 2px solid aliceblue;
        cursor: pointer;
       }
	   .side ul li:hover{
	      background:crimson;
		  color:aliceblue
		 }
       p{
	     font-size:20px;
        text-align: center;
     }
    
    </style>
</head>
<body>
    <nav>
        <h1>QR code at bus stop</h1>  
        <div class="but">
            <span class="but1"></span>
            <span class="but1"></span>
            <span class="but1"></span>
        </div>
    </nav>
    <div class="side ">
         <div class="side1">
            <ul class="list"> 
                <li>Add Bus detail</li>
                <li>View Bus details</li>
				<li>Add stop</li>
                <li>QR code</li>
				<li>Contact us</li>
            </ul>
         </div>       
            <div class="para"><p>Developed by Hari prasath</p></div>
    </div>
    <script src="./script.js"></script>
</body>
</html>