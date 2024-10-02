<?php
require_once __DIR__ . "/activerecord/ActiveRecord.php";

if (getenv('APP_ENV') !== 'production') {
  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
  $dotenv->load();
}

ActiveRecord\Config::initialize(function ($cfg) {
  $cfg->set_model_directory(__DIR__ . "/../../../Domain/Entities");

  if (getenv('APP_ENV') === 'production') {
    // Usar las variables de entorno configuradas en Heroku
    $db_host = getenv('DB_HOST_DEV');
    $db_username = getenv('DB_USERNAME_DEV');
    $db_password = getenv('DB_PASSWORD_DEV');
    $db_name = getenv('DB_DATABASE_DEV');
  } else {
      // Configuración local
      $db_host = 'localhost';
      $db_username = 'root';
      $db_password = 'tu_contraseña_local';
      $db_name = 'Gestion_turnos_guias_bd';
  }

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
