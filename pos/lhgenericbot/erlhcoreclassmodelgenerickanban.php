<?php

$def = new ezcPersistentObjectDefinition();
$def->table = "lh_generic_kanban"; // Cambia el nombre de la tabla
$def->class = "erLhcoreClassModelGenericKanban"; // Cambia el nombre de la clase

$def->idProperty = new ezcPersistentObjectIdProperty();
$def->idProperty->columnName = 'id';
$def->idProperty->propertyName = 'id';
$def->idProperty->generator = new ezcPersistentGeneratorDefinition(  'ezcPersistentNativeGenerator' );

// Añadir la propiedad 'nombre'
$def->properties['nombre'] = new ezcPersistentObjectProperty();
$def->properties['nombre']->columnName   = 'nombre'; // Cambia el nombre de la columna
$def->properties['nombre']->propertyName = 'nombre';
$def->properties['nombre']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

// Añadir la propiedad 'color'
$def->properties['color'] = new ezcPersistentObjectProperty();
$def->properties['color']->columnName   = 'color'; // Cambia el nombre de la columna
$def->properties['color']->propertyName = 'color';
$def->properties['color']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['posicion'] = new ezcPersistentObjectProperty();
$def->properties['posicion']->columnName   = 'posicion'; // Nombre de la nueva columna
$def->properties['posicion']->propertyName = 'posicion';
$def->properties['posicion']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

return $def;

?>
