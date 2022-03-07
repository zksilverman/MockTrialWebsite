<!-- Connecting -->
<?php
$databaseName = 'ZSILVERM_labs';
$dsn = 'mysql:host=webdb.uvm.edu;dbname=' . $databaseName;
$username = 'zsilverm_writer';
$password = 'rcVv7bOuGwIp';

$pdo = new PDO($dsn, $username, $password);
?>
<!-- Connection complete -->
