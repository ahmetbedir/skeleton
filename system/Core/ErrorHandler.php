<?php

namespace Ahmetbedir\Skeleton\Core;

class ErrorHandler
{
    protected $whoops;

    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->whoops = new \Whoops\Run;
        $this->whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
        $this->whoops->register();
    }
}
