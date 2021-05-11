<?php

        $bdd = new PDO('mysql:host=localhost;dbname=scrollride', 'root','root');

        if (isset($_POST['forminscription'])){
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $mail = htmlspecialchars($_POST['mail']);
            $mail2 = htmlspecialchars($_POST['mail2']);
            $sexe = htmlspecialchars($_POST['sexe']);
            $nom = htmlspecialchars($_POST['nom']);
            $prenom = htmlspecialchars($_POST['prenom']);

            $ville = htmlspecialchars($_POST['ville']);

            $photo = $_FILES['photo']['name'];


            $mdp = sha1($_POST['mdp']);
            $mdp2 = sha1($_POST['mdp2']);



            if(!empty($_POST['pseudo'])
               AND !empty($_POST['mail'])
                   AND !empty($_POST['mail2'])
                       AND !empty($_POST['mdp'])
                           AND !empty($_POST['mdp2']
                                      AND !empty($_POST['nom'])
                                          AND !empty($_POST['prenom'])
                                              AND !empty($_POST['ville'])
                                                  AND !empty($_POST['sexe'])
                                                      AND !empty ( $_FILES['photo']['name']) ) ){



                $pseudolength = strlen($pseudo);
                if($pseudolength <= 32)
                {
                    if ($mail == $mail2)
                    {
                        if(filter_var($mail, FILTER_VALIDATE_EMAIL)){

                                $reqmail = $bdd->prepare("SELECT * FROM utilisateur WHERE MAIL = ? ");
                                $reqmail->execute(array($mail));
                                $mailexist = $reqmail->rowCount();
                                if ($mailexist ==0){

                                    if ($mdp == $mdp2){

if (move_uploaded_file($_FILES['photo']['tmp_name'], "photo/".$photo)){
                                     //   $essaigrtt = '1';
                                        $sql = "INSERT INTO `utilisateur`
    ( `NOM`, `PRENOM`, `SEXE`, `IDENTIFIANT`, `PASSWORD`, `MAIL`, `VILLE`, `PHOTO`, `ID_ABONNEMENT`) 
    VALUES (?, ?, ?,? ,? , ?, ?, ?, ?) ";

                                           $insertmbr = $bdd->prepare($sql);



                                       $insertmbr->execute(array($nom,$prenom,$sexe,
                                           $pseudo,$mdp,$mail,$ville,$photo,'1'));


}
                                        $Erreur= "Me déconnecter";



                                    }else{
                                        $Erreur= "Mot de passe pas cohérent";
                                    }

                                }else{
                                    $Erreur = "Cette adresse est déjà utilisée ";
                                }

                                }
                        else{
                            $Erreur = "Votre adresse mail n'est pas valide";
                        }

                        }else{

                            $Erreur = "vos adresse mail ne correspondent pas";
                        }

                }else{
                    $Erreur = "Votre pseudo est trop long";
                }

            }else{

                $Erreur = "Tout les champs doivent être remplis";
            }


        }
?>




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Inscription  </title>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>


    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" type="text/css" href="css/fontawesome-free/css/all.css">
    <script src="js/param.js"></script>

</head>
<body class="inscrire">

<div id="inscription">
    <header>
        <div class="logo">
            <a href="index.php"> <img src="img/logo-blanc.svg" alt="logo Scroll & Ride"></a>
        </div>
        <div class="nav-toggle">
            <div class="nav-toggle-bar"></div>
        </div>
        <nav class="menu">
            <div class="nav-container">
                <ul id="nav-ul">
                    <li><a href="#">Profil</a></li>
                    <li><a href="index.php">Nos spots</a></li>
                    <li><a href="contest.html">Contest</a></li>
                    <li><a href="construction.html">Construit un park</a></li>
                </ul>
                <ul id="nav-reseaux">
                    <li><h4>Suivez-nous</h4></li>
                    <li><span></span></li>
                    <li><a href="https://www.facebook.com"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="https://www.instagram.com"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="https://youtube.com"><i class="fab fa-youtube"></i></a></li>
                </ul>
            </div>
        </nav>
    </header>
    <h1>REJOINS SCROLL & RIDE</h1>
    <form method="POST" action="" enctype="multipart/form-data">
        <h3>INSCRIPTION</h3>
            <!--<p>Votre Nom :</p>-->
        <div class="input-formulaire">
            <input type="text" placeholder="Nom" class="input-formulaire-inscription" id="nom" name="nom">
        </div>

            <!--<p>Votre Prénom :</p>-->
        <div class="input-formulaire">
            <input type="text" class="input-formulaire-inscription" id="prenom" placeholder="Prénom" name="prenom"><br/>
        </div>

        <div class="input-formulaire">
            <!--<p>Votre pseudo :</p>-->
            <input type="text" placeholder="Pseudo" class="input-formulaire-inscription" id="pseudo" name="pseudo" value="<?php if (isset($pseudo)) {echo $pseudo;} ?>">
        </div>

        <div class="input-formulaire">
        <label for="sexe" >Votre Sexe :</label>
            <select class="input-formulaire-inscription" id="sexe" name="sexe">
                <option value="Masculin">Masculin</option>
                <option value="Féminin">Féminin</option>
                <option value="Autre">Autre</option>
            </select>
        </div>

        <div class="input-formulaire">
            <!--<p> Votre Mail :</p>-->
            <input type="email" placeholder="Email" class="input-formulaire-inscription" id="mail" name="mail" value="<?php if(isset($mail)){echo $mail ;}  ?>">
        </div>

            <!--<p> Confirmer votre Mail :</p>-->
        <div class="input-formulaire">
        <input type="email" placeholder="Confirmer votre Email" class="input-formulaire-inscription"id="mail2" name="mail2" value="<?php if(isset($mail2)){echo $mail2 ;}  ?>">
        </div>

        <div class="input-formulaire">
            <label class="custom-file-label" for="photo">Choisir une photo de profil :</label>
                <input type="file" class="custom-file-input" id="photo" name="photo" required>
        </div>




        <div class="input-formulaire">
            <!--<p>Votre ville :</p>-->
            <input type="text" placeholder="Votre ville" class="input-formulaire-inscription" id="ville" name="ville">
        </div>

        <!--<p>Mot de passe :</p>-->
        <div class="input-formulaire">
        <input type="password" placeholder="Mot de passe" class="input-formulaire-inscription" id="mdp" name="mdp">
        </div>


        <div class="input-formulaire">
            <!--<p>Confirmer Mot de passe :</p>-->
            <input type="password" placeholder="Confirmer votre mot de passe" class="input-formulaire-inscription" id="mdp2" name="mdp2">
        </div>
        <div class="pure-controls">
            <label for="cb" class="pure-checkbox">
                <input id="cb" type="checkbox"> J'ai lu et j'accepte les <a href="cgu.html">conditions générales
                    d'utilisation</a>
            </label>
        </div>


            <input type="submit" id="submit-inscris" name="forminscription" value="S'inscrire">
        <p class="inscription-p">En t’inscrivant, tu recevras des exclusivités concernant Scroll & Ride</p>
        <p class="alerte"> <?php


            if (isset($Erreur)) {
                echo $Erreur;

            }


            ?></p>
        </form>
</div>
    <footer>

        <h4>Retrouve nous aussi sur </h4>

        <div id="social-networks">
            <ul>
                <li><a href="https://www.youtube.com/"><i class="fab fa-youtube-square fa-2x"></i></a>
                <li><a href="https://www.facebook.com"><i class="fab fa-facebook-square fa-2x"> </i></a>
                </li>
                <li><a href="https://www.instagram.com"><i class="fab fa-instagram fa-2x"></i></a>
                </li>
                <li><a href="https://twitter.com"><i class="fab fa-twitter-square fa-2x"></i></a></li>
            </ul>
        </div>
        <div class="footer-grid">
            <div>Nous contacter</div>
            <div>Confidentialité</div>
            <div>Centre d'aides</div>
            <div><a href="cgu.html">Conditions d'utilisations</a></div>
            <div><a href="mentions-legales.html">Mentions légales</a></div>
            <div><a href="cookies.html">Préférences des cookies</a></div>
            <div class="realiser">Réalisé par Tristan Seclet, Steven Goffinet et David Rivera.</div>
        </div>
        <p>® Scroll & Ride. Tous droits réservés </p>
    </footer>






        <?php

                if (isset($Erreur)){
                    echo $Erreur;

                }

                ?>



    <script src="app.js"></script>

</body>
</html>