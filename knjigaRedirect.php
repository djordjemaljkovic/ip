<?php 
    session_start();
    
    if(isset($_POST['slikadugme_x']) && (!empty($_SESSION['citalac']) || !empty($_SESSION['moderator']))){
        if(!empty($_SESSION['citalac'])){$zaduzenik = $_SESSION['citalac'];}
        if(!empty($_SESSION['moderator'])){$zaduzenik = $_SESSION['moderator'];}
        $id = $_POST['knjiga'];
        setCookie('idKnjige', $id);
        header('location:knjiga.php');
    }else{
        echo "<span style='color:red'>Da biste videli podatke o knjizi morate biti regisrovani!</span>";
        echo "<br>";
        echo "<a href='register.php'> -> forma za registraciju <- </a>";
    }
    
    
?>