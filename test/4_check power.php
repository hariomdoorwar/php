<?php
function power($n1,$n2)
{
  if($n1 <= 0)
    return "not power";
  
    elseif($n1 % $n2===0)
    return power($n1/$n2,$n2);

    elseif($n1==1){
        return "power";
    }
    return "not power";
}
$a = readline('Enter a number1: ');
$b = readline('Enter a number1: ');
echo(power($a,$b ). "\n");

?>