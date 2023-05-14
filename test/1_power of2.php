<?php
function power($no)
{
    if(($no & ($no-1)) ==0){
        
        return "The number is power of 2";
    }
    else {
        return "the number is not power of 2";
    }
}
$a = readline('Enter a string: ');
echo(power($a ). "\n");

?>