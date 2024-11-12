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

</head>
<body>
<?php 
    if (isset($_POST['products']) || empty($_SESSION['products'])){ // Vérifie si le formulaire a été soumis
    echo"<p> Aucun produit en session ...</p>";
    }
    else{
        echo "<table>",
                "<tdead>",
                    "<tr>",
                        "<th>#</th>" ,
                        "<th>Nom</th>",
                        "<th>Prix</th>",
                        "<th>Quantité</th>",
                        "<th>Total</th>",
                    "</tr>",
                "</tdead>",
            "<tbody>";
            /*Utilisons ces variables à l'intérieur de la boucle foreach() et affichons chaque produit
            comme ceci*/
            $totalGeneral = 0;
            
        foreach($_SESSION['products']as $index => $product){

            /* On parcourt le tableau $_SESSION['products'] pour numéroter chaque produit dans le tableau HTML 
            et afficher les informations de chaque produit sous forme de tableau. */

           

            echo "<tr>",                        // Ouvre une nouvelle ligne dans le tableau HTML pour un produit spécifique.
                
            "<td>".$index."</td>",              // Crée une cellule contenant l'index du produit (numéro de ligne ou identifiant).
                        
            "<td>".$product['name']."</td>",    // Crée une cellule contenant le nom du produit, récupéré depuis le tableau `$product`.
                        
            "<td>".number_format($product['price'], 2, ",", "&nbsp;")."&nbsp;€.</td>",  
            /* Crée une cellule pour le prix du produit, 
            formaté avec 2 décimales, une virgule comme séparateur décimal, 
            un espace insécable pour les milliers, suivi du symbole de l’euro (€).*/
                        
            
            /*La boucle créera alors une ligne <tr> et toutes les cellules <td> nécessaires à chaque partie
            du produit à afficher, et ce pour chaque produit présent en session.*/
            /*number_format(
            variable à modifier,
            nombre de décimales souhaité,
            caractère séparateur décimal,
            caractère séparateur de milliers5)*/

            $totalGeneral+= $product['total'];

        }
            
         echo "<tr>",
                    "<td colspan = 4>Total général : </td>",
                    //Colspan défini le nombre de colonne 
                    "<td><strong>".number_format($totalGeneral, 2, ",", "nbsp;")."&nbsp;€.</td>",
        "</tbody>",
        "</table>";
        /*Avant la boucle, initialisation de $totalGeneral à zéro pour cumuler les totaux.
        Dans la boucle, l'opérateur += ajoute chaque total de produit à $totalGeneral. 
        En fin de boucle, une ligne finale affiche l'intitulé (fusion de 4 colonnes) 
        et le montant formaté de $totalGeneral avec number_format().*/


        
        //Soit la clé "products" du tableau de session $_SESSION n'existe pas : !isset()
        //Soit cette clé existe mais ne contient aucune donnée : empty()"-->

    }
?>
</body>
</html>



