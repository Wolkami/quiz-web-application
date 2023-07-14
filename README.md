# Laravel 8 - Quiz Web Application

Проект создан в качестве пробы пера работы с фреймворком Laravel. Его расширение и поддержка в долгосрочной перспективе не предусмотрены.

## Системные требования
- Версия PHP 7.3 или выше
- Расширение PHP BCMath
- Расширение PHP Ctype
- Расширение PHP Fileinfo
- Расширение PHP JSON
- Расширение PHP Mbstring
- Расширение PHP OpenSSL
- Расширение PHP PDO
- Расширение PHP Tokenizer
- Расширение PHP XML

## Поддерживаемые БД:
- MariaDB версии 10.2 или выше
- MySQL версии 5.7 или выше
- PostgreSQL версии 9.6 или выше
- SQLite версии 3.8.8 или выше
- SQL Server версии 2017 или выше

## Установка на локальной машине
- Установить PHP и расширения в соответствии с системными требованиями
- Установить расширение PHP SQLite (PDO)
- Установить `composer` актуальной версии
- Установить `Node.js` актуальной версии
- Перейти в папку проекта `cd project-folder-path`
- Выполнить консольную команду `composer install`
- Выполнить консольную команду `npm install`
- Создать файл `database/database.sqlite`
- В `.env` указать тип соединения `DB_CONNECTION=sqlite`
- В `.env` указать **абсолютный** путь к файлу базы данных `DB_DATABASE=/absolute/path/to/database.sqlite`
- В `.env` добавить/обновить настройку `DB_FOREIGN_KEYS=true`
- Выполнить консольную команду `php artisan key:generate`
- Выполнить консольную команду `php artisan migrate:fresh --seed`
- Запустить локальный сервер командой `php artisan serve`
- Открыть приложение по локальному адресу http://127.0.0.1:8000

## Предустановленные доступы
- Логин: admin@example.com
- Пароль: 123
- Уровень прав: admin, имеет доступ в панель управления
