<?php
session_start();
$title = "Ajouter un produit";
ob_start();
$contenu = ob_get_clean();
require_once('template.php');
?>

<!-- Forumulaire d'ajout au panier -->
<main>
    <form class="add-product" action="traitement.php?action=add" method="post">
        <h1>Ajouter un produit</h1>
        <p>
            <label>
                Nom du produit :
                <input type="text" name="name">
            </label>
        </p>
        <p>
            <label>
                Prix du produit :
                <input type="number" step="any" name="price">
            </label>
        </p>
        <p>
            <label>
                Quantité désirée :
                <input type="number" name="qtt" value="1">
            </label>
        </p>
        <p class="submit">
            <input class="button" type="submit" name="submit" value="Ajouter le produit">
        </p>
    </form>

    <aside>
        <div class="products">
            <?php
            // Affiche le nombre de produits en session
            $total = 0; // Initialiser le total
            if (isset($_SESSION['products']) && !empty($_SESSION['products'])) { // Si la session existe et n'est pas vide
                foreach ($_SESSION['products'] as $index => $product) // Parcourir les produits en session
                    $total += $product['qtt']; // Ajouter la quantité du produit au total
            }
            echo "<h2>Produits en session : " . $total . "</h2>"; // Afficher le nombre de produits en session (total)

            if (isset($_SESSION['message']) && !empty($_SESSION['message'])) { // Si la session existe et n'est pas vide
                echo '<p class="message" style="color:#007bff;">' . $_SESSION['message'][0] . '</p>'; // Afficher le message (premier élément du tableau)
                $_SESSION['message'] = []; // Vider le message
            }
            ?>
        </div>
    </aside>
</main>
</body>

</html>