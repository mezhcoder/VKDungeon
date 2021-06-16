<h1>VKDungeon</h1>

<h2>Пример пользования API<h2>


```php
require_once("api/Controller.php");

$controller = new Controller();
$controller->loadDungeon("files/settings.json");
$controller->movedToRoom(1);
```

<h2>Основные методы API<h2>
<i>loadDungeon(path_settingsFile)</i> - загрузка подземелья</br>
<i>movedToRoom(numberRoom)</i> - переместить персонажа в определенную комнату
