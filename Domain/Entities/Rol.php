<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Infrastructure/Libs/Orm/Config.php";

class Rol  extends  ActiveRecord\Model {
        public static $has_many = array(array("usuarios"));
}

