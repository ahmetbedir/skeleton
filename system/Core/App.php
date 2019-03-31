<?php

/**
 * Application
 */
class App {
	
	protected static $allConfig;
	
	public function __construct(){

	}
	
	
	public function __destruct(){
		Route::dispatch();
	}
}