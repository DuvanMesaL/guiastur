<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Infrastructure/Libs/Orm/Config.php";

class Turno  extends  ActiveRecord\Model {
    public static $belongs_to = array(array("guia"), array("atencion"));
}

