<?php

$path = 'b64/teset6.jpg';
//$type = pathinfo($path, PATHINFO_EXTENSION);
//$data = file_get_contents($path);
//$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);



$base64 =  'data:image/' . $type . ';base64,' .base64_encode(file_get_contents($path));  
echo $base64;
?>
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <title>Hello world</title>
        <!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script type="text/javascript">
            var base64 = '<?php echo $base64;?>';
        
            function teste(){
                
                $.post("receberPost.php", {
                     base64:base64
                },
                     
                       function (retorno) {
                            $('#divVerificaSessaoUsuario').html(retorno);
                }, 'html');
            }
        </script>
        <script type="text/javascript">
            var base64 = '<?php echo $base64;?>';
        
            function teste(){
                
                $.post("receberPost.php", {
                     base64:base64
                },
                     
                       function (retorno) {
                            $('#divVerificaSessaoUsuario').html(retorno);
                }, 'html');
            }
        </script>
    </head>
    <body>
        <div id="divVerificaSessaoUsuario">
<!--            <img src="<?php echo $path; ?>" />-->
        </div>
        <a href="#" onclick="teste();">element1</a>
     
    </body>
</html>