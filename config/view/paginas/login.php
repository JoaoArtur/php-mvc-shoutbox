<!doctype html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>JAShoutBox | Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
          integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
</head>
<body>
    
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h3>Login</h3>
                <form action="" method="post">
                    <input type="text" placeholder="Usuario" name="dados[usuario]" class="form-control">
                    <input type="password" placeholder="Senha" name="dados[senha]" class="form-control">
                    <input type="submit" value="Entrar" class="btn btn-info">
                </form>
                <?php
                    if (isset($_POST['dados'])) {
                        $logar = JoaoArtur::logar();
                        if ($logar) {
                            ?>
                            <p>Logado com sucesso! Aguarde alguns segundos...</p>
                            <script>
                                setTimeout(function() {
                                    location.href = './';
                                },500);
                            </script>
                            <?php
                        } else {
                            echo "<p>Usuario e/ou senha incorretos!</p>";
                        }
                    }
                ?>
            </div>
        </div>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
        integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</body>
</html>