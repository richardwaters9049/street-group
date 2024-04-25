# Laravel CSV Data Parsing Dashboard

![Login](/images/login.png)

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

1. Clone the repository to your local machine.
2. Install PHP dependencies using Composer: `composer install`.
3. Install JavaScript dependencies using npm or yarn: `npm install` or `yarn install`.
4. Configure your environment variables by copying the `.env.example` file to `.env` and updating the necessary values.
5. Generate an application key: `php artisan key:generate`.
6. Run database migrations: `php artisan migrate`.
7. Serve the application: `php artisan serve`.
8. Access the application in your web browser.

## Dependencies

-   **Laravel Breeze**: Provides simple authentication scaffolding.
-   **Inertia.js**: Allows for client-side rendering with server-side controllers.
-   **Vue.js**: JavaScript framework for building user interfaces.
-   **Tailwind CSS**: Utility-first CSS framework for styling.

## Contributing

Contributions are welcome! Feel free to submit bug reports, feature requests, or pull requests to improve the project.

## License

This project is open-source and available under the [MIT License](LICENSE).
