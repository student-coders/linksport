<?php
require('config.php');

if (isset($_POST['login'] ,$_POST['motpass'])){

	
	
	$email = stripslashes($_POST['login']);
	$email = mysqli_real_escape_string($conn, $email);
	
	$password = stripslashes($_POST['motpass']);
	$password = mysqli_real_escape_string($conn, $password);

   	
	$query = "select*from`CLIENTS` where `login`='$email' and `motPasse`='$password '";

	

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
        <h1>S'login</h1>
        <input type="email" name="login" placeholder="Email" required>
        <input type="password" name="motpass" placeholder="Mot de passe" required>
        <input type="submit" value="S'inscrire" name="submit">
        <p>Déjà inscrit ? <a href="connection.php">Connectez-vous ici</a></p>
    </form>

</body>
</html>