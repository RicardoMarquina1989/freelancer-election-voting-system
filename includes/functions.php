<?php
function redirect_to($location = NULL){
if($location !=NULL){
header("location:{$location}");
exit;
}
}
?>
<?php
function mysql_prep($value){
$magic_quotes_active = get_magic_quotes_gpc();
$new_enough_php = function_exists("mysqli_real_escape_string");
//i.e php >= v4.3.0
if($new_enough_php){// php v.4.3.0 or higher
//undo any magic quotes effects so mysql_real_escape_string can do the work
if($magic_quotes_active){ $value = stripslashes($value); }
$value = mysqli_real_escape_string($value);
}
else
{ // before php v4.3.0
// if magic quotes aren't already on then add slashes manually 
if(!$magic_quotes_active){ $value = addslashes($value); }
// if magic quotes are active then the slashes already exist
}
return $value;
}
function custom_echo($text, $length){
	if(strlen($text)<=$length){
		echo $text;
	}else{
		$text2 = substr($text, 0,$length) . "...";
		echo $text2;
	}
}
function format_date($date_val){
	$date = date('d-M-Y',strtotime($date_val));
	echo $date;
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
function num_format($number_val){
	$number_val = number_format($number_val, 2, '.', ',');
	return $number_val;
}
function reCaptcha($recaptcha){
  $secret = "6Lf-GPgdAAAAAH1CNTbUFRQLF0g3mSkzbBTbFpzS";
  $ip = $_SERVER['REMOTE_ADDR'];
  $postvars = array("secret"=>$secret, "response"=>$recaptcha, "remoteip"=>$ip);
  $url = "https://www.google.com/recaptcha/api/siteverify";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_TIMEOUT, 10);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
  $data = curl_exec($ch);
  curl_close($ch);
  return json_decode($data, true);
}
function file_newname($path, $filename){
    if ($pos = strrpos($filename, '.')) {
           $name = substr($filename, 0, $pos);
           $ext = substr($filename, $pos);
    } else {
           $name = $filename;
    }
    $newpath = $path.'/'.$filename;
    $newname = $filename;
    $counter = 1;
    while (file_exists($newpath)) {
           $newname = $name .'_'. $counter . $ext;
           $newpath = $path.'/'.$newname;
           $counter++;
     }
    return $newname;
}
?>