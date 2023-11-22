<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
  google.charts.load('current', { 'packages': ['corechart'] });
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Raça', 'Quantidade de Animais'],
      <?php
      $sql = '
        SELECT tb_raca.nm_raca , COUNT(*) as qtd 
        FROM tb_animal
        INNER JOIN tb_raca ON tb_animal.id_raca = tb_raca.cd_raca
        GROUP BY tb_raca.nm_raca;
      ';

      $res = $GLOBALS['con']->query($sql);

      while ($exibe = mysqli_fetch_assoc($res)) {
        $nome_animal = $exibe['nm_raca'];
        $qtd_animal = $exibe['qtd'];
      ?>

        ['<?php echo $nome_animal; ?>', <?php echo $qtd_animal; ?>],
      <?php
      }
      ?>
    ]);

    var options = {
      title: 'Levantamento de Raças'
    };

    var chart = new google.visualization.PieChart(document.getElementById('lev_raca'));

    chart.draw(data, options);
  }
</script>