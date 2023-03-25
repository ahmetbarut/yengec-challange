# Kullanım

Kullanıma hoşgeldiniz. Bu bölümde API'nin nasıl kullanılacağını bulacaksınız.

#### [Postman Collection](yengec-postman-collection.json)

## API

*HEADER*
```http request
Accept: application/json
Content-Type: application/json
```
> HTTP Başlıklarını eklemezseniz hatalı mesajları göremezsiniz.

## Register
Yeni bir kullanıcı oluşturmak için kullanılır. Başarılı durumlarda 201 döner. Başarısız durumlarda 422 döner.

*`POST`*

*BASE_URL*`/api/register`

**Request**

```json
{
    "name": "string",
    "email": "string",
    "password": "string",
    "password_confirmation": "string"
}
```

**Response**
_201_
```json
{
    "access_token": "string"
}
```

Başarılı olması durumunda `access_token`'ı alacaksınız. Bu token ile diğer isteklerde kullanacaksınız.

## Login

Kullanıcı girişi yapmak için kullanılır. Başarılı durumlarda 200 döner. Başarısız durumlarda 422 döner.

*`POST`*

*BASE_URL*`/api/login`

**Request**

```json
{
    "email": "string",
    "password": "string"
}
```

**Response**
_200_
```json
{
    "access_token": "string"
}
```


## Yeni Entegrasyon Ekleme

Yeni bir entegrasyon eklemek için kullanılır. Başarılı durumlarda 201 döner. Başarısız durumlarda 422 döner.

*`POST`*

*BASE_URL*`/api/integrations`

**Request**

```json
{
    "marketpalce": "string",
    "name": "string",
    "password": "string"
}
```

**Response**
_201_

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

## Entegrasyon Güncelleme

Entegrasyon güncellemek için kullanılır. Başarılı durumlarda 201 döner. Başarısız durumlarda 422 döner.

*`PUT`*

*BASE_URL*`/api/integrations/{id}`

**Request**

```json
{
    "marketpalce": "string",
    "name": "string",
    "password": "string"
}
```

**Response**
_201_

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

## Entegrasyon Silme

Entegrasyon silmek için kullanılır. Başarılı durumlarda 204 döner. Başarısız durumlarda 422 döner.

*`DELETE`*

*BASE_URL*`/api/integrations/{id}`

**Response**
_204_

