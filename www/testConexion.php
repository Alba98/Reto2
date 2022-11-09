<html>
    <head>
        <title>Welcome to LAMP Infrastructure</title>
        <meta charset="utf-8">
       
    </head>
    <body>
        <div class="container-fluid">
            <?php  
                    echo "<h1>¡Hola, Bienvenida!</h1>";

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
        </div>
    </body>
</html>
