<?php
// Démarrer la session
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Récapitulatif des produits</title>
</head>

<body>
    <?php var_dump($_SESSION); ?>

    <?php
    // Si la session est vide ou n'existe pas
    if (isset($_SESSION['products']) || !empty($_SESSION['products'])) {
        echo "<p>Aucun produit en session...</p>";
    }
    // Sinon
    else {
        echo "<table>",
        "<thead>",
        "<tr>",
        "<th>#</th>",
        "<th>Nom</th>",
        "<th>Prix</th>",
        "<th>Quantité</th>",
        "<th>Total</th>",
        "</tr>",
        "</thead>",
        "<tbody>";

        // Parcourir les produits en session
        foreach ($_SESSION['products'] as $index => $product) {
        }
        echo "</tbody>",
        "</table>";
    }
    ?>
</body>

</html>