<?php

require('config.php');


if (isset($_POST['dateMatch'])) {
   
    $dateMatch = mysqli_real_escape_string($conn, $_POST['dateMatch']);
    
    
    $query = "SELECT r.idReservation, r.dateMatch, r.heureMatch, r.idTerrain, r.idClient 
              FROM RESERVATIONS r
              WHERE r.dateMatch = '$dateMatch' 
              ORDER BY r.heureMatch ASC";
    
    $result = mysqli_query($conn, $query);

  
    if (!$result) {
        die("Erreur dans la requête SQL : " . mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terrains Réservés</title>
    <link rel="stylesheet" href="style/style2.css">
</head>
<body>
    <h1>Liste des terrains réservés</h1>
    
 
    <form action="terrainsreserves.php" method="post">
        <label for="dateMatch">Sélectionnez la date du match :</label>
        <input type="date" id="dateMatch" name="dateMatch" required>
        <input type="submit" value="Voir les réservations">
    </form>

    <?php if (isset($result)): ?>
        <?php if (mysqli_num_rows($result) > 0): ?>
         
            <h2>Liste des terrains réservés pour le <?php echo htmlspecialchars($dateMatch); ?></h2>
            <table border="1">
                <tr>
                    <th>ID Réservation</th>
                    <th>Date du Match</th>
                    <th>Heure du Match</th>
                    <th>ID Terrain</th>
                    <th>ID Client</th>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['idReservation']); ?></td>
                        <td><?php echo htmlspecialchars($row['dateMatch']); ?></td>
                        <td><?php echo htmlspecialchars($row['heureMatch']); ?></td>
                        <td><?php echo htmlspecialchars($row['idTerrain']); ?></td>
                        <td><?php echo htmlspecialchars($row['idClient']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>Aucune réservation trouvée pour cette date.</p>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>
