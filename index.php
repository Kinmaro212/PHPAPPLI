<?php
session_start();
$message = isset($_SESSION['msg'])?$_SESSION['msg']:"" ;

$total = 0; 
foreach($_SESSION['products']as $index => $product){
    $total+= $product['qtt'];
    
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Première Application</title>
    <link rel="stylesheet" href="style.css">
    <?php
    include("navbar.php");
    ?>
    <div class="indexcontainer">
        <h1>Boutique DKM </h1>

    <?php if(!empty($message))  

    ?>
    <div><p><?php echo $message ?></p></div>
    <!-- Méthode post pour envoyer des informations pour la prochaine page / Méthode get pour récupérer des informations -->
    <form action="traitement.php?action=add" method="post">
        <p>
            <label>
                Nom du produit :
                <input type="text" name="name">
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
            <input class="uk-button uk-button-secondary" type="submit" name="submit" value="Ajouter le produit">
        </p>
    </form>
    </div>
</body>
<!-- UIkit CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.21.13/dist/css/uikit.min.css" />

<!-- UIkit JS -->
<script src="https://cdn.jsdelivr.net/npm/uikit@3.21.13/dist/js/uikit.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/uikit@3.21.13/dist/js/uikit-icons.min.js"></script>
</html>
