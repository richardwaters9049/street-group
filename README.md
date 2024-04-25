# Laravel CSV Data Parsing Dashboard

![Login](/public/images/login-page.png)

This project is a Laravel application that provides a dashboard for parsing and displaying data from CSV files. It utilizes Laravel Breeze for authentication, Inertia.js for client-side rendering, Vue.js for dynamic interactivity, and Tailwind CSS for styling.

## Features

-   **Authentication**: Users can log in securely using Laravel Breeze authentication.

-   **CSV Upload**: Users can upload CSV files containing data to be parsed and displayed.

-   **Data Parsing**: Upon uploading a CSV file, the application parses the data and displays it below the upload section.

-   **Dynamic Display**: Parsed data is dynamically rendered on the dashboard using Vue.js, allowing for smooth interaction without page reloads.

-   **Tailwind Styling**: The dashboard is styled using Tailwind CSS, providing a clean and responsive interface.

## How it Works

Upon logging in, users are presented with a dashboard where they can upload a CSV file. Once a CSV file is selected and uploaded, the application parses the data and displays it below the upload section.

### Dashboard Components

-   **File Upload**: Users can select a CSV file using the file input field and upload it by clicking the "Upload CSV" button.

-   **Parsed Data Display**: Parsed data from the uploaded CSV file is displayed below the upload section. Each entry in the CSV file is displayed in a structured format, showing relevant information.

### Code Overview

-   **Dashboard Component**: The dashboard is implemented using Vue.js and Inertia.js, allowing for a dynamic and reactive user interface.

-   **CSV Upload Handling**: The uploaded CSV file is processed on the server-side using Laravel controllers. The `CsvController` handles the file upload, while the `ParserController` parses the CSV data.

-   **Data Parsing Logic**: The parsing logic is implemented in the `ParserController`. It reads the uploaded CSV file, processes each row of data, and returns the parsed data to the client.

-   **Database Integration**: In a real-world scenario, instead of saving CSV files to a public directory, you would likely save the parsed data to a database. This can be achieved by modifying the `CsvController` and `ParserController` to store the data in your preferred database.

## Getting Started

1. Clone the repository to your local machine with `git clone https://github.com/richardwaters9049/street-group.git` or download it as a ZIP file.

-   For this project I'm assuming you already have composer and node already installed. If not, you can follow the instructions on the official Laravel website: https://laravel.com/docs/8.x#installation.

2. CD into the project directory and run `composer install` to install PHP dependencies.

3. Install JavaScript dependencies using npm or yarn: `npm install` or `yarn install`.

-   My project uses bun but npm should still work fine.

4. I have included a .env already configured for the project. If you wish to use your own database, you can update the.env file with your database credentials.

5. Generate an application key: `php artisan key:generate`.

6. Run database migrations: `php artisan migrate`.

7. Run the programme: `php artisan serve` and `npm run dev`.

Once the project is up and running you can create a dummy admin using the register page. You can then log in using the dummy admin credentials.

Example: username: admin
email: admin@admin.com
password: (This must be at least 8 characters long.)

## Dependencies

-   **Laravel Breeze**: Provides simple authentication scaffolding.
-   **Inertia.js**: Allows for client-side rendering with server-side controllers.
-   **Vue.js**: JavaScript framework for building user interfaces.
-   **Tailwind CSS**: Utility-first CSS framework for styling.

## Links To Relevant Code

Here I have provided links to the Dashboard view, CSV Upload controller and the CSV Parse controller.

-   [Dashboard View](https://github.com/richardwaters9049/street-group/blob/main/resources/js/Pages/Dashboard.vue)

![Dashboard](/public/images/dash.png)

-   [CSV Upload Controller](https://github.com/richardwaters9049/street-group/blob/main/app/Http/Controllers/CsvController.php)

-   [CSV Parse Controller](https://github.com/richardwaters9049/street-group/blob/main/app/Http/Controllers/ParserController.php)
