## Описание
Демо проект с использованием фреймворка Laravel 10.\
Имеющиеся скрипты создают локальную БД sqlite и наполняют её данным.\
Отображение данных происходит на странице http://localhost:8000/

## Используемые компоненты
- Laravel 10
- Laravel Breeze (авторизация, регистрация)
- Кэширование (file)
- Bootstrap 5 (CSS фреймворк)
- Blade (HTML шаблонизация)

## Требования
- PHP 8.1 и выше с поддержикой sqlite3 (например, пакет php8.1-sqlite3) либо Docker\
- Composer\
- 50 МБ свободного места на диске

## Установка и запуск (Linux)

Если имеется установленный докер:
```
git clone https://github.com/e7paul/todo-list
cd todo-list
./start_with_docker.sh
```

Остановка контейнера:
```
./vendor/bin/sail stop
```

Если отсутствует докер:
```
git clone https://github.com/e7paul/todo-list
cd todo-list
./start_without_docker.sh
```