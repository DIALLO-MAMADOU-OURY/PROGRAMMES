<?php
    $liste = getData('question');
    $npage = ceil(sizeof($liste)/5);
if(!isset($_GET['page'])){
    $page = 1;
}else{
    $page = $_GET['page'];
}
$min = ($page-1)*5; $max = $min + 5;
if($page <= 1){
    $page = 1;
    $prev = 'none';
}elseif($page>$npage){
    $page = $npage;
}
if($page == $npage){
    $max = sizeof($liste);
    $next = 'none';
}
?>
    <style>
        *{
            margin: 0;
        }
        .question-content input {
            margin-left: 25px;
        }
        .question-show {
            display: inline-block;
        }
        .text {
            height: 20px;
            text-align: center;
            font-size: 10px;
            font-weight: bold;
            width: auto;
        }
        .prev{
            display: <?= $prev ?>;
            align-self: flex-start;
        }
        .next{
            display: <?= $next ?>;
            float: right;
            margin-right: 10px;
            /* position: relative;
            top: 10px;
            left: 60%; */
            
        }
        .next>button,.prev>button{
            color: white;
            background-color: #3addd6;
            border: none;
            width: 120px;
            height: 35px;
        }
        .question-content>h3{
            color: #818181;
        }
        /* .paginate-zone{
            position: relative;
            top: 105px;
        } */
    </style>
<?php 
    $error="";
    $nbrequestion='';
    if (isset($_POST['btnOK'])) {
        if(empty($_POST['nbrequestion'])){
            $nbrequestion=$_POST["nbrequestion"];
            $error="Veuillez renseigner ce champs";
        }
        elseif(!is_numeric($_POST['nbrequestion'])){
            $nbrequestion=$_POST["nbrequestion"];
            
            $error="Veuillez saisir un nombre";
        }
        elseif($_POST['nbrequestion']<5){
            $nbrequestion=$_POST["nbrequestion"];
            $error="le nombre de question doit etre superieur ou egal a 5";
        }  
        else{
            $nbrquestion=getData("nbrquestions");
            $question=array();
            $question['nbrequestion']=$_POST["nbrequestion"];
            $js[]=$question;
            $js=json_encode($js);
            file_put_contents('data/nbrquestions.json',$js); 
        }
    }
?>
    <div class="right">
        <div id="nombreQuestion">
            <form action="" method="post" id="qstjeux">
                <label for="" id="nnbre">Nbre de question/Jeu</label>
                <input type="text" name="nbrequestion"  error="error-1" id="inputs" >
                <input type="submit" value="OK" id="inputOk" name="btnOK"">
                <div class="error-form" id="error-1">
                    <?php  echo$error; ?>
                </div>
            </form>
        </div>
        <div class="question-body">
        <?php

            for($cpt = $min; $cpt<$max; $cpt++){
                if(isset($liste[$cpt])){
                    $response = $liste[$cpt]["bonneReponse"];
                    $choixMultiple = $liste[$cpt]["reponsePossible"];
                    $type = $liste[$cpt]["type"];

                    ?>
                    <div class="question-content">
                    <?php
                        echo "<h3>",($cpt+1),". ",$liste[$cpt]["libelle"],"</h3>";
                        foreach ($choixMultiple as $key => $value) {
                            if ($type == 'text') {
                                echo '<input type="text" value="',$response,'" class="text" disabled>';
                            }
                            elseif ($type == 'multiple') {
                                if (in_array($value,$response)) {
                                    echo '<input type="checkbox" checked disabled> <h4 class="question-show">',$value,'</h4><br/>';
                                }
                                else{
                                    echo '<input type="checkbox" disabled> <h4 class="question-show">',$value,'</h4><br/>';
                                }
                            }
                            elseif ($type == 'simple') {
                                if ($value == $response) {
                                    echo '<input type="radio" checked disabled> <h4 class="question-show">',$value,'</h4><br/>';
                                }
                                else{
                                    echo '<input type="radio" disabled> <h4 class="question-show">',$value,'</h4><br/>';
                                }
                            }
                        }
                    ?>
                    </div>
                    <?php
                }
            }
        ?>
        </div>
        <div class="paginate-zone">
        <a class="prev" href="index.php?lien=accueil&block=listequestion&page=<?= $page-1 ?>"><button>Précédent</button> </a>
        <a href="index.php?lien=accueil&block=listequestion&page=<?= $page+=1?>" class="next"> <button>suivant</button> </a>
        </div>
    </div>
<script>
   const inputs = document.getElementsByTagName("input");
    for(input of inputs){
        input.addEventListener("keyup", function(e){
            if (e.target.hasAttribute("error")) {
                var idDivError = e.target.getAttribute("error");
                document.getElementById(idDivError).innerHTML=""
            }
        })
    }
    document.getElementById("qstjeux").addEventListener("submit", function(e){
        const inputs = document.getElementsByTagName("input");
        var error = false;
        for(input of inputs){
            if (input.hasAttribute("error")) {
                var idDivError = input.getAttribute("error");
                if (!input.value) {
                    document.getElementById(idDivError).innerText = "Ce champs est obligatoire"
                    error = true
                }
                else if (input.value<5) {
                    document.getElementById(idDivError).innerText = "le nombre de question doit etre superieur ou egal a 5"
                    error = true
                }
            }
        }
    if (error) {
        e.preventDefault();
        return false;
    }
    })
</script>

