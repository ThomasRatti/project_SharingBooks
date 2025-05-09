<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cerca Libri</title>
    <style>
        html{
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
            margin-top: 145px;
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
            text-align: right;
            font-size: larger;
        }
        fieldset{
            border-radius: 20px;
            box-shadow: 0px 20px 30px rgb(250, 152, 24);
            max-width: 800px;
            padding: 25px;
            margin: 25px;
            background: url(images/lente2.jpeg) no-repeat center left;
            background-color: white;
            opacity: 0.8;
            background-size: 700px;
        }
        .bottone {
            width: 100px;
            border-radius: 5px;
            background: transparent;
        }
        .risultato {
            background: linear-gradient(#f8cda9, #b8aa9f);
            box-shadow: 0px 20px 30px rgb(250, 152, 24);
            margin: 50px;
            width: 700px;
            padding: 50px;
            font-size: larger;
            border: ridge;
        }
        td{
            border-right: double;
            border-bottom: double;
            padding: 10px;
        }
        .info{
            font-weight: bold;
            width: 215px;
        }  
    </style>
</head>
<body>
    <?php
        if($_SESSION["autorizzato"]!=0 or $_SESSION["ospite"]!=0){
            require('connessione.php');
            echo "<center><a href='index.php'><img src='https://cdn.pixabay.com/photo/2013/07/12/12/56/home-146585_640.png'></a></center>
                <h1><span class='fancy'>Cerca</span> il libro dei tuoi <span class='fancy'>sogni</span> !</h1>
                <br>    
                <h3>Inserisci il titolo del libro o il codice ISBN:</h3>
                <br>
                <center><fieldset>
                            <form action='{$_SERVER['PHP_SELF']}' method='GET'>
                                <label>ISBN: </label><br><input type='text' name='isbn'><br><br>
                                <label>Titolo: </label><br><input type='text' name='titolo'><br><br>
                                <input type='submit' value='Cerca'><br><br>
                            </form>
                </fieldset></center><br><br><br>";

            if($_GET){
                if(!empty($_GET["isbn"])){
                    $isbn=$_GET["isbn"];
                }else{
                    $isbn= "";
                }  
                if(!empty($_GET["titolo"])){
                    $titolo=$_GET["titolo"];
                }else{
                    $titolo= "";
                }  
                $sql="SELECT * FROM libro WHERE isbn='$isbn' OR titolo='$titolo'";
                $result=$conn->query($sql);
                if($result->num_rows > 0){
                    echo "<center><div class='risultato'>
                            <label>Libro Richiesto: </label><br><br>
                            <table>
                                <b><tr>
                                    <td><b>Titolo</b></td>
                                    <td><b>Anno d'acquisto</b></td>
                                    <td><b>Prezzo Listino</b></td>
                                    <td><b>CD</b></td>
                                    <td><b>Online</b></td>
                                </tr></b>";
                    foreach($result as $riga){
                        echo "<tr>
                                <td>{$riga['titolo']}</td>
                                <td>{$riga['anno_acquisto']}</td>
                                <td>€ {$riga['prezzo_listino']}</td>";
                                if($riga['cd']==1){
                                    echo "<td> SI </td>";
                                }else{
                                    echo "<td> NO </td>";
                                }
                                if($riga['online_']==1){
                                    echo "<td> SI </td>";
                                }else{
                                    echo "<td> NO </td>";
                                }
                        echo "</tr>";
                    } 
                    echo "</table><br><br>";
                }else{
                    $_SESSION["error"]= "3";
                    header("Location: error.php");
                }     

                $sql="SELECT LO.* FROM libro L, libro_offerto LO WHERE L.isbn='$isbn' OR L.titolo='$titolo' AND L.ID_libro=LO.id_libro";
                $result=$conn->query($sql);
                if($result->num_rows > 0){
                    echo "<label>Utenti che hanno a disposizione il libro richiesto: </label><br><br>";
                    echo "<table>
                            <tr>
                                <td><b>Nome</b></td>
                                <td><b>Cognome</b></td>
                                <td><b>Email di contatto</b></td>
                                <td><b>Residenza</b></td>
                            </tr>"; 
                    $sql="SELECT DISTINCT A.* 
                        FROM autorizzato A, libro_offerto LO, libro L 
                        WHERE LO.id_autorizzato=A.ID_autorizzato AND LO.id_libro=L.ID_libro AND L.isbn='$isbn' OR L.titolo='$titolo'
                        ORDER BY A.residenza";
                    $result=$conn->query($sql);
                    foreach($result as $row){
                        echo "<tr>
                                <td>{$row['nome']}</td>
                                <td>{$row['cognome']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['residenza']}</td>
                            </tr>";
                    }
                    echo "</table></div></center>";
                }else{
                    echo "<label>Nessun utente ha condiviso il libro richiesto</label><br>";
                }
            }
        }else{
            header("Location: error.php");
        }
    ?>
</body>
</html>