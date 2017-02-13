<?php

class  ComprimirArquivos {
 
    private $source_path;
    private $destination_path;
    private $quality;
    private $arrayArquivo;
    
    public function __construct($source_path,$destination_path,$quality) {
        
        $this->source_path = $source_path;
        $this->destination_path = $destination_path;
        $this->quality = $quality;
    }
    
    private function compressImage($source_path, $destination_path, $quality) {
        
            $info = getimagesize($source_path);

            if ($info['mime'] == 'image/jpeg') {
                $image = imagecreatefromjpeg($source_path);
            } elseif ($info['mime'] == 'image/png') {
                $image = imagecreatefrompng($source_path);
            }

            imagejpeg($image, $destination_path, $quality);

            return $destination_path;
    }
    
    private function listarArquivoDiretorio($dir){
    
        // array que armazena lista de arquivos do diretorio informado
        $arrayFile = array();
        // esse abrindo o diretório
        $dh = opendir($dir); 
        // loop que busca todos os arquivos até que não encontre mais nada
        while (false !== ($filename = readdir($dh))) { 
        // verificando se o arquivo é .jpg ou .png
            if (substr($filename,-4) == ".jpg" || substr($filename,-4) == ".png" ) { 

                array_push($arrayFile, $filename);
            }
        }

        return $arrayFile;
    }
    
    public function  compressarArquivosDiretorio(){
        
        $this->arrayArquivo = $this->listarArquivoDiretorio($this->source_path);
        
         foreach ( $this->arrayArquivo as $value) {
         
            $pathOrigem = $this->source_path.$value;
            $pathDestino =  $this->destination_path.$value;

            $this->compressImage($pathOrigem, $pathDestino, $this->quality);
         
        }
        
    }

}



//function listarArquivo($dir){
//    
//    // array que armazena lista de arquivos do diretorio informado
//    $arrayFile = array();
//    // esse abrindo o diretório
//    $dh = opendir($dir); 
//    // loop que busca todos os arquivos até que não encontre mais nada
//    while (false !== ($filename = readdir($dh))) { 
//    // verificando se o arquivo é .jpg ou .png
//        if (substr($filename,-4) == ".jpg" || substr($filename,-4) == ".png" ) { 
//
//            array_push($arrayFile, $filename);
//        }
//    }
//    
//    return $arrayFile;
//}
//
//$arrayFile = listarArquivo("img/");
// 
// function  compressaImagens($arrayFile,$pathOrigem,$pathDestino,$quality){
//     
//     foreach ($arrayFile as $value) {
//         
//        $source_path = $pathOrigem.$value;
//        $destination_path = $pathDestino.$value;
//        
//        compressImage($source_path, $destination_path, $quality);
//         
//     }
//     
//     
// }
// 
// compressaImagens($arrayFile, "img/", "b64/", 40);

?>