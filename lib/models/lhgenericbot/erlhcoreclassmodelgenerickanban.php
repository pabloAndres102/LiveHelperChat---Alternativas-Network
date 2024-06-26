<?php
#[\AllowDynamicProperties]
class erLhcoreClassModelGenericKanban {

    use erLhcoreClassDBTrait;

    public static $dbTable = 'lh_generic_kanban'; // Manteniendo el nombre de la tabla
    public static $dbTableId = 'id';
    public static $dbSessionHandler = 'erLhcoreClassGenericBot::getSession';
    public static $dbSortOrder = 'DESC';

    public function getState()
    {
        $stateArray = array(
            'id' => $this->id,
            'nombre' => $this->nombre,
            'color' => $this->color,
            'chat_id' => $this->chat_id, 
        );

        return $stateArray;
    }

    public function __toString()
    {
        return $this->nombre;
    }

    public $id = null;
    public $nombre = '';
    public $color = '';
    public $chat_id = null; 
}
?>
