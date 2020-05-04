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
    <div class="right">
        <div id="nombreQuestion">
            <form action="" method="post">
                <label for="" id="nnbre">Nbre de question/Jeu</label>
                <input type="text" name="" id="inputs" value="<?php echo $max ?>">
                <input type="submit" value="OK" id="inputOk" name="ok">
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
        <a href="index.php?lien=accueil&block=listequestion&page=<?= $page+=1?>" class="next"> <button>suivat</button> </a>
        </div>
    </div>

