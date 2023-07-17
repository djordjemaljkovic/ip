 <?php
    
    $conn = mysqli_connect('localhost:3309', 'root', "", 'biblioteka');
    
    if(!$conn){
        die("Connection failed: ".mysqli_connect_error());
    }
?>