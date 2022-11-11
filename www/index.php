<?php require('VIEWS/PARTIALS/header.php') ?>
<?php  
        echo "<h1>¡Hola, Bienvenido!</h1>";

        $servername = "db";
        $username = "root";
        $password = "db123";
        $dbname = "reto2";
    
    try{
        $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
        $conn -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        echo "Connected succesfully";
    } catch(PDOException $e){
        echo "Connection failed: " . $e -> getMessage();
    }
?>
<?php require('VIEWS/PARTIALS/footer.php') ?>