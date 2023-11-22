<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
  google.charts.load('current', { 'packages': ['corechart'] });
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Raça', 'Quantidade de Animais'],
      <?php
      $sql = '
        SELECT tb_cor.nm_cor , COUNT(*) as qtd 
        FROM tb_animal
        INNER JOIN tb_cor ON tb_animal.id_cor = tb_cor.cd_cor
        GROUP BY tb_cor.nm_cor;
      ';

      $res = $GLOBALS['con']->query($sql);

      while ($exibe = mysqli_fetch_assoc($res)) {
        $nome_cor = $exibe['nm_cor'];
        $qtd_animal = $exibe['qtd'];
      ?>

        ['<?php echo $nome_cor; ?>', <?php echo $qtd_animal; ?>],
      <?php
      }
      ?>
    ]);

    var options = {
      title: 'Levantamento de Cor'
    };

    var chart = new google.visualization.PieChart(document.getElementById('lev_cor'));

    chart.draw(data, options);
  }
</script>