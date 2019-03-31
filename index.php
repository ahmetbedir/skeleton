<?php 

ini_set('error_reporting', E_ALL);
set_error_handler("appError", E_ALL);

function appError($errno, $errstr) {
  echo "<b>Error:</b> [$errno] $errstr<br>";
}

define("ROOT_DIR", __DIR__);
// System Paths
define("SYSTEM_PATH", ROOT_DIR."/system");
define("CORE_PATH", SYSTEM_PATH."/Core");
define("HELPERS_PATH", SYSTEM_PATH."/Helpers");

// App Paths
define("APP_PATH", ROOT_DIR."/app");
define("CONTROLLERS_PATH", ROOT_DIR."/app/Controllers");
define("VIEWS_PATH", ROOT_DIR."/app/Views");
define("MODELS_PATH", ROOT_DIR."/app/Models");

// Config ve Vendor dizinleri
define("VENDOR_PATH", ROOT_DIR."/vendor");
define("CONFIG_PATH", ROOT_DIR."/config");

// Temel framework dosyalarını dahil et
require CORE_PATH."/App.php";
require CORE_PATH."/Loader.php";
require VENDOR_PATH.'/autoload.php';

// Sistem için gerekli dosyaları dahil et
Loader::register();

// Rota dosyasını dahil et.
require APP_PATH."/routes.php";

// Uygulamayı başlat.
$app = new App();