
# User Management Laravel Application

## Installation

1. **Clone the repository**

    ```bash
    git clone https://github.com/emkr-13/user-management-laravel.git
    cd user-management-laravel
    ```

2. **Install dependencies**

    ```bash
    composer install
    npm install
    npm run dev
    ```

3. **Set up environment**

    - Copy `.env.example` to `.env`
    - Configure your database and other environment variables in the `.env` file

4. **Generate application key**

    ```bash
    php artisan key:generate
    ```

5. **Run migrations**

    ```bash
    php artisan migrate
    ```

6. **Seed the database (optional)**

    ```bash
    php artisan db:seed
    ```

7. **Start the development server**
    ```bash
    php artisan serve
    ```

## Usage

-   Access the application at `http://127.0.0.1:8000`
-   Register a new user or log in with existing credentials
-   Manage users, view profiles, and more through the dashboard

## Features

-   User registration and authentication
-   User management with soft delete functionality
-   Profile management
-   Responsive design

## Contributing

Feel free to submit issues or pull requests. For major changes, please open an issue first to discuss what you would like to change.

## License

This project is open-source and available under the [MIT License](LICENSE).
