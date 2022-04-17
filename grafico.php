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
    $file = file_get_contents($path);
    $valores = json_decode($file);
  }
}
$array = [[]];
?>

<head>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {
      'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Valor', 'Aparições'],
        <?php
        foreach (array_count_values($valores) as $key => $value) {
          echo "['$key', $value],";
        }
        ?>
      ]);

      var options = {
        title: 'Aparições',
        curveType: 'function',
        legend: {
          position: 'bottom'
        }
      };

      var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

      chart.draw(data, options);
    }
  </script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    <?$titulo ?>
  </title>
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>
  <img style="width: 16px; height: 16px; display:inline" src="https://upload.wikimedia.org/wikipedia/commons/6/6a/External_link_font_awesome.svg" alt="" srcset="">
  <a href="index.php">Gerar números </a>
  <img style="margin-left: 10px; width: 16px; height: 16px; display:inline" src="https://upload.wikimedia.org/wikipedia/commons/6/6a/External_link_font_awesome.svg" alt="" srcset="">
  <a href="estatistica.php">Dados</a>
  <form action="" method="POST">
    <label for="arquivo">Nome do arquivo</label>
    <input type="text" name="arquivo" placeholder="Nome do arquivo">
    <button type="submit">Abrir arquivo</button>
  </form>
  <?php
  if ($erro) {
    echo "<h1 class=error>Erro ao abrir arquivo</h1>";
  } else
  if ($arquivo) {
    echo "Valores gerados: <br>";
    for ($i = 0; $i < count($valores); $i++) {
      echo $valores[$i] . " ";
    }
    echo "<div id=curve_chart overflow-x: scroll; style=width: 1800px; height: 500px></div>";
  }

  ?>
</body>

</html>