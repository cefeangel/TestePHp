<?php
$path = 'http://mappsistemas.com.br/';
//$type = pathinfo($path, PATHINFO_EXTENSION);
//$data = file_get_contents($path);
//$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);



//$base64 =  'data:image/' . $type . ';base64,' .base64_encode(file_get_contents($path));  
$base64 = base64_encode(file_get_contents($path));
?>
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <title>Hello world</title>
       
    </head>
    <body>
        
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <h1><a href="photos-redirect://" id="foto">element1</a></h1>
            <input type="text"  id="teste" value="Angelo">
            <a href="javascript:void(0)" onclick="testEcho('<?php echo $path; ?>');">element2</a>
            <a href="javascript:void(0)" onclick="myFunction(3)">element3</a>
                </div>
            </div>
            
        </div>
        <script type="text/javascript">
            
            function testEcho(message){
                JavaScriptInterface.testSend(message);
            }
        </script>
        
</html>