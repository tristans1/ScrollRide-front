<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=scrollride', 'root','root');

if (isset($_GET['id']) AND $_GET['id'] > 0)
{

        $getid= intval($_GET['id']);
        $requser = $bdd->prepare('SELECT * FROM utilisateur WHERE ID_UTILISATEUR = ?');
        $requser->execute(array($getid));
        $userinfo = $requser->fetch();


?>


    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>Profil</title>


        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,800&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" type="text/css" href="css/fontawesome-free/css/all.css">


        <script src="js/param.js"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>


    </head>
<body id="profil">
<header>
    <div class="logo">
        <a href="index.php"> <img src="img/LogoOfficiel.svg" alt="logo Scroll & Ride"></a>
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

<div class="content-profil">
    <div class="mon-profil">
        <img src="photo/<?php echo $userinfo['PHOTO'] ?>" alt="photo-profil">
    </div>

        <div class="info-flex">
            <h1 class="nom-profil"> <?php echo $userinfo['IDENTIFIANT'] ?></h1>
            <h4>Mes informations</h4>
            <div class="flex-info-button">
                <div class="info">
            <h4><?php echo $userinfo['PRENOM']." ".$userinfo['NOM'] ?></h4>
            <h4><?php echo $userinfo['VILLE'] ?></h4>
            <h4><?php echo $userinfo['MAIL'] ?></h4>
                </div>
            <div class="button-flex">

                <button type="submit" onclick="window.open('create-spot.php')"><i class="fas fa-map-marked-alt"></i>Référencer un spot</button>
                <button type="submit" onclick="window.open('deconnexion.php')">Se déconnecter</button>
            </div>
        </div>
        </div>
</div>

 <h2>Spots référencés</h2>
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




    <?php
    if (isset($_SESSION['ID_UTILISATEUR']) AND $userinfo['ID_UTILISATEUR'] == $_SESSION['ID_UTILISATEUR']) {
        ?>
        <?php
    }
    ?>




    <?php

    if (isset($Erreur)){
        echo $Erreur;

    }

    ?>



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


<script>
    // Tableau pour liste des batailles
    var liste = new Array();
    // Appel Ajax via Axios en get
    axios.get(backend + 'listeSpot.php')
    // Réponse et récupération des données
        .then(response => {
            liste = response.data;
            console.log('liste', liste);
            var modele = document.querySelector(".spot-items").outerHTML;
            var contenu = '';
            // Parcours de la liste
            for (var i = 0; i  < 2; i++) {
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
        .catch(error => {
            console.log('Erreur', error);
        })
</script>

</body>
</html>

<?php

}

?>