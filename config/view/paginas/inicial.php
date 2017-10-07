<!doctype html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>JAShoutBox | Dash</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
          integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
</head>
<body>
    
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h3>JAShoutBox</h3>
                <form action="" method="post" id="ja_shoutbox">
                  <div class="row">
                        <div class="col-md-12">
                              <textarea cols="30" rows="20" class="form-control" readonly style='resize:none' placeholder='Mensagens...'></textarea>
                        </div>
                        <div class="col-md-8">
                              <input type="text" placeholder="Escreva sua mensagem..." class="form-control" name="mensagem">
                        </div>
                        <div class="col-md-4">
                              <input type="submit" value="Enviar mensagem" class="form-control btn btn-info">
                        </div>
                        <div class='col-md-12 alert alert-info' style='display:none' id='msg'>

                        </div>
                  </div>
                </form>
            </div>
        </div>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
        integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<script src="<?php echo JoaoArtur::carregarArquivo('js/chat.js'); ?>"></script>
</body>
</html>