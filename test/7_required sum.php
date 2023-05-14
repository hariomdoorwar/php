<?php
function sum($arr,$val)
{
$count = count($arr) - 2;
$result=[];
for ($x = 0; $x < $count; $x++) 
{
    if ($arr[$x] + $arr[$x+1] + $arr[$x+2] == $val)
    {
        array_push($result, "{$arr[$x]} + {$arr[$x+1]} + {$arr[$x+2]} = $val");
    }
}
return $result;
}
$arr= array(2, 7, 7, 1, 8, 2, 7, 8, 7);
print_r(sum($arr, 16));



?>