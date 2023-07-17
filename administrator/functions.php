<?php 

include_once('connection.php');
include_once('../loginfajl.php');
#session_start();
$errors = array();

function isAdmin(){
	if ($_SESSION['privilegije']=='admin' ) {
		return true;
	}else{
		return false;
	}
}

function isLoggedIn(){
	if ($_SESSION['privilegije']=='admin'|| $_SESSION['privilegije']=='moderator'|| $_SESSION['privilegije']=='citalac') {
		return true;
	}else{
		return false;
	}
    }
    

    
function getUserById($korIme){
    $query = "SELECT * FROM citaoci WHERE korIme=" . $korIme;
    $result = mysqli_query($conn, $query);

    $user = mysqli_fetch_assoc($result);
    return $user;
}
     


if(isset($_POST['login'])){
        $korIme = $_POST['korIme'];
        $lozinka = $_POST['lozinka'];
        if(empty($korIme)){
            $errors['korIme'] = "Polje za korisnicko ime je prazno!";
        }
        if(empty($lozinka)){
            $errors['lozinka']= "Polje za lozinku je prazno!";
        }
        if(count($errors)==0){
            $lozinka = md5($lozinka);
            $query2 = "SELECT * FROM administrator WHERE korIme='$korIme' AND lozinka='$lozinka'";
            $result2 = mysqli_query($conn, $query2);
            if(mysqli_num_rows($result2)==1){
                $_SESSION['korIme'] = $korIme;
                $_SESSION['success'] = "Uspesno ste ulogovani u sistem biblioteke!";
                header('location: validate.php');
            } else {
                array_push($errors, "Korisnicko ime i/ili sifra nisu pravilno uneti");
                header('location: adminlogin.php');
            }
        }
    }
    

if(isset($_POST['approve'])){
    $korIme = $_POST['korIme'];
    $lozinka = $_POST['lozinka'];
    $potvrda = $_POST['lozinkaPotvrda'];
    $imePrezime = $_POST['imePrezime'];
    $adresa = $_POST['adresa'];
    $telefon = $_POST['telefon'];
    $imejl = $_POST['imejl'];
    #$slika = $_POST['slika'];

    $approving = "INSERT INTO citaoci (korIme,lozinka,imePrezime,adresa,telefon,imejl) VALUES ('$korIme','$enkriptLoz','$imePrezime','$adresa','$telefon','$imejl')";
    $result = mysqli_query($conn, $approving);
    $_SESSION['approved'] = 'Citalac je uspesno prihvacen';
    
    echo '<script type = "text/javascript">';
    echo 'alert("Korisnik je uspesno dodat u citaoce");';
    echo 'window.location.href = "validate.php"';
    echo '</script>';
}

if(isset($_POST['refresh']) && isset($_POST['approve'])){
    header('location: citalac/pocetna.php');
}


if(isAdmin() && isset($_POST['citalac'])){
    $korIme = $_POST['korIme'];
    $lozinka = $_POST['lozinka'];
    $imePrezime = $_POST['imePrezime'];
    $adresa = $_POST['adresa'];
    $telefon = $_POST['telefon'];
    $imejl = $_POST['imejl'];
    if(isset($_POST['slika']))
    {
    $slika = $_POST['slika'];
    }
    else {
        $slika= "default_user.jpg";
    }
    
    $opcije = ['cost' => 10];
    $sifrovanaLozinka = password_hash($lozinka, PASSWORD_DEFAULT, $opcije);
    
    $sql = "INSERT INTO citalac (korIme,lozinka,imePrezime,adresa,telefon,imejl,slika) VALUES ('$korIme','$sifrovanaLozinka','$imePrezime','$adresa','$telefon','$imejl','$slika');";
    
    $delete = "DELETE FROM pomocna WHERE korIme = $korIme;";
    
    if($conn->query($sql)==TRUE && $conn->query($delete)==TRUE){
        header("Location:admin_meni.php"); echo "0";
    }else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    #$conn->close();
}

if(isAdmin() && isset($_POST['moderator'])){
    $korIme = $_POST['korIme'];
    $lozinka = $_POST['lozinka'];
    $imePrezime = $_POST['imePrezime'];
    $adresa = $_POST['adresa'];
    $telefon = $_POST['telefon'];
    $imejl = $_POST['imejl'];
    if(isset($_POST['slika']))
    {
    $slika = $_POST['slika'];
    }
    else {
        $slika= "default_user.jpg";
    }
    
    $opcije = ['cost' => 10];
    $sifrovanaLozinka = password_hash($lozinka, PASSWORD_DEFAULT, $opcije);
    
    $sql = "INSERT INTO moderator (korIme,lozinka,imePrezime,adresa,telefon,imejl,slika) VALUES ('$korIme','$sifrovanaLozinka','$imePrezime','$adresa','$telefon','$imejl','$slika');";
    
    $delete = "DELETE FROM pomocna WHERE korIme = $korIme;";
    
    if($conn->query($sql)==TRUE && $conn->query($delete)==TRUE){
        header("Location:admin_meni.php"); echo "0";
    }else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    #$conn->close();
}



