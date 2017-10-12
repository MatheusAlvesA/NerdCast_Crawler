<?php
require_once('libs/controller.php');

if(isset($_GET['pendentes'])) {
    echo json_encode(get_lista_novos());
    exit();
}
if(isset($_GET['log'])) {
    echo json_encode(get_log());
    exit();
}
if(isset($_GET['progresso'])) {
    echo get_progresso();
    exit();
}
if(isset($_GET['motor'])) {
    motor();
    exit();
}

?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>NerdCast Crawler</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body style="margin-top: 30px;">
        
        <div class="row">
            <div role="main" class="col-md-3">
              <div class="panel panel-success">
                  
                <div class="panel-heading" style="text-align: center;">
                  <b>Log dos ultimos baixados</b>
                </div>
                
                <div id="painelLogs" class="panel-body" style="overflow: hidden;">
                </div>
                
              </div>
        </div>
          <div role="main" class="col-md-5">

              <div class="panel panel-info">
                <div class="panel-heading" style="text-align: center;">
                  <b>Motor Principal</b>
                </div>
                <div class="panel-body">
                    <div class="progress">
                      <div id="barraProgresso" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                      </div>
                    </div>
                    <hr>
                    <p>Estado do motor:
                    <a href="#" class="btn btn-success btn-lg" style="float: right;" onclick="motor()">
                      <span id="iconeMotor" class="glyphicon glyphicon-off" style="color: #CD2626"></span>
                    </a>
                  </p> 
                </div>
              </div>
              
          </div>
          
            <div role="main" class="col-md-4">

                <div class="panel panel-primary">
                    <div class="panel-heading" style="text-align: center;">
                      <b>Pendentes</b>
                    </div>
                    <div id="painelDownloadsPendentes" class="panel-body" style="overflow: hidden;">
                    </div>
                </div>
            </div>

    </div>

        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script type="text/javascript">
                ler_dados();
                
            function ler_dados() {
                get_pendentes();
                setInterval(get_pendentes, 30000);
                
                get_log();
                setInterval(get_log, 5000);
                
                get_progresso();
                setInterval(get_progresso, 3000);
            }
            
            function get_pendentes() {
                $.ajax({
                          method: "GET",
                          url: "index.php?pendentes"
                        }).done(function(retorno) {
                            var lista = JSON.parse(retorno);
                            var texto = '';
                            lista.forEach(function (item, index) {
                                texto += '<p>' + item + '</p>'
                            });
                            document.getElementById('painelDownloadsPendentes').innerHTML = texto;
                });
            }
            
             function get_log() {
                $.ajax({
                          method: "GET",
                          url: "index.php?log"
                        }).done(function(retorno) {
                            var lista = JSON.parse(retorno);
                            var texto = '';
                            lista.forEach(function (item, index) {
                                texto += '<p>' + item + '</p>'
                            });
                            document.getElementById('painelLogs').innerHTML = texto;
                });
            }
            
            function get_progresso() {
                $.ajax({
                          method: "GET",
                          url: "index.php?progresso"
                        }).done(function(retorno) {
                            var progresso = parseFloat(retorno);
                            $("#barraProgresso").css('width', progresso + '%').attr('aria-valuenow', progresso).text(progresso.toFixed(2)+'%');
                });
            }
            
            var intervalo_motor = null;
            function motor() {
                if(intervalo_motor === null) {
                    intervalo_motor = setInterval(baixar, 1000);
                    $("#iconeMotor").css('color', '#00EEEE');
                }
                else {
                    clearInterval(intervalo_motor);
                    $("#iconeMotor").css('color', '#CD2626');
                    intervalo_motor = null;
                }
            }
            
            var ultima_requisicao = 0;
            function baixar() {
                var d = new Date();
                if((d.getTime() - ultima_requisicao) > 60*1000) {
                    $.ajax({
                        method: "GET",
                        url: "index.php?motor"
                    }).then(function (r) {
                        ultima_requisicao = 0;
                    });
                    ultima_requisicao = d.getTime();
                }
            }
        </script>
    </body>
</html>