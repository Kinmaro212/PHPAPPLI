<?php


$message = isset($_SESSION['msg']) ? $_SESSION['msg'] : "";
$total = 0;

if (isset($_SESSION['products'])) {
    foreach ($_SESSION['products'] as $product) {
        $total += $product['qtt'];
    }
}
?>

<link rel="stylesheet" href="style.css">

<!-- Navbar -->
<nav>
    <ul>
        <li class="liste" ><a href="index.php">Accueil</a></li>
        <li><a href="recap.php" class="panier-link">
                <span class="badge"><?php echo $total; ?></span> <!-- Affiche le nombre total d'articles -->
                <span uk-icon="icon: cart"></span> <!-- Icône de panier -->
                Panier
            </a>
        </li>
    </ul>
</nav>