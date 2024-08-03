# Dishub App

## Introduction


## ERD

Entity Relationship Diagram (ERD) :


## Installation

To set up this project, please ensure that your system meets the following requirements:

- Laravel 11
- PHP 8.2 or higher
- MySQL 5.7 or higher
- Composer 2.5 or higher

After confirming that your system meets the requirements, follow these steps to set up the project:

1. Install the necessary dependencies by running the following command in your project directory:

    ```bash
    composer install
    ```

2. Copy the `.env.example` file and rename it to `.env`. Make sure to configure the `.env` file with the necessary settings.

3. Generate an application key by running:

    ```bash
    php artisan key:generate
    ```

4. Migrate the database tables by running:

    ```bash
    php artisan migrate
    ```

5. Seed the database with initial data by running:

    ```bash
    php artisan db:seed
    ```

6. Import data for the administrative area:

    ```bash
    php artisan import:administrative-area
    ```

