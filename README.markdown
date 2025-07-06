![image](https://github.com/user-attachments/assets/c3a90a67-f45a-4856-beb0-4fc71a9bee97)

# Руководство по установке

## Предварительные требования

- Установить **Docker**:
  ```bash
  sudo apt install docker.io
  ```
- Проверьте версию:
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
   sudo docker build -t redvwav1 .
   ```

4. **Запустите приложение**  
   ```bash
   sudo apt-get install docker-compose
   sudo docker-compose up -d
   ```

## Проверка
```bash
docker ps
```

## Примечания
- Для остановки приложения выполните:
  ```bash
  sudo docker-compose down
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


