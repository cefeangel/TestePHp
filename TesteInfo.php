<?Php 
////
//define ( 'debug', false);
////   echo date('Y-m-d H:i'). '<br />'; 
//if (debug == true) 
//{ 
//    ini_set ( 'display_errors', 'on'); 
//    error_reporting (E_ALL); 
//} 
//else 
//{ 
//    ini_set ( 'display_errors', 'Off'); 
//    error_reporting (0); 
//}
//phpinfo();


//$txt = 'C/DEV/Desktop/Livroslocalhostrespondido2.txt';
$arquivo = fopen ('localhostind-2.txt', 'r');
	
$txt = '';
while(!feof($arquivo))
{
$linha = fgets($arquivo, 1024);
    
    echo preg_replace('/\r\n/',',', $linha);

}
echo $txt;

fclose($arquivo);

?> 
