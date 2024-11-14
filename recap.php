<?php
session_start();    
/*crée une session ou restaure celle trouvée sur le serveur, 
via l'identifiant de session passé dans une requête GET, POST ou par un cookie*/

/*A la différence d'index.php, nous aurons besoin ici de parcourir le tableau de session, il est
donc nécessaire d'appeler la fonction session_start() en début de fichier*/

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="widtd=device-widtd, initial-scale=1.0">
    <title>Récapitulatif des produits</title>
    <link rel="stylesheet" href="style.css">
<div class="container">
   
<?php 

    include("navbar.php");

    if (empty($_SESSION['products'])) { // Si le panier est vide 
        echo "<p >Panier vide ! <br> Vite remplis le !</p>";
    }
    else{
        echo "<table class='uk-table-small'>",
                "<thead >",
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
        /*Utilisons ces variables à l'intérieur de la boucle foreach() et affichons chaque produit
        comme ceci*/
            $totalGeneral = 0;

        /* On parcourt le tableau $_SESSION['products'] pour numéroter chaque produit dans le tableau HTML 
        et afficher les informations de chaque produit sous forme de tableau. */
        foreach($_SESSION['products']as $index => $product){
            $totalGeneral+= $product['total'];
        //Ajoute le total de product dans total géneral $totalGeneral = $totalGeneral + $product['total']
            

           

            echo "<tr>",                        // Ouvre une nouvelle ligne dans le tableau HTML pour un produit spécifique.
            "<td>".$index ."</td>",            
            "<td>".$product['name']."</td>",    // Crée une cellule contenant le nom du produit, récupéré depuis le tableau `$product`.
                        
            "<td>".number_format($product['price'], 2, ",", "&nbsp;")."&nbsp;€</td>",  
            /* Crée une cellule pour le prix du produit, 
            formaté avec 2 décimales, une virgule comme séparateur décimal, 
            un espace insécable pour les milliers, suivi du symbole de l’euro (€).*/
                        
            
        /*La boucle créera alors une ligne <tr> et toutes les cellules <td> nécessaires à chaque partie
        du produit à afficher, et ce pour chaque produit présent en session.*/
        /*number_format(
        variable à modifier,
        nombre de décimales souhaité,
        caractère séparateur décimal,
        caractère séparateur de milliers)*/
        
        "<td>".$product['qtt']."</td>",    // Crée une cellule contenant le nom du produit, récupéré depuis le tableau `$qtt`.
         "<td>".number_format($product['total'], 2, ",", "&nbsp;")."&nbsp;€.</td>";

        echo "<td>",
      "<a href='traitement.php?action=delete&id=" . $index . "' uk-icon='icon: trash'></a> | 
      <a href='traitement.php?action=up-qtt&id=" . $index . "'><span uk-icon='icon: plus-circle'></span></a> | 
      <a href='traitement.php?action=down-qtt&id=" . $index . "'><span uk-icon='icon: minus-circle'></span></a></td>";
        
        }

         echo "<tr>",
         "<td colspan = 4>Total articles : </td>",
         "<td><strong>".number_format($total, 0, ",", " ")."&nbsp;</strong></td>",
                    "<td colspan = 4>Total général : </td>",
                    //Colspan défini le nombre de colonne 
                    "<td><strong>".number_format($totalGeneral, 2, ",", " ")."&nbsp;€</strong></td>",
                    //strong pr mettre en gras 
        "</tbody>",
        "</table>
        <div class=buttonvide>
        <a class='uk-button uk-button-text' href='traitement.php?action=Vider le panier'>Vider le panier</a></div>";
        /*Avant la boucle, initialisation de $totalGeneral à zéro pour cumuler les totaux.
        Dans la boucle, l'opérateur += ajoute chaque total de produit à $totalGeneral. 
        En fin de boucle, une ligne finale affiche l'intitulé (fusion de 4 colonnes) 
        et le montant formaté de $totalGeneral avec number_format().*/

        
        
        //Soit la clé "products" du tableau de session $_SESSION n'existe pas : !isset()
        //Soit cette clé existe mais ne contient aucune donnée : empty()"-->

    }
?>
    </div>
</body>
<!-- UIkit CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.21.13/dist/css/uikit.min.css" />

<!-- UIkit JS -->
<script src="https://cdn.jsdelivr.net/npm/uikit@3.21.13/dist/js/uikit.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/uikit@3.21.13/dist/js/uikit-icons.min.js"></script>
</html>



