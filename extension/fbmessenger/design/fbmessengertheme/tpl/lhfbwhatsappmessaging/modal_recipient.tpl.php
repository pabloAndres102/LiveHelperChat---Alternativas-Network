<?php
$modalHeaderClass = 'pt-1 pb-1 pl-2 pr-2';
$modalHeaderTitle = erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Contact information');
$modalSize = 'lg';
$modalBodyClass = 'p-1';
?>
<?php include(erLhcoreClassDesign::designtpl('lhkernel/modal_header.tpl.php'));?>

<table class="table table-striped">
    <thead>
        <tr>
            <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Field'); ?></th>
            <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Value'); ?></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>ID</td>
            <td><?php echo htmlspecialchars($item->id); ?></td>
        </tr>
        <tr>
            <td><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Phone'); ?></td>
            <td><?php echo htmlspecialchars($item->phone); ?></td>
        </tr>
        <tr>
            <td><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Created At'); ?></td>
            <td><?php echo htmlspecialchars(date('Y-m-d H:i:s', $item->created_at)); ?></td>
        </tr>
        <tr>
            <td><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Email'); ?></td>
            <td><?php echo htmlspecialchars($item->email); ?></td>
        </tr>
        <tr>
            <td><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Disabled'); ?></td>
            <td><?php echo $item->disabled ? erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Yes') : erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','No'); ?></td>
        </tr>
        <tr>
            <td><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Mailing List IDs'); ?></td>
            <td><?php echo htmlspecialchars(json_encode($item->ml_ids)); ?></td>
        </tr>
        <tr>
            <td><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Title'); ?></td>
            <td><?php echo htmlspecialchars($item->title); ?></td>
        </tr>
        <tr>
            <td><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Last Name'); ?></td>
            <td><?php echo htmlspecialchars($item->lastname); ?></td>
        </tr>
        <tr>
            <td><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Company'); ?></td>
            <td><?php echo htmlspecialchars($item->company); ?></td>
        </tr>
        <tr>
            <td><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Date'); ?></td>
            <td><?php echo htmlspecialchars($item->date); ?></td>
        </tr>
        <tr>
            <td><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Delivery Status'); ?></td>
            <td><?php
                switch($item->delivery_status) {
                    case \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppContact::DELIVERY_STATUS_UNKNOWN:
                        echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Unknown');
                        break;
                    case \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppContact::DELIVERY_STATUS_UNSUBSCRIBED:
                        echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Unsubscribed');
                        break;
                    case \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppContact::DELIVERY_STATUS_FAILED:
                        echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Failed');
                        break;
                    case \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppContact::DELIVERY_STATUS_ACTIVE:
                        echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Active');
                        break;
                    default:
                        echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Unknown');
                        break;
                }
            ?></td>
        </tr>
        <tr>
            <td><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','File 1'); ?></td>
            <td><?php echo htmlspecialchars($item->file_1); ?></td>
        </tr>
        <tr>
            <td><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','File 2'); ?></td>
            <td><?php echo htmlspecialchars($item->file_2); ?></td>
        </tr>
        <tr>
            <td><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','File 3'); ?></td>
            <td><?php echo htmlspecialchars($item->file_3); ?></td>
        </tr>
        <tr>
            <td><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','File 4'); ?></td>
            <td><?php echo htmlspecialchars($item->file_4); ?></td>
        </tr>
        <tr>
            <td><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Name'); ?></td>
            <td><?php echo htmlspecialchars($item->name); ?></td>
        </tr>
        <tr>
            <td><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Phone Recipient'); ?></td>
            <td><?php echo htmlspecialchars($item->phone_recipient); ?></td>
        </tr>
        <tr>
            <td><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Attribute 1'); ?></td>
            <td><?php echo htmlspecialchars($item->attr_str_1); ?></td>
        </tr>
        <tr>
            <td><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Attribute 2'); ?></td>
            <td><?php echo htmlspecialchars($item->attr_str_2); ?></td>
        </tr>
        <tr>
            <td><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Attribute 3'); ?></td>
            <td><?php echo htmlspecialchars($item->attr_str_3); ?></td>
        </tr>
        <tr>
            <td><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Attribute 4'); ?></td>
            <td><?php echo htmlspecialchars($item->attr_str_4); ?></td>
        </tr>
        <tr>
            <td><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Attribute 5'); ?></td>
            <td><?php echo htmlspecialchars($item->attr_str_5); ?></td>
        </tr>
        <tr>
            <td><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Attribute 6'); ?></td>
            <td><?php echo htmlspecialchars($item->attr_str_6); ?></td>
        </tr>
        <tr>
            <td><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Chat ID'); ?></td>
            <td><?php echo htmlspecialchars($item->chat_id); ?></td>
        </tr>
        <tr>
            <td><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','User ID'); ?></td>
            <td><?php echo htmlspecialchars($item->user_id); ?></td>
        </tr>
        <tr>
            <td><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Private'); ?></td>
            <td><?php echo $item->private ? erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Yes') : erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','No'); ?></td>
        </tr>
    </tbody>
</table>

<?php include(erLhcoreClassDesign::designtpl('lhkernel/modal_footer.tpl.php'));?>
