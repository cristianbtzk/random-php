<!DOCTYPE html>
<html lang="en">
<?php
$arquivo = isset($_POST["arquivo"]) ? $_POST["arquivo"] : 0;
$valores = array();
$erro = false;
if ($arquivo) {
  $path = './arquivos/' . $arquivo . '.json';
  if (!file_exists($path)) {
    $erro = true;
  } else {
    $erro = false;
    $file = file_get_contents($path);
    $valores = json_decode($file);

    $soma = array_sum($valores);
    $media =  $soma / count($valores);

    sort($valores);
    $count = count($valores);
    if ($count % 2 == 0)
      $mediana = ($valores[$count / 2 - 1] + $valores[$count / 2]) / 2;
    else
      $mediana = $valores[$count / 2];
  }
}

function primo($num)
{
  if ($num < 2) return false;
  for ($i = 2; $i < $num; $i++) {
    if ($num % $i == 0)
      return false;
  }
  return true;
}
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    <?$titulo ?>
  </title>
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>
  <img style="width: 16px; height: 16px; display:inline" src="https://upload.wikimedia.org/wikipedia/commons/6/6a/External_link_font_awesome.svg" alt="" srcset="">
  <a href="index.php">Gerar números</a>
  <img style="margin-left: 10px; width: 16px; height: 16px; display:inline" src="https://upload.wikimedia.org/wikipedia/commons/6/6a/External_link_font_awesome.svg" alt="" srcset="">
  <a href="grafico.php">Gráfico </a>
  <form action="" method="POST">
    <label for="arquivo">Nome do arquivo</label>
    <input type="text" name="arquivo" placeholder="Nome do arquivo">
    <button type="submit">Abrir arquivo</button>
  </form>
  <?php
  if ($erro) {
    echo "<h1 class=error>Erro ao abrir arquivo</h1>";
  } else if ($arquivo) {
    echo "<p>Valores gerados: </p>";
    for ($i = 0; $i < count($valores); $i++) {
      echo $valores[$i] . " ";
    }
    echo "<p>Valor máximo: " . max($valores) . "</p>";
    echo "<p>Valor mínimo: " . min($valores) . "</p>";
    echo "<p>Valores pares: ";
    for ($i = 0; $i < count($valores); $i++) {
      if ($valores[$i] % 2 == 0)
        echo $valores[$i] . " ";
    }
    echo "</p>";
    echo "<p>Valores ímpares: ";
    for ($i = 0; $i < count($valores); $i++) {
      if ($valores[$i] % 2 == 1)
        echo $valores[$i] . " ";
    }
    echo "</p>";

    echo "<p>Soma: $soma </p>";
    echo "<p>Média: $media </p>";
    echo "<p>Valores acima ou na média: ";
    for ($i = 0; $i < count($valores); $i++) {
      if ($valores[$i] >= $media)
        echo $valores[$i] . " ";
    }
    echo "</p>";

    echo "<p>Valores abaixo da média: ";
    for ($i = 0; $i < count($valores); $i++) {
      if ($valores[$i] < $media)
        echo $valores[$i] . " ";
    }
    echo "</p>";

    echo "<p>Primos: ";
    for ($i = 0; $i < count($valores); $i++) {
      if (primo($valores[$i]))
        echo $valores[$i] . " ";
    }
    echo "</p>";

    echo "<p>Mediana: $mediana </p>";
  }

  ?>
</body>

</html>