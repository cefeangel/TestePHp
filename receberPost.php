<?php

//print_r($_POST);

$str="data:image/png;base64,"; 
$data=str_replace($str,"",$_POST['base64']); 
$data = base64_decode($data);
file_put_contents('img/'.mktime().'.jpg', $data);
?>
<img src="<?phpe echo $_POST['base64']; ?>" />