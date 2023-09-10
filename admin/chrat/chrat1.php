<nav>
<canvas style="min-width: 310px; height: 400px; margin: 0 auto; " id="myChart"></canvas>
        <script>
            const labels = ['Completed: <?php echo $complished_percentage_formatted; ?>%', 'Failed: <?php echo $failed_percentage_formatted; ?>%'];
            const data = {
                labels: labels,
                datasets: [{
                    label: 'Percentage of Completed and Failed Rows',
                    data: [<?php echo $complished_percentage_formatted; ?>, <?php echo $failed_percentage_formatted; ?>],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                    ],
                    borderWidth: 1
                }]
            };

            const config = {
                type: 'pie',
                data: data,
                options: {}
            };

            var myChart = new Chart(
                document.getElementById('myChart'),
                config
            );
        </script>
        
</nav>