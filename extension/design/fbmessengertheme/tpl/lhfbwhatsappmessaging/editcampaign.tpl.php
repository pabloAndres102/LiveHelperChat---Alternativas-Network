<h1><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Edit'); ?></h1>

<?php if (isset($updated)) : $msg = erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Updated'); ?>
    <?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_success.tpl.php')); ?>
<?php endif; ?>

<?php if (isset($errors)) : ?>
    <?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php')); ?>
<?php endif; ?>

<form action="<?php echo erLhcoreClassDesign::baseurl('fbwhatsappmessaging/editcampaign') ?>/<?php echo $item->id ?>" method="post" ng-non-bindable>

    <?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php')); ?>

    <ul class="nav nav-tabs mb-3" role="tablist">
        <li role="presentation" class="nav-item"><a href="#settings" class="nav-link<?php if ($tab == '') : ?> active<?php endif; ?>" aria-controls="settings" role="tab" data-bs-toggle="tab"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Main'); ?></a></li>
    </ul>

    <div class="tab-content">
        <div role="tabpanel" class="tab-pane <?php if ($tab == '') : ?>active<?php endif; ?>" id="settings">
            <?php include(erLhcoreClassDesign::designtpl('lhfbwhatsappmessaging/parts/form_campaign.tpl.php')); ?>
        </div>
    </div>

   

    <div class="btn-group" role="group" aria-label="...">
        <input type="submit" class="btn btn-sm btn-secondary" name="Save_page" value="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/buttons', 'Save'); ?>" />
        <input type="submit" class="btn btn-sm btn-secondary" name="Update_page" value="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/buttons', 'Update'); ?>" />
        <input type="submit" class="btn btn-sm btn-secondary" name="Cancel_page" value="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/buttons', 'Cancel'); ?>" />
    </div>

</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        

        var departmentSelect = document.querySelector('select[name="dep_id"]');
        var privateCheckbox = document.querySelector('input[name="private"]');
        var startDateTimeInput = document.getElementById('startDateTime');
        var phoneSelect = document.getElementById('id_phone_sender_id');
        var businessAccountSelect = document.querySelector('select[name="business_account_id"]');
        var templateSelect = document.querySelector('select[name="template"]');

        // Deshabilita el campo para hacerlo de solo lectura

        departmentSelect.setAttribute('disabled', 'disabled');
        privateCheckbox.setAttribute('disabled', 'disabled');
        startDateTimeInput.setAttribute('readonly', 'readonly');
        phoneSelect.setAttribute('disabled', 'disabled');
        businessAccountSelect.setAttribute('disabled', 'disabled');
        templateSelect.setAttribute('disabled', 'disabled');
        
    });
// </script>