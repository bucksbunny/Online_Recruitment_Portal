<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head><title>Random</title></head>
    
    <?php
    
    $servername = "localhost";
    $username = "guestuser";
    $password = "guestuser";
    $database = "login";
    
    $conn = new mysqli($servername, $username, $password, $database);
    
    //Check connection
    if($conn->connect_error){
        die("Connection Error : ".$conn->connect_error);
    }
    echo("Connection Established");
    
    $id = "admin";
    $pass = "admin@1234";
    
    $sql = "SELECT * FROM login_details WHERE username='".$id."' AND password='".$pass."';";
    
    $result_login = $conn->query($sql);
    
    if($result_login->num_rows == 1){
        echo "login done";
    }
    else{
        die("NOT FOUND");
    }
    
    $_SESSION["username"] = $result_login->fetch_assoc()["username"];
    
    $sql = "SELECT * FROM user_data WHERE username='".$_SESSION["username"]."';";
    
    $result_data = $conn->query($sql);
    
    if($result_login->num_rows == 1){

        //  Start Session
        session_start();

        //  Get Data
        $row = $result_data->fetch_assoc();
        $fname = $row["first_name"];
        $lname = $row["last_name"];
        $email = $row["email_id"];
        
        echo "Name : ".$fname." ".$lname."<br>";
        echo "Email : ".$email;
    }
    else{
        die("ERROR");
    }
    
    ?>
    
    <body>
    </body>
    
</html>