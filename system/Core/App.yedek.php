<?php

/**
 * Application
 */
class App {
	
	protected $controllerName	= null;
	protected $controller		= null;
	protected $method			= null;
	protected $params			= array();
	
	public  $_uri				= array();
	public  $_routes			= array();
	
	protected static $allConfig;
	
	public function __construct(){
		$this->parseURL();
	}
	
	public function route($uri = null, $method = null){
		$uri				= trim($uri, '/');
		$this->_uri[]		= empty($uri) ? '/' : '/'.$uri;
        $this->_routes[] 	= $method;
	}

	private function run(){
		
		$uriGetParam	= isset($_GET['url']) ? '/'.trim($_GET['url'], '/') : '/';
		
		$uriParams		= array_map(function($item){
			return empty($item) ? '/' : $item;
		}, explode('/', $uriGetParam));
		
        foreach($this->_uri as $key => $value){
        	
        	$routesParams = array_map(function($item){
        		return empty($item) ? '/' : $item;
        	}, explode("/", $value));
        	
        	// print_r($routesParams);
        	
        	// Zorunlu tutulacak rota
        	$importantRoutes	= $this->importantRoutes($routesParams, $uriParams);
        
        	// İsteğe bağlı rota
        	$optionalRoutes		= $this->optionalRoutes($routesParams);
        	
        	// Rotadan gelen method ismi ve tarayıcıdan gelen method
        	// Parametleri yok ise işleme girmez.
        	if(isset($routesParams[1]) && isset($uriParams[1])){
        		
        		// Rotada ki method ile tarayıcıdan gelen method parametleri
        		// eşleşmez ise işleme girmez.
        		if(preg_match("#^".$routesParams[1]."#", $uriParams[1])){
        			
        			if(count($uriParams) > count($routesParams)){
        				throw HTTP_NOT_FOUND;
        			}
        			
        			// Mecburi rotaya eşleştirilmesi
        			$this->importantRoutesControl($importantRoutes, $uriParams);
        			
        			// Method adını ve '/' işaretini temizle
					unset($uriParams[0], $uriParams[1], $routesParams[0], $routesParams[1]);
					
					/// Rotaları ve Tarayıcı URI'ın index numaralarını sırala
					// $routesParams	= sortindex($routesParams);
					// $uriParams		= sortindex($uriParams);
					
					// Controller'e gönderilecek tüm parametre bilgileri
					$allParams	= array();
					
					// Rota ayarları
					if(count($routesParams)){
						// Son index numarasını ayarla
						end($routesParams);
						// Rota ayarlarını parametrelere göre düzenle
						for($i = 2; $i <= key($routesParams); $i++){
							// Tarayıcıdan gelen parametreler ile rotadan gelen 
							// parametlerin kontrolü yapılır
							if(isset($uriParams[$i]) && isset($routesParams[$i])){
								// Parametler değişken ise tarayıcdan gelen bilgiler ile değiştiriler
								$allParams[$i]	= preg_replace("#\{(.*?)\}#", $uriParams[$i], $routesParams[$i]);
							}
						}
					}
	        		
	        		// Rotadan gelen değer string ise
	        		// Control ve Method bilgilerine göre çağırma işlemi yap
					if(is_string($this->_routes[$key])){
						
						// Rota bilgisinin @ işareti kontrolü yapılır
						// Ve @ işaretinden sonra method adı kontrolü yapılır
						if(strstr($this->_routes[$key], '@') && (substr($this->_routes[$key], strpos($this->_routes[$key], '@')+1) == true)){
							
							// Rota bilgisini @ işareti yardımıyla parçala
							$split		= explode('@', $this->_routes[$key]);
							$controller = $split[0]; // Controller adı
							$method		= $split[1]; // Controller içerisinde ki method adı
							
							// Controller dosyasının Namespace ni ve adını birleştir
							$controllerClass =  "App\Controllers\\".$controller;
							
							// Controllerın sınıfının kontrolü yapılır
							if(class_exists($controllerClass)){
								// $this->controller değişkenine yeni bir controller oluşturulur.
								$this->controller	= new $controllerClass;
								
								// Controllerin içindeki rotadan gelen method adı kontrol edilir.
								if(method_exists($this->controller, $method)){
									// Controller ve method çalıştırılır
									// Çalıştırma işleminden önce parametreler gönderilir.
									return call_user_func_array(array($this->controller, $method), $allParams);
								}else{
									die("Hata: $class sınıfı içerisindeki $method method bulunamadı!");
								}
							}else{
								die("Hata: $class sınıfı bulunamadı!");
							}
						}else{
							die("Hata: {$this->_routes[$key]} rotasına @ işareti ve method girilmemiş!");
						}
					}else{
						// Rotada Coluser kullanılmış ise fonksiyonu çalıştırır.
						return call_user_func($this->_routes[$key]);
					}
	            }
        	}
        }
        
        die($this->method." Aradığınız sayfa bulunamadı!");
        //trigger_error("Aradığınız sayfa bulunamadı!", E_USER_WARNING);
	}

	private function parseURL(){
		if(isset($_GET['url'])){
			$url = explode('/', trim($_GET['url'], '/'));
			
			if(count($url) > 0){
				$this->controllerName   = isset($url[0]) ? $url[0] : null;
				$this->method           = isset($url[1]) ? $url[1] : null;
				
				unset($url[0], $url[1]);
					
				$this->params = isset($url) ? $url : null;
			}
		}
	}
	
	private function importantRoutes(array $routes = null){
		if(is_array($routes)){
			
			$importantRoutes = array('','');
			$urlRoutes = $this->_uri;
			unset($routes[0], $routes[1]);
			
			
			foreach ($routes as $value) {
				$important = [];
				
				if(strstr($value, '{') && strstr($value, '}')){
					preg_match_all("#{.+[^\?]}+#", $value, $important);
					$importantRoutes[]	= current($important[0]);
				}else{
					$importantRoutes[] = $value;
				}
			}
			
			$importantRoutes = array_filter($importantRoutes);
			
			// print_r($importantRoutes);
			
			if(count($importantRoutes) > 0){
				return $importantRoutes;
			}
		}
		
		return [];
	}
	
	private function optionalRoutes(array $routes = null){
		if(is_array($routes)){
			
			$optionalRoutes = array();
			foreach ($routes as $value) {
				preg_match_all("#{.+?\?\}+#", $value, $optional);
				
				$optionalRoutes[]	= current($optional[0]);
			}
			$optionalRoutes = array_filter($optionalRoutes);
			
			if(count($optionalRoutes)){
				return $optionalRoutes;
			}
		}
		
		return null;
	}
	
	// Rotada eşleşmesi mecburi değerlerin
	// Eleştirilip bir listede toplanması gerekiyor
	// Mecburi değerler yok ise rota eşleştirilmeyecek..
	private function importantRoutesControl($importantRoutes = [], $uriParams = []){
		$importantRoutesResults = [];
		if(count($importantRoutes) && count($uriParams)){
			end($importantRoutes);
			for($i = 2; $i <= key($importantRoutes);$i++){
				if(isset($importantRoutes[$i]) && isset($uriParams[$i])){
					if(strstr($importantRoutes[$i], '{') && strstr($importantRoutes[$i], '}')){
						$importantRoutesResults[$uriParams[$i]] = $importantRoutes[$i];
					}else{
						if($importantRoutes[$i] == $uriParams[$i]){
							$importantRoutesResults[$uriParams[$i]] = $importantRoutes[$i];
						}
					}
				}
			}
		}
		
		if(count($importantRoutes)){
			if(count($importantRoutesResults) != count($importantRoutes)){
				die("Aradığınız sayfa bulunamadı!!");
			}
		}
	}
	
	public function __destruct(){
		$this->run();
	}
}