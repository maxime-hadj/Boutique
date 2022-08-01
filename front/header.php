<?php
?>
    <header>
            <div class="containerHeader">
                <!-- LOGO -->
                <img src="./images/logo.jpg" alt="Logo">
                <!-- NAV BARRE -->
            
                    <ul class="navbar">
                        <li><a href="index.php">Accueil</a></li>
                        <li><a href="nouveautes.php">Nouveautés</a></li>
                        <li><a href="boutique.php">Boutique</a></li>
                    </ul>
                    </ul>
                    <ul class="pictos">
                        <li><a href="<?php if(isset($_SESSION['user']) && $_SESSION['user'] == 42){echo 'admin.php';}else{ echo 'Inscription.php';} ?>">
                            <img src="<?php if(isset($_SESSION["user"]) && $_SESSION["user"] != 42){echo "./images/connecte.png";
                            }else if(isset($_SESSION["user"]) && $_SESSION["user"] == 42){echo "./images/admin.png";}else{echo "./images/user.jpg";} ?>" alt="user"></a></li>
                        <?php if(isset($_SESSION["user"])){
                        echo "<li><a href=' deconnexion.php '><img src='./images/deco.jpg' alt='deco'></a></li>"
                        ;}?>
                        <li><a href="panier.php"><img src="<?php if(isset($_SESSION["panier"])){echo "./images/panierplein.png";
                            }else{echo "./images/panier.jpg";} ?>" alt="panier"></a></li>
                    </ul>
            </div>
    </header>
