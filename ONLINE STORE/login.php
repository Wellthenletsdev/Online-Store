<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title></title>
</head>
<body>
 <h1><center>SOUTH STREET AUTO LOGIN</center></h1>
<div id="form">
            <h1>Login Form</h1>
            <form name="form" action="example.php" onsubmit="return isvalid()" method="POST">
                <label>Username: </label>
                <input type="text" id="user" name="user" required></br></br>
                <label>Password: </label>
                <input type="password" id="pass" name="pass" required></br></br>
                <label> Email:</label>
                <input type="email" id="email" name="email" required></br></br>

                
                <input type="submit" id="btn" value="Login" name = "submit"/>

            </form>
        </div>
    
</body>
</html>