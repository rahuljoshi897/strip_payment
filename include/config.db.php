<?PHP
include_once("config.db.custom.php");

##
function getMYSQLIConnection($db = null)
{
    if ($db != null)
        return $db;
    $conn = new mysqli('p:'.DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    $conn->set_charset("utf8");
    if ($conn->connect_error)
        error_log('Database connection failed: ' . $conn->connect_error.';'. E_USER_ERROR);
    return $conn;
}