<?php
$tpl = erLhcoreClassTemplate::getInstance('lhfbwhatsapp/templates.tpl.php');

try {
    $instance = LiveHelperChatExtension\fbmessenger\providers\FBMessengerWhatsAppLiveHelperChat::getInstance();
    $templates = $instance->getTemplates();
    
    // Inicializa la variable de conteo de plantillas
    $templateCount = 0;
    $filteredTemplates = [];

    // Filtrado de plantillas basado en parámetros GET
    $searchName = isset($_GET['search_name']) ? trim($_GET['search_name']) : '';
    $searchStatus = isset($_GET['search_status']) ? $_GET['search_status'] : '';
    $searchCategory = isset($_GET['search_category']) ? $_GET['search_category'] : '';
    $search_language = isset($_GET['search_language']) ? $_GET['search_language'] : '';
    $excludedTemplates = array(
        'sample_purchase_feedback',
        'sample_issue_resolution',
        'sample_flight_confirmation',
        'sample_shipping_confirmation',
        'sample_happy_hour_announcement',
        'sample_movie_ticket_confirmation'
    );


    foreach ($templates as $template) {
        if (!in_array($template['name'], $excludedTemplates)) {
            
            // Filtrado por nombre
            if ($searchName && stripos($template['name'], $searchName) === false) {
                continue;
            }
            // Filtrado por estado
            if ($searchStatus && $template['status'] !== $searchStatus) {
                continue;
            }
            // Filtrado por categoría
            if ($searchCategory && $template['category'] !== $searchCategory) {
                continue;
            }
            if ($search_language && $template['language'] !== $search_language) {
                continue;
            }
            // Si pasa los filtros, añádelo a la lista filtrada
            $filteredTemplates[] = $template;
            $templateCount++;
        }
    }

} catch (Exception $e) {
    $tpl->set('error', $e->getMessage());
    $filteredTemplates = [];
}

// Configuración de permisos
if ($currentUser->hasAccessTo('lhfbwhatsapp', 'delete_templates')) {
    $tpl->set('delete_template', true);
} else {
    $tpl->set('delete_template', false);
}

// Paginación
$pages = new lhPaginator();
$pages->items_total = $templateCount;

// Si hay búsqueda, no se aplica paginación
if ($searchName || $searchStatus || $searchCategory || $searchLanguage) { // Incluye el idioma en la condición
    $pages->setItemsPerPage($templateCount); // Muestra todos los resultados
} else {
    $itemsPerPage = 7; // Paginación normal
    $pages->setItemsPerPage($itemsPerPage);
}

$filteredTemplates = array_slice($filteredTemplates, $pages->low, $pages->items_per_page);
$pages->translationContext = 'chat/activechats';
$pages->serverURL = erLhcoreClassDesign::baseurl('fbwhatsapp/templates');
$pages->paginate();
$tpl->set('pages', $pages);
$tpl->set('templates', $filteredTemplates);

$Result['content'] = $tpl->fetch();
$Result['path'] = array(
    array('url' => erLhcoreClassDesign::baseurl('fbmessenger/index'), 
        'title' => erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Facebook chat')),
    array(
        'title' => erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Templates')
    )
);




?>