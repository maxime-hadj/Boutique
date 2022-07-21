<?php
   require ("../back/ModelCommande.php");
   require ("../back/ModelPanier.php");
   $resum = new Commande();
   $id_client = $_SESSION["user"];

   $tot = new Panier;
   $total = $tot->total();

   $resumeComs = $_SESSION["panier"];

   $infos = $resum->infoUser($id_client);
   //var_dump($infos);
   

//   unset($_SESSION);
//    unset($_SESSION["panier"]);
//    unset($_SESSION["panierCount"]);
//    unset($_SESSION["panierPrix"]);
//    unset($_SESSION["user"]);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styleOrdi.css">
    <title>Résumé de commande</title>
</head>
<body>
    <?php require "header.php"; ?>
    <section class="containerReCom">
        <div class="remerciement">
            <h1>
                Merci d'avoir commandé chez nous ! En éspérant cous revoir bientot sur Les nouveaux collectionneurs.
            </h1>
        </div>

        <div>

        </div>
    
    <div class="infoRecom">
        <h2>Récapitulatif de commande</h3>
        <?php 
        if(isset($resumeComs)){
                    foreach($resumeComs as $resumeCom) {
                    ?>
                    <div>
                        <div class="produits">  
                            <img src="<?php print $resumeCom['link'] ?>">
                            <p><?= $resumeCom['titre']; ?></p> 
                            <p><?= $resumeCom['prix']; ?></p>
                            <p><?= $resumeCom['quantité']; ?></p> 
                        </div>
                            
                        <?php
                        }
                        ?>
                    <?php    
                    ;}
                    ?>
    </div>

    <section>
        <h2>Informations Commandes: </h>
        <div>
    <?php 
        if(isset($infos)){
                foreach($infos as $info) {
                ?>
                <div class="containerProduits">
                    <div class="produits">  
                        <p>Nom : <?= $info['nom']; ?></p>
                        <p>Prenom: <?= $info['prenom']; ?></p> 
                        <p>Email: <?= $info['email'];  ?></p>
                        <p>Tel: <?= $info['téléphone'];  ?></p> 
                        <p>Rue: <?= $info['num et nom de rue'];  ?></p> 
                        <p>Ville: <?= $info['ville'];  ?></p> 
                        <p>Pays: <?= $info['pays'];  ?></p> 
                    </div>
                        
                    <?php
                    }
                    ?>
                <?php    
                ;}
                ?>
    </div>
        <h2>Total Commandes: <?= $total ?> €</h2>            
    </section>
    <div class="buttonReCom">
        <a href="index.php">Retour à l'acceuil</a>
        <?php 
            unset($_SESSION["panier"]);
            unset($_SESSION["panierCount"]);
            unset($_SESSION["panierPrix"]);
        ?>
    </div>
    </section>
</body>
</html>