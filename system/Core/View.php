<?php 

class View {
    
    /**
     * View dosyasının yolu
     */
    protected static $page  = null;
    
    
    /**
     * View dosyasına gönderilecek veriler
     */
    protected static $data  = [];
    
    
    /**
     * View dosyasında önbellekleme kullanımı için
     * Varsayılan olarak aktif değildir.
     */
    protected static $cache = false;
    
    /**
     * View dosyasının yolunu, verilerini ve önbellek verilerini ayarlar
     */
    public static function make($pagePath, $data = [], $cache = false){
        self::$page     = trim((strpos($pagePath, '.') ? str_replace('.','/', $pagePath) : $pagePath), '/');
        self::$cache    = $cache;
        self::$data     = $data;
        
        return new self();
    }
    
    /**
     * View dosyasına gönderilecek verileri ekler
     */
    public function with($key, $value){
        self::$data[$key] = $value;
        
        return $this;
    }
    
    /**
     * View dosyasını yükler, verileri sayfaya dahil eder
     * Template kullanılıyor ise onu yükler, yok ise normal php dosyalarını yükler
     */
    private function render(){
        $path       = VIEWS_PATH.'/'.self::$page.'.php';
        $blade      = VIEWS_PATH.'/'.self::$page.'.blade.php';
        $edge       = VIEWS_PATH.'/'.self::$page.'.edge.php';
        
        self::$data = array_key_filter(array_filter(self::$data));
        
        $template   = new Template();
        $result     = $template->render(self::$page, self::$data, self::$cache);
        
        if(!is_null($result)){
            echo $result;
        }else{
            if(file_exists($path)){
                if(count(self::$data)){
                    extract(self::$data);
                }
                return require($path);
            }else{
                die("Hata: $path adlı view bulunamadı!");
            }
        }
    }
    
    /**
     * make fonksiyonu ile view bilgileri girildikten sonra
     * yıkıcı fonksiyon ile classın kullanımı bittiği anda 
     * otomatik render() fonksiyonunu çağırarak view dosaysını render etmiş oluruz.
     */
    public function __destruct(){
        $this->render();
    }
    
}