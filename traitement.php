<?php
session_start(); // Démarre ou restaure la session via l'ID de session une session est un moyen de stocker 
//des informations spécifiques à chaque utilisateur, 
//de manière temporaire, entre les pages d'un site web

$id = (isset($_GET["id"])) ? $_GET["id"] : null; // cela va me servir a recuperer article par article

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case "add":
            if (isset($_POST['submit'])) { // Vérifie si le formulaire a été soumis
                // Un tableau associatif de variables transmises au script actuel via la méthode HTTP POST lors de l'utilisation de l'application

                // filter_input — Récupère une variable externe et la filtre
                $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS); // Assainit "name"
                $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION); // Valide "price" avec fraction
                $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT); // Valide "qtt" comme un entier non nul

                if ($name && $price && $qtt) { // Vérifie que toutes les variables sont valides (non false, null, ou 0), si oui on push dans notre variable product avec les valeurs recupérees

                    // $product contient une quatrième valeur "total" (prix * quantité), comme stipulé dans le cahier des charges.
                    // Cette organisation des données facilitera l'affichage futur des produits et rendra le code plus explicite.

                    $total = $qtt * $price;
                    $product = [
                        "name" => $name,
                        "price" => $price,
                        "qtt" => $qtt,
                        "total" => $total
                    ];
                    // Ajoute $product au tableau $_SESSION["products"]. Si "products" n'existe pas, PHP le crée automatiquement.
                    // Les crochets "[]" ajoutent $product comme nouvelle entrée dans ce tableau.

                    $_SESSION['products'][] = $product; // On ajoute le produit au tableau 'products'

                    $_SESSION['msg'] = "<div class='uk-alert-success' uk-alert>" .
                        "<a href='#' class='uk-alert-close' uk-close></a>" .
                        "Votre produit a été ajouté avec succès</div>";
                } else {
                    $_SESSION['msg'] = "<div class='uk-alert-danger' uk-alert>" .
                        "<a href='recap.php?' class='uk-alert-close' uk-close></a>" .
                        "Erreur !</div>";
                }
            }
            break;

        /* Une session en PHP permet de stocker des données spécifiques à chaque utilisateur grâce à un identifiant unique. 
        Cet identifiant est généralement transmis au navigateur par des cookies de session, permettant de récupérer les données de session existantes. 
        Contrairement aux cookies, les sessions stockent les informations côté serveur, ce qui les rend plus sécurisées. 
        Elles sont temporaires, démarrant avec session_start() et se terminant souvent à la fermeture du navigateur, sauf configuration contraire. 
        La superglobale $_SESSION est un tableau associatif qui contient toutes les données de session après son démarrage.*/

        case "delete":
            unset($_SESSION['products'][$_GET['id']]); // supprime la ligne d'index id dans le tableau products
            // Code pour supprimer le produit à l'index donné
            header("Location: recap.php");
            exit();

        case "Vider le panier":
            // Code pour vider tous les produits de la session
            $_SESSION['products'] = [];
            header("Location: recap.php");
            exit();

        case "up-qtt":
            $_SESSION['products'][$_GET['id']]['qtt']++;
            $_SESSION["products"][$id]["total"] = $_SESSION["products"][$id]["qtt"] * $_SESSION["products"][$id]["price"];
            header("Location: recap.php");
            exit();

            case "down-qtt":
                // Si la quantité du produit est supérieure à 1
                if ($_SESSION['products'][$_GET['id']]['qtt'] > 1) {
                    // La quantité du produit peut être retirée un par un
                    $_SESSION['products'][$_GET['id']]['qtt']--;
                    // Le total sera ainsi calculé grâce à l'incrémentation négative "--" et s'adaptera à la quantité et au prix du produit
                    $_SESSION["products"][$_GET['id']]["total"] = $_SESSION["products"][$_GET['id']]["qtt"] * $_SESSION["products"][$_GET['id']]["price"];
                    ?><!DOCTYPE html>
                    <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Document</title>
                    </head>
                    <body>
                        <main>
                            <?php

                        // Message d'alerte
                    $_SESSION['msg'] = "<div class=containere><div class=prodretirer> <div class='uk-alert-warning' uk-alert>" .
                        "<a href='#' class='uk-alert-close' uk-close></a>" .
                        "Votre produit a bien été retiré !</div></div></div>    ";
                } else {
                    // Si la quantité est 1 ou moins, supprimer l'article du panier
                    unset($_SESSION['products'][$_GET['id']]);
                }
                // Retourner à la page panier (recap.php)
                header("Location: recap.php");
                exit();
    }
}

header("Location: index.php"); // Redirige vers index.php si aucune action n'est détectée
exit(); // Stoppe le script après header() pour éviter les erreurs de redirection
?>
        </main>   
    </body>
</html>

                    
