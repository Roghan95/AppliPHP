<?php
// Démarrer la session
session_start();
// var_dump($_POST);

$action = $_GET['action'];
switch ($action) {
    case "add":
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);


        if ($name && $price && $qtt) {
            $product = [
                "name" => $name,
                "price" => $price,
                "qtt" => $qtt,
                "total" => $price * $qtt,
            ];

            $_SESSION['products'][] = $product;
            $_SESSION['message'][] = 'Ajout produit "'  . $product["name"] . '" avec succès';
            header("Location: index.php");
        } else {
            $_SESSION['message'][] = "Erreur";
            header("Location: index.php");
        }
        break;

    case 'delete':
        $index = $_POST['delete'];
        $nom = $_SESSION["products"][$index]["name"];
        unset($_SESSION["products"][$index]);
        $_SESSION["products"] = array_values($_SESSION["products"]);
        $_SESSION["message"][] = 'Produit "' . $nom . '" supprimé avec succès !';
        header("Location: recap.php");
        break;


    case 'clear':
        $_SESSION["products"] = [];
        $_SESSION["products"] = array_values($_SESSION["products"]);
        $_SESSION["message"][] = 'Suppression de tous les produits avec succès !';

        header("Location: recap.php");
        break;

    case 'up-qtt':
        $index = $_POST["up-qtt"];
        $_SESSION["products"][$index]["qtt"] += 1;
        $_SESSION["products"][$index]["total"] = $_SESSION["products"][$index]["qtt"] * $_SESSION["products"][$index]["price"];
        $_SESSION["products"] = array_values($_SESSION["products"]);
        header("Location: recap.php");
        break;

    case 'down-qtt':
        $index = $_POST["down-qtt"];
        $_SESSION["products"][$index]["qtt"] -= 1;
        $_SESSION["products"][$index]["total"] = $_SESSION["products"][$index]["qtt"] * $_SESSION["products"][$index]["price"];
        $_SESSION["products"] = array_values($_SESSION["products"]);

        if ($_SESSION["products"][$index]["qtt"] <= 0) {
            $nom = $_SESSION["products"][$index]["name"];
            unset($_SESSION["products"][$index]);
            $_SESSION["products"] = array_values($_SESSION["products"]);
            $_SESSION["message"][] = 'Suppression du produit "' . $nom . '" avec succès !';
        }
        header("Location: recap.php");
        break;
}
?>

// if (isset($_GET['action'])) {
// switch ($_GET['action']) {
// case "add":
// case "delete":
// case "clear":
// case "up-qtt":
// case "down-qtt":
// }
// }