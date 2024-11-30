<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rendement des Terrains</title>
</head>
<body>
    <h1>Chiffre d'Affaires des Terrains</h1>

    <form method="GET" action="">
        <label for="annee">Choisir l'année:</label>
        <input type="number" id="annee" name="annee" value="<?php echo date("Y"); ?>" required>
        <input type="submit" value="Afficher">
    </form>

    <table border="2" width="100%">
        <tr>
            <th>Numéro de Terrain</th>
            <th>Catégorie de Terrain</th>
            <th>Chiffre d'Affaires</th>
        </tr>

        <?php
        require 'config.php';
        $chiffre_affaires_global = 0; // Initialize the variable here
        if (isset($_GET['annee'])) {
            // Récupérer l'année à partir des paramètres GET
            $annee = intval($_GET['annee']);
        
            // Requête pour obtenir le chiffre d'affaires par terrain
            $requete = "
                SELECT 
                    T.idTerrain, 
                    TA.categorie, 
                    SUM(TA.prix) AS chiffre_affaires
                FROM 
                    RESERVATIONS R
                JOIN 
                    TERRAINS T ON R.idTerrain = T.idTerrain
                JOIN 
                    TARIFS TA ON T.idTarif = TA.idTarif
                WHERE 
                    YEAR(R.dateMatch) = $annee
                GROUP BY 
                    T.idTerrain, TA.categorie
            ";

            // Exécuter la requête
            $query = mysqli_query($conn, $requete);
        
            // Affichage des résultats
            while ($row = mysqli_fetch_assoc($query)) {
                echo "<tr>";
                echo "<td>" . ($row['idTerrain']) . "</td>";
                echo "<td>" . ($row['categorie']) . "</td>";
                echo "<td>" . number_format($row['chiffre_affaires'], 2, ',', ' ') . " €</td>";
                echo "</tr>";

                // Accumuler le chiffre d'affaires global
                $chiffre_affaires_global += $row['chiffre_affaires'];
            }
        } 
        
        // Affichage du chiffre d'affaires global
        echo "<tr>";
        echo "<td colspan='2'><strong>Chiffre d'Affaires Global</strong></td>";
        echo "<td><strong>" . number_format($chiffre_affaires_global, 2, ',', ' ') . " €</strong></td>";
        echo "</tr>";
        ?>
    </table>
</body>
</html>
