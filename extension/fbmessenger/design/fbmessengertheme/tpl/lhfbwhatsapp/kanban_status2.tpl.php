<?php
$modalHeaderClass = 'pt-1 pb-1 pl-2 pr-2';
$modalHeaderTitle = erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Add kanban status');
$modalSize = 'lg';
$modalBodyClass = 'p-1';
?>
<?php include(erLhcoreClassDesign::designtpl('lhkernel/modal_header.tpl.php')); ?>
<div id="alert-container"></div>
<div id="kanban-status-container">
    <form id="kanban-status-form" method="post" action="">
        <input type="hidden" name="chat_id" value="<?php echo htmlspecialchars($chat->id); ?>" />

        <div class="form-group">
            <select name="kanban_status" class="form-control" id="kanban_status">
                <?php foreach ($kanban_status as $status) : ?>
                    <option value="<?php echo htmlspecialchars($status->id); ?>" <?php if ($chat->kanban_status == $status->id) echo 'selected'; ?>>
                        <?php echo htmlspecialchars($status->nombre); ?>
                    </option>
                <?php endforeach; ?>
                <option value="0"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','NO STATUS'); ?></option>
            </select>
        </div>

        <!-- Alineación a la derecha -->
       
        <div class="modal-footer">
        <div class="btn-group" role="group" aria-label="...">
        <input type="submit" class="btn btn-sm btn-secondary" id="update-kanban-status" name="Save_page" value="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/buttons','Save');?>"/>
            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/buttons','Close')?></button>
        </div>
    </div>
    </form>
</div>
<script>
    $(document).ready(function() {
        $('#update-kanban-status').click(function(e) {
            e.preventDefault();

            var chatId = <?php echo json_encode($chat->id); ?>;
            var newStatus = $('#kanban_status').val();

            $.ajax({
                type: "POST",
                url: "<?php echo erLhcoreClassDesign::baseurl('fbwhatsapp/kanban_status2'); ?>",
                data: {
                    chat_id: chatId,
                    kanban_status: newStatus,
                },
                success: function(response) {
                    console.log("Respuesta del servidor:", response);
                    mostrarMensaje('success', 'El estado de enbudo se ha actualizado correctamente.');
                },
                error: function(xhr, status, error) {
                    console.error("Error en la solicitud AJAX:", error);
                    mostrarMensaje('error', 'Hubo un error al actualizar el estado de enbudo.');
                }
            });
        });

        function mostrarMensaje(type, message) {
            var alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
            var alertHtml = '<div class="alert ' + alertClass + ' alert-dismissible fade show" role="alert">' +
                message +
                '</div>';

            $('#alert-container').html(alertHtml); // Agregar mensaje al contenedor

            // Opcional: Scroll hacia arriba para ver el mensaje (si es necesario)
            $('html, body').animate({
                scrollTop: 0
            }, 'fast');
        }
    });
</script>



<?php include(erLhcoreClassDesign::designtpl('lhkernel/modal_footer.tpl.php')); ?>