<?php

$response = erLhcoreClassChatEventDispatcher::getInstance()->dispatch('fbwhatsapp.metric_templates', array());
$fbOptions = erLhcoreClassModelChatConfig::fetch('fbmessenger_options');
$data = (array)$fbOptions->data;
$tpl = erLhcoreClassTemplate::getInstance('lhfbwhatsapp/metric_templates.tpl.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $template_id = $_POST['template_id'];
    $instance = \LiveHelperChatExtension\fbmessenger\providers\FBMessengerWhatsAppLiveHelperChat::getInstance();
    $jsonresponse = $instance->getTemplateMetrics($template_id);
}

if (!empty($jsonresponse)) {
    $dataPoints = $jsonresponse["data"][0]["data_points"];
    $pages = new lhPaginator();
    $pages->items_total = count($dataPoints);
    $itemsPerPage = 90;
    $pages->setItemsPerPage($itemsPerPage);
    $dataPoints = array_slice($jsonresponse, $pages->low, $pages->items_per_page);
    $pages->translationContext = 'chat/metric_templates';
    $pages->serverURL = erLhcoreClassDesign::baseurl('fbwhatsapp/metric_templates');
    $pages->paginate();
    $tpl->set('pages', $pages);
    $tpl->set('metrics', $dataPoints);

    $info_sent = 0;
    $info_read = 0;
    $info_delivered = 0;
    $info_clicked = 0;

    $data_metrics = $dataPoints['data'][0]['data_points'];


    foreach ($data_metrics as $data_metric) {
        // Accede a los datos individuales dentro de cada punto de datos
        $sent = $data_metric['sent'];
        $read = $data_metric['read'];
        $delivered = $data_metric['delivered'];

        // Realiza las operaciones deseadas con los datos, por ejemplo, sumarlos
        $info_sent += $sent;
        $info_read += $read;
        $info_delivered += $delivered;
    }

    $tpl->setArray([
        'info_sent' => $info_sent,
        'info_read' => $info_read,
        'info_delivered' => $info_delivered,
    ]);
}
// Prepara los datos para Chart.js
$labels = [];
$sentData = [];
$deliveredData = [];
$readData = [];

// Recorre los puntos de datos y extrae la información
if (isset($dataPoints) && !empty($dataPoints)) :
    $data_points = $dataPoints['data'][0]['data_points'];
    foreach ($data_points as $data_point) : 
        $labels[] = date('d/m/Y', $data_point['start']);
        $sentData[] = $data_point['sent'];
        $deliveredData[] = $data_point['delivered'];
        $readData[] = $data_point['read'];
    endforeach;
endif;

// Convertir datos a JSON para pasar a JavaScript
$labelsJson = json_encode($labels);
$sentDataJson = json_encode($sentData);
$deliveredDataJson = json_encode($deliveredData);
$readDataJson = json_encode($readData);

$tpl->setArray([
    'labelsJson' => $labelsJson,
    'sentDataJson' => $sentDataJson,
    'deliveredDataJson' => $deliveredDataJson,
    'readDataJson' => $readDataJson,
]);


$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://graph.facebook.com/v18.0/' . $template_id . '',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer ' . $data['whatsapp_access_token']
    ),
));

$response = curl_exec($curl);

curl_close($curl);
$response2 = json_decode($response, true);
$tpl->set('template_name', $response2['name']);



$Result['content'] = $tpl->fetch();
$Result['path'] = array(
    array(
        'url' => erLhcoreClassDesign::baseurl('fbmessenger/index'),
        'title' => erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Facebook chat')
    ),
    array(
        'url' => erLhcoreClassDesign::baseurl('fbwhatsapp/templates'),
        'title' => erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Templates')
    ),
    array(
        'title' => erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Metrics')
    )
);
