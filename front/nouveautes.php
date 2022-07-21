<?php

require ("../back/ModelProduits.php");
$displayProd = new Produits();

$nouv = $displayProd->getNouv();


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styleOrdi.css">
    <title>Nouveautés</title>
    <style>@import url('https://fonts.googleapis.com/css2?family=Noto+Sans:ital@0;1&display=swap%27');</style>
</head>
<body>
    <?php require "header.php" ?>
    <main>
        <div class="main-containerNouv">
            <div clas="title-container">
                <h1>Nos Nouveautés</h1>
                <hr>
            </div>
            <div class="containerNouvImage">
                <?php foreach($nouv as $nouvs){ ?>
                    <a href="Produits.php?id_produit=<?= $nouvs['id_produit'] ?>">
                        <img src="<?php print $nouvs['link'] ?>">
                        <p><?php echo $nouvs['titre'] ?></p>
                        <p><?php echo $nouvs['prix'] ?></p>
                    </a>
                <?php } ?>
            </div>
        </div>


    </main>
    <?php require "footer.php"; ?>
    </body>
    </html>
