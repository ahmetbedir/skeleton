# Skeleton Framework

İlgi ve merakım üzerine geliştirilen bir framework profesyonel bir amaç için kullanıma uygun değildir! Şuan ki halinde çok eksik var zamanla geliştirmeye devam edeceğim.

Sadelik ve kolaylık bakımında beğendiğim Laravel'in kullandığı paketlerden bir kaçını kullanıyorum.

## Özellikleri
- Eloquent Model Yapısı
- Edge Template Motoru (Edge)
- Laravel benzeri rota sistemi

# Örnek: Rota Sistemi
```php
// Gönderilen ID ye sahip kullanıcın yazılarını döndür
Route::get('/users/{id}/articles', function($id){
    return User::with('articles')->find($id)->articles;
});

// Tüm yazıları göster
Route::get('articles', 'ArticleController@index');

// Yeni yazı oluşturma sayfasına git
Route::get('articles/create', 'ArticleController@create');

// Yeni yazı oluşturma formunda gönderilen değeleri kaydet
Route::post('articles', 'ArticleController@store');

// Gönderilen ID ye sahip yazıyı göster
Route::get('articles/{id}', 'ArticleController@show');

// Gönderilen ID ye sahip yazıyı bul ve düzenleme sayfasını aç
Route::get('articles/{id}/edit', 'ArticleController@edit');

// Gönderilen ID ye sahip yazıyı bul ve formdan gönderilen değerler ile güncelle
Route::put('articles/{id}', 'ArticleController@update');

// Gönderilen ID ye sahip yazıyı bul ve sil
Route::delete('articles/{id}', 'ArticleController@destroy');
```

# Örnek: Eloquent User Model
```php
use App\Models\Articles;

class User extends Model {   
    protected $table = 'users';

    public function articles(){
        return $this->hasMany(Articles::class);
    }
}
```