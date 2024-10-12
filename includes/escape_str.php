<?php
function mysql_prep($value){
$magic_quotes_active = get_magic_quotes_gpc();
$new_enough_php = function_exists("mysqli_real_escape_string");
//i.e php >= v4.3.0
if($new_enough_php){// php v.4.3.0 or higher
//undo any magic quotes effects so mysql_real_escape_string can do the work
if($magic_quotes_active){ $value = stripslashes($value); }
$value = mysqli_real_escape_string($conn, $value);
}
else
{ // before php v4.3.0
// if magic quotes aren't already on then add slashes manually 
if(!$magic_quotes_active){ $value = addslashes($value); }
// if magic quotes are active then the slashes already exist
}
return $value;
}
?>