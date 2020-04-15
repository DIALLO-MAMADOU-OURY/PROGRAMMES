<?php 
function is_lower($char){
    return ($char>='a' && $char<='z');
}

function is_upper($char){
    return ($char>='A' && $char<='Z');
}

function is_entier($char){
    return ($char>='0' && $char <='9');
}

function my_strlen($tabouChaine){
    $i=0;
    while (!empty($tabouChaine[$i])) {
        $i++;
    } 
    return $i;
}   

function is_valide($mot){
    for ($i=0; $i < my_strlen($mot); $i++) { 
        if (!(is_upper($mot[$i]))&&!(is_lower($mot[$i]))) {
            return false;
        }
    }
    return true;
} 

function is_number($nbr){
    for ($i=0; $i < my_strlen($nbr); $i++) { 
        if (!(is_entier($nbr[$i]))) {
            return false;
        }
    }
    return ($nbr>0); 
} 

function is_char_in_string($char,$mot){
    for ($i=0; $i < my_strlen($mot); $i++) { 
        if ($mot[$i]==$char) {
            return true;
        }
    }
    return false;
} 

function count_char_in_string($char,$mot){
    $n=0;
    for ($i=0; $i < my_strlen($mot); $i++) { 
        if ($mot[$i]==$char) {
            $n++; 
        }
    }
    return $n;
} 

?>
