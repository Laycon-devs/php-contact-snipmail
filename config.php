<?php

define("SERVERNAME", "localhost");
define("DBNAME", "snipmail");
define("DBUSERNAME", "root");
define("DBPASSWORD", "");

try {
    $connection = new PDO("mysql:host=" . SERVERNAME . ";dbname=" . DBNAME, DBUSERNAME, DBPASSWORD);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "CONNECTED SUCCESSFULLY";
} catch (PDOException $e) {
    echo "CONNECTION FAILED" . $e->getMessage();
}


