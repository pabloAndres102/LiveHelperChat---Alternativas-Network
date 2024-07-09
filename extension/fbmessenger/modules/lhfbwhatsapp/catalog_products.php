<?php

$tpl = erLhcoreClassTemplate::getInstance('lhfbwhatsapp/catalog_products.tpl.php');



$products = erLhcoreClassModelCatalogProducts::getList();


$tpl->set('products', $products);








$Result['content'] = $tpl->fetch();

$Result['path'] = array(
    array(
        'title' => erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Catalog')
    )
);