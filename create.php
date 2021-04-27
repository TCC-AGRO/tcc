<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$name = $email = $senha = $confirmação_de_senha= $rua = $n_casa = $bairro = "";
$name_err = $email_err = $senha_err = $confirmação_err = $rua_err = $n_casa_err = $bairro_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_name = trim($_POST["nome"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    
    // Validate senha
   
    //if($input_senha){
       // $senha_err = "Please enter an senha.";     
    //} else{
       // $senha = $input_senha;
    //}
    // valida email
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "digitar email.";     
    } else{
        $email = $input_email;
    }
    // Validate confirmação
    //if ($input_confirmação_de_senha = $input_senha) 
    
        //if(  $input_confirmação_de_senha = $senha){
        //  echo "ok" ;     
       // } else{
       //     $confirmação_err = "senha incorreta";
       // }

    
    // Validate rua
    $input_rua = trim($_POST["rua"]);
    if(empty($input_rua)){
        $rua_err = "Please enter the rua amount.";     
    } elseif(!filter_var($input_rua)){
        $rua_err = "Please enter a positive integer value.";
    } else{
        $rua = $input_rua;
    }
    // Validate numero da casa
    $input_ncasa = trim($_POST["numerodacasa"]);
    if(empty($input_ncasa)){
        $n_casa_err = "Please enter the rua amount.";     
    } elseif(!filter_var($input_ncasa)){
        $n_casa_err = "Please enter a positive integer value.";
    } else{
        $n_casa = $input_ncasa;
    }
    // Validate bairro
    $input_bairro = trim($_POST["bairro"]);
    if(empty($input_bairro)){
        $bairro = "Please enter the rua amount.";     
    } elseif(!filter_var($input_bairro)){
        $bairro = "Please enter a positive integer value.";
    } else{
        $bairro = $input_bairro;
    }
    // Check input errors before inserting in database
    if(empty($name_err) && empty($email_err) && empty($senha_err) && empty($confirmação_err)&& empty($rua_err)&& empty($n_casa)&& empty($bairro)){
        // Prepare an insert statement
        $sql = "INSERT INTO tcc (name,email, senha, confirmação de senha, rua, n_casa, bairro) VALUES (:name, :email, :senha, :confirmação de senha, :rua, :n_casa, :bairro)";
 
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":name", $param_name);
            $stmt->bindParam(":email", $param_email);
            $stmt->bindParam(":senha", $param_senha);
            $stmt->bindParam(":confirmação de senha", $param_confirmação);
            $stmt->bindParam(":rua", $param_rua);
            $stmt->bindParam(":numerodacasa", $param_n_casa);
            $stmt->bindParam(":bairro", $param_bairro);

            // Set parameters
            $param_name = $name;
            $param_email = $email;
            $param_senha = $senha;
            $param_confirmação_de_senha= $confirmação_de_senha;
            $param_rua = $rua;
            $param_n_casa = $n_casa;
            $param_bairro = $bairro;

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        unset($stmt);
    }
    
    // Close connection
    unset($pdo);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
        body {
            background-color :#92C47D;
        }
    </style>
</head>
<body >
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Cadastre-se</h2>
                    </div>
                    <!--<p>Please fill this form and submit to add employee record to the database.</p>-->
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> "  method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Nome</label>
                            <input type="text" name="nome" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                            <label>e-mail</label>
                            <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                            <span class="help-block"><?php echo $email_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($senha_err)) ? 'has-error' : ''; ?>">
                            <label>senha</label>
                            <input type="text"name="senha" class="form-control"><?php echo $senha; ?>
                            <span class="help-block"><?php echo $senha_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($confirmação_err)) ? 'has-error' : ''; ?>">
                            <label>Confirmação de senha</label>
                            <input type="text" name="confirmação" class="form-control" value="<?php echo $confirmação_de_senha; ?>">
                            <span class="help-block"><?php echo $confirmação_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($rua_err)) ? 'has-error' : ''; ?>">
                            <label>Rua</label>
                            <input type="text" name="rua" class="form-control" value="<?php echo $rua; ?>">
                            <span class="help-block"><?php echo $rua_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($rua_err)) ? 'has-error' : ''; ?>">
                            <label>Numero da casa</label>
                            <input type="text" name="numerodacasa" class="form-control" value="<?php echo $n_casa; ?>">
                            <span class="help-block"><?php echo $n_casa_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($rua_err)) ? 'has-error' : ''; ?>">
                            <label>Bairro</label>
                            <input type="text" name="bairro" class="form-control" value="<?php echo $bairro; ?>">
                            <span class="help-block"><?php echo $bairro_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="cadastrar">
                        <a href="index.php" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>