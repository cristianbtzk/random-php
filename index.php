<!DOCTYPE html>
<html lang="en">
<?php
$tab = isset($_POST["tab"]) ? $_POST["tab"] : 0;
$qtd = isset($_POST['qtd']) ? $_POST['qtd'] : 0;
$min = isset($_POST['minimo']) ? $_POST['minimo'] : 0;
$max = isset($_POST['maximo']) ? $_POST['maximo'] : 0;
$arquivo = isset($_POST['arquivo']) ? $_POST['arquivo'] : 0;
$numeros = array();
$sucesso = false;

if ($qtd && $min && $max) {
  for ($i = 0; $i < $qtd; $i++) {
    $numeros[$i] = rand($min, $max);
  }

  $json_data = json_encode($numeros);
  $fp = fopen("./arquivos/" . $arquivo . ".json", 'w');
  fwrite($fp, $json_data);
  fclose($fp);
  $sucesso = true;
  $qtd = 0;
  $min = 0;
  $max = 0;
}
?>


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    JSON
  </title>
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>
  <img style="width: 16px; height: 16px; display:inline" src="https://upload.wikimedia.org/wikipedia/commons/6/6a/External_link_font_awesome.svg" alt="" srcset="">
  <a href="estatistica.php">Dados</a>
  <img style="margin-left: 10px; width: 16px; height: 16px; display:inline" src="https://upload.wikimedia.org/wikipedia/commons/6/6a/External_link_font_awesome.svg" alt="" srcset="">
  <a href="grafico.php">Gráfico </a>
  <form action="" method="post">
    <fieldset>
      <label for="qtd">Quantidade de números gerados</label>
      <input required type="number" min="1" name="qtd" placeholder="Quantidade">
      <label for="minimo">Mínimo</label>
      <input required type="number" min="1" name="minimo" placeholder="Mínimo">
      <label for="maximo">Máximo</label>
      <input required type="number" min="1" name="maximo" placeholder="Máximo">
      <label for="arquivo">Nome do arquivo</label>
      <input required name="arquivo" placeholder="Nome do arquivo">
      <button type="submit">Gravar arquivo</button>
    </fieldset>
  </form>
  <?php
  if ($sucesso)
    echo "<h1 class=success>Arquivo gravado com sucesso</h1>";
  ?>

</body>

</html>