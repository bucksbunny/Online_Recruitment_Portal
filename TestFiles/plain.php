<!DOCTYPE html>
<html>
    
    <head>
        <title>Login</title>
        <style>
            .errorClass{
                color: #FF0000;
            }
        </style>
    </head>
    
    <body>
        <h1>This is a primitive Login Facility</h1>
        <br>
        
        <?php
        $fName = $email = $pass = "";
        $fNameErr = $emailErr = $passErr = "";
        
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            
            if(empty($_POST["fName"])){
                $fNameErr = "Name Required";
            }
            else{
                $fName = testInput($_POST["fName"]);
                if(!preg_match("/^[a-zA-Z]*$/", $fName)){
                    $fNameErr = "Only letters and whitespaces allowed";
                }
            }
            
        }
        
        function testInput($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        
        ?>
        
        <form method="post" name="FormOne" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
            Name : <input type="text" name='fName' value="<?php echo $fName?>">
                    <span class="errorClass">*<?php echo $fNameErr?></span><br><br>
            Email : <input type="email" name="emailID">
                    <span class="errorClass">*<?php echo $emailErr?></span><br><br>
            Password : <input type="password" name="pass">
                    <span class="errorClass">*<?php echo $passErr?></span><br><br>
            <button type="submit">Submit</button>
        </form>
        
        
    </body>
</html>
