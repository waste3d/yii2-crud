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

3. **Если порт 8080 занят — измените его**

Откройте файл `docker-compose.yml` и найдите секцию порта:

```yaml
ports:
  - "8080:80"
```

Измените `8080` на свободный порт, например:

```yaml
ports:
  - "8082:80"
```

Теперь приложение будет доступно на `http://localhost:8082`

4. **Запустите контейнеры**

```bash
docker compose up -d --build
```


5. **Установите зависимости**

```bash
docker compose exec app composer install
docker compose exec app composer update
```


6. **Выполните миграции**

```bash
docker compose exec app php yii migrate
```

7. **Откройте в браузере**

Перейдите по адресу:

* `http://localhost:8080` — если порт не меняли
* `http://localhost:<ваш_порт>` — если указали другой

---

## ⛔ Остановка проекта

```bash
docker compose down
```

---

## Важные моменты

* Контейнер `app` запускает PHP сервер внутри Docker.
* Контейнер `mysql` использует параметры из `docker-compose.yml`.
* Для подключения к базе используется `mysql` как имя хоста — это имя сервиса MySQL в Compose.
