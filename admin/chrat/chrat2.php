<nav>
  <script src="https://cdn.jsdelivr.net/npm/chartkick"></script>
  <div id="chart-1" style="height: 300px;"></div>
  <script>
    const data1 = [
      ['Verified <?php echo $verified2_percentage_formatted; ?>%', <?php echo $verified2_percentage_formatted; ?>],
      ['Not Verified <?php echo $not_verified2_percentage_formatted; ?>%', <?php echo $not_verified2_percentage_formatted; ?>]
    ];

    const options1 = {
      chartType: 'PieChart',
      legend: 'none',
      colors: ['#4dc9f6', '#ff6384']
    };


    new Chartkick.PieChart("chart-1", data1, options1);
  </script>
</nav>