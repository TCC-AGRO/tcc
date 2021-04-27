<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head >
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
  <style type="text/css">
  body {
      background-color :#92C47D;
        }
  nav#divBusca {
    position: absolute;
    left: 400px;
    top: 25px;
}
#select{
   
    opacity: 1;
    padding: 5px;
    font-size: 1.375em;
}
  </style>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body >
    <header >
      <form action="Racao.php" method="post">
        <nav id="divBusca">
          <input type="text"  placeholder="Buscar..." size="40"/>
          <input type="submit" value="Busca"/>
        </nav>
        <div id="selecao">
          <select name="secao" id="select" >
            <option >Tipo de produto</option>
            <option value="Ração para gato">Ração para gato</option>
            <option value="Ração para cachorro">Ração para cachorro</option>
            <option value="Milho">Milho</option>
          </select>
        </div>
      </form>
    </header>
  </body>
</html>
