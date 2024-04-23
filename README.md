# Street Group Homeowners Task

## A Laravel project with Breeze, Inertia and VueJS and Tailwind.

### HomeController.php

The **`HomeController`** class extends the **`Controller`** class. It defines a single method called **`upload`**, which is responsible for handling the upload of a file.

-   The **`upload`** method takes a **`Request`** object as a parameter.
-   Inside the method, a mock array of parsed data is created.
-   The parsed data is then returned as a JSON response using the **`response()->json()`** method.

In summary, the **`HomeController`** class provides a route for uploading a file and returns the parsed data in JSON format.

### web.php

In this file, we define a POST route in Laravel that handles file uploads.

Specifically:

-   `Route::post` defines a POST route
-   `/upload` is the URI that will match this route
-   `'App\Http\Controllers\HomeController@upload'` is the controller action that will handle the request
    -   `App\Http\Controllers\HomeController` references the HomeController class
    -   `@upload` calls the `upload()` method on that controller

So in summary, this route is mapping POST requests to `/upload` to the `upload()` method on the `HomeController`. This is likely handling file uploads submitted from a form on the front end.

The `upload()` method will probably accept the uploaded file, validate it, store it somewhere, and return a response to the front end.

Common things you'd see in an upload controller action:

-   Accepting the uploaded file from `$request->file('name')`
-   Validating file size, type, etc.
-   Saving the file to storage
-   Creating a database record for the upload
-   Returning a response indicating success/failure

So this single line sets up the routing to handle a file upload process in a Laravel app.

### Dashboard.vue

For demonstration purposes, I have included the script within the Dashboard to parse the data as if it was using a POST request, to achieve this I just created an event when the user clicks the Upload CSV button.
