<?php
// Démarrer la session
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.recap.css">
    <title>Récapitulatif des produits</title>
</head>

<body>
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
        $totalGeneral = 0;
        foreach ($_SESSION['products'] as $index => $product) {
            echo "<tr>",
            "<td>" . $index . "</td>",
            "<td>" . $product['name'] . "</td>",
            "<td>" . number_format($product['price'], 2, ",", "$nbsp;") . "$nbsp;€</td>",
            "<td>" . $product['qtt'] . "</td>",
            "<td>" . number_format($product['total'], 2, ",", "$nbsp;") . "$nbsp;€</td>",
            "</tr>";
            $totalGeneral += $product['total'];
        }
        // Afficher le total général
        echo "<tr>",
        "<td colspan='4'>Total général</td>",
        "<td><strong>" . number_format($totalGeneral, 2, ",", "$nbsp;") . "$nbsp;€</strong></td>",
        "</tr>",
        "</tbody>",
        "</table>";
    }
    ?>
</body>

</html>