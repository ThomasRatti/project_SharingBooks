<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Account</title>
        <style>
            body{
                background: linear-gradient(#ac6830cb, #633309);
                height: 100%;
            }
            img{
                max-width: 25px;
                max-height: 25px;
            }
            .container {
                display: flex;
                flex-direction: column;
                padding: 3% 2%;
                box-sizing: border-box;
                align-items: center;
            }
            .box {
                flex: 1;
                overflow: hidden;
                transition: .5s;
                margin: 0 2%;
                box-shadow: 0 20px 30px rgba(0,0,0,.1);
                background: linear-gradient(#e4c0a8, #d3a27f);
                text-align: left;
                padding: 20px;
                max-width: fit-content;
                margin-bottom: 20px;
            }
            .box  > span {
                font-size: 25px;
                display: block;
                align-items: center;
                text-align: center;
                height: 7vh;
                line-height: 2.6;
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

            hr{
                background-color: black;
                height: 3px;
            }
            .submit {
                border-radius: 5px;
                background: transparent;
                transition: 0.7s;
                height: 27px;
                width: 200px;
            }
            .submit:hover {
                background: #cd853f;
                color: black;
            }
            input {
                border-radius: 5px;
                background: transparent;
                transition: 0.7s;
                height: 27px;
            }
            input:hover {
                background: #cd853f;
                color: black;
            }
            .bottone{
                margin: 20px;
                border: 0px;
                text-align: center;
            }




            .box-libri {
                flex: 1;
                overflow: hidden;
                transition: .5s;
                box-shadow: 0 20px 30px rgba(0,0,0,.1);
                background: linear-gradient(#e4c0a8, #d3a27f);
                text-align: left;
                padding: 20px;
                max-width: fit-content;
            }
            .box-libri  > span {
                font-size: 25px;
                display: block;
                align-items: center;
                text-align: center;
                height: 7vh;
                line-height: 2.6;
            }
            .modificaLibri {
                border-radius: 5px;
                background: transparent;
                transition: 0.7s;
                height: 27px;
            }
            button {
                border-radius: 5px;
                background: transparent;
                transition: 0.7s;
                height: 27px;
            }
            table.eliminaLibri {
                width: 300px;
                font-size: larger;
            }

            @media screen and (min-width: 1092px) {
                body{
                    height: 100vh;
                }
                .container {
                    display: flex;
                    flex-direction: row;
                    box-sizing: border-box;
                    padding-top: 20px;
                }
                .box-libri {
                    flex: 1;
                    overflow: hidden;
                    transition: .5s;
                    box-shadow: 0 20px 30px rgba(0,0,0,.1);
                    background: linear-gradient(#e4c0a8, #d3a27f);
                    text-align: left;
                    padding: 20px;
                    max-width: -webkit-fill-available;
                }
            }
        </style>
    </head>
    <body>
        <?php
        require('connessione.php');
        if($_SESSION["autorizzato"]==1 and $_SESSION["ospite"]==0){
            $id=$_SESSION["id"];
            $query="SELECT * FROM autorizzato WHERE ID_autorizzato='$id'";
            $risultato=$conn->query($query);
        }else{
            $id=$_SESSION["id"];
            $query="SELECT * FROM ospiti WHERE ID_ospite='$id'";
            $risultato=$conn->query($query);
        } 
        echo"<center>  
        <a href='index.php'><img src='https://cdn.pixabay.com/photo/2013/07/12/12/56/home-146585_640.png'></a>
        <div class='container'>
            <div class='box'>
                <span>Informazioni Account</span>
                <hr><br><br>";

                if(isset($_GET["conferma"])){
                    if($_SESSION["conferma"]=="dati"){
                        $nome=$_GET["nome"];
                        $cognome=$_GET["cognome"];
                        $dataNascita=$_GET["dataNascita"];
                        $indirizzo=$_GET["indirizzo"];
                        $residenza=$_GET["residenza"];
                        $email=$_GET["email"];
                        foreach($risultato as $row){
                            $password=$row["password"];
                        }
                    }
                    if($_SESSION["conferma"]=="password"){
                        foreach($risultato as $row){
                            $nome=$row["nome"];
                            $cognome=$row["cognome"];
                            $dataNascita=$row["data_Nascita"];
                            $indirizzo=$row["indirizzo"];
                            $residenza=$row["residenza"];
                            $email=$row["email"];
                        }
                        $password=$_GET["password"];
                    }
                    require('connessione.php');
                    if($_SESSION["autorizzato"]==1 and $_SESSION["ospite"]==0){
                        $sql="UPDATE autorizzato SET nome='$nome', cognome='$cognome', data_Nascita='$dataNascita', indirizzo='$indirizzo', residenza='$residenza', email='$email'
                                WHERE ID_autorizzato=$id";
                        if($conn->query($sql)===true){
                            header("Location: account.php");
                        }
                        
                    }else{
                        $sql="UPDATE ospite SET nome='$nome', cognome='$cognome', data_Nascita=$dataNascita, indirizzo='$indirizzo', residenza='$residenza', email='$email'
                                WHERE ID_ospite=$id";
                        if($conn->query($sql)===true){
                            header("Location: account.php");
                        }
                    }
                }
                if(!$_GET || isset($_GET["conferma"]) || isset($_GET["modificaLibri"]) || isset($_GET["elimina"])){
                    echo "<form action='account.php' method='GET'><table>";
                    foreach($risultato as $row){
                        echo "<tr><td class='info'>Nome: </td><td>".$row["nome"]."</td></tr>";
                        echo "<tr><td class='info'>Cognome: </td><td>".$row["cognome"]."</td></tr>";
                        echo "<tr><td class='info'>Data di Nascita: </td><td>".$row["data_Nascita"]."</td></tr>";
                        echo "<tr><td class='info'>Indirizzo: </td><td>".$row["indirizzo"]."</td></tr>";
                        echo "<tr><td class='info'>Residenza: </td><td>".$row["residenza"]."</td></tr>";
                        echo "<tr><td class='info'>E-mail: </td><td>".$row["email"]."</td></tr>";
                        echo "<tr><td class='info'>Password: </td><td>********</td></tr>";
                        echo "<tr><td class='bottone'><input type='submit' value='Modifica Dati Personali' name='modificaDati' class='submit'></td>
                            <td class='bottone'><input type='submit' value='Modifica Password' name='modificaPassword' class='submit'></td></tr>";
                    }
                    echo "</table></form>";
                }else{
                    if(isset($_GET["modificaDati"])){
                        $_SESSION["conferma"]="dati";
                        echo "<form action='account.php' method='get'><table>";
                        foreach($risultato as $row){
                            echo "<tr><td class='info'>Nome: </td><td><input type='text' value='{$row['nome']}' name='nome'></td></tr>";
                            echo "<tr><td class='info'>Cognome: </td><td><input type='text' value='$row[cognome]' name='cognome'></td></tr>";
                            echo "<tr><td class='info'>Data di Nascita: </td><td><input type='date' value='$row[data_Nascita]' name='dataNascita'></td></tr>";
                            echo "<tr><td class='info'>Indirizzo: </td><td><input type='text' value='$row[indirizzo]' name='indirizzo'></td></tr>";
                            echo "<tr><td class='info'>Residenza: </td><td><input type='text' value='$row[residenza]' name='residenza'></td></tr>";
                            echo "<tr><td class='info'>E-mail: </td><td><input type='text' value='$row[email]' name='email'></td></tr>";
                            echo "<tr><td class='info'>Password: </td><td>********</td></tr>";
                            echo "<tr><td class='bottone'><input type='submit' value='Conferma' name='conferma' class='submit'></td>
                                <td class='bottone'><input type='submit' value='Modifica Password' name='modificaPassword' class='submit'></td></tr>";
                        }
                        echo "</table></form>";
                    }
                    if(isset($_GET["modificaPassword"])){
                        $_SESSION["conferma"]="password";
                        echo "<form action='account.php' method='GET'><table>";
                        foreach($risultato as $row){
                            echo "<tr><td class='info'>Nome: </td><td>".$row["nome"]."</td></tr>";
                            echo "<tr><td class='info'>Cognome: </td><td>".$row["cognome"]."</td></tr>";
                            echo "<tr><td class='info'>Data di Nascita: </td><td>".$row["data_Nascita"]."</td></tr>";
                            echo "<tr><td class='info'>Indirizzo: </td><td>".$row["indirizzo"]."</td></tr>";
                            echo "<tr><td class='info'>Residenza: </td><td>".$row["residenza"]."</td></tr>";
                            echo "<tr><td class='info'>E-mail: </td><td>".$row["email"]."</td></tr>";
                            echo "<tr><td class='info'>Password: </td><td><input type='text' value='$row[password]' name='password'></td></tr>";
                            echo "<tr><td class='bottone'><input type='submit' value='Modifica Dati Personali' name='modificaDati' class='submit'></td>
                            <td class='bottone'><input type='submit' value='Conferma' name='conferma' class='submit'></td></tr>";
                        }
                        echo "</table></form>";
                    }
                }    
        echo "</div>
            <div class='box-libri'>
                <span>Libri Condivisi</span>
                <hr><br><br>";
                    $sql="SELECT LO.*, L.titolo, L.isbn FROM libro_offerto LO, libro L WHERE LO.id_autorizzato='$id' AND LO.id_libro=L.id_libro";
                    $result=$conn->query($sql);
                    if(isset($_GET["elimina"])){
                            $delete="DELETE FROM libro_offerto WHERE ID_libro_offerto='$_GET[elimina]'";  
                            $conn->query($delete);
                    }
                    if(!isset($_GET["modificaLibri"]) || isset($_GET['elimina'])){
                        if($result->num_rows > 0){
                            echo "<form action='account.php' method='GET'><table class='tlibri'>";
                            echo "<tr class='libri'>
                                        <td><b>Titolo</b></td>
                                        <td><b>ISBN</b></td>
                                        <td><b>Esercizi Svolti</b></td> 
                                        <td><b>Sottolineato</b></td>
                                        <td><b>Voto</b></td>
                                        <td><b>CD</b></td>
                                        <td><b>Online</b></td>   
                                    </tr>";
                            foreach($result as $riga){
                                echo "<tr><td>".$riga['titolo']."</td>
                                        <td>".$riga['isbn']."</td>";
                                    if($riga['stato_es_svolti']==1){
                                        echo "<td>SI</td>";
                                    }else{
                                        echo "<td>NO</td>";
                                    }
                                    if($riga['sottolineato']==1){
                                        echo "<td>SI</td>";
                                    }else{
                                        echo "<td>NO</td>";
                                    }
                                    echo "<td>".$riga['voto']."</td>";
                                    if($riga['presenza_cd']==1){
                                        echo "<td>SI</td>";
                                    }else{
                                        echo "<td>NO</td>";
                                    }
                                    if($riga['online_valido']==1){
                                        echo "<td>SI</td>";
                                    }else{
                                        echo "<td>NO</td>";
                                    }
                            }
                            echo "</table><br><center><input type='submit' value='Modifica Libri' name='modificaLibri' class='modificaLibri'></center>";
                            echo "</form>";
                        }else{
                            if($_SESSION["autorizzato"]==0 and $_SESSION["ospite"]==1){
                                echo "Non sei uno studente autorizzato alla condivisione di libri!<br><br>";
                            }else{
                                echo "Non hai ancora inserito dei libri per la condivisione!<br><br>";
                                echo "<a href='condividi.php'>Inserisci Ora!</a>";
                            }
                        }
                    }else{
                        $_SESSION["conferma"]="libri";
                        echo "<center><table class='eliminaLibri'>";
                        echo "<tr class='libri'>
                                    <td class='libri'><b>Titolo</b></td>
                                    <td class='libri'><b>ISBN</b></td>
                                    <td class='libri'></td>
                                </tr>";
                                foreach($result as $riga){
                                    echo "<form action='account.php' method='GET'>";
                                    echo "<tr><td class='linfo'>".$riga['titolo']."</td>
                                            <td class='linfo'>".$riga['isbn']."</td>";
                                            
                                    echo "<td><button type='submit' name='elimina' value='$riga[ID_libro_offerto]'>Elimina</button></td>";
                                    echo "</form>";
                                }
                        echo "</table></center><br>";

                    }
            echo "</div>
        </div>
        </center>"; 
        ?>
    </body>
</html>