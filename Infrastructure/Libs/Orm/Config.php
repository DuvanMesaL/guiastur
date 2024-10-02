<?php
require_once __DIR__ . "/activerecord/ActiveRecord.php";

if (getenv('APP_ENV') !== 'production') {
  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
  $dotenv->load();
}

ActiveRecord\Config::initialize(function ($cfg) {
  $cfg->set_model_directory(__DIR__ . "/../../../Domain/Entities");

  $db_host = getenv('DB_HOST_DEV') ?: 'localhost';
  $db_username = getenv('DB_USERNAME_DEV') ?: 'root';
  $db_password = getenv('DB_PASSWORD_DEV') ?: '';
  $db_name = getenv('DB_DATABASE_DEV') ?: 'Gestion_turnos_guias_bd';

  $cfg->set_connections(
    array(
      //'development' => 'mysql://root:@localhost/Gestion_turnos_guias_bd'
      'development' => 'mysql://' . $db_username . ':' . $db_password . '@' . $db_host . '/' . $db_name
      //    ,
      //    'test' => 'mysql://username:password@localhost/test_database_name',
      //    'production' => 'mysql://username:password@localhost/production_database_name'
    )
  );
});
