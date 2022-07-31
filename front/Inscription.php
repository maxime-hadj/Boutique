<?php
session_start();
require ("../back/ModelUsers.php");
$message = '';
if(isset($_POST['login']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_retype'])){
    $login = htmlspecialchars($_POST['login']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $password_retype = htmlspecialchars($_POST['password_retype']);

    //Si le password et le password_retype identiques alors je crypte le mdp et j'appel la fonction d'inscription 
    if($password === $password_retype){
        $password = password_hash($password, PASSWORD_BCRYPT);
        $user = new User();
        $user->Inscription($login, $email, $password);
    }
    else{
        $message = 'Mots de passe non-identiques.';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styleOrdi.css">
    <title>Inscription</title>
</head>
<body class='body'>

    <?php require 'header.php';?>

<main class="main">
    <form class="formContainer" action="" method="post">
        <h1>INSCRIPTION</h1>
        <?php echo $message; ?>
        <?php if(isset($_SESSION['message'])){echo $_SESSION['message'];} ?>
        <p><input type="text" id="login" name="login" class="zonetext" placeholder="Identifiant..."></p>
        <p><input type="text" id="email" name="email" class="zonetext" placeholder="Email..."></p>
        <p><input type="password" id="password" name="password" class="zonetext" placeholder="Mot de passe..."></p>
        <p><input type="password" id="password_retype" name="password_retype" class="zonetext"  placeholder="Confirmez votre mot de passe..."></p>
        <p style="color:red" id="erreur"></p>
        <p><input type="submit" id="#button" class="boutonvalidation" name="submit" value="Envoyer"></p> 
    </form>
    <a id="lienCo" href="connexion.php">Vous avez déjà un compte ? Cliquez ici !</a>
    <script type="text/javascript">
        let btnEnvoyer = document.getElementById('#button');

        btnEnvoyer.addEventListener("click", function(e) {
            var erreur;
            login = document.querySelector("#login")
            email = document.querySelector("#email")
            password = document.querySelector("#password")
            password_retype = document.querySelector("#password_retype")
            //console.log(login.value);

            if (!password_retype.value){
                erreur = "Veuillez retaper votre mot de passe.";
            }

            if (!password.value){
                erreur = "Veuillez renseigner votre mot de passe.";
            }

            if (!email.value){
                erreur = "Veuillez renseigner votre email.";
            }
            
            if (!login.value){
                erreur = "Veuillez renseigner votre login.";
            }

            if(password.value != password_retype.value){
                erreur = "Veuillez rentrer des mots de passe indentiques.";
            }

            if(erreur){
                e.preventDefault();
                document.querySelector("#erreur").innerHTML = erreur;
                return false;
            }else{
                
            }
        })
    </script>
</main>

<?php require 'footer.php'; ?>

</body>
</html>