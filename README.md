OpenServer

<p>HTTP: Apache-PHP-7</p>
<p>PHP-7.1</p>
<p>MySQL-5.6</p>
<hr>
create migrate
<p>php yii migrate/create <name migrate></p>
    
create tables in db
<p>php yii migrate</p>
<hr>
```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii-user',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
];
```

