# API para la administración de facturas

Este proyecto contiene elservicio API REST para la adminsitracion y pago de facturas

## Comenzando 

_Estas instrucciones te permitirán obtener una copia del proyecto en funcionamiento en tu máquina local para propósitos de desarrollo y pruebas._


### Pre-requisitos 📋

```
Para configurar el proyecto necesitas:

PHP 7.2
MySQL
composer
```

### Instalación 🔧
Ir a la raiz del proyecto

* Ejecutar el siquiente comando para instalar las dependencias
```
> composer install
```

* Configurar las variables de entorno

```
IVA_PERCENT = Porcentaje de iva para el calculo de impuestos)
PAY_PAGE_URL = Url de la ubicacion de la aplicación Administrador de Facturas (dte-frontend)

Configurar las variables y credenciales para el correo electronico y conexion a base de datos
```

* Ejecutar el siguiente comando para levantar el servicio en el puerto 8000
```
>php -S localhost:8000 -t public
```

## Construido con 🛠️

* [Lumen](https://lumen.laravel.com/docs/8.x) - El framework web usado
* [Composer](https://getcomposer.org/doc/) - Manejador de dependencias

## Autor ✒️

* **Andrés Duque** - [andres-duque](https://github.com/andres-duque)
