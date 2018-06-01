<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li <?php active('accueil.php'); ?> class="nav-item">
        <a class="nav-link" href="index.php">Accueil</a>
      </li>
      <li <?php active('palmares.php'); ?> class="nav-item">
        <a class="nav-link" href="palmares.php" class="">Palmarès</a>
      </li>
	  <li <?php active('profil.php'); ?> class="nav-item">
        <a class="nav-link" href="profil.php">Profil</a>
      </li>
	  <li <?php active('jeu.php'); ?> class="nav-item">
        <a class="nav-link" href="jeu.php">Nouvelle partie</a>
      </li>
    </ul>
  </div>
</nav>

<?php

// Foncion qui rajoute la classe active en fonction de l'url donnée
function active($url)
{
$url_page = $_SERVER["PHP_SELF"];
$url_page = basename($url_page);
if ($url_page == $url)
{
echo ' class="active"';
}
}
