<?php
    function premier($nbre){
        $tab[0]=2;
        $tab[1]=3;
        $tab[2]=5;
        for ($i=5; $i <=$nbre ; $i++) { 
            $div=0;
            $j=0;
            do{
                if($i % $tab[$j]==0){
                    $div=1;
                }
                if($div==1){
                    break;
                }
                $j++;
            }while(($i/2)+1>$tab[$j-1]);
            if($div==0){
                $tab[]=$i;
            }
        }
        return $tab;
    }
    function moyenne($tab){
        $somme=0;
        for ($i=0; $i <count($tab); $i++) { 
            $somme+=$tab[$i];
        }
        $moyenne=$somme/count($tab);
        return $moyenne;
    }
    function afficheTabPremier($tab){
        
        $elementsParPage=100; 
 
        //nombre element du tab
        $total=count($tab);
 
        //determinons le nbre des pages
        $nombreDePages=ceil($total/$elementsParPage);
        if(isset($_GET['page'])){
            $pageActuelle=intval($_GET['page']);
            if($pageActuelle>$nombreDePages) {
                $pageActuelle=$nombreDePages;
            }
        }
        else {
            $pageActuelle=1;    
        }
        $premiereEntree=($pageActuelle-1)*$elementsParPage; // On calcule la première entrée à lire
        $cpt=0;
        echo "<table  border='1' style='margin-top:10px;' align='center'><tr>";
        for ($i=$premiereEntree; $i < ($premiereEntree+$elementsParPage); $i++) { 
            if($i==count($tab))
                break;
            $cpt++;            
            echo '<td>'.$tab[$i].'</td>';
            if($cpt==10){
                echo '</tr>';
                $cpt=0;
            }
        }
        echo '</table>';
        echo '<p align="center">Page : '; 
        for($i=1; $i<=$nombreDePages; $i++){
            if($i==$pageActuelle){
                echo ' [ '.$i.' ] '; 
            }
            else {
                echo ' <a href="exo1.php?page='.$i.'">'.$i.'</a> ';
            }
        }
        echo '</p>';
    }
    function testAlphabetic($lettre){
        return ( ($lettre>="a" && $lettre<="z" ) || ($lettre>="A" && $lettre<="Z") );
    }
    function testOrange($numero){

        $reg ='#^77[ ]?[0-9]{3}([ ]?[0-9]{2}){2}$#';
         $reg1 = '#^78[ ]?[0-9]{3}([ ]?[0-9]{2}){2}$#';
             if (preg_match($reg,$numero)|| preg_match($reg1,$numero)) {
                 $ok = "vrai";
             }else{
                 $ok = "faux";
             }
             return  $ok;
     }

     function testFree($numero){

         $reg ='#^76[ ]?[0-9]{3}([ ]?[0-9]{2}){2}$#';
              if (preg_match($reg,$numero)) {
                  $ok = "vrai";
              }else{
                  $ok = "faux";
              }
              return  $ok;
      }

      function testExpresso($numero){

         $reg ='#^70[ ]?[0-9]{3}([ ]?[0-9]{2}){2}$#';
              if (preg_match($reg,$numero)) {
                  $ok = "vrai";
              }else{
                  $ok = "faux";
              }
              return  $ok;
      }
?>