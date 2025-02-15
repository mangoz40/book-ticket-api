# Event Ticket Booking App - Laravel Backend API

## Description

This is the Laravel backend API for the Event Ticket Booking App. It provides a RESTful API to be consumed by the Kotlin Android frontend application.  This API handles:

  * **Event Management:**  Provides endpoints to browse available events, retrieve event details.
  * **Booking Management:** Handles ticket booking requests, stores booking information, generates QR codes for tickets.
  * **Data Storage:**  Utilizes a MySQL database to persist event and booking data.

**Important Note:** This backend is designed to be used in conjunction with the Kotlin Android frontend application.  It is built as a dedicated API server and does not include a frontend interface itself.

## Tech Stack

  * **Backend Framework:** Laravel (PHP)
  * **Programming Language:** PHP
  * **Database:** MySQL
  * **API Style:** RESTful API
  * **QR Code Generation:**  SimpleSoftwareIO/Simple-QRcode Laravel package
  * **Dependency Management:** Composer
  * **Architecture Pattern:** Repository Pattern

## Architecture

This Laravel backend API employs a layered architecture, potentially including the Repository Pattern for data access.

  * **Controllers:**  Handle incoming HTTP requests, validate input, orchestrate business logic by interacting with services or repositories, and return API responses (JSON).
  * **Models:** Represent database tables and provide an interface for interacting with data using Eloquent ORM.
  * **Migrations:** Define database schema and allow for version control of database changes.
  * **API Resources:** Transform Eloquent models into structured JSON responses for the API.
  * **Repositories:** Abstract data access logic away from controllers. Provide an interface for data operations, making controllers cleaner and more testable.  
  * **Routes (API Routes):** Define the API endpoints and map them to controller actions.

## Setup Instructions

Before you begin, ensure you have the following installed:

  * **PHP:**  Version 8.3
  * **Composer:**  Dependency Manager for PHP 
  * **MySQL Server:**  Install and run a MySQL server instance.

**Steps to set up and run the backend API:**

1.  **Clone the Repository:**

    ```bash
    git clone https://github.com/mangoz40/book-ticket-api.git
    cd book-ticket-api 
    ```
2.  **Install Composer Dependencies:**

    ```bash
    composer install
    ```

3.  **Configure Environment Variables (.env file):**

      * Copy `.env.example` to `.env`:

        \`\`\`bash
        cp .env.example .env
        \`\`\`

      * Open the `.env` file and configure the following settings:

          * **`APP_NAME`**:  Set the application name
          * **`APP_URL`**: Set the base URL of your API (e.g., `http://localhost:8000`).
          * **`DB_CONNECTION`**: Set to `mysql`.
          * **`DB_HOST`**:  MySQL host (e.g., `127.0.0.1` or `localhost`).
          * **`DB_PORT`**:  MySQL port (default `3306`).
          * **`DB_DATABASE`**:  Database name (e.g., `book_tickets`). **Create this database in your MySQL server.**
          * **`DB_USERNAME`**: MySQL username.
          * **`DB_PASSWORD`**: MySQL password.

4.  **Generate Application Key:**

    ```bash
    php artisan key:generate
    ```

5.  **Run Database Migrations:**

    ```bash
    php artisan migrate
    ```

    This will create the necessary database tables (`events`, `bookings`, etc.) based on the migrations provided.
6.  **Run Database Seeder:**

    ```bash
    php artisan db:seed
    ```

    This will create the necessary database dummy content.
7.  **Start the Laravel Development Server:**

    ```bash
    php artisan serve --host=192.168.137.1 --port=8000  
    ```

    This will start the development server, usually accessible at specified URL.

## API Endpoints

The following API endpoints are available:

  * **`GET /api/events`**:

      * Description: Retrieve a list of all events.
      * Response: JSON array of `Event` resources.

  * **`GET /api/events/{event}`**:

      * Description: Retrieve details of a specific event.
      * Parameters: `{event}`: Event ID.
      * Response: JSON `Event` resource.

  * **`POST /api/book-event`**:

      * Description: Create a new booking for an event.
      * Request Body (JSON):
        ```json
        {
          "event_id": integer,  // ID of the event to book
          "customer_name": string, // Customer's name
          "customer_email": string, // Customer's email
          "quantity": integer   // Number of tickets to book
        }
        ```
      * Response: JSON `Booking` resource upon successful booking, or error response if booking fails (e.g., validation errors, insufficient tickets).

  * **`GET /api/bookings/{booking}`**: For now we are using the /api/events/{event} as they are similar

      * Description: Retrieve details of a specific booking.
      * Parameters: `{booking}`: Event ID.

## Testing the API

You can use tools like **Postman** or ``` curl ``` to test the API endpoints.

**Example using curl to get a list of events:** Assuming ur running on localhost

```bash
curl http://localhost:8000/api/events
```

**Example using curl to create a booking (replace with your actual data):**

```bash
curl -X POST \
  http://localhost:8000/api/bookings \
  -H 'Content-Type: application/json' \
  -d '{
    "event_id": 1,
    "customer_name": "John Doe",
    "customer_email": "[email address removed]",
    "quantity": 2
  }'
```

**QR Codes:** After successfully creating a booking, the API response will include a `qr_code_url`.
 * **Important Note:** For the QR code its just a combination of unique UUID string and Event ID which is returned to the frontEnd that is where the QR code image is generated.

## Future Enhancements (Potential Contributions)

  * User Authentication and Authorization: Implement user registration, login, and API authentication (e.g., using Laravel Sanctum) to secure booking data and potentially manage user profiles.
  * More Robust Validation: Enhance request validation rules (e.g., quantity limits, data format validation).
  * Payment Gateway Integration: Integrate a real or dummy payment gateway to handle actual ticket purchases.
  * Admin Panel: Develop an admin panel (potentially using Laravel Filament or similar) to manage events, view bookings, and generate reports.
  * Testing: Write comprehensive unit tests and integration tests for API endpoints and backend logic.

## Author

Mangoz40


**All the Best\!!! **