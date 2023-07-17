<?php
            
            
            if(isset($_POST['postavi'])){
                session_start();
                $zaduzenje = $_POST['zaduzenje'];
                $_SESSION['zaduzenje'] = $zaduzenje;
            }
            
            
        ?>
            <a href="admin_zaduzenje.php" >NAZAD</a>

