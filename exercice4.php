<!DOCTYPE html>
<html>
<head>
	<title>EXERCICE 4 </title>
</head>
<body>

<div class="container">
        <form  method="post">
            <fieldset>
                <legend>SAISIR DES PHRASES DE MOINS DE 200 CARACTERES </legend>
                <div>
                    <textarea type="text" name="phrase" placeholder="saisir les phrases" required="required" cols="80" rows="20"></textarea> 
                </div>
                <div class="button">
                    <button type="submit">corriger </button>
                </div>
            </fieldset>
        </form>
</div>
<?php 
    if(isset($_POST['phrase'])){
        if(!empty($_POST['phrase'])){
            $txt=$_POST['phrase'];
            $txt = preg_replace("#  +#", " ",$txt);?>
            <form  method="get">
                <fieldset>
                    <legend>le texte corige</legend>
                        <div>
                           <textarea type="text" name="a" required="required" cols="80" rows="20">
                                <?php echo"$txt";  ?>
                            </textarea> 
                        </div>
                </fieldset>
            </form>
            <?php            
        }    
    }
?> 
</body>
</html>

