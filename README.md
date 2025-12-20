# Scholarship Application System (Pengajuan Beasiswa)

A web-based scholarship application and management system built with Laravel. This platform facilitates the entire scholarship process, from donor management and scholarship creation to student applications and administrative validation.

## Features

### Administrator Panel

-   **Donor Management**: Manage scholarship donors.
-   **Scholarship Management**: Create and configure scholarship programs.
-   **Requirement Management**: Define file requirements for applications.
-   **Application Validation**: Review and validate documents submitted by students.
-   **Approval System**: Approve or reject scholarship applications.
-   **Reporting**: Export data to Excel and generate PDF reports.
-   **Announcement System**: Post announcements for users.
-   **User Management**: Manage admin access and roles.

### Student/User Panel

-   **Registration & Profile**: User account creation and profile management.
-   **Scholarship Browsing**: View available scholarship programs.
-   **Application**: Apply for scholarships and upload required documents.
-   **Status Tracking**: Track the status of applications.

## Tech Stack

-   **Framework**: [Laravel 10.x](https://laravel.com)
-   **Language**: PHP ^8.1
-   **Frontend**:
    -   [Vite](https://vitejs.dev)
    -   [Tailwind CSS](https://tailwindcss.com)
    -   [Flowbite](https://flowbite.com)
    -   [Alpine.js](https://alpinejs.dev)
    -   jQuery
-   **Database**: MySQL
-   **Key Libraries**:
    -   `barryvdh/laravel-dompdf`: PDF generation
    -   `maatwebsite/excel`: Excel import/export
    -   `cviebrock/eloquent-sluggable`: URL slugs

## Prerequisites

-   PHP >= 8.1
-   Composer
-   Node.js & NPM
-   MySQL Database

## Installation

1. **Clone the repository**

    ```bash
    git clone <repository-url>
    cd pengajuan-beasiswa
    ```

2. **Install PHP dependencies**

    ```bash
    composer install
    ```

3. **Install Frontend dependencies**

    ```bash
    npm install
    ```

4. **Environment Configuration**
   Copy the example environment file and configure your database settings.

    ```bash
    cp .env.example .env
    ```

    Open `.env` and update the database credentials:

    ```dotenv
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```

5. **Generate Application Key**

    ```bash
    php artisan key:generate
    ```

6. **Run Database Migrations**

    ```bash
    php artisan migrate
    ```

    _(Optional) Seed the database with initial data:_

    ```bash
    php artisan db:seed
    ```

7. **Build Frontend Assets**
   For development (hot reload):

    ```bash
    npm run dev
    ```

    For production:

    ```bash
    npm run build
    ```

8. **Run the Application**
    ```bash
    php artisan serve
    ```
    The application will be accessible at `http://localhost:8000`.
