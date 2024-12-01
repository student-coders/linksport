<?php
require('config.php');

if (isset($_POST['login'] ,$_POST['motpass'])){

	
	
	$email = stripslashes($_POST['login']);
	$email = mysqli_real_escape_string($conn, $email);
	
	$password = stripslashes($_POST['motpass']);
	$password = mysqli_real_escape_string($conn, $password);

   	
	$query = "select*from`CLIENTS` where `login`='$email' and `motPasse`='$password '";

	

if (mysqli_query($conn, $query)){
    header("Location: terrainsreserves.php");
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
     <title>Login</title>
    <link rel="stylesheet" href="styles/style0.css">
</head>
<body>
<div class="container">
    <div class="forms-container">
      <div class="signin-signup">
        <form action="" method="POST" class="sign-in-form">
          <h2 class="title">Login</h2>
        <input type="email" name="login" placeholder="Email" required>
        <input type="password" name="motpass" placeholder="Mot de passe" required>
        <input type="submit" value="S'inscrire" name="submit" class="btn">


        <p>Déjà inscrit ? <a href="registre.php">Connectez-vous ici</a></p>
        <p class="social-text">Ou Connectez-vous avec les plateformes sociales</p>
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
        <div class="content">
          <h3>Nouveau ici ?</h3>
          <p>
          Rejoignez-nous aujourd'hui et découvrez des opportunités incroyables qui 
          vous sont spécialement destinées !
          </p>
          <a href="registre.php" class="btn transparent" id="sign-in-btn" style="padding:10px 20px;text-decoration:none">
          S'inscrire
          </a>
        </div>
        <img src="img/log.svg" class="image" alt="" />
      </div>
    </div>
  </div>

  <script src="js/app.js"></script>
</body>

</html>
</body>
</html>