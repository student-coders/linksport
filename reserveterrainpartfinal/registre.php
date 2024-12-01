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
    header("Location: authentification.php");
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
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <title>Register</title>
    <link rel="stylesheet" href="styles/style0.css">
    
</head>
<body>
   
<div class="container sign-up-mode">
    <div class="forms-container">
        <div class="signin-signup">
            <form action="" method="POST" class="sign-up-form">
                <h2 class="title">S'inscrire</h2>
                <input type="text" name="nomClient" placeholder="Nom d'utilisateur" required>
                <input type="number" name="telClient" placeholder="Téléphone" required>
                <select name="typeClient" required>
                    <option value="0">Entreprise ou Établissement</option>
                    <option value="1">Groupe de particuliers</option>
                </select>
                <input type="email" name="login" placeholder="Email" required>
                <input type="password" name="motpass" placeholder="Mot de passe" required>
                <input type="submit" value="S'inscrire" name="submit" class="btn">
                <p class="social-text">Ou Inscrivez-vous sur les plateformes sociales</p>
                <div class="social-media">
                    <a href="#" class="social-icon">
                        <i class="fab fa-facebook-f"></i> 
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-twitter"></i> 
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-linkedin-in"></i> 
                    </a>
                </div>
            </form>
        </div>
    </div>
    <div class="panels-container">
        <div class="panel left-panel">
        </div>
        <div class="panel right-panel">
            <div class="content">
                <h3>L'un de nous ?</h3>
                <p>Rejoignez notre communauté et accédez à des opportunités uniques pour booster votre carrière !</p>
                <a href="authentification.php" class="btn transparent" id="sign-in-btn" style="padding:10px 20px;text-decoration:none">Se connecter</a>
            </div>
            <img src="img/register.svg" class="image" alt="" />
        </div>
    </div>
</div>



<script src="js/app.js"></script>
</body>
</html>
