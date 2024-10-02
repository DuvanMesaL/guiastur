<?php
require_once __DIR__ . "/activerecord/ActiveRecord.php";


ActiveRecord\Config::initialize(function ($cfg) {
  $cfg->set_model_directory(__DIR__ . "/../../../Domain/Entities");
  $cfg->set_connections(
    array(
      'development' => 'mysql://root:@localhost/Gestion_turnos_guias_bd'
      //'development' => 'mysql://' . $_ENV['DB_USERNAME'] . ':' . $_ENV['DB_PASSWORD'] . '@' . $_ENV['DB_HOST'] . '/' . $_ENV['DB_DATABASE']
      //    ,
      //    'test' => 'mysql://username:password@localhost/test_database_name',
      //    'production' => 'mysql://username:password@localhost/production_database_name'
    )
  );
});
