<?php

$txt = <<<MSG
       <div class="alert alert-warning">
  <strong>Warning!</strong> Indicates a warning that might need attention.
</div>
MSG;

echo $txt;
$b = array();
$a = array("Java"=>1.2,"Php"=>8.0);


$c = array_merge($a, $b);

var_dump($c);

?>