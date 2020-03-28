<?php

use Windwalker\Edge\Cache\EdgeFileCache as EdgeFileCache;
use Windwalker\Edge\Edge;
use Windwalker\Edge\Loader\EdgeFileLoader as EdgeFileLoader;

class Template
{

    public function render($file, $data = [], $cache = true)
    {
        $paths = array(VIEWS_PATH);

        $loader = new EdgeFileLoader($paths);
        $loader->addFileExtension('.blade.php');

        if ($cache === true) {
            $this->edge = new Edge($loader, null, new EdgeFileCache(STORAGE_PATH . '/framework/view/cache'));
        } else {
            $this->edge = new Edge($loader);
        }

        $result = null;

        try {
            $result = $this->edge->render($file, $data);
        } catch (Exception $e) {
            $result = null;
        }

        return $result;
    }

}
