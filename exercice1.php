<?php  
session_start();
include('fonction.php');
if (!empty($_POST)) {
	if (empty($_POST['nombre'] )|| !preg_match('/^[0-9]+$/',$_POST['nombre'])) {
		$errors['nombre']="le nombre saisie est invalide";
    }
    else{
            $_SESSION['nb']=$_POST['nombre'];
        
        if ($_POST['nombre'] <= 10000) {
            $errors['nombre1']="le nombre doit etre supperieur a 10000";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>EXERCICE 1 </title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
        <h3 class="textcentre">PROGRAMME DES NOMBRES PREMIERS</h3>
        <form  method="post">
            <fieldset>
                <legend>SAISIR UN NOMBRE SUPPERIEUR A 10000</legend>
                <div>
                    <label for="name">Nombre :</label>
                    <input type="text" id="a" name="nombre" >
                </div>
                <div class="button">
                    <button type="submit"> valider </button>
                </div>
            </fieldset>
        </form>
</div>
<ul>
<?php if (!empty($errors)):?>
<?php foreach($errors as $error): ?>
<li><?= $error ?></li>
<?php endforeach;?>
<?php endif;      ?>
</ul>
<?php 
if(empty($errors)){
    $tab=premier($_SESSION['nb']);
    $moyenne=moyenne($tab);
    $tabl=['superieur'=>[],
            'inferieur'=>[]];
    for ($i=0; $i <count($tab) ; $i++) { 
        if ($tab[$i]<$moyenne) {
            $tabl['inferieur'][]=$tab[$i];
        } else {
            $tabl['superieur'][]=$tab[$i];
        }
    }
    ?>
    <form ><div>
            <div class="tabinf">
                <h5 class="textcentre">TABLEAU DES NOMBRES PREMIERS INFERIEUR A LA MOYENNE</h5>
                <?php afficheTabPremier($tabl['inferieur']); ?>
            </div>
            <div class="tabsup">
                <h5 class="textcentre">TABLEAU DES NOMBRES PREMIERS SUPRIEUR A LA MOYENNE</h5>
                <?php  afficheTabPremier($tabl['superieur']) ?>
            </div>
            <?php
        }?>  
    </div></form>
</body>
</html>
