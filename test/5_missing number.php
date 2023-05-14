<?php

function missing($list){
    $new = range($list[0],max($list));
    return array_diff($new,$list);
}

// $arr = explode(' ', readline("enter numbers "));
// print_r(missing($arr). "/n");

print_r(missing(array(1,2,3,6,7,8)));
?>