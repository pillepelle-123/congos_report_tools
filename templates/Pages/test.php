<?php
$this->loadHelper('Authentication.Identity');

?>

<h1>Hallo</h1>

<?php
    if ($this->Identity->isLoggedIn()) {
        echo 'Du bist eingeloggt als ' . $this->Identity->get('username') . '<br>';
    } 
?>