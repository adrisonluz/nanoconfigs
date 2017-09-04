# Nano Configs


## Instalação

### Editar config/app.php

Adicionar provider:
NanoSoluctions\NanoConfigs\NanoConfigsServiceProvider::class,

Adicionar alias:
'NanoConfigs' => NanoSoluctions\NanoConfigs\NanoConfigsServiceProvider::class,

### Editar composer.json

Adicionar psr4:
"NanoSoluctions\\NanoConfigs\\": "packages/nanosoluctions/nanoconfigs/src/"


### Comandos
composer dumpautoload
php artisan vendor:publish
composer dumpautoload

php artisan migrate
php artisan db:seeder --class=NanoSeeder