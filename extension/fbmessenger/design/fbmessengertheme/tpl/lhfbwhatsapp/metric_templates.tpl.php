<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }
    </style>
     <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<?php include(erLhcoreClassDesign::designtpl('lhkernel/paginator.tpl.php')); ?>
<center><h4><?php print_r($template_name)?></h4></center> <br>
<div id="infoDiv" style=" border: 2px solid #3498db; border-radius: 10px; padding: 20px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); background-color: #f9f9f9; margin-top: 20px;">
    <h1 style="font-size: 24px; color: #3498db; margin-bottom: 10px;"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/pendingchats','Resumen')?> <span class="material-icons">query_stats</span></h1>
    <p style="font-size: 18px; margin-bottom: 10px;"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Sended')?>: <?php print_r($info_sent) ?></p>
    <p style="font-size: 18px; margin-bottom: 10px;"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Delivered')?>: <?php print_r($info_delivered) ?></p>
    <p style="font-size: 18px;"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Readed')?>: <?php print_r($info_read) ?></p>
</div>
<br><br>
<small><mark><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Summary of the last 30 days'); ?> </mark></small>
<br>

<table>
    <tr>
        <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Start')?></th>
        <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','End')?></th>
        <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Sended')?></th>
        <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Delivered')?></th>
        <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Readed')?></th>
        <th>Clicks</th>
    </tr>
    <?php 
    $end = time(); // Obtiene la fecha y hora actual en formato Unix.

    // Restar 90 días (90 * 24 * 60 * 60 segundos) a la fecha actual.
    $start = $end - (89 * 24 * 60 * 60);

        if (isset($metrics) && !empty($metrics)) :
        $data_points = $metrics['data'][0]['data_points'];
        foreach (array_slice($data_points, $pages->low, $pages->items_per_page) as $data_point) : ?>
            <?php if ($data_point['sent'] > 0) : ?>
                <tr>
                    <td><?php print_r(date('d/m/Y', $data_point['start'])); ?></td>
                    <td><?php print_r(date('d/m/Y', $data_point['end'])); ?></td>
                    <td><?php print_r($data_point['sent']); ?></td>
                    <td><?php print_r($data_point['delivered']); ?></td>
                    <td><?php print_r($data_point['read']); ?></td>
                    <td>
                        <?php if (isset($data_point['clicked'])) : ?>
                            <ul>
                                <?php foreach ($data_point['clicked'] as $clickedItem) : ?>
                                    <li>
                                        <strong> <?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Button name')?>: </strong> <?php print_r ($clickedItem['button_content']); ?><br>
                                        <strong> Clicks: </strong> <?php print_r ($clickedItem['count']); ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else : ?>
                            N/A
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php else : ?>
        <?php print_r($metrics) ?>
    <?php endif; ?>
</table>
<canvas id="lineChart" width="400" height="200"></canvas>

<script>
    // Datos en formato JSON desde PHP
    var labels = <?php echo $labelsJson; ?>;
    var sentData = <?php echo $sentDataJson; ?>;
    var deliveredData = <?php echo $deliveredDataJson; ?>;
    var readData = <?php echo $readDataJson; ?>;

    // Configuración del gráfico de líneas
    var ctx = document.getElementById('lineChart').getContext('2d');
    var lineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Enviado',
                    data: sentData,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: false
                },
                {
                    label: 'Entregado',
                    data: deliveredData,
                    borderColor: 'rgba(153, 102, 255, 1)',
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    fill: false
                },
                {
                    label: 'Leído',
                    data: readData,
                    borderColor: 'rgba(255, 159, 64, 1)',
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    fill: false
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Date'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Count'
                    }
                }
            }
        }
    });
</script>





<!-- <td><?php print_r($data_point[0]['data_points'][0]['delivered']); ?></td> -->

</body>
</html>
<!-- <script>
    // Obtén el botón y el div por su ID
    var showInfoButton = document.getElementById('showInfoButton');
    var infoDiv = document.getElementById('infoDiv');

    // Agrega un evento de clic al botón
    showInfoButton.addEventListener('click', function() {
        // Comprueba si el div está visible
        if (infoDiv.style.display === 'none') {
            // Si está oculto, muéstralo
            infoDiv.style.display = 'block';
        } else {
            // Si está visible, ocúltalo
            infoDiv.style.display = 'none';
        }
    });
</script> -->
