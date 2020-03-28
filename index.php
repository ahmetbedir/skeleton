<?php

ini_set('error_reporting', E_ALL);

// Yol tanımlamaları
define("ROOT_DIR", __DIR__);
define("SYSTEM_PATH", ROOT_DIR . "/system");
define("CORE_PATH", SYSTEM_PATH . "/Core");
define("HELPERS_PATH", SYSTEM_PATH . "/Helpers");
define("APP_PATH", ROOT_DIR . "/app");
define("CONTROLLERS_PATH", ROOT_DIR . "/app/Controllers");
define("VIEWS_PATH", ROOT_DIR . "/app/Views");
define("MODELS_PATH", ROOT_DIR . "/app/Models");
define("CONFIG_PATH", ROOT_DIR . "/config");
define("STORAGE_PATH", ROOT_DIR . "/storage");
define("VENDOR_PATH", ROOT_DIR . "/vendor");

// Temel framework dosyalarını dahil et
require CORE_PATH . "/App.php";
require CORE_PATH . "/Loader.php";
require VENDOR_PATH . '/autoload.php';

// Error handler start
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

// Sistem için gerekli dosyaları dahil et
Loader::register();

// Rota dosyasını dahil et.
require APP_PATH . "/routes.php";

// Uygulamayı başlat.
$app = new App();
