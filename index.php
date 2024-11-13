<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Première Application</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Ajouter un produit</h1>
    <form action="traitement.php" method="post">
    <!--Pour éviter d'afficher les données dans l'URL, la méthode POST est employée,
    contrairement à GET, qui transmet les informations via l'URL et limite leur taille. 
    POST est plus sécurisé et adapté aux formulaires contenant des données sensibles ou volumineuses. -->

    <!--action (qui indique la cible du formulaire, le fichier à atteindre lorsque l'utilisateur soumettra le formulaire)-->
    <!--method (qui précise par quelle méthode HTTP les données du formulaire seronttransmises au serveur)-->

        <p>
            <label>
                Nom du produit :
                <input type="text" name="name">
            </label>
            <!--Les éléments <input> dont l'attribut type vaut "submit" 
            sont affichés comme des boutons permettant d'envoyer les données d'un formulaire.-->
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
                <input type="submit" name="submit" value="Ajouter le produit">
    <!--le bouton de soumission du formulaire,contient lui aussi un attribut "name". 
    Nous verrons plus bas que ce choix permettra de vérifier côté serveur que le formulaire a bien été validé par l'utilisateur.-->
        </p>
    </form>

</body>
</html>

<?php
    session_start();
    /*crée une session ou restaure celle trouvée sur le serveur, 
    via l'identifiant de session passé dans une requête GET, POST ou par un cookie*/

var_dump($_POST);
// var_dump($_SESSION);


