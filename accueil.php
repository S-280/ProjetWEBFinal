<?php
  include 'include/head.php';
?>
  <div id="bandeau">
		<?php include 'include/header.php';?>
	</div>
  <div id="menu">
		<?php include 'include/menu.php';?>
	</div>

<?php

echo "Vous êtes connecté ".$_COOKIE['pseudo'];

include 'include/footer.php';

?>
