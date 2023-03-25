# Kullanım

Kullanıma hoşgeldiniz. Bu bölümde API'nin nasıl kullanılacağını bulacaksınız.

## İçerik

- [Kullanım](#kullanım)
  - [İçerik](#i̇çerik)
  - [Postman Collection](#postman-collection)
  - [Kaydolma](#register)
  - [Giriş Yap](#login)
  - [Yeni Entegrasyon](#yeni-entegrasyon-ekleme)
  - [Entegrasyon Güncelleme](#entegrasyon-güncelleme)
  - [Entegrasyon Silme](#entegrasyon-silme)
  - [Komutlar](#komutlar)


#### [Postman Collection](yengec-postman-collection.json)
## Endpointler

Projenin endpointleri aşağıdaki gibidir:

### Register

Bu endpoint, yeni bir kullanıcı oluşturmak için kullanılır. Başarılı durumlarda 201 dönerken başarısız durumlarda 422 döner.
`POST BASE_URL/api/register`**Request**

```
{
    "name": "string",
    "email": "string",
    "password": "string",
    "password_confirmation": "string"
}

```

**Response** *201*

```
{
    "access_token": "string"
}

```

Başarılı olması durumunda `access_token`'ı alacaksınız. Bu token ile diğer isteklerde kullanabilirsiniz.

### Login

Bu endpoint, kullanıcı girişi yapmak için kullanılır. Başarılı durumlarda 200 dönerken başarısız durumlarda 422 döner.
`POST BASE_URL/api/login`**Request**

```
{
    "email": "string",
    "password": "string"
}

```

**Response***200*

```
{
    "access_token": "string"
}

```

### Yeni Entegrasyon Ekleme

Bu endpoint, yeni bir entegrasyon eklemek için kullanılır. Başarılı durumlarda 201 dönerken başarısız durumlarda 422 döner.
`POST BASE_URL/api/integrations`**Request**

```
{
    "marketpalce": "string",
    "name": "string",
    "password": "string"
}

```

**Response** *201*

```
{
    "name": "string",
    "marketplace": "string",
    "user_id": "number",
    "updated_at": "datetime",
    "created_at": "datetime",
    "id": "number"
}

```

### Entegrasyon Güncelleme

Bu endpoint, entegrasyon güncellemek için kullanılır. Başarılı durumlarda 201 dönerken başarısız durumlarda 422 döner.
`PUT BASE_URL/api/integrations/{id}`**Request**

```
{
    "marketpalce": "string",
    "name": "string",
    "password": "string"
}

```

**Response***201*

```
{
    "name": "string",
    "marketplace": "string",
    "user_id": "number",
    "updated_at": "datetime",
    "created_at": "datetime",
    "id": "number"
}

```

### Entegrasyon Silme

Bu endpoint, entegrasyon silmek için kullanılır. Başarılı durumlarda 204 dönerken başarısız durumlarda 422 döner.
`DELETE BASE_URL/api/integrations/{id}`**Response***204*

## Commandlar

Projenin bir diğer özelliği de entegrasyon ekleyen, çıkaran ve güncelleyen bir komut dosyası oluşturulmalıdır.

## Testler

API testleri, unit testleri ve command testleri olmak üzere üç farklı kategoride testler oluşturulmalıdır. API testleri için Register servisinde girilen email adresi email adresi değilse hata verilmeli ve gerekli alanlardan name alanı girilmediğinde hata verilmeli. Unit testleri için entegrasyon ekleme, silme ve güncelleme işlemleri test edilmelidir. Command testleri ise entegrasyon ekleyen, çıkaran ve güncelleyen komut dosyası için oluşturulmalıdır.

## Postman

Proje için Postman API dökümanı hazırlanmalıdır. Ayrıca, Postman Collection hazırlanmalıdır.

## Kurulum

Son olarak, proje için bir kurulum klavuzu hazırlanmalıdır. Bu klavuz, projeyi kullanacak kişilerin proje kodunu nasıl çalıştıracağına dair detaylı bilgiler içermelidir.

Sonuç olarak, projenin başarılı bir şekilde tamamlanabilmesi için öncelikle ön koşulların ve testlerin tamamının dikkatle incelenmesi gerekmektedir. Ayrıca, API dökümanı, Postman Collection ve kurulum klavuzu gibi ilgili dokümantasyonlar hazırlanmalıdır.

## Komutlar

Komutlar entegrasyon ekleme, güncelleme ve silme işlemlerini yapmak için kullanılır. Aşağıda bu komutların kullanımı hakkında daha fazla bilgi bulabilirsiniz:

### Entegrasyon Ekleme

Entegrasyon eklemek için şu komutu kullanabilirsiniz:

```
php artisan app:create-integration marketplace name password  # Veya boş bırakıp sormasını sağlayabilirsiniz.

```

Bu komut, `marketplace`, `name` ve `password` parametrelerini alır. Bu parametrelerle birlikte entegrasyon oluşturur. Ayrıca parametreleri boş bırakarak da entegrasyon oluşturma işlemini yapabilirsiniz. Bu durumda, Terminal size parametreleri soracaktır:

```
php artisan app:create-integration

```

### Entegrasyon Güncelleme

Entegrasyon güncellemek için sadece id'yi parametre olarak iletebilirsiniz veya boş bırakıp size sormasını sağlayabilirsiniz. Aşağıdaki komutları kullanabilirsiniz:

```
php artisan app:update-integration --id=1  # Veya boş bırakıp sormasını sağlayabilirsiniz.

```

Bu komut, `id` parametresini alır ve entegrasyonu bu `id` değerine göre günceller. Ayrıca, parametreyi boş bırakarak da güncelleme işlemini yapabilirsiniz. Bu durumda, Terminal size `id` parametresini soracaktır.

### Entegrasyon Silme

Entegrasyon silmek için aşağıdaki komutları kullanabilirsiniz:

```
php app:destroy-integration --id=1 # Veya boş bırakıp sormasını sağlayabilirsiniz.

```

Bu komut, `id` parametresini alır ve entegrasyonu bu `id` değerine göre siler. Ayrıca, parametreyi boş bırakarak da silme işlemini yapabilirsiniz. Bu durumda, Terminal size `id` parametresini soracaktır.
