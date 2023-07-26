<?php
session_start();
ob_start();
?>


<header>
    <a class="logo" href="index.php">
        APPLI PHP
    </a>
    <nav class="navigation">
        <ul>
            <a href="index.php">
                <li>AJOUT PRODUITS</li>
            </a>
            <a href="recap.php">
                <li>PANIER</li>
            </a>
        </ul>
    </nav>
</header>
<?php
// Si la session est vide ou n'existe pas
if (!isset($_SESSION['products']) || empty($_SESSION['products'])) {
    echo "<p class='message'>Aucun produit en session...</p>";
}
// Sinon
else { // Afficher le tableau récapitulatif
    echo "<table class='product-table'>",
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
    foreach ($_SESSION["products"] as $index => $product) { // Parcourir les produits en session
        echo "<tr>",
        "<td>" . $index . "</td>", // Affiche l'index du produit

        // Affiche le nom du produit
        "<td>" . $product["name"] . "</td>",

        // Affiche le prix du produit avec 2 chiffres après la virgule
        "<td>" . number_format($product["price"], 2, ",", "&nbsp;") . "&nbsp;€</td>",

        // Affiche la quantité de produit et bouton + et -
        "<td>
                <div class='container'>
                    <form class='form-up-down' action='traitement.php?action=up-qtt' method='post'>
                        <input class='inp-up-down' type='hidden' name='up-qtt' value='$index'>
                        <button class='btn-up-qtt' type='submit'>+</button>
                    </form>"

            . $product["qtt"] . // Affiche la quantité du produit

            // Bouton moins (diminuer la quantité)
            "<form class='form-up-down' action='traitement.php?action=down-qtt' method='post'>
                        <input class='inp-up-down' type='hidden' name='down-qtt' value='$index'>
                        <button class='btn-down-qtt' type='submit'>-</button>
                    </form>
                </div>
            </td>",

        // Affiche le total du produit avec 2 chiffres après la virgule
        "<td>" . number_format($product["total"], 2, ",", "&nbsp;") . "&nbsp;€</td>";

        // Bouton Supprimer le produit en session
        echo "<td>
                <form class='form-delete' method='POST' action='traitement.php?action=delete'>
                    <input class='inp-delete' type='hidden' name='delete' value='$index'>
                    <button class='btn-delete' type='submit'>X</button>
                </form>
            </td>",
        "</tr>";
        // Calculer le total général
        $totalGeneral += $product["total"];
    }
    // Afficher le total général
    echo "<tr>",
    "<td colspan=4 class='total-label'>Total général : </td>",
    "<td class='total-value'><strong>" . number_format($totalGeneral, 2, ",", "&nbsp;") . "&nbsp;€</strong></td>",
    "</tr>",
    "</tbody>",
    "</table>";

    // Bouton Supprimer tout le contenu
    echo "<form class='form-delete' action='traitement.php?action=clear' method='post'>
    <input class='button' type='submit' name='clear' value='Supprimer le contenu'>
</form>";
}
?>

</main>
<aside>
    <div class="products">
        <?php
        // Afficher le nombre de produits en session
        $total = 0; // Initialiser le total
        if (isset($_SESSION['products']) && !empty($_SESSION['products'])) { // Si le tableau existe et n'est pas vide
            foreach ($_SESSION['products'] as $index => $product) // Parcourir les produits en session
                $total += $product['qtt']; // Ajouter la quantité du produit au total
        }
        echo "<h2>Produits en session : " . $total . "</h2>";

        if (isset($_SESSION['message']) && !empty($_SESSION['message'])) { // Si le message existe et n'est pas vide
            echo '<p class="message" style="color:#007bff;">' . $_SESSION['message'][0] . '</p>'; // Afficher le message
            $_SESSION['message'] = []; // Vider le message
        }
        ?>
    </div>
</aside>
<?php
$content = ob_get_clean();
$title = "Panier";
require_once('template.php');
