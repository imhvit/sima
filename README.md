<h1 align="center">
SIMA
</h1>
<p align="center">
  <strong>Gestión de Almacenes e Inventarios</strong><br>
  Plataforma para el control, rastreo y auditoría de movimientos de stock.
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-13.x-FF2D20?style=flat-square&logo=laravel" alt="Laravel 13">
  <img src="https://img.shields.io/badge/Vue.js-3.5-4FC08D?style=flat-square&logo=vue.js" alt="Vue 3.5">
  <img src="https://img.shields.io/badge/Tailwind_CSS-4.0-06B6D4?style=flat-square&logo=tailwind-css" alt="Tailwind 4">
  <img src="https://img.shields.io/badge/Inertia.js-3.0-9553E9?style=flat-square&logo=inertia" alt="Inertia 3">
  <img src="https://img.shields.io/badge/MySQL-8.0-4479A1?style=flat-square&logo=mysql" alt="MySQL 8">
</p>

## Sobre el proyecto

SIMA es un sistema web de gestión de almacenes e inventarios diseñado para controlar, rastrear y auditar todos los movimientos de stock dentro de una organización. Permite administrar productos, categorías, niveles de stock y el historial completo de movimientos, garantizando trazabilidad en tiempo real.

Actualmente el proyecto se encuentra en desarrollo, buscando ofrecer una interfaz clara y eficiente para la operación diaria de almacén.

## Características

- **Gestión de productos:** creación, edición y visualización de detalles.
- **Categorización:** organización de productos por categorías.
- **Control de stock:** visualización en tiempo real de existencias.
- **Movimientos de inventario:** trazabilidad de entradas, salidas y ajustes.
- **DataTables server-driven:** tablas con paginación y búsqueda procesadas desde el backend.
- **Renderizado SSR:** mejora en tiempos de carga inicial mediante Inertia.js SSR.

## Stack Tecnológico

- **Backend:** Laravel 13 (PHP 8.3+)
- **Frontend:** Vue.js 3.5 & Inertia.js 3.0 (SSR)
- **Estilos:** Tailwind CSS 4.0
- **Base de Datos:** MySQL / MariaDB
- **Build Tool:** Vite

## Capturas de pantalla

**Dashboard**

<img width="1600" height="829" alt="32c7a4b2-398d-4daa-9ca9-ec7bc249fe72" src="https://github.com/user-attachments/assets/b8dbb6f8-13aa-46f9-9f6f-1be434804c35" />

**Productos**

<img width="1600" height="831" alt="0aa592f9-321a-4bc7-a3b6-76cabc1f9828" src="https://github.com/user-attachments/assets/013b6bb3-867d-4d2e-9022-c30d9bbd74b1" />

**Categorías**

<img width="1600" height="829" alt="80653c58-a381-4284-8ac5-745391073fef" src="https://github.com/user-attachments/assets/49b11707-8f5d-4b86-9efb-cd70a5597e9e" />

**Stock**

<img width="1600" height="831" alt="7bf276ca-f321-48f0-be41-e43b962ad074" src="https://github.com/user-attachments/assets/1f72a45a-0f1b-415f-86c4-05aef10a5bf5" />


**Movimientos**

<img width="1600" height="830" alt="849dff55-00d8-4aa4-89f4-d3bc6f4433f6" src="https://github.com/user-attachments/assets/426eb90a-cdeb-494e-9826-1d9c8c4aebeb" />


**Crear producto**

<img width="1600" height="832" alt="58fff255-6383-4357-accd-ae5bc5f52933" src="https://github.com/user-attachments/assets/59acbd17-8f91-428c-af84-164e6dbd4cd7" />


**Editar producto**

<img width="1600" height="828" alt="69876ed9-39d0-4580-9578-2ecccd6d8fb9" src="https://github.com/user-attachments/assets/ce22761a-85d1-4f9c-a626-7f31ff3c7056" />


**Detalles de producto**

<img width="1600" height="830" alt="9db39a66-a379-48df-a201-d5b5468273b3" src="https://github.com/user-attachments/assets/30d20aa2-f197-4e2b-9da1-efc49196bd60" />

## Instalación

1. **Clonar repositorio:**
    ```bash
    git clone https://github.com/imhvit/sima.git
    cd sima
    ```
2. **Instalación:**
    ```bash
    composer install
    npm install
    cp .env.example .env
    php artisan key:generate
    php artisan migrate --seed
    ```
3. **Ejecutar en desarrollo:**
    ```bash
    composer run dev
    ```
    _Este comando inicia simultáneamente `php artisan serve`, el worker de colas y el servidor de Vite._

## Requisitos y Notas

- **Idioma:** La interfaz (UI) está en **Español**. El código y la configuración base utilizan Inglés.
- **Servidor Web:** Compatible con Apache (recomendado), Nginx o el servidor embebido de Laravel.

## Contribuir

Si deseas contribuir al desarrollo de SIMA:

1. Realiza un **Fork** del repositorio.
2. Crea una rama para tu mejora con nombres en minúscula (ej: `feature-stock`, `fix-datatable`).
3. Realiza tus cambios y haz commit con mensajes descriptivos en minúscula (ej: `add: nueva funcionalidad`, `fix: error en tabla`).
4. Envía un **Pull Request**.

## Licencia

Este software es de código abierto bajo la licencia [MIT](LICENSE).

<p align="center">
  Desarrollado por <a href="https://github.com/imhvit">imhvit</a>
</p>
