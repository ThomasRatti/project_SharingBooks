<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Book Sharing</title>
        <style>
            * {
                padding: 0;
                margin: 0;
                box-sizing: border-box;
            }

            html {
                height: -webkit-fill-available;
            }
            body{
                background: linear-gradient(#ac6830cb, #633309);
            }

            td{
                padding: 3px;
                align-content: center;
            }

            td img{
                max-width: 20px;
                max-height: 15px;
            }

            input[type="submit"] {
                border-radius: 5px;
                background: transparent;
                transition: 0.7s;
                height: 27px;
            }
            
            input[type="submit"]:hover {
                background: #cd853f;
                color: black;
            }

            .container {
                display: flex;
                flex-direction: column;
                width: 100%;
                box-sizing: border-box;
                height: 96vh;
            }

            img{
                opacity: 50%;
            }

            .box {
                flex: 1;
                overflow: hidden;
                transition: .5s;
                margin: 0 2%;
                box-shadow: 0 20px 30px rgba(0,0,0,.1);
                line-height: 0;
                background: linear-gradient(#e4c0a8, #d3a27f);
            }

            .box > a > img {
                width: 200%;
                height: calc(100% - 10vh);
                object-fit: cover; 
                transition: .5s;
            }

            .box  > span {
                font-size: 25px;
                display: block;
                align-items: center;
                text-align: center;
                height: 10vh;
                line-height: 2.6;
            }

            .box:hover {
                flex: 10%; 
            }
            
            .box:hover > a > img {
                width: 100%;
                height: 100%;
                opacity: 1;
            }

            /* @media screen and (max-width: 300px)  {
                .container {
                    padding: 8% 4%;
                    height: 100vh;
                    flex-direction: row;
                }
            } */
            @media screen and (min-width: 771px)  {
                .container {
                    padding: 8% 4%;
                    height: 100vh;
                    flex-direction: row;
                }
            }
        </style>
    </head>
    <body>
        <?php
            $_SESSION["error"]=0;
            $_SESSION["complete"]=0;
            $_SESSION["login"]=0;
            if(!isset($_SESSION["id"])){
                $_SESSION["autorizzato"]=0;
                $_SESSION["ospite"]=0;
            }else{
                echo"<center><form action='logout.php'><table>
                        <tr>
                            <td><img src='images/icon.png'></td>
                            <td>{$_SESSION['email']}</td>
                            <td><input type='submit' value='Logout'></td>
                        </tr>
                    </table></form></center>";
            }
        ?>
        
        <div class="container">
            <div class="box">
                <a href="condividi.php">
                    <img src="images/1.jpeg">
                </a>
                <span>Condividi Libri</span>
            </div>
            <div class="box">
                <a href="cerca.php">
                    <img src="images/2.jpeg">
                </a>
                <span>Cerca Libri</span>
            </div>
            <div class="box">
                <?php
                    if(!isset($_SESSION["id"])){
                        echo "<a href='login.html'>
                                <img src='images/handwrite.jpeg'>
                            </a>";
                    }else{
                        echo"<a href='account.php'>
                                <img src='images/handwrite.jpeg'>
                            </a>";
                    }
                ?>
                <span>Account</span>
            </div>
        </div>
    </body>
</html>