#iBazaar

##Requisitos
* PHP 5.3.* + CLI
* Módulo para MySQL de PHP.
* Instancia de MySQL 5.2.*
* Apache 2.3.*

##Configuración

En `app/config/parameters.yml` están los parámetros de configuración. Los referentes a la base de datos son:

* `database_drive`: Tipo de gestor de base de datos (sólo testeada `pdo_mysql`).
* `database_host`: Hostname de la máquina donde esté alojada la base datos.
* `database_name`: Nombre de la base de datos.
* `database_user`: Usuario con acceso a la base de datos.
* `database_password`: Contraseña del usuario.

##Instalación de instancia de prueba (Linux)

* Copiar los ficheros a la ruta de despliegue.
* Instalar Composer:
```
$ curl -s https://getcomposer.org/installer | php
```
* Instalar las dependencias de proyecto. Durante este proceso se pueden introducir los parámetros de configuración.
```
$ php composer.phar install
```
* Creamos las bases de datos:
```
$ php composer.phar install
```
$ php app/console doctrine:database:create
$ php app/console doctrine:schema:create
```
* Metemos los datos de prueba:
```
$ php app/console doctrine:fixtures:load
```
* Damos permisos a la carpetas `cache` y `logs`:
```
$ sudo chmod -R 777 app/cache
$ sudo chmod -R 777 app/logs
```

* Y ya estará iBazaar disponible en: `http://<RUTA_DESPLIEGUE>/app.php/`