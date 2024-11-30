<!DOCTYPE html>
<html lang="en">
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

        // Récupérer l'année à partir des paramètres GET
        $annee = isset($_GET['annee']) ? intval($_GET['annee']) : date("Y");

        // Requête pour obtenir le chiffre d'affaires par terrain
        $sql = "
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
                YEAR(R.dateMatch) = ?
            GROUP BY 
                T.idTerrain, TA.categorie
        ";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $annee);
        $stmt->execute();
        $result = $stmt->get_result();

        $chiffre_affaires_global = 0;

        // Affichage des résultats
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['idTerrain'] . "</td>";
            echo "<td>" . $row['categorie'] . "</td>";
            echo "<td>" . number_format($row['chiffre_affaires'], 2, ',', ' ') . " €</td>";
            echo "</tr>";

            // Accumuler le chiffre d'affaires global
            $chiffre_affaires_global += $row['chiffre_affaires'];
        }

        // Affichage du chiffre d'affaires global
        echo "<tr>";
        echo "<td colspan='2'><strong>Chiffre d'Affaires Global</strong></td>";
        echo "<td><strong>" . number_format($chiffre_affaires_global, 2, ',', ' ') . " €</strong></td>";
        echo "</tr>";

        $stmt->close();
        $conn->close();
        ?>
    </table>
</body>
</html>