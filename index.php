<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=scrollride', 'root','root');

if (isset($_POST['formconnexion'])){
    $mailconnect = htmlspecialchars($_POST['mailconnect']);
    $mdpconnect = sha1($_POST['mdpconnect']);

    if (!empty($mailconnect) AND !empty($mdpconnect)){

        $requser = $bdd->prepare("SELECT * FROM utilisateur WHERE MAIL = ? and PASSWORD = ?");
        $requser->execute(array($mailconnect,$mdpconnect));
        $userexist = $requser->rowCount();
        if ($userexist==1){

            $userinfo = $requser->fetch();
            $_SESSION['ID_UTILISATEUR'] = $userinfo['ID_UTILISATEUR'];
            $_SESSION['IDENTIFIANT'] = $userinfo['IDENTIFIANT'];
            $_SESSION['MAIL'] = $userinfo['MAIL'];
            header("Location: profil.php?id=".$_SESSION['ID_UTILISATEUR']);


        }else{
            $Erreur = "mauvais mail ou mot de passe";
        }

    }else{

        $Erreur = "Tout les champs doivent être complétés !";
    }

}

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Accueil</title>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" type="text/css" href="css/fontawesome-free/css/all.css">

    <script src="js/param.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <script>
        $(window).on("load",function () {
            $(".loader-wrapper").fadeOut(1500);
        });
    </script>



</head>

<body id="accueil">
<div class="background">
    <header>

        <section class="loader-wrapper">
            <!-- Loading square for squar.red network -->
            <span class="loader"><span class="loader-inner"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 290.76 366.83">
            <defs><style>.cls-1{fill:none;stroke:#000;stroke-miterlimit:10;stroke-width:17px; }</style>
            </defs><title>LogoOfficiel</title>
            <g id="Calque_2" data-name="Calque 2">
                <g id="Calque_5" data-name="Calque 5">
                    <path class="cls-1" d="M56.63,25c-.34-4.24-.58-8.48-.76-12.69H8.59v270.3h270.3V281C163.18,267.17,67.6,161,56.63,25Z"/>
                    <circle class="cls-1" cx="101.5" cy="33.38" r="23.09"/>
                    <polyline class="cls-1" points="147.12 8.5 282.26 8.5 282.26 242.76"/>
                    <path class="cls-1" d="M143.74.05s0,90,104.74,183"/>


                    <text/>
                </g>
            </g>
        </svg></span></span>
        </section>
        <div class="logo">
            <a href="index.php"> <img src="img/LogoOfficiel.svg" alt="logo Scroll & Ride"></a>
        </div>
        <div class="search-bar" id="sb-accueil">
            <input id="search-input" type="search" placeholder="Cherche ta ville"><i class="fas fa-search"></i>
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

<div class="accueil-flex-container">

    <div class="accueil-flex-item">
        <h1>PARTAGE, CHERCHE ET TROUVE TON SPOT</h1>
        <div class="search-bar" id="sb-accueil-2">
            <input id="search-input" type="search" placeholder="Cherche ta ville"><i class="fas fa-search"></i>
        </div>
    </div>

    <form class="form" method="POST" action="">
        <h3>S'IDENTIFIER</h3>



            <div class="input-formulaire">
                <input id="email" type="email" name="mailconnect" placeholder="E-mail">
            </div>

            <div class="input-formulaire">
                <input id="password" type="password" name="mdpconnect" placeholder="Mot de passe">
            </div>



            <button class="connexion" name="formconnexion" type="submit"><img id="skate-form" src="img/skateboard-svgrepo-com.svg">Se connecter</button>

            <button type="submit" onclick="window.open('inscription.php')">S'inscrire</button>

    </form>

</div>
</div>


<div class="content-flex">
    <div class="content-items">


        <div class="spot-items">
            <div id="flex-spot">
            <div class="bio-spot">
                <h3>{{nom}}</h3>
                <p>{{adresse}}</p>
                <div class="share-comment">
                    <i class="fas fa-share-square"></i>
                    <i class="far fa-comment-alt"></i>
                </div>
            </div>

            <div class="spot-img">
                <img src="{{image}}" alt="">
            </div>

                <div class="tag-spot">
                    <p></p>
                </div>
        </div>
            <div class="description-spot">


                <p>{{resume}}</p>
            </div>
        </div>
    </div>


    <div class="fil-arianne">
        <p class="fil">NOS SPOTS</p>
        <span></span>
    </div>
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

<script src="app.js"></script>
</body>
</html>

<script>
    // Tableau pour liste des batailles
    var liste = new Array();
    // Appel Ajax via Axios en get
    axios.get(backend+'listeSpot.php')
    // Réponse et récupération des données
        .then(response => {
            liste = response.data;
            console.log('liste', liste);
            var modele = document.querySelector(".spot-items").outerHTML;
            var contenu = '';
            // Parcours de la liste
            for(var i=0;i<liste.length;i++){
                // Pour chaque villageois, on récupère le modèle
                var spot = modele;
                // et on injecte les bonnes informations
                spot = spot.replace('{{adresse}}', liste[i].adresse);
                spot = spot.replace('{{resume}}', liste[i].resume);
                spot = spot.replace('{{image}}', liste[i].photo);

                spot = spot.split('{{nom}}').join(liste[i].nom);


                // On ajoute ensuite la balise au contenu
                contenu += spot;
            }
            // On ajoute le contenu à la liste
            document.querySelector('.content-items').innerHTML = contenu;
        })
        // Si erreur de larequete
        .catch( error =>{
            console.log('Erreur', error);
        })
</script>