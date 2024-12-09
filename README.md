#### Клонирование репозитория
```
git clone https://github.com/maximishchenko/noviy_gorod noviy_gorod
```

#### Установка пакетов
```
composer install
```

#### Инициализация окружения
```
php init
```

#### Применение миграций базы данных
```
php yii migrate
```

#### Загрузка наборов тестовых данных
```
php yii fixture/load "*"
```

#### Сборка фронтенда
```
php yii asset assets.php frontend/config/assets-prod.php
```

> Параметры кэширования фронтальной части прилжения устанавливаются в файле ``` frontend\config\main-local.php ``` 


> Параметры подключения к БД и подключения к серверу электронной почты устанавливаются в файле ``` common\config\main-local.php ```

> Адрес отправителя (для соответствия требованиям SMTP) устанавливается в файле ``` common\config\params-local.php ```