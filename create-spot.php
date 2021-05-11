<?php ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Référence ton spot</title>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>


    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" type="text/css" href="css/fontawesome-free/css/all.css">
    <script src="js/param.js"></script>

</head>
<body id="create-spot">
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
                <li><a href="index.php">Recommandé</a></li>
                <li><a href="contest.html">Contest</a></li>
                <li><a href="#">Construit un park</a></li>
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
<h1>PARTAGE TON SPOT</h1>


<form id="form" method="POST" action="" enctype="multipart/form-data">
    <h3>NOUVEAU SPOT</h3>

    <div class="input-formulaire">
        <input type="text" placeholder="Nom du spot" class="input-formulaire-spot" id="nom-spot" name="nom-spot" >
    </div>


    <div class="input-formulaire">
        <input type="text" placeholder="Adresse et ville" class="input-formulaire-spot" id="ville-spot" name="ville-spot">
    </div>


    <div class="input-formulaire">
        <label for="type-rider">Adapté pour </label>
        <select class="input-formulaire-inscription" id="type-rider" name="type-rider">
            <option value="BMX">BMX uniquement</option>
            <option value="Skate roller trott">Skate, roller, trottinette</option>
            <option value="All">Tous les sports</option>
        </select>
    </div>


    <div class="input-formulaire">
        <input type="text" placeholder="Description (250 caractères max)" class="input-formulaire-spot" id="description-spot" name="description-spot">
    </div>

    <div class="input-formulaire">
        <label class="custom-file-label" for="photo">Choisir une photo du spot </label>
        <input type="file" class="custom-file-input" id="photo" name="photo" required>
    </div>

    <div class="input-formulaire">
        <label for="date">Date de publication</label>
        <input type="date"  class="input-formulaire-spot" id="date" name="date">
    </div>



    <input type="submit" id="submit-inscris" name="forminscription" value="Référencer le spot">
    <p class="inscription-p">Les spots seront vérifiés, puis postés si le contenu correspond à un lieu dédier aux
        sports de glisses </p>
</form>










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

    //retrouver la personne qui ajoute un spot


    // Soumission du formulaire
    document.querySelector("#form")
        .addEventListener("submit", function (event) {
            // Stopper la propagation évènementielle
            event.preventDefault();
            const params = new FormData();
            params.append('nom', document.querySelector('#nom-spot').value);
            params.append('adresse', document.querySelector('#ville-spot').value);
            params.append('resume', document.querySelector('#description-spot').value);
            params.append('date', document.querySelector('#date').value);
            params.append('photo', document.querySelector('#photo').files[0]);
            // Ajax

            axios.post(backend + 'createSpot.php', params,
                {headers: {'Content-Type': 'multipart/form-data'}}
            )
                .then(response => {
                    console.log("response", response.data);
                    // redirection sur la liste des villageois
                    window.location.href =
                        window.location.origin
                        + window.location.pathname
                        + "#";
                })
                .catch(function (error) {
                    console.log("ERREUR", error)
                });
        });


    // prévisualisation d'une nouvelle image
    document.querySelector("#photo")
        .addEventListener("change", function (event) {
            // Reference à l'origine de l'évènement
            var input = event.target;
            // Récupération du ou des champs de type files
            if (input.files && input.files[0]) {
                // Creation d'un objet FileReader
                var reader = new FileReader();
                // Création du callback onload
                reader.onload = (e) => {
                    // lecture de l'image en base64
                    // pour la charger en imageData
                    var imageData = document.querySelector("#previewImage");
                    imageData.setAttribute("src", e.target.result);
                }
                // Rendu de l'image en tant l'url
                reader.readAsDataURL(input.files[0]);
            }
        });
</script>
</body>
</html>

