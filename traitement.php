<?php
session_start(); // Démarre ou restaure la session via l'ID de session une session est un moyen de stocker 
//des informations spécifiques à chaque utilisateur, 
//de manière temporaire, entre les pages d'un site web



if (isset($_POST['submit'])) { // Vérifie si le formulaire a été soumis
    //Un tableau associatif de variables transmises au script actuel via la méthode HTTP POST lors de l'utilisation de application

    //filter_input — Récupère une variable externe et la filtre
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

$_SESSION['products'][] = $product; // On push les produit dans le tableau product 


/* Une session en PHP permet de stocker des données spécifiques à chaque utilisateur grâce à un identifiant unique. 
Cet identifiant est généralement transmis au navigateur par des cookies de session, permettant de récupérer les données de session existantes. 
Contrairement aux cookies, les sessions stockent les informations côté serveur, ce qui les rend plus sécurisées. 
Elles sont temporaires, démarrant avec session_start() et se terminant souvent à la fermeture du navigateur, sauf configuration contraire. 
La superglobale $_SESSION est un tableau associatif qui contient toutes les données de session après son démarrage.*/
    }
}

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case "delete":
            unset($_SESSION['products'][$_GET['index']]); // supprime la ligne d'index id dans le tableau products
            // Code pour supprimer le produit à l'index donné
            break;
        case "Vider le panier":
            // Code pour vider tous les produits de la session
            $_SESSION['products'] = []; 
            break;
        case "up-qtt":
            $index = $_GET['index'];
            $_SESSION['products'][$index]['qtt']++; // ++ = on rajoute 1
            $_SESSION['products'][$index]['total'] = $_SESSION['products'][$index]['price'] * $_SESSION['products'][$index]['qtt'];
            // Code pour augmenter la quantité du produit
            break;
        case "down-qtt":
            $index = $_GET['index'];
            $_SESSION['products'][$index]['qtt']--; // -- = on soustrait 1
            $_SESSION['products'][$index]['total'] = $_SESSION['products'][$index]['price'] * $_SESSION['products'][$index]['qtt'];
            // Code pour diminuer la quantité du produit
            break;
    }
}

header("Location: recap.php"); // Redirige vers index.php






/*Lorsqu'on vérifie l'existence de la clé "submit" dans $_POST, cela signifie que le formulaire a été soumis. 
La clé "submit" correspond à l'attribut name="submit" du bouton <input type="submit">.

Si la clé "submit" n'existe pas, on utilise header("Location:…") pour rediriger vers le formulaire. 
Cette fonction envoie un en-tête HTTP de redirection (status code 302) au client, 
qui lui indique de charger la ressource spécifiée.

Aucun HTML ou sortie (echo, print) ne doit précéder header(), sinon l'en-tête sera perturbé.
header() n'arrête pas le script. Il est donc recommandé d'appeler exit() juste après pour interrompre l'exécution*/

exit(); 
// Stoppe le script après header() pour éviter les erreurs de redirection




