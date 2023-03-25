# Challange Hoşgeldiniz
Bu challange'de birkaç laravel özelliğini yazıp, testlerini yazdım. Bunların detayları aşağıda olacaktır. Ama önce kurulum yapmamız gerekli !


## Kurulum
Öncelikle laravel olduğu için bize çok fazla kolaylık sağlama eğiliminde. İsteyen normal kurar, isteyen docker ile kurar. Bütün adımlarını anlatacağım.

### Docker ile kurulum
Bu aşamada bilgisayarınızda docker'in kurulu olması, açık olması ve terminali kullanabilmeniz gereklidir (arayüzden nasıl yapıldığı hakkında bir fikrim yok).

1. docker'i öncelikle başlatın ve arkaplanda dursun.
2. `composer install`
3. `cp .env.example .env`
2. terminali açın ve `sail up -d` komutunu çalıştırın.
   3. Bu komut, dockerfile'da belirtilen kurulumları yapacaktır. Bunları yapmamızın nedeni de herhangi bir ortam kurmanıza gerek kalmadan, hepsini docker ile yapmaktır.
   4. Eğer console'den çıktıları görmek isterseniz `sail up` komutunu çalıştırabilirsiniz. Bu komut terminali açık bırakır.
5. Docker ile bu kadar. Şimdi uygulamayı tarayıcıdan açabilirsiniz.
   6. Terminalde yazması gerekli ama yazmazsa bunlardan birinde aktif olması gerekir. 
   6. http://0.0.0.0, http://127.0.0.1, http://127.0.0.1:8000, http://localhost, http://localhost:8000

### Normal kurulum
1. `composer install`
   2. Eğer yoksa [composer](https://getcomposer.org) kurulumunu yapın.
2. `cp .env.example .env`
3. veritabanı ayarlarınızı yapın.

```env
DB_CONNECTION=sqlite # sqlite, mysql, pgsql, sqlsrv
DB_HOST=mysql # 127.0.0.1
DB_PORT=3306 # 3306, 5432, 1433
DB_DATABASE=yengec_challange # mysql, pgsql, sqlsrv, sqlite
DB_USERNAME=sail # root
DB_PASSWORD=password 
```

5. `php artisan migrate --force && php artisan passport:install --force`
6. `php artisan serve`
   7. http://127.0.0.1:8000


### [Kullanım](usage.md)
