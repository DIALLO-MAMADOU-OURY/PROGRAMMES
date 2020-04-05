<?php
    include "fonction_exo3.php";
    $formvalide=false;
    $nombre="";
    $msg="";
	$result="";
    $mots="";
	if(!empty($_POST['nombre'])){
        if(!is_number($_POST['nombre']))
            $msg= "veuillez saisir un nombre entier positif";
        else{   
            $nombre=$_POST['nombre'];
			for ($i=1; $i <= $nombre; $i++) { //Recuperation du Mot
				if(empty($_POST['nombre'.$i]))
					$errors['mv'.$i]='veuillez saisir le mot numero '.$i;
            	if(!empty($_POST['nombre'.$i])){
					$mot=$_POST['nombre'.$i];
					if (!is_valide($mot) ) {
						$errors['m'.$i]='le  mot '.$i.' saisie est invalide';
					}  
					elseif(strlen($mot)>20){
						$errors['ml'.$i]='le  mot '.$i.' doit contenir moins de 20 caracteres';
					} 
                } 
            }
         	$formvalide=true;
        }
    }       
    if($msg!=""){
        echo $msg;
	}    
?>

<!DOCTYPE html>
<html>
<head>
	<title>EXERCICE 3 </title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="container">
        <form  method="post">
            <fieldset>
                <legend>SAISIR DES MOTS DE MOINS DE 20 CARACTERES </legend>
                <div>
                    <label form="mot">nombre de mots: </label>
                    <input type="text" id="a" name="nombre" value="<?php echo $nombre;?>"/><br><br> <?php
            		if($formvalide){
                		for ($i=1; $i <= $nombre; $i++){ 
							echo"<label for=\"mot\">MOT Nro $i: </label>";
							echo"<input type=\"text\" id=\"mot\" name=\"nombre$i\" ";
							if (!empty($_POST['nombre'.$i])) {
								$mot=$_POST['nombre'.$i];
								echo"value=\"$mot\"> ";
							}
							echo"<br><br><br>";
               			 }
           			 }?> 
				</div>
				<div class="button">
                    <button style="margin-left: 220px;" type="submit"> valider </button>
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
if (!empty($_POST['nombre'])) {
	if(empty($errors)){?>
			<form><div><?php
		   	$tabmot=[];
		   	if (!empty($_POST['nombre1'])) {
				echo'les mot saisies sont: <br>';
		   	}
			$nbre=0;
			for ($i=1; $i <= $nombre; $i++) { //Recuperation du Mot
            	if(!empty($_POST['nombre'.$i])){
					$tabmot[]=$_POST['nombre'.$i];
                } 
            }
       		foreach ($tabmot as $key => $mot) {
        		echo$mot.'<br>';
            	if(is_char_in_string('m',$mot) || is_char_in_string('M',$mot)){
            	   $nbre++;
           		}
       		}
       		if($nbre==0 && !empty($tabmot[0]))
        		echo'il n y a pas de mot contenant la letrre m';
       		elseif ($nbre==1) {
           		echo'le mot contenant la letrre m est <br>';
           		foreach ($tabmot as $key => $mot) {
					if(is_char_in_string('m',$mot) || is_char_in_string('M',$mot)){              		
						echo$mot.'<br>';
               		}
           		}
       		}
       		elseif ($nbre>1){
           		echo'les'.$nbre.' mots contenant la letrre m sont <br>';
           		foreach ($tabmot as $key => $mot) {
					if(is_char_in_string('m',$mot) || is_char_in_string('M',$mot)){
                   		echo$mot.'<br>';
               		}
           		}
			   }?> 
		</div></form><?php
	}
}
?>
</body>
</html>

