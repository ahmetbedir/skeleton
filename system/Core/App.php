<?php

/**
 * Application
 */
class App
{
    public function __destruct()
    {
        Route::dispatch();
    }
}
