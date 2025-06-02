
## 🚀 Запуск проекта

1. **Склонируйте репозиторий**

```bash
git clone <URL_репозитория>
cd yii2-crud
```

2. **Настройте подключение к базе данных**

Убедитесь, что в конфигурационном файле `config/db.php` указаны правильные параметры подключения к MySQL:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=mysql;dbname=crud',
    'username' => 'appuser',
    'password' => 'secret',
    'charset' => 'utf8',
];
```

3. **Запустите контейнеры**

```bash
docker compose up -d --build
```

4. **Установите зависимости через Composer**

Выполните внутри контейнера:

```bash
docker compose exec app composer update
docker compose exec app composer install
```

> 💡 Или одной строкой:
>
> ```bash
> docker compose exec app sh -c "composer update && composer install"
> ```

5. **Выполните миграции**

```bash
docker compose exec app php yii migrate
```

6. **Откройте в браузере**

Перейдите по адресу [http://localhost:8080](http://localhost:8080)

---

## ⛔ Остановка проекта

```bash
docker compose down
```

---

## ℹ️ Важные моменты

* Контейнер `app` запускает встроенный PHP-сервер на порту `8080`.
* Контейнер `mysql` содержит базу данных с настройками из `docker-compose.yml`.
* Для успешного подключения к БД используется `mysql` как имя хоста (это имя контейнера).
