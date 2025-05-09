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
    $nome=$_GET["nome"];
    $cognome=$_GET["cognome"];
    $dataNascita=$_GET["dataNascita"];
    $indirizzo=$_GET["indirizzo"];
    $residenza=$_GET["residenza"];
    $email=$_GET["email"];
    $password=$_GET["password"];
    
    $_SESSION["email"]=$email;
    $_SESSION["password"]=$password;

    //controllo della lista
    require('connessione.php');
        if(!empty($nome) && !empty($cognome) && !empty($dataNascita) && !empty($indirizzo) && !empty($residenza)  && !empty($email) && !empty($password) ){
            $sql="SELECT A.* FROM autorizzato A WHERE A.Email='$email'";
            $sql2="SELECT O.* FROM ospiti O WHERE O.Email='$email'";
            $result = $conn->query($sql);
            $result2 = $conn->query($sql2);
            if ($result->num_rows > 0) {
                $_SESSION["complete"]="1";
                $_SESSION["autorizzato"]=true;
                header("Location: error.php");
            }else{
                if($result2->num_rows > 0){
                    $_SESSION["complete"]="1";
                    $_SESSION["autorizzato"]=false;
                    header("Location: error.php");
                }else{
                    $sql="INSERT INTO ospiti(nome, cognome, data_Nascita, indirizzo, residenza, email, password) 
                              VALUES ('$nome', '$cognome', '$dataNascita', '$indirizzo', '$residenza', '$email', '$password');";
                        if($conn->query($sql)===true){
                            header("Location: index.php");
                        }
                }
            }
        }else {
            $_SESSION["error"]= "1";
            header("Location: error.php");
        }
    ?>
</body>
</html>