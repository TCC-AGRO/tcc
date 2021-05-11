<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
 $email = $senha = "";
 $email_err = $senha_err = "";
 

    
    // Validate senha
   
    if(empty($input_senha)){
        $senha_err = "Please enter an senha.";     
    } else{
        $senha = $input_senha;
    }
    // valida email
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "";     
    } else{
        $email = $input_email;
    }
    // Check input errors before inserting in database
    if(empty($email_err) && empty($senha_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO tcc (email, senha) VALUES ( :email, :senha)";
 
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            
            $stmt->bindParam(":email", $param_email);
            $stmt->bindParam(":senha", $param_senha);
           

            // Set parameters
            
            $param_email = $email;
            $param_senha = $senha;
            

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
    
    
    // Close connection
    unset($pdo);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
            padding:50px;
        }
        body {
            background-color :#1A1617;
        }
        
            .font{
           color:white;
        }

    </style>
</head>
<body >
<div align="center" id="st">
      <img src="site.jpeg" alt="st">

    </div>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    
                        <h2></h2>
                    </div>
                    <!--<p>Please fill this form and submit to add employee record to the database.</p>-->
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        
                        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                            <label class="font">E-mail</label>
                            <input type="text" name="email"  class="form-control" value="<?php echo $email; ?>">
                            <span class="help-block"><?php echo $email_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($senha_err)) ? 'has-error' : ''; ?>">
                            <label class="font">Senha</label>
                            <input type="text"name="senha" class="form-control"><?php echo $senha; ?>
                            <span class="help-block"><?php echo $senha_err;?></span>
                        
                        <input type="submit" class="btn btn-primary" value="Login">
                        <a href="index.php" class="btn btn-default">Voltar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>