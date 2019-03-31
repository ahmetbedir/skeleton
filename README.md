# Basit MVC Framework (BDR)

İlgi merakım üzerine geliştirilen bir framework profesyonel bir amaç için şuanki halinde çok eksik var zamanla geliştirmeye devam edeceğim.

Sadelik ve kolaylık bakımında beğendiğim Laravel'in kullandığı paketleriden bir kaçığını kullanıyorum.

## Özellikleri
- Eloquent Model Yapısı
- Blade Template Motoru (Edge)
- Laravel benzeri rota sistemi
- Composer ile ek paketler kurulabilir.

# Rota Sistemi
```php
Route::get('/makale/{id}', function(){
    return view('');
});
```

# Eloquent Model
```php
class User extends Model {   
    protected $table = 'users';
}
```