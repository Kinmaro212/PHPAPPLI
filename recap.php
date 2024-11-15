<?php
session_start();

if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']); // Supprime le message après l'affichage pour éviter sa persistance
}  
/* crée une session ou restaure celle trouvée sur le serveur, 
via l'identifiant de session passé dans une requête GET, POST ou par un cookie */

/* À la différence d'index.php, nous aurons besoin ici de parcourir le tableau de session, il est
donc nécessaire d'appeler la fonction session_start() en début de fichier */

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Récapitulatif des produits</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
<?php include("navbar.php");?>
</header>
<div class="container">
<main>
<?php 

    

    if (empty($_SESSION['products'])) { // Si le panier est vide 
        echo "<p  class='uk-card uk-card-secondary uk-card-body' style='background-color: #f0f0f0; color: #333; width:30%; border-radius:10px'>Panier vide ! <br> Vite, remplis-le !</p>";
    } else {
        echo "<table class='uk-table-small'>",
                "<thead>",
                    "<tr>",
                        "<th>#</th>",
                        "<th>Nom</th>",
                        "<th>Prix</th>",
                        "<th>Quantité</th>",
                        "<th>Total</th>",
                        "<th>Modifier</th>",
                    "</tr>",
                "</thead>",
            "<tbody>";
        
        $totalGeneral = 0; // Initialisation du total général à zéro pour le calcul cumulatif des totaux

        /* On parcourt le tableau $_SESSION['products'] pour numéroter chaque produit dans le tableau HTML 
        et afficher les informations de chaque produit sous forme de tableau. */
        foreach ($_SESSION['products'] as $index => $product) {
            $totalGeneral += $product['total']; // Ajoute le total du produit au total général
            
            echo "<tr>",                        // Ouvre une nouvelle ligne dans le tableau HTML pour un produit spécifique
            "<td>" . $index . "</td>",            
            "<td>" . $product['name'] . "</td>",    // Crée une cellule contenant le nom du produit
            
            "<td>" . number_format($product['price'], 2, ",", "&nbsp;") . "&nbsp;€</td>",  
            /* Crée une cellule pour le prix du produit, 
            formaté avec 2 décimales, une virgule comme séparateur décimal, 
            un espace insécable pour les milliers, suivi du symbole de l’euro (€). */
                        
            "<td>" . $product['qtt'] . "</td>",    // Quantité du produit récupérée depuis `$product`
            "<td>" . number_format($product['total'], 2, ",", "&nbsp;") . "&nbsp;€</td>", // Total pour chaque produit

            "<td>",
            "<div class='tab'><a href='traitement.php?action=delete&id=" . $index . "' uk-icon='icon: trash'></a> | 
             <a href='traitement.php?action=up-qtt&id=" . $index . "'><span uk-icon='icon: plus-circle'></span></a> | 
             <a href='traitement.php?action=down-qtt&id=" . $index . "'><span uk-icon='icon: minus-circle' ></span></a></div></td>",
            "</tr>";
        }

        echo "<tr>",
             "<td colspan='4'>Total général : </td>",
             // Fusionne les colonnes pour l'affichage du total général
             "<td><strong>" . number_format($totalGeneral, 2, ",", " ") . "&nbsp;€</strong></td>",
             "</tr>",
        "</tbody>",
        "</table>",
        "<div class='buttonvider'>
        <a class=' uk-card uk-card-body' href='traitement.php?action=Vider le panier'>Vider le panier</a></div>";
        /* Avant la boucle, initialisation de $totalGeneral à zéro pour cumuler les totaux.
        Dans la boucle, l'opérateur += ajoute chaque total de produit à $totalGeneral. 
        En fin de boucle, une ligne finale affiche l'intitulé (fusion de 4 colonnes) 
        et le montant formaté de $totalGeneral avec number_format(). */
    }
?>
        </main>
    </div>
</body>
<!-- UIkit CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.21.13/dist/css/uikit.min.css" />

<!-- UIkit JS -->
<script src="https://cdn.jsdelivr.net/npm/uikit@3.21.13/dist/js/uikit.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/uikit@3.21.13/dist/js/uikit-icons.min.js"></script>
</html>



