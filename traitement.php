<?php
// Démarrer la session
session_start();
// var_dump($_POST);

$action = $_GET['action']; // Récupérer l'action dans l'URL
switch ($action) {
        // Ajouter un produit
    case "add":
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS); // Filtre le nom du produit (caractères spéciaux)
        $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION); // Filtre le prix du produit (nombre à virgule)
        $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT); // Filtre la quantité du produit (entier)

        // Si le nom, le prix et la quantité sont valides
        if ($name && $price && $qtt) {
            $product = [
                "name" => $name, // Ajouter le nom du produit dans le tableau
                "price" => $price, // Ajouter le prix du produit dans le tableau
                "qtt" => $qtt, // Ajouter la quantité du produit dans le tableau
                "total" => $price * $qtt, // Ajouter le total du produit dans le tableau prix * quantité
            ];

            // Ajouter le produit dans la session
            $_SESSION['products'][] = $product; // Ajouter le produit dans le tableau
            $_SESSION['message'][] = 'Ajout produit "'  . $product["name"] . '" avec succès'; // Afficher un message
            header("Location: index.php"); // Rediriger vers la page index.php
        } else {
            $_SESSION['message'][] = "Erreur"; // Afficher un message d'erreur
            header("Location: index.php"); // Rediriger vers la page index.php
        }
        break;

        // Supprimer un produit
    case 'delete':
        $index = $_POST['delete']; // récupérer l'index du produit
        $nom = $_SESSION["products"][$index]["name"]; // récupérer le nom du produit
        unset($_SESSION["products"][$index]); // supprimer le produit
        $_SESSION["message"][] = 'Produit "' . $nom . '" supprimé avec succès !'; // Afficher un message
        header("Location: recap.php"); // rediriger vers la page recap.php
        break;

        // Supprimer tous les produits
    case 'clear':
        $_SESSION["products"] = []; // initialiser le tableau
        unset($_SESSION["products"]); // supprimer le tableau
        $_SESSION["message"][] = 'Suppression de tous les produits avec succès !'; // Afficher un message
        header("Location: recap.php");
        break;

        // Augmenter la quantité d'un produit
    case 'up-qtt':
        $index = $_POST["up-qtt"]; // récupérer l'index du produit
        $_SESSION["products"][$index]["qtt"] += 1; // augmenter la quantité
        $_SESSION["products"][$index]["total"] = $_SESSION["products"][$index]["qtt"] * $_SESSION["products"][$index]["price"]; // recalculer le total (prix * quantité)
        $_SESSION["products"] = array_values($_SESSION["products"]); // réindexer le tableau
        header("Location: recap.php"); // rediriger vers la page recap.php
        break;

        // Diminuer la quantité d'un produit
    case 'down-qtt':
        $index = $_POST["down-qtt"]; // récupérer l'index du produit
        $_SESSION["products"][$index]["qtt"] -= 1; // diminuer la quantité
        $_SESSION["products"][$index]["total"] = $_SESSION["products"][$index]["qtt"] * $_SESSION["products"][$index]["price"]; // recalculer le total
        $_SESSION["products"] = array_values($_SESSION["products"]); // réindexer le tableau

        if ($_SESSION["products"][$index]["qtt"] <= 0) { // si la quantité est inférieure ou égale à 0
            $nom = $_SESSION["products"][$index]["name"]; // récupérer le nom du produit
            unset($_SESSION["products"][$index]); // supprimer le produit
            $_SESSION["message"][] = 'Suppression du produit "' . $nom . '" avec succès !'; // Afficher un message
        }
        header("Location: recap.php"); // rediriger vers la page recap.php
        break; // arrêter le switch
}
