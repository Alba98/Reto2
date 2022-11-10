<?php
/**
 *
 *
 * @author    GRUPO 1 <wat2022.wordpress.com>
 * @version   2022-11-22
 * 
 * 
*/

function connect(){
    $dbname = "reto2";
    $host = "db";
    $username = "root";
    $pass = "db123";

    try {
        # MySQL
        $dbh= new PDO("mysql:host=$host;dbname=$dbname", $username, $pass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbh;
    }
    catch(PDOException $e) {
        echo $e->getMessage();
        return null;
    }
}
