<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background: linear-gradient(#ac6830cb, #633309);
        }
        .error {
            background-color: #fff;
            height: 400px;
            width: 400px;
            position: absolute;
            margin: auto;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.3);
            overflow: hidden;
        }
        h2 {
            text-align: center;
            margin-top: 150px;
            position: absolute;
            z-index: 9999;
            font-size: 26px;
            color: #633309;
            width: 100%;
            font-family: 'Noto Sans', serif;
        }
        h2 small {
            font-weight: normal;
            font-size: 65%;
            color: rgba(0,0,0,0.5);
        }
        .button-container {
            text-align: center;
            margin-top: 290px;
            position: absolute;
            z-index: 9999;
            width: 100%;
            font-family: 'Noto Sans', serif;
        }
        .button {
            color: #fff;
            border: 2px solid #black;
            background-color: #ac6830cb;
            padding: 10px 25px;
            border-radius: 50px;
            font-size: 17px;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="error">
        <?php
        if($_SESSION["login"]=="1"){
                echo "<h2>ATTENZIONE!<br><small>Effettua l'accesso per visualizzare la pagina</small></h2>
                    <div class='button-container'>
                        <a href='login.html' class='button'>OK</a>
                    </div>";
        }
        if($_SESSION["login"]=="2"){
            echo "<h2>ATTENZIONE!<br><small>Non sei uno studente autorizzato</small></h2>
                <div class='button-container'>
                    <a href='index.php' class='button'>OK</a>
                </div>";
            $_SESSION["login"]="0"; 
        }
        if($_SESSION["error"]=="1"){
            echo "<h2>ATTENZIONE!<br><small>Inserisci i dati nei campi dedicati</small></h2>
                <div class='button-container'>
                    <a href='login.html' class='button'>OK</a>
                </div>";
            $_SESSION["error"]="0";
        }
        if($_SESSION["error"]=="2"){
            echo "<h2>ATTENZIONE!<br><small>Username o Password non corretti</small></h2>
                <div class='button-container'>
                    <a href='login.html' class='button'>OK</a>
                </div>";
            $_SESSION["error"]="0";
        }
        if($_SESSION["error"]=="3"){
            echo "<h2>ATTENZIONE!<br><small>Non è presente nessun libro <br>con lo stesso ISBN o Titolo</small></h2>
                <div class='button-container'>
                    <a href='cerca.php' class='button'>OK</a>
                </div>";
            $_SESSION["error"]="0";    
        }
        if($_SESSION["error"]=="4"){
            echo "<h2>ATTENZIONE!<br><small>Non è presente nessun libro <br>con lo stesso ISBN</small></h2>
                <div class='button-container'>
                    <a href='condividi.php' class='button'>OK</a>
                </div>";
            $_SESSION["error"]="0";    
        }


        if($_SESSION["complete"]=="1"){
            echo "<h2>ATTENZIONE!<br><small>Email corrispondente ad un account<br> già esistente</small></h2>
                <div class='button-container'>
                    <a href='login.html' class='button'>OK</a>
                </div>";
            $_SESSION["complete"]="0";
        }
        if($_SESSION["complete"]=="2"){
            echo "<h2>COMPLIMENTI!<br><small>Inserimento del libro avvenuto<br>con successo</small></h2>
                <div class='button-container'>
                    <a href='index.php' class='button'>OK</a>
                </div>";
            $_SESSION["complete"]="0";
        }

        /*
            errore:
            1 = no campi inseriti login;
            2= nessuna corrispondenza delle credenziali (ospite e autorizzato)
            3= no isbn o titolo corrispondente
            4= no isbn corrispondente

            inserimento:
            1= account già esistente 
            2= inserimento libro successo




            login: 
            1= utente ospite
        */
        ?>
    </div>
</body>
</html>
