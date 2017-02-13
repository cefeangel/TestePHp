<?php
session_start();

require_once './controleEntidade/ControleCO2.php';
$objControle = new ControleCO2();



$dados = $objControle->buscarConfiguracoesModulo('CO2');
$arrayCamposObrigatorios = null;
$valorQuilo = null;
$valorKm = null;
$jsonString = null;
//print_r($dados);

if ($dados['id'] == '') {
    $dados['id'] = 0;
    $dados['ativo'] = '';
    $arrayCamposObrigatorios['TipoVeiculo'] = '';
} else {
    $arrayCamposObrigatorios = json_decode($dados['arrayConfiguracoes'], true);
    $key = array_keys($arrayCamposObrigatorios['Quilo']);

    $valorQuilo = $arrayCamposObrigatorios['Quilo'][$key[0]];
    $key = array_keys($arrayCamposObrigatorios['Km']);

    $valorKm = $arrayCamposObrigatorios['Km'][$key[0]];

    $jsonString = $dados['arrayConfiguracoes'];
}


/**
 * chamada atraves do painel
 */
$url = $_SERVER['HTTP_HOST']; // monta o URL
$url = str_replace('www.', '', $url); // remove o www. se houver


if (isset($_SESSION['expresso']['nome'])) {
    ?>
    <!DOCTYPE html>
    <html lang="pt-BR">
        <head>
            <meta charset="utf-8"/>
            <title>Módulo CO2</title>
            <?php
            require_once('../includes/heads2nivel.php');
            require_once('./scriptCO2.php');
            ?>
            <script src="../js/jquery.mask.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            <!--resolver problema de cook navegado-->


            <script>
                if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
                    // safari não aceita gravar cookies
                    //            alert("Browser is Safari");         
                } else {
                    if (typeof (Storage) !== "undefined") {
                        var sessao = "valorfretezoom";
                        if (localStorage.getItem(sessao)) {
                            //                alert('existe');
                        } else {
                            //                alert("nao existe")
                            localStorage.setItem(sessao, "S");
                            window.location.reload(true);
                        }


                    }

                }
            </script>
        </head>
        <body>
            <section class="container-fluid" style="min-height: 600px;">


                <div class="row">
                    <div class="col-md-12">
                        <h4 class="text-center text-info">
                            Configuração para Módulo CO2
                        </h4>

                    </div>
                </div>
                <hr />
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <p>
                            Tendo este módulo ativo, você poderá exibir para seus clientes
                            o consumo de CO2 por km de acordo com suas configuraçãos do tipo de veiculo
                        </p>
                        <p>
                            Eles poderão obter realtórios de quantos kilos de CO2 produziram em um mês ou determinado período.
                        </p>
                        <p>
                            "A queima de um litro de gasolina produz 2,3035 kg de CO2"

                            <a href="http://www.sunearthtools.com/pt/tools/CO2-emissions-calculator.php" target="_blank">
                                Fonte desta informação
                            </a>
                        </p>

                    </div>
                </div>
                <hr />
                <?php
                if ($dados['ativo'] == 'S') {
                    ?>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-4">
                            <label>
                                Módulo CO2 está ativado
                            </label>
                        </div>
                        <div class="col-md-4">
                            <div id="divDesativar"></div>
                            <input type="button" value="Desativar" class="btn btn-danger" onclick="ativarProfissionalIndica('divDesativar', 'N', 'ajaxs/ajaxAtivarDesativar.php');" />
                        </div>

                    </div>
                    <hr />
                    <?php
                } elseif ($dados['ativo'] == 'N') {
                    ?>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-4">
                            <label>
                                Módulo CO2 está desativado
                            </label>
                        </div>
                        <div class="col-md-4">
                            <div id="divAtivar"></div>
                            <input type="button" value="Ativar" class="btn btn-success" onclick="ativarProfissionalIndica('divAtivar', 'S', 'ajaxs/ajaxAtivarDesativar.php');" />
                        </div>

                    </div>
                    <hr />
                    <?php
                } else {
                    ?>      
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="row alert alert-info">

                                <label class="">
                                    Você ainda não adquiriu o Módulo Profissional Indica
                                    <a href="" class="btn btn-primary" id="teste" style="margin-left: 200px">Adquirir / Saber mais</a>
                                </label>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <?php
                }
                ?>

                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <input id="jsonString" type="hidden"   value='<?php ($arrayCamposObrigatorios['TipoVeiculo'] != '') ? print $jsonString : null; ?>' >
                        <?php require_once './verificarTipoVeiculo.php'; ?>
                    </div>

                </div>
                <hr />    
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <label for="km">Km por litro </label>
                        <input id="km" type="text" class="form-control"  style="width: 100px" value="" name="km" placeholder="Km">
                    </div>
                </div>
                <hr /> 
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <label for="quilo">Quilo por litro </label>
                        <input id="quilo" type="text" class="form-control" style="width: 100px" value="" name="km" placeholder="Quilo">
                    </div>
                </div>
                <hr />
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <p>
                            Coloque aqui a informação que irá aparecer para seu cliente no ato da solicitação do serviço
                            <br />
                            Exemplo: veja a imagem<br />
                            Você escreve o que irá aparecer antes e depois do valor
                            <img src="mco2exemplo.jpg" width="" alt="mco2exemplo"/>

                        </p>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Insira o texto que será exibido ANTES do valor *:</label>
                                <input id="msg_antes" type="text" class="form-control"  value="" name="msg_antes" placeholder="Antes do valor (Irá gerar:)">                                
                            </div>
                            <div class="col-md-3 text-center">
                                <br />
                                Sistema exibe o valor
                            </div>
                            <div class="col-md-4">
                                <label>Insira o texto que será exibido APÓS o valor:</label>
                                <input id="msg_depois" type="text" class="form-control"  value="" name="km" placeholder="Mensagem após o valor calculado pelo sistema">
                            </div>
                        </div>  

                    </div>
                </div>
                <hr />
                <div class="row"  >
                    <div class="col-md-2">


                    </div>
                    <div class="col-md-2">
                        <div id="divRetornoCadAlterar"></div>
                    </div>
                    <div class="col-md-6 col-md-offset-1">
                        <?php
                        if ($dados['ativo'] != '' && $dados['ativo'] != null) {
                            ?>
                            <input type="button" value="Salvar / Alterar" class="btn btn-primary" onclick="salvarAlterarConfig('divRetornoCadAlterar', '<?php echo $dados['id']; ?>');" style="margin-top: 5px;" />
                            <?php
                        }
                        ?>
                    </div>
                </div>

            </section>
            <div class="row-fluid">
                <div class="span12">
                    <?php
//                    require_once('../includes/rodape.php');
                    ?>
                </div>
            </div>
        </body>
    </html>
<?php } else {
    ?>

    <script language ="javascript">
        //        alert('FAVOR LOGAR');
        location.href = '../index.php';
    </script>

    <?php
}
?>

