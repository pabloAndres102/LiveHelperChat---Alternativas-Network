<?php

$tpl = erLhcoreClassTemplate::getInstance('lhfbwhatsappmessaging/kanban_status.tpl.php');

$status = erLhcoreClassModelGenericKanban::getList();

$tpl->set('status',$status);


















$Result['path'] = array(
    array(
        'url' => erLhcoreClassDesign::baseurl('genericbot/kanban'),
        'title' => erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Kanban'),
    ),
    array(
        'url' => erLhcoreClassDesign::baseurl('fbwhatsappmessaging/kanban_status'),
        'title' => erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Estatus kanban'),
    ),
);


$Result['content'] = $tpl->fetch();