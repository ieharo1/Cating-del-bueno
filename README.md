# Inventory QR - Sistema de Inventario con QR

Proyecto desarrollado por **Isaac Esteban Haro Torres**.

---

## Descripción

Sistema profesional de inventario con lectura de códigos QR, gestión de productos, categorías, ubicaciones, movimientos de stock y flujo de picking.

---

## Características

- Gestión de productos con códigos SKU únicos
- Categorías y ubicaciones organizadas
- Sistema de lectura de códigos QR
- Flujo de picking con confirmación de cantidades
- Control de stock con alertas de bajo inventario
- Historial de movimientos (entrada, salida, transferencia)
- Dashboard con estadísticas en tiempo real
- Interfaz moderna tipo admin

---

## Stack Tecnológico

* PHP 8.2
* Laravel 11
* Livewire 3
* Bootstrap 5
* MySQL 8.0
* Docker
* Docker Compose

---

## Instalación desde cero

1. Clonar el repositorio
2. Ejecutar `docker compose up -d --build`
3. Esperar a que los contenedores estén levantados
4. Ejecutar migraciones: `docker compose exec app php artisan migrate`
5. Ejecutar seeders: `docker compose exec app php artisan db:seed`
6. Acceder al sistema en `http://localhost:8000`

### Configuración de Base de Datos

El sistema está configurado para usar MySQL con las siguientes credenciales:
- Host: mysql
- Database: inventory_qr
- User: laravel
- Password: laravel

---

## Desarrollado por Isaac Esteban Haro Torres

Ingeniero en Sistemas · Full Stack · Automatización · Data

Email: [zackharo1@gmail.com](mailto:zackharo1@gmail.com)

WhatsApp: 098805517

GitHub: https://github.com/ieharo1

Portafolio: https://ieharo1.github.io/portafolio-isaac.haro/

---

## Licencia

© 2026 Isaac Esteban Haro Torres
