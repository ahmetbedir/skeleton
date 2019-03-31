<?php
return array(
    /*
    |--------------------------------------------------------------------------
    | Uygulama Adı
    |--------------------------------------------------------------------------
    |
    | Bu değer uygulamanın adını belirtir. Ugulamanın adını belirtmen 
    | framework ve paketler için önemlidir.
    |
    */
    'name' => 'BDR MVC Project',
    
    /*
    |--------------------------------------------------------------------------
    | Uygualama Ortamı
    |--------------------------------------------------------------------------
    |
    | Bu değer çalışma ortamını belirtir. Development ve Production olarak
    | belirtebilirsiniz. Böylece uygulama içerisinde hata ve bilgi mesajları 
    | development modunda daha detaylı olarak alabilirsiniz.
    |
    */
    'env' => 'development',
    
     /*
    |--------------------------------------------------------------------------
    | Uygulama URL
    |--------------------------------------------------------------------------
    |
    | Bu değer ile uygulamnızın URLsi belirterek framework içerisinde kullanılan
    | belirtilen urlnin başına otomatik eklenecektir.
    |
    */
    'base_url'              => 'http://localhost',
    /*
    |--------------------------------------------------------------------------
    | Uygulama Zaman Dilimi
    |--------------------------------------------------------------------------
    |
    | Bu değer uygulama içerisinde kullandığınız PHP tarih ve saat 
    | fonksiyonlarda etki gösterecektir. Bölgenize göre desteklenen biçimler
    | PHP tarafından geri döndürülür.
    |
    */
    'timezone' => 'UTC',
    
    /*
    |--------------------------------------------------------------------------
    | Şifreleme Anahtarı
    |--------------------------------------------------------------------------
    |
    | Bu anahtar 32 karakter olarak belirtilmelidir. Şifreleme işlemlerinde
    | kullanılır ve benzersiz olarak projelerinizde kullanmanız önerilir.
    |
    */
    'key' => '',
    
    /*
    |--------------------------------------------------------------------------
    | Uygulama Dili
    |--------------------------------------------------------------------------
    |
    | Bu değer uygulamnızın dilini belirtir ve PHP fonksiyonlarında etkili olur
    |
    */
    'language'              => 'tr',
    
    /*
    |--------------------------------------------------------------------------
    | Varsayılan Controller
    |--------------------------------------------------------------------------
    |
    | Bu değer uygulama başlatıldığında varsayılan kontrolcüyü devreye sokar.
    |
    */
    'default_controller'    => 'Home',
    
    /*
    |--------------------------------------------------------------------------
    | Varsayılan Controller Method'u
    |--------------------------------------------------------------------------
    |
    | Bu değer varsayılan controller başlatıldığında 
    | çalıştırılacak methodu belirtir.
    |
    */
    'default_method'        => 'index',
    
    /*
    |--------------------------------------------------------------------------
    | Varsayılan View
    |--------------------------------------------------------------------------
    |
    | Bu değer varsayılan view dosyasını ayarlar ve ilk olarak bu view gösterilir. 
    |
    */
    'default_view'          => 'home.index',
    
    /*
    |--------------------------------------------------------------------------
    | Composer
    |--------------------------------------------------------------------------
    |
    | Bu değer uygulama içerisinde composer kullanılıp kullanılmayacağını belirler.
    |
    */
    'composer'              => true,
);