<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .btn-group>a {
            margin-right: 10px;
            /* Puedes ajustar el valor según tu preferencia */
        }

        .components-column {
            max-width: 300px;
            /* Puedes ajustar el valor según tus necesidades */
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
</head>

<body>
    <h1><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Templates'); ?></h1>

    <div class="btn-group" role="group" aria-label="Acciones">
        <a href="<?php echo erLhcoreClassDesign::baseurl('fbwhatsapp/create'); ?>" class="btn btn-primary d-flex align-items-center">
            <span class="material-icons mr-2">add_circle_outline</span>
            <?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Create template'); ?>
        </a>
        <a href="<?php echo erLhcoreClassDesign::baseurl('fbwhatsapp/carousel'); ?>" class="btn btn-primary d-flex align-items-center">
            <span class="material-icons mr-2">view_carousel</span>
            <?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Create carousel'); ?>
        </a>
    </div>



    <br><br>
    </div>
    <?php
    // Comprueba si hay un mensaje de éxito en la variable de sesión
    if (isset($_SESSION['delete_template_message'])) {
        echo '<div class="alert alert-success">' . $_SESSION['delete_template_message'] . '</div>';
        // Elimina el mensaje de éxito de la variable de sesión para que no se muestre nuevamente después de la recarga
        unset($_SESSION['delete_template_message']);
    }

    // Comprueba si hay un mensaje de error en la variable de sesión
    if (isset($_SESSION['delete_template_error'])) {
        echo '<div class="alert alert-danger">' . $_SESSION['delete_template_error'] . '</div>';
        unset($_SESSION['delete_template_error']);
    }

    if (isset($_SESSION['api_error'])) {
        if (isset($_SESSION['api_error']['error']['message'])) {
            echo '<div class="alert alert-danger">' . $_SESSION['api_error']['error']['message'] . '</div>';
            if (isset($_SESSION['api_error']['error']['error_user_msg'])) {
                echo '<div class="alert alert-danger">' . $_SESSION['api_error']['error']['error_user_msg'] . '</div>';
            }
        } else {
            echo '<div class="alert alert-danger">' . $_SESSION['api_error'] . '</div>';
        }
        unset($_SESSION['api_error']);
    }

    if (isset($_SESSION['api_response'])) {
        $apiResponse = $_SESSION['api_response'];

        // Accede a campos específicos del JSON
        $id = $apiResponse['id'];
        $status = $apiResponse['status'];
        $category = $apiResponse['category'];

        // Mapea los valores de status a representaciones en español
        $statusMap = array(
            'PENDING' => 'PENDIENTE',
            'APPROVED' => 'APROBADA',
            'REJECTED' => 'RECHAZADA'
        );
        $categoryMap = array(
            'MARKETING' => 'MARKETING',
            'UTILITY' => 'UTILIDAD',
            'AUTHENTICATION' => 'AUTENTICACIÓN'
        );

        if (array_key_exists($category, $categoryMap)) {
            $categoryLegible = $categoryMap[$category];
        } else {
            $categoryLegible = $category; // Si no está en el mapa, muestra el valor original
        }

        // Verifica si el valor de status está en el mapa
        if (array_key_exists($status, $statusMap)) {
            $statusLegible = $statusMap[$status];
        } else {
            $statusLegible = $status; // Si no está en el mapa, muestra el valor original
        }

        echo '<div class="alert alert-success">';
        echo '<h4>Su plantilla se ha creado con éxito</h4>';
        echo '<div class="response-details">';
        echo '<p><strong>ID de plantilla:</strong> ' . $id . '</p>';
        echo '<p><strong>Estado:</strong> ' . $statusLegible . '</p>';
        echo '<p><strong>Categoría:</strong> ' . $categoryLegible  . '</p>';
        echo '</div>';
        echo '</div>'; // Cierra div class="alert alert-success"

        unset($_SESSION['api_response']);
    }
    ?>

    <?php include(erLhcoreClassDesign::designtpl('lhkernel/paginator.tpl.php')); ?>
    <table class="table table-sm" ng-non-bindable>
        <thead>
            <tr>
                <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Name'); ?></th>
                <th>Idioma</th>
                <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/pendingchats', 'Status') ?></th>
                <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('abstract/proactivechatinvitation', 'Category') ?></th>
                <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('abstract/proactivechatinvitation', 'Template type') ?></th>
                <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('file/file', 'Components') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Lista de nombres de plantillas a excluir
            $excludedTemplates = array(
                'sample_purchase_feedback',
                'sample_issue_resolution',
                'sample_flight_confirmation',
                'sample_shipping_confirmation',
                'sample_happy_hour_announcement',
                'sample_movie_ticket_confirmation'
            );

            foreach ($templates as $template) :
                // Verifica si el nombre de la plantilla está en la lista de exclusiones
                if (!in_array($template['name'], $excludedTemplates)) :
            ?>
                    <tr>
                        <td>
                            <?php echo htmlspecialchars($template['name']) ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($template['language']) ?>
                        </td>
                        <td>
                            <?php
                            $status = htmlspecialchars($template['status']);
                            if ($status == 'APPROVED') {
                                echo '<span style="color: green;">' . erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'APPROVED') . '</span>';
                            } elseif ($status == 'PENDING') {
                                echo '<span style="color: yellow;">' . erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'PENDING') . '</span>';
                            } elseif ($status == 'REJECTED') {
                                echo '<span style="color: red;">' . erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'REJECTED') . '</span>';
                            } else {
                                echo htmlspecialchars($template['status']);
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            $category = htmlspecialchars($template['category']);
                            // Mostrar categorías en mayúsculas y en español
                            if ($category == 'MARKETING') {
                                echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'MARKETING');
                            } elseif ($category == 'UTILITY') {
                                echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'UTILITY');
                            } elseif ($category == 'AUTHENTICATION') {
                                echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'AUTHENTICATION');
                            } else {
                                echo $category; // Mostrar categoría original si no coincide con las categorías hardcoded
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            $templateType = ''; // Variable para almacenar el tipo de plantilla
                            foreach ($template['components'] as $component) {
                                if ($component['type'] == 'CAROUSEL') {
                                    $templateType = 'CARRUSEL';
                                } elseif ($component['type'] == 'LIMITED_TIME_OFFER') {
                                    $templateType = 'OFERTA';
                                }
                                foreach ($component['buttons'] as $buttons) {
                                    if ($buttons['type'] == 'MPM') {
                                        $templateType = 'MULTIPRODUCTO';
                                    }
                                    if ($buttons['type'] == 'CATALOG') {
                                        $templateType = 'CATALOGO';
                                    }
                                }
                            }
                            if (empty($templateType)) {
                                $templateType = 'ESTÁNDAR';
                            }
                            echo htmlspecialchars($templateType);
                            ?>
                        </td>

                        <td class="components-column">
                            <?php $fieldsCount = 0;
                            $fieldsCountHeader = 0;
                            $fieldCountHeaderDocument = 0;
                            $fieldCountHeaderImage = 0;
                            $fieldCountHeaderVideo = 0; ?>
                            <div class="rounded bg-light p-2" title="<?php echo htmlspecialchars(json_encode($template, JSON_PRETTY_PRINT)) ?>">
                                <?php foreach ($template['components'] as $component) : ?>
                                    <?php if ($component['type'] == 'HEADER' && $component['format'] == 'IMAGE' && isset($component['example']['header_url'][0])) : ?>
                                        <img src="<?php echo htmlspecialchars($component['example']['header_url'][0]) ?>" width="100px" />
                                    <?php endif; ?>
                                    <?php if ($component['type'] == 'HEADER' && $component['format'] == 'DOCUMENT' && isset($component['example']['header_url'][0])) : ?>
                                        <div>
                                            <span class="badge badge-secondary">FILE: <?php echo htmlspecialchars($component['example']['header_url'][0]) ?></span>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($component['type'] == 'HEADER' && $component['format'] == 'VIDEO' && isset($component['example']['header_url'][0])) : ?>
                                        <div>
                                            <span class="badge badge-secondary">VIDEO: <?php echo htmlspecialchars($component['example']['header_url'][0]) ?></span>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <?php foreach ($template['components'] as $component) : ?>
                                    <?php if ($component['type'] == 'BODY') :
                                        $matchesReplace = [];
                                        preg_match_all('/\{\{[0-9]\}\}/is', $component['text'], $matchesReplace);
                                        if (isset($matchesReplace[0])) {
                                            $fieldsCount = count($matchesReplace[0]);
                                        }
                                    ?><p><?php echo htmlspecialchars($component['text']) ?></p><?php endif; ?>
                                    <?php if ($component['type'] == 'HEADER') : ?>
                                        <?php if ($component['format'] == 'DOCUMENT') : $fieldCountHeaderDocument = 1; ?>
                                            <h5 class="text-secondary">DOCUMENT</h5>
                                        <?php elseif ($component['format'] == 'VIDEO') : $fieldCountHeaderVideo = 1; ?>
                                            <h5 class="text-secondary">VIDEO</h5>
                                            <?php if (isset($component['example']['header_handle'][0])) : ?>
                                                <video width="100">
                                                    <source src="<?php echo htmlspecialchars($component['example']['header_handle'][0]) ?>" type="video/mp4">
                                                </video>
                                            <?php endif; ?>
                                        <?php elseif ($component['format'] == 'IMAGE') : $fieldCountHeaderImage = 1; ?>
                                            <h5 class="text-secondary">IMAGE</h5>
                                            <?php if (isset($component['example']['header_handle'][0])) : ?>
                                                <img src="<?php echo htmlspecialchars($component['example']['header_handle'][0]) ?>" width="100px" />
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <?php
                                            $matchesReplace = [];
                                            preg_match_all('/\{\{[0-9]\}\}/is', $component['text'], $matchesReplace);
                                            if (isset($matchesReplace[0])) {
                                                $fieldsCountHeader = count($matchesReplace[0]);
                                            }
                                            ?>
                                            <h5 class="text-secondary"><?php echo htmlspecialchars($component['text']) ?></h5>
                                        <?php endif; ?>

                                    <?php endif; ?>
                                    <?php if ($component['type'] == 'FOOTER') : ?><p class="text-secondary"><?php echo htmlspecialchars($component['text']) ?></p><?php endif; ?>
                                    <?php if ($component['type'] == 'BUTTONS') : ?>
                                        <?php foreach ($component['buttons'] as $button) : ?>
                                            <div class="pb-2"><button class="btn btn-sm btn-secondary"><?php echo htmlspecialchars($button['text']) ?> | <?php echo htmlspecialchars($button['type']) ?></button></div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </td>
                        <td>
                            <?php if ($delete_template == true) : ?>
                                <form method="post" action="<?php echo erLhcoreClassDesign::baseurl('fbwhatsapp/delete') ?>" onsubmit="return confirm('Esta acción es irreversible, ¿desea eliminar la plantilla? ');">
                                    <input type="hidden" name="template_name" value="<?php echo htmlspecialchars_decode($template['name']); ?>">
                                    <button type="submit" class="btn btn-danger"><span class="material-icons">delete</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Delete'); ?></button>
                                </form>
                            <?php endif ?>
                            <form method="post" action="<?php echo erLhcoreClassDesign::baseurl('fbwhatsapp/metric_templates') ?>">
                                <input type="hidden" name="template_id" value="<?php echo htmlspecialchars_decode($template['id']); ?>">
                                <button type="submit" class="btn btn-dark"><span class="material-icons">equalizer</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Metrics'); ?></button>
                            </form>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>