<?php

namespace Skeleton\Core;

/**
 * View Manager
 */
class View
{

    /**
     * View dosyasının yolu
     */
    protected static $page = null;

    /**
     * View dosyasına gönderilecek veriler
     */
    protected static $data = [];

    /**
     * View dosyasında önbellekleme kullanımı için
     * Varsayılan olarak aktif değildir.
     */
    protected static $cache = false;

    /**
     * View dosyasının yolunu, verilerini ve önbellek verilerini ayarlar
     */
    public static function make($pagePath, $data = [], $cache = false)
    {
        self::$page = trim((strpos($pagePath, '.') ? str_replace('.', '/', $pagePath) : $pagePath), '/');
        self::$cache = $cache;
        self::$data = $data;

        return new self();
    }

    /**
     * View dosyasına gönderilecek verileri ekler
     */
    public function with($key, $value)
    {
        self::$data[$key] = $value;

        return $this;
    }

    /**
     * View dosyasını yükler, verileri sayfaya dahil eder
     * Template kullanılıyor ise onu yükler, yok ise normal php dosyalarını yükler
     */
    public function render()
    {
        $path = view_path('/' . self::$page . '.php');
        $path = view_path('/' . self::$page . '.blade.php');

        self::$data = array_key_filter(array_filter(self::$data));

        $template = new Blade();
        $result = $template->render(self::$page, self::$data, self::$cache);

        if (!is_null($result)) {
            return $result;
        } else {
            if (!file_exists($path)) {
                throw new Exception("Hata: $path adlı view bulunamadı!", 1);
            }

            if (count(self::$data)) {
                extract(self::$data);
            }

            return require $path;
        }
    }

    public function __toString()
    {
        return $this->render();
    }
}
