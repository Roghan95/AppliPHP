<?php
// Démarrer la session
session_start();
// var_dump($_POST);


// Si le formulaire a été soumis
if (isset($_POST['submit'])) {
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING); // Filtrer l'entree de l'utilisateur
    $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION); // Filtrer l'entree de l'utilisateur (float) et accepter les nombres a virgule
    $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT); // Filtrer l'entree de l'utilisateur (int)

    // Si les champs sont remplis
    if ($name && $price && $qtt) {
        $product = [
            "name" => $name,
            "price" => $price,
            "qtt" => $qtt,
            "total" => $price * $qtt
        ];

        // Si la session n'existe pas
        $_SESSION['products'][] = $product;
    }
}

// Redirection vers la page index.php
header("Location: index.php");
