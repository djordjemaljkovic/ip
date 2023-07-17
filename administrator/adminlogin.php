<?php 

include_once "../dbconnection.php";


if(isset($_POST['logujadmina'])){
    $errors = array();
    $flag = 0;
    if (empty($_POST['korIme']) || empty($_POST['lozinka'])){
        $errors['prazno'] = "Niste popunili sva polja!";
    }else{
        $korIme = $_POST['korIme'];
        $lozinka = $_POST['lozinka'];

        
        $result = mysqli_query($conn, "select * from administratori where ".
                "korIme = '$korIme' and lozinka = '$lozinka'");
       
        if (mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result); //assoc da bismo mogli normalno da
                                                //pristupamo kolonama normalno kao nizu!!!
                session_start();
                $_SESSION['privilegijea']='administrator';
                $_SESSION['administrator']=$row['korIme'];
                $_SESSION['zaduzenje'] = 14;
                $flag = 1;
                echo "<script>window.location.href='admin_index.php'</script>";
                mysqli_free_result($result);
            }
        else {
                $errors['pogresno'] = "Losi kredencijali!";
            }
        } 
        
        mysqli_close($conn);          //uvek se radi!!!
        }

?>

<html>
<head>
    <title>Log in</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">
</head>
<body>
    <div  class="sve">
        <form action="" method="post">
            <?php
                include_once('../errors.php') ?>
                <table  class="sve nav">
                    <th colspan="2">
                    
                        ULOGUJTE SE
                   
                    </th>
                    <tr>
                        <td>
                            &nbsp;
                        </td>
                        <td>
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Korisničko ime :
                        </td>
                        <td>
                            <input type='text' name='korIme' />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Lozinka :
                        </td>
                        <td>
                            <input type='password' name='lozinka' />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            &nbsp;
                        </td>
                        <td>
                            <input class="dugme" type="submit" value="Uloguj se" name="logujadmina"/>
                            <input class="dugme" type="reset" value="Poništi"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            &nbsp;
                        </td>
                        <td>
                            &nbsp;
                        </td>
                    </tr>
                </table>
        </form>
    </div>
</body>
</html>