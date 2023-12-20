<?php
session_start();
// Function to establish a database connection
function connectToDatabase($host, $username, $password, $database)
{
    $conn = mysqli_connect($host, $username, $password, $database);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    return $conn;
}

// Function to get a list of tables in the database
function getTables($conn)
{
    $tables = array();

    $result = mysqli_query($conn, "SHOW TABLES");

    if ($result) {
        while ($row = mysqli_fetch_row($result)) {
            $tables[] = $row[0];
        }

        mysqli_free_result($result);
    }

    return $tables;
}

// Function to get the fields and data types of a table
function getTableFields($conn, $table)
{
    $fields = array();

    $result = mysqli_query($conn, "DESCRIBE $table");

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $fields[] = array(
                'Field' => $row['Field'],
                'Type' => $row['Type'],
            );
        }

        mysqli_free_result($result);
    }

    return $fields;
}

// Function to generate a file with table and field information
function generateFile($filename, $tablesData)
{
    $content = json_encode($tablesData, JSON_PRETTY_PRINT);

    file_put_contents($filename, $content);

    $_SESSION['message'] = "File $filename generated successfully";
    header("Location: index.php");
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = $_POST["host"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $database = $_POST["database"];

    // Connect to the database
    $conn = connectToDatabase($host, $username, $password, $database);

    // Get list of tables
    $tables = getTables($conn);

    // Get table fields with data types for each table
    $tablesData = array();

    foreach ($tables as $table) {
        $fields = getTableFields($conn, $table);
        $tablesData[$table] = $fields;
    }

    // Generate a file with table and field information
    $filename = "$database.json" ;
    generateFile($filename, $tablesData);

    // Close the database connection
    mysqli_close($conn);
}
?>