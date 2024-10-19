<?php
// Database connection parameters as constants
define('DB_HOST', 'localhost');
define('DB_NAME', 'candyCrush');
define('DB_USER', 'root');
define('DB_PASS', 'Ajit@1997');

try {
    // Function to create a PDO connection
    function createPDOConnection($host, $username, $password) {
        $pdo = new PDO("mysql:host=$host", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    // connection to the server
    $pdo = createPDOConnection(DB_HOST, DB_USER, DB_PASS);

    // Creating the candyCrush database if it doesn't exist
    $pdo->exec("CREATE DATABASE IF NOT EXISTS " . DB_NAME);

    // Connecting to database
    $pdo = createPDOConnection(DB_HOST, DB_USER, DB_PASS);
    $pdo->exec("USE " . DB_NAME);

    // Function to create the candies table
    function createCandiesTable($pdo) {
        $createTableQuery = "
            CREATE TABLE IF NOT EXISTS candies (
                CandyID INT AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier
                CandyName VARCHAR(255) NOT NULL,  -- Name of the candy
                CandyType VARCHAR(100),  -- Type of candy (e.g., gummy, chocolate)
                StockAvailable INT NOT NULL,  -- Available stock quantity
                PricePerUnit DECIMAL(8, 2) NOT NULL  -- Price per candy unit
            )";
        $pdo->exec($createTableQuery);
    }

    // Creating the candies table
    createCandiesTable($pdo);

} catch (PDOException $e) {
    die("Error establishing database connection: " . $e->getMessage());
}
?>  
