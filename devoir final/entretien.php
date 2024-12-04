<?php
include 'config.php'; 

$query = "SELECT idTerrain, etat FROM TERRAINS WHERE etat IN (1, 2)";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    echo "<h2>Liste des terrains en entretien ou hors service</h2>";
    echo "<table class='styled-table'>
            <thead>
                <tr>
                    <th>ID Terrain</th>
                    <th>État</th>
                </tr>
            </thead>
            <tbody>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>" . $row['idTerrain'] . "</td>
                <td>" . ($row['etat'] == 1 ? 'En entretien' : 'Hors service') . "</td>
              </tr>";
    }
    echo "</tbody>
        </table>";
} else {
    echo "<p>Aucun terrain en entretien ou hors service.</p>";
}

mysqli_close($conn); 
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
    <style>
body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fa;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #3e3e3e;
            margin-bottom: 20px;
        }

        .styled-table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .styled-table thead {
            background-color: #009879;
            color: white;
            text-align: left;
        }

        .styled-table th, .styled-table td {
            padding: 12px 15px;
            text-align: left;
        }

        .styled-table tbody tr {
            border-bottom: 1px solid #ddd;
        }

        .styled-table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .styled-table td {
            font-size: 14px;
        }

        p {
            text-align: center;
            font-size: 16px;
            color: #777;
        }
    </style>
</body>
</html>
