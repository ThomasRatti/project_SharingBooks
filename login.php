<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $email=$_GET["email"];
    $password=$_GET["password"];
    // Set session variables
    $_SESSION["email"]=$email;
    $_SESSION["password"]=$password;

    
    require('connessione.php');
    if(!empty($email) && !empty($password)){
        $sql="SELECT A.* FROM autorizzato A WHERE A.email='$email' AND A.password='$password'";
        $sql2="SELECT O.* FROM ospiti O WHERE O.email='$email' AND O.password='$password'";
        $result = $conn->query($sql);
        $result2 = $conn->query($sql2);
        if($result->num_rows > 0){
            $_SESSION["autorizzato"]=1;
            $_SESSION["ospite"]=0;
            foreach($result as $row){
                $_SESSION["id"]=$row["ID_autorizzato"];
            }
            header("Location: index.php");
        }else{
            if ($result2->num_rows > 0) {
                $_SESSION["ospite"]=1;
                $_SESSION["autorizzato"]=0;
                foreach($result2 as $row){
                    $_SESSION["id"]=$row["ID_ospite"];
                }
                header("Location: index.php");
            }else{
                $_SESSION["error"]="2";
                header("Location: error.php");
            }
        }
    }else{
        $_SESSION["error"]= "1";
        header("Location: error.php");
    }
    ?>
</body>
</html>