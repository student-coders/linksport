<?php
include 'config.php'; // Inclusion du fichier de connexion

// Requête pour obtenir les terrains en entretien ou hors service
$query = "SELECT idTerrain, etat FROM TERRAINS WHERE etat IN (1, 2)";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn)); // Error handling
}

if (mysqli_num_rows($result) > 0) {
    echo "<h2>Liste des terrains en entretien ou hors service</h2>";
    echo "<table border='1'>
    <tr>
    <th scope='col'>ID Terrain</th>
    <th scope='col'>État</th>
    </tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
        <td>" . $row['idTerrain'] . "</td>
        <td>" . ($row['etat'] == 1 ? 'En entretien' : 'Hors service') . "</td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "Aucun terrain en entretien ou hors service.";
}

mysqli_close($conn); // Fermeture de la connexion
?>
