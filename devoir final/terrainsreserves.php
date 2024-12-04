<?php
require('config.php');

// Partie réservation
if (isset($_POST['reserve'])) {
    // Récupération des données envoyées via POST
    $dateMatch = mysqli_real_escape_string($conn, $_POST['dateMatch']);
    $heureMatch = mysqli_real_escape_string($conn, $_POST['heureMatch']);
    $heureFin = mysqli_real_escape_string($conn, $_POST['heureFin']);
    $idTerrain = isset($_POST['idTerrain']) ? mysqli_real_escape_string($conn, $_POST['idTerrain']) : 1; // Par défaut, Terrain 1
    $idClient = 1; // Par défaut, un client avec id 1

    // Vérifier si l'heure du match est avant minuit (12:00 AM)
    if (strtotime($heureMatch) == strtotime('00:00:00')) {
        echo "<p>Il n'est pas possible de réserver un terrain à partir de minuit.</p>";
        exit; 
    }

    // Calcul de la durée en heures
    $heureMatchObj = new DateTime($dateMatch . ' ' . $heureMatch);
    $heureFinObj = new DateTime($dateMatch . ' ' . $heureFin);

    // Si l'heure de fin est avant l'heure de début, ajouter un jour à l'heure de fin
    if ($heureFinObj < $heureMatchObj) {
        $heureFinObj->modify('+1 day');
    }

    // Calcul de la différence entre les deux heures
    $interval = $heureMatchObj->diff($heureFinObj);

    // Calcul total de la durée en heures et minutes
    $duration = $interval->h + ($interval->days * 24); // heures + jours convertis en heures
    if ($interval->i > 0) {
        $duration += $interval->i / 60; // Ajoute les minutes fractionnées en heures
    }

    // Afficher la durée totale calculée avant l'insertion
    // Si la durée en minutes est égale à zéro, n'afficher que les heures
    $displayDuration = $interval->i == 0 ? $duration : $duration . " heure(s) " . $interval->i . " minute(s)";

    echo "Durée totale: " . $displayDuration;

    // Insertion dans la base de données
    $insertQuery = "INSERT INTO RESERVATIONS (dateMatch, heureMatch, idTerrain, duration, idClient, heureFin)
                    VALUES ('$dateMatch', '$heureMatch', '$idTerrain', '$duration', '$idClient', '$heureFin')";

     // Exécution de la requête
     if (mysqli_query($conn, $insertQuery)) {
        echo "<p>Réservation effectuée avec succès pour le $dateMatch à $heureMatch.</p>";
    } else {
        echo "<p>Erreur dans la réservation : " . mysqli_error($conn) . "</p>";
    }
}

// Partie pour savoir les réservations
if (isset($_POST['dateMatch']) && !empty($_POST['dateMatch'])) {
    $dateMatch = mysqli_real_escape_string($conn, $_POST['dateMatch']);
    $heureMatch = isset($_POST['heureMatch']) ? mysqli_real_escape_string($conn, $_POST['heureMatch']) : '';

    // Construction de la requête SQL
    $query = "SELECT idReservation, dateMatch, heureMatch, idTerrain, duration, heureFin, idClient
              FROM RESERVATIONS
              WHERE dateMatch = '$dateMatch'"; // Filtre par date
// Filtrage par heure si spécifiée
if ($heureMatch != '') {
    $query .= " AND heureMatch = '$heureMatch'";
}

$query .= " ORDER BY heureMatch ASC";

// Exécution de la requête
$result = mysqli_query($conn, $query);


      // Exécution de la requête
      if (mysqli_query($conn, $insertQuery)) {
        echo "<p>Réservation effectuée avec succès pour le $dateMatch à $heureMatch.</p>";
    } else {
        echo "<p>Erreur dans la réservation : " . mysqli_error($conn) . "</p>";
    }
}


?>




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terrains Réservés</title>
    <link rel="stylesheet" href="styles/sty5.css">
</head>
<body>
<style>
  .hidden {
  display: none;
}

.visible {
  display: block; 
}
</style>


<!---------formulaire----------------->
<section class="main-reservation visible" id="reservationList">
        <h1>Liste des terrains réservés</h1>

            <form action="terrainsreserves.php" method="post">
                <label for="dateMatch">Sélectionnez la date et heure du match :</label>
                <input type="date" id="dateMatch" name="dateMatch" required>
                <input type="time" id="heureMatch" name="heureMatch">
                <input type="submit" value="Voir les réservations">
                <button type="button" onclick="switchToForm()">Faire une réservation</button>
                
            </form>

            <!-- Affichage des réservations sous forme de tableau -->
            <?php if (isset($result)): ?>
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <div class="printable-table" id="printableTable">
                        <h2>Liste des terrains réservés pour le <?php echo htmlspecialchars($dateMatch); ?></h2>
                        <table border="1">
                            <tr>
                                <th>ID Réservation</th>
                                <th>Date du Match</th>
                                <th>Heure du Match</th>
                                <th>Fin du Match</th>
                                <th>Durée</th>
                                <th>ID Terrain</th>
                            </tr>
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                <?php
                                // Conversion de l'heure en format 24h
                                $formattedHour = date('H:i', strtotime($row['heureMatch']));
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['idReservation']); ?></td>
                                    <td><?php echo htmlspecialchars($row['dateMatch']); ?></td>
                                    <td><?php echo htmlspecialchars($formattedHour); ?></td>
                                    <td><?php echo htmlspecialchars($row['heureFin']); ?></td>
                                    <td><?php echo htmlspecialchars($row['duration']); ?> heure(s)</td>
                                    <td><?php echo htmlspecialchars($row['idTerrain']); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </table>
                        <button type="button" onclick="printTable()">Imprimer les réservations</button>
                    </div>
                <?php else: ?>
                    <p>Aucune réservation trouvée pour cette date.</p>
                <?php endif; ?>
            <?php endif; ?>
</section>
          <section class="main-reservation hidden" id="reservationForm">
            <h1>Effectuer une réservation</h1>
            <form action="terrainsreserves.php" method="post">
           
                <label for="dateMatch">Sélectionnez la date de votre réservation :</label>
                <input type="date" id="dateMatch" name="dateMatch" required>

                <label for="heureMatch">Sélectionnez l'heure :</label>
                <input type="time" id="heureMatch" name="heureMatch" required>

                <label for="idTerrain">Sélectionnez l'ID du terrain :</label>
                <select name="idTerrain" id="idTerrain" required>
                    <option value="1">Terrain 1</option>
                    <option value="2">Terrain 2</option>
                </select>

                <label for="heureFin">Heure de fin du match :</label>
                <input type="time" id="heureFin" name="heureFin" required>
               
            
                <input type="submit" name="reserve" value="Réserver">
                <button type="button" onclick="switchToList()">Retour à la liste</button>
          
            </div>
            </form>
          </section>

    <script>
       function switchToForm() {
                document.getElementById('reservationList').classList.remove('visible');
                document.getElementById('reservationList').classList.add('hidden');
                document.getElementById('reservationForm').classList.remove('hidden');
                document.getElementById('reservationForm').classList.add('visible');
            }

            function switchToList() {
                document.getElementById('reservationForm').classList.remove('visible');
                document.getElementById('reservationForm').classList.add('hidden');
                document.getElementById('reservationList').classList.remove('hidden');
                document.getElementById('reservationList').classList.add('visible');
            }

            function printTable() {
                window.print(); 
            }
            function printTable() {
                var printContent = document.getElementById('printableTable'); 
                
                
                var printWindow = window.open('', '', 'height=500, width=800');
                printWindow.document.write('<html><head><title>Impression</title></head><body>');
                printWindow.document.write(printContent.innerHTML); 
                printWindow.document.write('</body></html>');
                printWindow.document.close(); 
                printWindow.print(); 
            }


    </script>
</body>
</html>



</body>
</html>
