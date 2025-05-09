<?php
// new mysqli('indirizzo server', 'nome utente', 'password', 'nome database')
$conn = new mysqli('thomasratti.altervista.org', 'root', '', 'my_thomasratti');

//Controllo la connessione
if($conn->connect_error){
    die('Connessione Fallita!<br><br>'.$conn->connect_error);
}
?>