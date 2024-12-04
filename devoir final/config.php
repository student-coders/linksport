
<?php
/*define('DB_SERVER', 'localhost');
define('DB_USER','sofia_user');
define('DB_PASSWORD','LS95soZe');
define('DB_NAME','sofia');

$conn = new mysqli(DB_SERVER,DB_USER,DB_PASSWORD, DB_NAME);

if($conn === false){
    die("ERREUR : Impossible de se connecter. " . mysqli_connect_error());
}*/

$conn = mysqli_connect("localhost", "sofia_user", "LS95soZe", "Sofia");

if (!$conn) {
    die("Échec de la connexion : " . mysqli_connect_error());
}
?>





