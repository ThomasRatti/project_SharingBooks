<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Condividi Libri</title>
    <style>
        html {
            height: -webkit-fill-available;
        }
        body{
            background: linear-gradient(#ac6830cb, #633309);
        }
        img{
            max-width: 25px;
            max-height: 25px;
        }
        h1 {
            margin-top: 100px;
            text-align: center;
            font-family: sans-serif;
        }
        h3 {
            text-align: center;
            font-family: sans-serif;
        }
        .fancy {
            position: relative;
            white-space: nowrap;
            &:after {
                --deco-height: 0.3125em;
                content: "";
                position: absolute;
                left: 0;
                right: 0;
                bottom: calc(var(--deco-height) * -0.625);
                height: var(--deco-height);
                background-image: url("https://images.pngnice.com/download/2007/Abstract-Green-Wave-PNG-File.png");
                background-size: auto 120%;
                background-repeat: round;
                background-position: 0em;
            }
        }
        form{
            text-align: left;
            font-style: bold;
        }
        fieldset{
            border-radius: 20px;
            box-shadow: 0px 20px 30px rgb(250, 152, 24);
            max-width: 800px;
            padding: 25px;
            margin: 25px;
            background: url(images/book.jpeg) no-repeat center left;
            opacity: 0.8;
        }
        .bottone {
            width: 100px;
            border-radius: 5px;
            background: transparent;
        }
        
    </style>
</head>
<body>
    <?php
        $_SESSION["page"]="condividi";
        if($_SESSION["autorizzato"]!=0 or $_SESSION["ospite"]!=0){
            if($_SESSION["autorizzato"]==1 and $_SESSION["ospite"]==0){
                require('connessione.php');
                echo "<center><a href='index.php'><img src='https://cdn.pixabay.com/photo/2013/07/12/12/56/home-146585_640.png'></a></center>
                    <h1><span class='fancy'>Condividere</span> i tuoi libri non è mai stato cosi <span class='fancy'>semplice</span> !</h1>
                        <br>    
                        <h3>Inserisci i dati del tuo libro e aspetta che qualcuno ti contatti:</h3>
                        <br>
                            <center><fieldset>
                                    <form action='{$_SERVER['PHP_SELF']}' method='GET'>
                                        <label>ISBN del Libro: </label><br><input type='text' name='isbn'><br><br>
                                        <label>Esercizi Svolti: </label><input type='checkbox' name='eserciziSvolti' value='si'><br><br>
                                        <label>Sottolineato: </label><input type='checkbox' name='sottolineato' value='si'><br><br>
                                        <label>Voto: </label><input type='number' name='voto' min='1' max='10'><br><br>
                                        <label>CD: </label><input type='checkbox' name='cd' value='si'><br><br>
                                        <label>Online Valido: </label><input type='checkbox' name='online' value='si'><br><br>
                                        <br><input type='reset' class='bottone' value='Cancella'> <input type='submit' class='bottone' value='Inserisci'><br>
                                    </form>
                        </fieldset></center>";

                if($_GET){
                    $isbn=$_GET["isbn"];
                    $query="SELECT * FROM libro WHERE isbn='$isbn'";
                    $risultato=$conn->query($query);
                    if($risultato->num_rows > 0){
                        foreach($risultato as $row){
                            if($row["isbn"]==$_GET["isbn"]){
                                $id_libro=$row["ID_libro"];
                            }
                        }
                        if(isset($_GET["eserciziSvolti"]) && $_GET["eserciziSvolti"]=='si'){
                            $eserciziSvolti=1;
                        }else{
                            $eserciziSvolti=0;
                        }
                        if(isset($_GET["sottolineato"]) && $_GET["sottolineato"]=='si'){
                            $sottolineato=1;
                        }else{
                            $sottolineato=0;
                        }
                        $voto=$_GET["voto"];
                        if(isset($_GET["cd"]) && $_GET["cd"]=='si'){
                            $cd=1;
                        }else{
                            $cd=0;
                        }
                        if(isset($_GET["online"]) && $_GET["online"]=='si'){
                            $online=1;
                        }else{
                            $online=0;
                        }
                        $id_autorizzato=$_SESSION["id"];
                        $sql="INSERT INTO libro_offerto (stato_es_svolti, sottolineato, voto, presenza_cd, online_valido, id_libro, id_autorizzato)
                                VALUES ($eserciziSvolti, $sottolineato, $voto, $cd, $online, $id_libro, $id_autorizzato)";
                        if($conn->query($sql)===true){
                            $_SESSION["complete"]="2";
                            header("Location: error.php");
                        }
                    }else{
                        $_SESSION["error"]="4";
                        header("Location: error.php");
                    }
                }
            }else{
                $_SESSION["login"]= "2";
                header("Location: error.php");
            }
        }else{
            $_SESSION["login"]= "1";
            header("Location: error.php");
        }
    ?>
</body>
</html>