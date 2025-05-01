# Руководство по установке

## Предварительные требования

- Установленный **Docker**. Проверьте версию:
  ```bash
  docker --version
  ```
- Установленный **Docker Compose**. Проверьте версию:
  ```bash
  docker compose version
  ```

## Установка

1. **Клонируйте репозиторий**  
   ```bash
   git clone https://github.com/cmhdhffec1/reDVWAv1.git
   ```

2. **Перейдите в директорию проекта**  
   ```bash
   cd reDVWAv1
   cd my-dvwa
   ```

3. **Соберите Docker-образ**  
   Создайте Docker-образ с именем `redvwav1`:
   ```bash
   docker build -t redvwav1 .
   ```

4. **Запустите приложение**  
   ```bash
   docker-compose up -d
   ```

## Проверка
```bash
docker ps
```

## Примечания
- Для остановки приложения выполните:
  ```bash
  docker compose down
  ```

# Основная информация

**http://localhost:8081/ - основная страница**  
**http://localhost:8080/ - phpMyAdmin**

Подключение к базе данных:
```bash
$host = 'db';
$user = 'dvwa';
$pass = 'dvwa';
$dbname = 'dvwa';
```

https://t.me/EchoKill_Hack
https://t.me/EchoKill_Hack
https://t.me/EchoKill_Hack
