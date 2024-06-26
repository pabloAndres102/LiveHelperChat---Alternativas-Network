<style>
    /* Estilos para el título del gráfico */
    .chart-title {
        font-size: 24px;
        /* Tamaño de fuente */
        color: #333;
        /* Color del texto */
        margin-bottom: 10px;
        /* Margen inferior */
        text-align: center;
        /* Alinear al centro */
    }

    /* Estilos para los inputs de fecha */
    input[type="datetime-local"] {
        padding: 8px 12px;
        /* Ajustar el relleno */
        border: 1px solid #ced4da;
        /* Borde */
        border-radius: 4px;
        /* Bordes redondeados */
        box-sizing: border-box;
        /* Incluir el borde en el tamaño total */
        font-size: 14px;
        /* Tamaño de fuente */
        outline: none;
        /* Eliminar el resplandor al enfocar */
    }

    /* Estilos para los botones */
    button.btn {
        padding: 8px 16px;
        /* Ajustar el relleno */
        border: none;
        /* Sin borde */
        border-radius: 4px;
        /* Bordes redondeados */
        cursor: pointer;
        /* Cursor de puntero */
        background-color: #007bff;
        /* Color de fondo */
        color: #fff;
        /* Color de texto */
        font-size: 14px;
        /* Tamaño de fuente */
    }

    /* Estilos para el botón de búsqueda */
    button.btn-primary {
        background-color: #007bff;
        /* Color de fondo */
    }

    /* Estilos para el icono de búsqueda */
    span.material-icons {
        vertical-align: middle;
        /* Alinear verticalmente */
        margin-right: 5px;
        /* Margen derecho */
    }

    /* Estilos para los recuadros */
    .recuadro {
        background-color: #f8f9fa;
        /* Color de fondo */
        border: 1px solid #dee2e6;
        /* Borde */
        padding: 20px;
        /* Espaciado interno */
        margin-bottom: 20px;
        /* Espaciado inferior */
        transition: all 0.3s ease;
        /* Transición suave para el efecto hover */
    }

    /* Estilos para el texto dentro del recuadro */
    .recuadro p,
    .recuadro h1 {
        margin: 0;
        /* Eliminar márgenes para el texto */
    }

    /* Efecto hover */
    .recuadro:hover {
        background-color: #e9ecef;
        /* Cambiar el color de fondo al hacer hover */
        transform: translateY(-5px);
        /* Elevar ligeramente el recuadro */
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
        /* Sombra suave */
        border-color: #ced4da;
        /* Cambiar el color del borde */
        cursor: pointer;
        /* Cambiar el cursor al hacer hover */
    }

    /* Estilos para los números */
    .recuadro h1 {
        font-size: 32px;
        /* Tamaño de fuente grande para los números */
        color: #007bff;
        /* Color azul para los números */
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container">
    <form method="POST" action="<?php echo erLhcoreClassDesign::baseurl('fbmessenger/index') ?>">
        <!-- Establecer por defecto el primer día del mes actual a las 00:00 para la primera fecha -->
        <input type="datetime-local" name="start" value="<?php echo (isset($startTimestamp) ? date('Y-m-01\T00:00', $startTimestamp) : date('Y-m-01\T00:00')); ?>">&nbsp;&nbsp;

        <!-- Establecer por defecto la fecha y hora actuales para la segunda fecha -->
        <input type="datetime-local" name="end" value="<?php echo (isset($endTimestamp) ? date('Y-m-d\TH:i', $endTimestamp) : date('Y-m-d\TH:i')); ?>"> &nbsp;&nbsp;

        <button class="btn btn-primary" type="submit"><span class="material-icons">search</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/buttons', 'Search'); ?></button>
    </form>
    <br>
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="recuadro"> <!-- Recuadro 1 -->
                <p><strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Sent conversations'); ?></strong></p>
                <?php if (isset($totalSent)) : ?>
                    <h1><?php echo $totalSent; ?></h1>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="recuadro"> <!-- Recuadro 4 -->
                <p><strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Total read'); ?></strong></p>
                <?php if (isset($totalRead)) : ?>
                    <h1><?php print_r($totalRead); ?></h1>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="recuadro"> <!-- Recuadro 3 -->
                <p><strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Engagement'); ?></strong></p>
                <?php if (isset($engagement)) : ?>
                    <h1><?php print_r($engagement . '%'); ?></h1>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="recuadro"> <!-- Recuadro 2 -->
                <p><strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Incoming conversations'); ?></strong></p>
                <?php if (isset($msg_services)) : ?>
                    <h1><?php echo $msg_services; ?></h1><small>(api)</small>

                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="recuadro"> <!-- Recuadro 3 -->
                <p><strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Generated conversations'); ?></strong></p>
                <?php if (isset($chatid)) : ?>
                    <h1><?php echo $chatid; ?></h1>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="recuadro"> <!-- Recuadro 4 -->
                <p><strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Promedio de lectura'); ?></strong></p>
                <?php if (isset($averageTime)) : ?>
                    <h1><?php echo $averageTime; ?></h1>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="recuadro"> <!-- Recuadro 4 -->
                <p><strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Lectura más rápida'); ?></strong></p>
                <?php if (isset($fastestTime)) : ?>
                    <h1><?php echo $fastestTime; ?></h1>
                <?php else : ?>
                    <h1>Sin datos</h1>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="recuadro"> <!-- Recuadro 4 -->
                <p><strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Lectura más lenta'); ?></strong></p>
                <?php if (isset($slowestTime)) : ?>
                    <h1><?php echo $slowestTime; ?></h1>
                <?php else : ?>
                    <h1>Sin datos</h1>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="recuadro"> <!-- Recuadro 4 -->
                <p><strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Estado de entregados'); ?></strong></p>
                <?php if (isset($deliveredCount)) : ?>
                    <h1><?php echo $deliveredCount; ?></h1>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="recuadro"> <!-- Recuadro 4 -->
                <p><strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Estado de fallidos'); ?></strong></p>
                <?php if (isset($failedCount)) : ?>
                    <h1><?php echo $failedCount; ?></h1>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="recuadro"> <!-- Recuadro 4 -->
                <p><strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Estado Rechazado'); ?></strong></p>
                <?php if (isset($rejectedCount)) : ?>
                    <h1><?php echo $rejectedCount; ?></h1>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="recuadro"> <!-- Recuadro 4 -->
                <p><strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Plantilla más enviada'); ?></strong></p>
                <?php if (isset($mostRepeatedTemplate)) : ?>
                    <h1 style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?php echo $mostRepeatedTemplate; ?></h1>
                    <p>(<?php echo $maxFrequency; ?>)</p>
                <?php else : ?>
                    <h1>Sin datos</h1>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="recuadro"> <!-- Recuadro 4 -->
                <p><strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Día que se envió más plantillas'); ?></strong></p>
                <?php if (isset($dayWithMostMessages)) : ?>
                    <h1><?php echo $dayWithMostMessages; ?></h1>
                    <p>(<?php echo $maxMessages; ?>)</p>
                <?php else : ?>
                    <h1>Sin datos</h1>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="recuadro"> <!-- Recuadro 4 -->
                <p><strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'día mayor engagement'); ?></strong></p>
                <?php if (isset($dayWithMaxEngagement)) : ?>
                    <h1><?php echo $dayWithMaxEngagement; ?></h1>
                <?php else : ?>
                    <h1>Sin datos</h1>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="recuadro"> <!-- Recuadro 4 -->
                <p><strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'día menor engagement'); ?></strong></p>
                <?php if (isset($dayWithMinEngagement)) : ?>
                    <h1><?php echo $dayWithMinEngagement; ?></h1>
                <?php endif; ?>
            </div>
        </div>
    </div>


    <div class="container-graphics">
        <h3 class="chart-title">Plantillas enviadas</h3>
        <p style="color: red; font-style: italic;  text-align: center;"><span class="material-icons">warning</span>Importante: Esta información puede variar con base a la privacidad definida por el usuario.</p>
        <canvas id="myChart" width="300" height="100"></canvas>
        <br>
        <h3 class="chart-title">Estado de las Plantillas</h3>
        <center><canvas id="pieChart" width="400" height="400"></canvas></center>
        <br>
        <h3 class="chart-title">Envíos por agente</h3>
        <center><canvas id="pieChartAgents" width="400" height="400"></canvas></center>
        <br>
        <h3 class="chart-title">Plantillas leídas</h3>
        <p style="color: red; font-style: italic;  text-align: center;"><span class="material-icons">warning</span>Importante: Esta información puede variar con base a la privacidad definida por el usuario.</p>
        <canvas id="myChartRead" width="300" height="100"></canvas>
        <br>
        <h3 class="chart-title">Conversaciones generadas por Plantillas</h3>
        <canvas id="myChartGenerated" width="300" height="100"></canvas>
        <br>
        <h3 class="chart-title">Engagement diario</h3>
        <canvas id="myChartEngagement" width="300" height="100"></canvas>
    </div>

</div>
<?php
$labels = [];
$currentDate = $startTimestamp;

while ($currentDate <= $endTimestamp) {
    $labels[] = date('Y-m-d', $currentDate);
    $currentDate = strtotime('+1 day', $currentDate); // Avanzar al siguiente día
}
?>
<script>
    // Obtener el contexto del lienzo
    var ctx = document.getElementById('myChart').getContext('2d');

    // Datos de ejemplo (reemplaza esto con tus datos reales)
    var data = {
        labels: <?php echo json_encode($labels); ?>, // Aquí van las fechas
        datasets: [{
            label: 'Enviadas',
            backgroundColor: 'rgba(54, 162, 235, 0.7)',
            borderColor: 'rgba(54, 162, 235, 1)',
            data: <?php echo json_encode($sentPerDay); ?>, // Aquí van las cantidades de mensajes enviados por día
        }, {
            label: 'Leídas',
            borderColor: 'rgba(128, 0, 128, 1)', // Color de la línea más oscuro
            borderWidth: 2, // Grosor de la línea
            fill: false,
            data: <?php echo json_encode($readPerDay); ?>, // Aquí van las cantidades de mensajes leídos por día
            type: 'line',
            order: 2 // Ajusta el orden de visualización para que la línea esté encima de las barras
        }]
    };

    // Configuración del gráfico
    var options = {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    };

    // Crear el gráfico de barras
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: data,
        options: options
    });

    // Asumiendo que tienes un array llamado messagesPerDay que contiene las frecuencias de mensajes por día
    var messagesPerDay = <?php echo json_encode($messagesPerDay); ?>;

    // Iterar sobre el array y agregar datos al gráfico
    Object.keys(messagesPerDay).forEach(function(date) {
        data.labels.push(date);
        data.datasets[0].data.push(messagesPerDay[date]);
    });

    // Actualizar el gráfico
    myChart.update();
</script>


<script>
    // Obtener context de Canvas
    var ctx = document.getElementById('pieChartAgents').getContext('2d');

    // Datos para el gráfico
    var data = {
        labels: <?php echo json_encode($agentNames); ?>,
        datasets: [{
            data: <?php echo json_encode($messageCounts); ?>,
            backgroundColor: [
                'rgba(128, 0, 128, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 99, 132, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(153, 102, 255, 0.5)'
            ]
        }]
    };

    // Opciones del gráfico
    var options = {
        responsive: false,
        maintainAspectRatio: false,
        title: {
            display: true,
            text: 'Envios por agente'
        }
    };

    // Crear el gráfico de pastel
    var pieChart = new Chart(ctx, {
        type: 'pie',
        data: data,
        options: options
    });
</script>



<script>
    // Obtener context de Canvas
    var ctx = document.getElementById('pieChart').getContext('2d');

    // Datos para el gráfico
    var data = {
        labels: ['Leídos', 'Enviado', 'Fallido', 'Entregado', 'Rechazado', 'Pendiente'],
        datasets: [{
            data: [<?php echo $totalRead ?>, <?php echo $sentCount ?>, <?php echo $failedCount ?>, <?php echo $deliveredCount ?>, <?php echo $rejectedCount ?>, <?php echo $PendingCount ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(153, 102, 255, 0.5)',
                'rgba(46, 204, 113, 0.5)'
            ]
        }]
    };

    // Opciones del gráfico
    var options = {
        responsive: false,
        maintainAspectRatio: false,
        title: {
            display: true,
            text: 'Porcentaje de Mensajes por Estado'
        }
    };

    // Crear el gráfico de pastel
    var pieChart = new Chart(ctx, {
        type: 'pie',
        data: data,
        options: options
    });
</script>

<script>
    // Obtener el contexto del lienzo
    var ctx = document.getElementById('myChartRead').getContext('2d');

    // Datos de ejemplo (reemplaza esto con tus datos reales)
    var data = {
        labels: <?php echo json_encode($labels); ?>, // Aquí van las fechas
        datasets: [{
            label: 'Leídas',
            backgroundColor: 'rgba(255, 206, 86, 0.8)',
            borderColor: 'rgba(255, 206, 86, 1)',
            data: <?php echo json_encode($readPerDay); ?>, // Aquí van las cantidades de mensajes por día
        }]
    };

    // Configuración del gráfico
    var options = {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    };

    // Crear el gráfico de barras
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: data,
        options: options
    });

    // Asumiendo que tienes un array llamado messagesPerDay que contiene las frecuencias de mensajes por día
    var messagesPerDay = <?php echo json_encode($messagesPerDay); ?>;

    // Iterar sobre el array y agregar datos al gráfico
    Object.keys(messagesPerDay).forEach(function(date) {
        data.labels.push(date);
        data.datasets[0].data.push(messagesPerDay[date]);
    });

    // Actualizar el gráfico
    myChart.update();
</script>

<script>
    // Obtener el contexto del lienzo
    var ctx = document.getElementById('myChartGenerated').getContext('2d');

    // Datos de ejemplo (reemplaza esto con tus datos reales)
    var data = {
        labels: <?php echo json_encode($labels); ?>, // Aquí van las fechas
        datasets: [{
            label: 'Conversaciones generadas',
            backgroundColor: 'rgba(75, 192, 192, 0.8)',
            borderColor: 'rgba(75, 192, 192, 1)',
            data: <?php echo json_encode($generatedConversationPerDay); ?>, // Aquí van las cantidades de mensajes por día
        }]
    };

    // Configuración del gráfico
    var options = {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    };

    // Crear el gráfico de barras
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: data,
        options: options
    });

    // Asumiendo que tienes un array llamado messagesPerDay que contiene las frecuencias de mensajes por día
    var messagesPerDay = <?php echo json_encode($messagesPerDay); ?>;

    // Iterar sobre el array y agregar datos al gráfico
    Object.keys(messagesPerDay).forEach(function(date) {
        data.labels.push(date);
        data.datasets[0].data.push(messagesPerDay[date]);
    });

    // Actualizar el gráfico
    myChart.update();
</script>

<script>
    // Obtener el contexto del lienzo
    var ctx = document.getElementById('myChartEngagement').getContext('2d');

    // Datos de ejemplo (reemplaza esto con tus datos reales)
    var data = {
        labels: <?php echo json_encode($labels); ?>, // Aquí van las fechas
        datasets: [{
            label: 'Engagement',
            backgroundColor: 'rgba(75, 192, 192, 0.8)',
            borderColor: 'rgba(75, 192, 192, 1)',
            data: <?php echo json_encode($engagementValues); ?>, // Aquí van las cantidades de mensajes por día
        }]
    };

    // Configuración del gráfico
    var options = {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    };

    // Crear el gráfico de barras
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: data,
        options: options
    });

    // Asumiendo que tienes un array llamado messagesPerDay que contiene las frecuencias de mensajes por día
    var messagesPerDay = <?php echo json_encode($messagesPerDay); ?>;

    // Iterar sobre el array y agregar datos al gráfico
    Object.keys(messagesPerDay).forEach(function(date) {
        data.labels.push(date);
        data.datasets[0].data.push(messagesPerDay[date]);
    });

    // Actualizar el gráfico
    myChart.update();
</script>