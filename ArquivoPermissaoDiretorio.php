<?php

    $pasta = "./dirPhp";

if(file_exists($pasta) ){
    echo "O arquivo $pasta existe";
    echo "<br>";
    
//    if(chmod($pasta, 0755))
//    {
//        echo 'Permissão modificada com sucesso.';
//    }
//    else
//    {
//        echo 'Não foi possível alterar permissão';
//    }
}else{
    echo "O arquivo $pasta Não existe";
    if (mkdir('dirPhp' , 0760)){
        echo 'Pasta Criada';
    }else{
         echo 'Error Pasta Não Criada';
    }
}
    

?>