<?php
function power($no)
{
  if($no <= 0)
    return "no is not power of 3";
  
    elseif($no % 3===0)
    return power($no/3);

    elseif($no==1){
        return "power of 3";
    }
    return "not power of 3";
}
$a = readline('Enter a string: ');
echo(power($a ). "\n");

?>