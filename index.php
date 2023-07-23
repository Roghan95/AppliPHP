<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">

    </svg>
    <title>Ajout produit</title>
</head>

<body>
    <header>
        <a class="logo" href="index.php">
            APPLI PHP
        </a>
        <nav class="navigation">
            <ul>
                <a class="active" href="index.php">
                    <li>AJOUT PRODUITS</li>
                </a>
                <a href="recap.php">
                    <li>PANIER</li>
                </a>
            </ul>
        </nav>
    </header>
    <main>
        <form action="traitement.php" method="post">
            <h1>Ajouter un produit</h1>
            <p>
                <label>
                    Nom du produit :
                    <input type="text" step="name">
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
            <p>
                <input class="button" type="submit" name="submit" value="Ajouter le produit">
            </p>
        </form>
        <?php echo $_SESSION ?>
    </main>
</body>

</html>