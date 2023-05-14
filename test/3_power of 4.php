<?php
function power($no)
{
  if($no <= 0)
    return "no is not power of 4";
  
    elseif($no % 4===0)
    return power($no/4);

    elseif($no==1){
        return "power of 4";
    }
    return "not power of 4";
}
$a = readline('Enter a string: ');
echo(power($a ). "\n");

?>