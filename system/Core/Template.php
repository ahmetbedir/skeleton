<?php

namespace Ahmetbedir\Skeleton\Core;

use Windwalker\Edge\Cache\EdgeFileCache as EdgeFileCache;
use Windwalker\Edge\Edge;
use Windwalker\Edge\Loader\EdgeFileLoader as EdgeFileLoader;

/**
 * Template Manager
 */
class Template
{

    public function render($file, $data = [], $cache = true)
    {
        $paths = array(view_path());

        $loader = new EdgeFileLoader($paths);
        $loader->addFileExtension('.blade.php');

        if ($cache === true) {
            $this->edge = new Edge($loader, null, new EdgeFileCache(STORAGE_PATH . '/framework/view/cache'));
        } else {
            $this->edge = new Edge($loader);
        }

        try {
            return $this->edge->render($file, $data);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

}
