<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 600px;
            margin: 0 auto;
           
        }
        body,html{
            width: 100%;
            height: 100%;
        }
        #test{
            position:relative;
            width: 100% !important;
            height: 100% !important;
            background-image: url(fachada.png);
            background-repeat:no-repeat;
            background-size:100% 100%; 
        
        }
        #fundo-externo {
            overflow: hidden; /* para que não tenha rolagem se a imagem de fundo for maior que a tela */
            width: 100%;
            height: 100%;
            position: relative; /* criamos um contexto para posicionamento */
}

        /*#test {
            position: fixed;  posição fixa para que a possível rolagem da tela não revele espaços em branco 
            width: 100% !important;
            height: 100% !important;
            background-size:100% 100%; 
            background-repeat:no-repeat;
            position:relative ; 
            
}*/

        #fundo img {
            width: 100% !important; /* com isso imagem ocupará toda a largura da tela. Se colocarmos height: 100% também, a imagem irá distorcer */
            position: absolute;
            
}
        .page-header h2{
            padding-bottom: 5px;
            margin: 37px -7px 2px;
            border-bottom: 2px solid #eee;
        }
       
        
        table tr td:last-child a{
            margin-right: 15px;
        }
        #site {
            position: absolute;
    top: 91px;
    left: 52%;
    width: 568px;
    padding: 136px;
    margin-left: -300px;
    background:rgba(45, 15, 15, 0.9);
    height: 489px;
    border-radius:15px;
}
        p{
            margin-bottom: 1.5em;
            margin: 37px -8px 21px;
            width: 343px;
            font-size:15px;
            color: rgba(135,205, 6);
        }
        h1, .h1 {
    font-size: 30px;
    margin-top: -39px;
    margin-bottom: 10px;
    font-family: inherit;
    font-weight: 500;
    line-height: 1.1;
    color:rgba(135,205, 6);
}
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
        // Função adaptImage()
// Parâmetros: targetimg (objeto jquery com elementos selecionados)
function adaptImage(targetimg) {
    var wheight = $(window).height(); // altura da janela do navegador
    var wwidth = $(window).width(); // largura da janela do navegador

    // removemos os atributos de largura e altura da imagem
    targetimg.removeAttr("width")
    .removeAttr("height")
    .css({ width: "", height: "" }); // removemos possíveis regras css também

    var imgwidth = targetimg.width(); // largura da imagem
    var imgheight = targetimg.height(); // altura da imagem

    var destwidth = wwidth; // largura que a imagem deve ter
    var destheight = wheight; // altura que a imagem deve ter

    // aqui vamos determinar o tamanho final da imagem
    if(imgheight < wheight) {
    // se a altura da imagem for menor que a altura da tela, fazemos um cálculo
    // para redefinir a largura da imagem para bater com a altura que queremos
    destwidth = (imgwidth * wheight)/imgheight;

    $('#fundo img').height(destheight);
        $('#fundo img').width(destwidth);
    }

    // aqui utilizamos um cálculo simples para determinar o posicionamento da imagem
    // para que a mesma fique no meio da tela
    // posição = dimensão da imagem/2 - dimensão da tela/2
    destheight = $('#fundo img').height();
    var posy = (destheight/2 - wheight/2);
    var posx = (destwidth/2 - wwidth/2);

    //se o cálculo das posições der resultado positivo, trocamos para negativo
    if(posy > 0) {
    posy *= -1;
    }
    if(posx > 0) {
    posx *= -1;
    }

    // colocamos através da função css() do jquery o posicionamento da imagem
    $('#fundo').css({'top': posy + 'px', 'left': posx + 'px'});
    }

    //quando a janela for redimensionada, adaptamos a imagem
    $(window).resize(function() {
    adaptImage($('#fundo img'));
});

//quando a página carregar, fazemos o mesmo
$(window).load(function() {
    $(window).resize();
});
    </script>
</head>
<body  id="test">
       
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        
                            <!--<h2 class="pull-left">Agro Roque</h2>-->
                            <a href="create.php" class="btn btn-success pull-right">Cadastrar-se</a> 
                            <a href="login.php" class="btn btn-success pull-right">Login</a> 
                        </div>
                        <?php
                    // Include config file
                        require_once "config.php";
                    
                    // Attempt select query execution
                        $sql = "SELECT * FROM cliente";
                        if($result = $pdo->query($sql)){
                        if($result->rowCount() > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Address</th>";
                                        echo "<th>Salary</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch()){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['address'] . "</td>";
                                        echo "<td>" . $row['salary'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='read.php?id=". $row['id'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a href='update.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='delete.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            unset($result);
                        } else{
                            //echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
                    }
                    
                   // Close connection
                    unset($pdo);
                        ?>
                    </div>
                </div>        
            </div>
        </div>
        <div id="site">
    <h1>AGRO ROQUE </h1>
    <p>
      Uma agropecuária funda por familiares, ergueu-se pelo interresse por animais dos proprietários.
    </p>
    <p>
      Katia ..... e Alexandre ...... residem no múcipio de Balneario Gaivota, no bairro Figueirinha onde antes de terem a agropecuária criavam diversos tipos de animais (.....).
      <p>
      Localizada também no municipio de Balneário Gaivota, AGRO ROQUE se encontra na Rod. José Tiscoski, 3079 - Lagoa de Fora.
      </p>              
    </p>
    </div>
</body>
</html>