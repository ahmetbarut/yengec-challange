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
`POST` `BASE_URL/api/register`

Bu endpoint, yeni bir kullanıcı oluşturmak için kullanılır. Başarılı durumlarda 201 dönerken başarısız durumlarda 422 döner.

**Request**

```json
{
    "name": "string",
    "email": "string",
    "password": "string",
    "password_confirmation": "string"
}

```

**Response** *201*

```json
{
    "access_token": "string"
}

```

Başarılı olması durumunda `access_token`'ı alacaksınız. Bu token ile diğer isteklerde kullanabilirsiniz.

### Login

`POST` `BASE_URL/api/login`

Bu endpoint, kullanıcı girişi yapmak için kullanılır. Başarılı durumlarda 200 dönerken başarısız durumlarda 422 döner.

**Request**

```json
{
    "email": "string",
    "password": "string"
}

```

**Response***200*

```json
{
    "access_token": "string"
}

```

### Yeni Entegrasyon Ekleme

`POST` `BASE_URL/api/integrations`

Bu endpoint, yeni bir entegrasyon eklemek için kullanılır. Başarılı durumlarda 201 dönerken başarısız durumlarda 422 döner.
**Request**

```json
{
    "marketpalce": "string",
    "name": "string",
    "password": "string"
}

```

**Response** *201*

```json
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
`PUT` `BASE_URL/api/integrations/{id}`

Bu endpoint, entegrasyon güncellemek için kullanılır. Başarılı durumlarda 201 dönerken başarısız durumlarda 422 döner.
**Request**

```json
{
    "marketpalce": "string",
    "name": "string",
    "password": "string"
}

```

**Response***201*

```json
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
`DELETE` `BASE_URL/api/integrations/{id}`

Bu endpoint, entegrasyon silmek için kullanılır. Başarılı durumlarda 204 dönerken başarısız durumlarda 422 döner.
**Response***204*

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
