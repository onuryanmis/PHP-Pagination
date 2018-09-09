PHP Sayfalama sınıfı
================

PHP ile hazırlanmış özelleştirilebilir sayfalama sınıfı.

Kurulum
=======

Sınıfı sayfamıza dahil ediyoruz.

``` php
require_once "src/pagination.class.php";

```

Kullanımı
=======
``` php
$page = isset($_GET["page"]) ? intval($_GET["page"]) : 1;  // Tarayıcıdan sayfa bilgisini alıyoruz. (Sonradan ekliyebileceğiniz ayar ile sef linke uygun yapabilirsiniz.  örn: example.com/test/2  )
$config = [
    "url" => "http://localhost/pagination/test.php", // Sayfalama linkleri oluşturulurken kullanılacak url.
    "total" => 10,   // Toplam veri sayısı
    "per_page" => 2,   // Her sayfada kaç tane veri gösterileceğini yazıyoruz.
    "current_page" => $page  // Aktif sayfa
];

// Sayfalama sınıfına ayarlarımızı gönderip çalıştırıyoruz
// 2.parametre belirterek bootstrap3'e ve bootstrap4'e uyumlu hale getirebiliriz.
// bootstrap4 => bs4,
// bootstrap3 => bs3
$pagination = new Pagination($config);

echo $pagination->create();  // Linklerimizi oluşturuyoruz

```

Sayfalama ayarları
=======

**Sayfa numarasının gönderildiği get parametresinin ismini değiştirmek**
``` php
// örn:example.com/test.php?sayfa=2
$config["query_string_name"] = "sayfa";
```


**Sef link şeklinde linklendirme**
``` php
// örn:example.com/test/2
$config["query_string"] = false;
```


**İlk ve son linklerini gizlemek**
``` php
$config["first_last_page"] = false;
```

**Sonraki ve önceki linklerini gizlemek**
``` php
$config["prev_next"] = false;
```

Özelleştirmeler
=======


**Sayfalama açılış etiketi (Sayfalama linkleri oluşmadan önce eklemek istediğiniz kodlar)**
``` php
$config["open"] = "<div class='sayfalama'>";  // Açılış etiketi
```

**Sayfalama kapanış etiketi (Sayfalama linkleri oluşturulduktan sonra eklemek istediğiniz kodlar)**
``` php
$config["close"] = "</div>";  // Açılış etiketimizi kapatıyoruz
```


**Sayfa numaralarını özelleştirme**
``` php
// Değerler belirtilmezse varsayılan değerler alınacaktır.
$config["page"] = [
    "before"=>"<li>",  // Sayfa numara linklerinden önce eklenecek kodlar. (varsayılan değer : "")
    "after"=>"</li>", // Sayfa numara linklerinden sonra eklenecek kodlar. (varsayılan değer : "")
    "content"=>"(:num). sayfa",  // Sayfa numara linkinde yazılacak yazı.  (:num) kısmını otomatik olarak sayıya çevirir. (varsayılan değer : "(:num)")
    "attr"=>["class"=>"deneme"]  // Sayfa numara linkine vermek istediğiniz özellikler (varsayılan değer : [])
];
```

**Aktif sayfa linkini özelleştirme**
``` php
// Değerler belirtilmezse varsayılan değerler alınacaktır.
$config["cur_page"] = [
    "before"=>"<li>",  // Aktif sayfa linkinden önce eklenecek kodlar.  (varsayılan değer : "")
    "after"=>"</li>", // Aktif sayfa linkinden sonra eklenecek kodlar. (varsayılan değer : "")
    "content"=>"(:num). sayfa",  // Aktif sayfa linkinde yazılacak yazı.  (:num) kısmını otomatik olarak sayıya çevirir. (varsayılan değer : "(:num)")
    "attr"=>["class"=>"deneme"]  // Aktif sayfa linkine vermek istediğiniz özellikler (varsayılan değer : [])
];
```

**İlk sayfaya yönlendiren linki özelleştirme**
``` php
// Değerler belirtilmezse varsayılan değerler alınacaktır.
$config["first_page"] = [
    "before" => "<li>", // İlk sayfaya yönlendiren linkten önce eklenecek kodlar. (varsayılan değer : "")
    "after" => "</li>", // İlk sayfaya yönlendiren linkten sonra eklenecek kodlar. (varsayılan değer : "")
    "content" => "&lsaquo; İlk",  // İlk sayfaya yönlendiren linkte yazılacak yazı. (varsayılan değer : "&lsaquo; İlk")
    "attr" => [] // İlk sayfaya yönlendiren linke vermek istediğiniz özellikler (varsayılan değer : [])
];

```

**Son sayfaya yönlendiren linki özelleştirme**
``` php
// Değerler belirtilmezse varsayılan değerler alınacaktır.
$config["last_page"] = [
    "before" => "<li>", // Son sayfaya yönlendiren linkten önce eklenecek kodlar. (varsayılan değer : "")
    "after" => "</li>", // Son sayfaya yönlendiren linkten sonra eklenecek kodlar. (varsayılan değer : "")
    "content" => "Son &rsaquo;",  // Son sayfaya yönlendiren linkte yazılacak yazı. (varsayılan değer : "Son &rsaquo;")
    "attr" => [] // Son sayfaya yönlendiren linke vermek istediğiniz özellikler  (varsayılan değer : [])
];

```

**Önceki sayfaya yönlendiren linki özelleştirme**
``` php
// Değerler belirtilmezse varsayılan değerler alınacaktır.
$config["prev_page"] = [
    "before" => "<li>", // Önceki sayfaya yönlendiren linkten önce eklenecek kodlar. (varsayılan değer : "")
    "after" => "</li>", // Önceki sayfaya yönlendiren linkten sonra eklenecek kodlar. (varsayılan değer : "")
    "content" => "&lt; Önceki",  // Önceki sayfaya yönlendiren linkte yazılacak yazı. (varsayılan değer : "&lt;")
    "attr" => [] // Önceki sayfaya yönlendiren linke vermek istediğiniz özellikler  (varsayılan değer : [])
];
```

**Sonraki sayfaya yönlendiren linki özelleştirme**
``` php
// Değerler belirtilmezse varsayılan değerler alınacaktır.
$config["next_page"] = [
    "before" => "<li>", // Sonraki sayfaya yönlendiren linkten önce eklenecek kodlar. (varsayılan değer : "")
    "after" => "</li>", // Sonraki sayfaya yönlendiren linkten sonra eklenecek kodlar. (varsayılan değer : "")
    "content" => "Sonraki &gt;",  // Sonraki sayfaya yönlendiren linkte yazılacak yazı. (varsayılan değer : "&gt;")
    "attr" => [] // Sonraki sayfaya yönlendiren linke vermek istediğiniz özellikler  (varsayılan değer : [])
];
```


Tema seçme
=======

Sayfalama sınıfını oluştururken göndereceğimiz 2.parametre ile bootstrap4 veya bootstrap3 ile uyumlu hale getirebiliriz. Bu özellik önceki başlıkta bulunan özelleştirme işlemlerini seçtiğiniz temaya göre düzenler.


**Bootstrap4 uyumlu hale getirme**

``` php
$config = [
    "url" => "http://localhost/pagination/test.php", // Sayfalama linkleri oluşturulurken kullanılacak url.
    "total" => 10,   // Toplam veri sayısı
    "per_page" => 2,   // Her sayfada kaç tane veri gösterileceğini yazıyoruz.
    "current_page" => $page  // Aktif sayfa
];
$pagination = new Pagination($config, "bs4");
```

**Bootstrap3 uyumlu hale getirme**

``` php
$config = [
    "url" => "http://localhost/pagination/test.php", // Sayfalama linkleri oluşturulurken kullanılacak url.
    "total" => 10,   // Toplam veri sayısı
    "per_page" => 2,   // Her sayfada kaç tane veri gösterileceğini yazıyoruz.
    "current_page" => $page  // Aktif sayfa
];
$pagination = new Pagination($config, "bs3");
```


 İsterseniz temanın ayarlarınıda bir önceki özelleştirme başlığında anlatıldığı gibi özelleştirebilirsiniz.
 
 ``` php
$config["last_page"] = [
  "content"=>"Son sayfa"
];
```
 
 
Veritabanı sorguları için limit değerini almak
=======
 ``` php
$pagination = new Pagination($config);  
$limit = $pagination->getLimit();  // Verileri listeletirken sorgumuza göndereceğimiz limit değerini buluyoruz.
```


 [PDO ve MySQL örnek uygulama için tıklayın](http://www.webderslerim.com/ders/php---sayfalama-pagination-sinifi.html)
 
 
 