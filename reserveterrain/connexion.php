<?php
require('config.php');

if (isset($_POST['nomClient'], $_POST['telClient'], 
$_POST['typeClient'], $_POST['login'] ,$_POST['motpass'])){

	$username = stripslashes($_POST['nomClient']);
	$username = mysqli_real_escape_string($conn, $username); 
	
	$email = stripslashes($_POST['login']);
	$email = mysqli_real_escape_string($conn, $email);
	
	$password = stripslashes($_POST['motpass']);
	$password = mysqli_real_escape_string($conn, $password);
    $type= stripslashes($_POST['typeClient']);
	$type = mysqli_real_escape_string($conn, $type);
    $tel = stripslashes($_POST['telClient']);
	$tel= mysqli_real_escape_string($conn, $tel);
   	
	$query = "INSERT INTO `CLIENTS`(`nomClient`, `typeClient`, `telClient`, `login`, `motPasse`)
     VALUES ('$username',' $type',' $tel','$email','$password')";

	

if (mysqli_query($conn, $query)){
echo"mzn";
}else{
    echo "madaztch" . mysqli_error($conn);
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="" method="POST">
        <h1>S'inscrire</h1>
        <input type="text" name="nomClient" placeholder="Nom d'utilisateur" required>
        <input type="number" name="telClient" placeholder="Telephone" required>
        <select name="typeClient" id="">
            <option value="0">Entreprise ou Etablissement</option>
            <option value="1">Group de particuliers</option>
        </select>
        <input type="email" name="login" placeholder="Email" required>
        <input type="password" name="motpass" placeholder="Mot de passe" required>
        <input type="submit" value="S'inscrire" name="submit">
        <p>Déjà inscrit ? <a href="connection.php">Connectez-vous ici</a></p>
    </form>

</body>
</html>