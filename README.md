## Запуск проекта

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

4. **Выполните миграции**

```bash
docker compose exec app php yii migrate
```

5. **Откройте в браузере**

Перейдите по адресу [http://localhost:8080](http://localhost:8080)

---

## Остановка проекта

```bash
docker compose down
```

---

## Важные моменты

* Контейнер `app` запускает PHP встроенный сервер на порту 8080.
* Контейнер `mysql` содержит базу данных с настройками из `docker-compose.yml`.
* Для успешного подключения Yii2 использует `mysql` как хост базы данных — это имя сервиса MySQL из docker-compose.
