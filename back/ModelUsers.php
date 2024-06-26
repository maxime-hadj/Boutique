<?php
require ('Model.php');
class User extends Model{
        private $id;
        public $login;
        public $email;
        protected $password;
    
    
    public function __construct(){
        parent::__construct();
    }

    public function Inscription($login, $email, $password){
            $this->login = $login;
            $this->email = $email;
            $this->password = $password;
            $requetesql2 = "SELECT login FROM `users` WHERE login = '$this->login'";
            $calcul2 = $this->bdd->prepare($requetesql2);
            $calcul2 -> execute();
            $result2 = $calcul2->rowCount();

            // Si aucun utilisateur n'a ce login alors je le rentre en db
            if(($result2) == 0){
                $requetesql1 = "INSERT INTO `users` (`login`, `email`, `password`, `id_droit`) VALUES ('$this->login', '$this->email', '$this->password', 1)";
                $calcul1 = $this->bdd->prepare($requetesql1);
                $calcul1 -> execute();
                $_SESSION['message'] = '<div class="messageERR">'.'Inscription reussie'.'</div>';
                header('Refresh: 3; url=connexion.php');
            }else{$_SESSION['message'] = '<div class="messageERR">'.'Login deja existant'.'</div>';}

            //var_dump($result2);
    }

    public function connexion($login, $password){
            $this->login = $login;
            $this->password = $password;

            //recupération du login dans BDD
            $request = "SELECT login FROM `users` WHERE login = '$this->login'";
            $calcul = $this->bdd->prepare($request);
            $calcul -> execute();
            $result = $calcul->rowCount();

             //recupération du password dans BDD
            $request2 = "SELECT password FROM `users` WHERE login = '$this->login'";
            $calcul2 = $this->bdd->prepare($request2);
            $calcul2 -> execute();
            // On utilise fetchColumn car la fonction password_verify a besoin d'un résultat sous forme de string
            $result2 = $calcul2-> fetchColumn();
           

            // Création variable récupération décryptage password
            $check_password = $result2;
            


            //Vérification que le login existe bien 
            if(($result) == 1){
                //vérification du password
                if(password_verify($password, $check_password)){
                    // Si le password est vérifié alors on récupère toutes les infos user et on les met dans la session
                    $request3 = "SELECT*FROM `users` WHERE login = '$this->login'";
                    $calcul3 = $this->bdd->prepare($request3);
                    $calcul3 -> execute();
                    $result3 = $calcul3-> fetch(PDO::FETCH_ASSOC);
                    
                    $_SESSION['user'] = $result3['id'];
                    $_SESSION['message'] = '<div class="messageERR">'.'Connexion reussie'.'</div>';
                    if($result3['id_droit'] == 42){
                        $_SESSION['user'] = $result3['id_droit'];
                        header('Location: admin.php');
                    }
                    else if(isset($_SESSION["panier"])){
                        header('Refresh: 1; url=panier.php');
                    }else{
                        header('Refresh: 1; url=index.php');  
                    }
                    
                }else{$_SESSION['message'] = '<div class="messageERR">'.'Password incorrect'.'</div>';}
            }else{$_SESSION['message'] = '<div class="messageERR">'.'Login inexistant'.'</div>';}
    }
}
?>