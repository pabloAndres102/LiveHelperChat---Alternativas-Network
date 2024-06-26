<?php

$tpl = erLhcoreClassTemplate::getInstance('lhfbwhatsapp/templates.tpl.php');

try {
    $instance =  LiveHelperChatExtension\fbmessenger\providers\FBMessengerWhatsAppLiveHelperChat::getInstance();
    $templates = $instance->getTemplates();
    $templateCount = 0;
    $excludedTemplates = array(
        'sample_purchase_feedback',
        'sample_issue_resolution',
        'sample_flight_confirmation',
        'sample_shipping_confirmation',
        'sample_happy_hour_announcement',
        'sample_movie_ticket_confirmation'
    );
    foreach ($templates as $template) {
        if (!in_array($template['name'], $excludedTemplates)){
        $templateCount++; 
        }
    }

} catch (Exception $e) {
    $tpl->set('error', $e->getMessage());
    $templates = [];
}

if ($currentUser->hasAccessTo('lhfbwhatsapp', 'delete_templates')) {
    $tpl->set('delete_template',true);
}else{
    $tpl->set('delete_template',false); 
}


$pages = new lhPaginator();
$pages->items_total = $templateCount;
$itemsPerPage = 7; 
$pages->setItemsPerPage($itemsPerPage);
$templates = array_slice($templates, $pages->low, $pages->items_per_page);
$pages->translationContext = 'chat/activechats';
$pages->serverURL = erLhcoreClassDesign::baseurl('fbwhatsapp/templates');
$pages->paginate();
$tpl->set('pages',$pages);
$tpl->set('templates', $templates);


$Result['content'] = $tpl->fetch();
$Result['path'] = array(
    array('url' => erLhcoreClassDesign::baseurl('fbmessenger/index'), 
        'title' => erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Facebook chat')),
    array(
        'title' => erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Templates')
    )
);



?>