# Library System REST API
Library REST API is a Laravel-based API that manages a library's system. User roles are also implemented to limit functionalities based on access permissions.

# Technologies Used
- Laravel
- PHP
- MySQL
- API REST
- JSON
- Documentation API (POSTMAN, OPEN API or SWAGGER)
- Authentication with Laravel via (sanctum, jwt, or passport)
# Features
- Creating, editing, deleting and viewing books.
- Genre creation, editing, deletion and consultation.
- Implemented user roles to limit functionality based on access permissions.
# User Stories
- As a user, I can create an account using my email address and a secure password.
- As a user, I can login to my existing account using my email address and password.
- As a user, I can reset my password using my email address associated with my account.
- As a user, I can change my account information, such as my email address and password, at any time.
- As a library receptionist, I can create a product by entering a title, book author, collection, isbn, publication date, number of pages, location (the physical location of the book in the library), status (current status of the book, eg borrowed, available, processed, etc.), content and by associating genres.
- As a receptionist, I can edit or delete existing books.
- As a user, I can view the list of available books, filter by genre, and view details for a particular book.
- As an administrator, I can edit or delete all books and genres.
- As an administrator, I can create, edit and delete genres.
- As an administrator, I can edit and delete user roles, and assign access permissions to each role.
# Installation
To install and run this project, please follow these steps:

- Clone the repository
- Install dependencies by running composer install
- Create a new database
- Rename .env.example to .env and configure the database connection
- Run migrations by running php artisan migrate
- Start the server by running php artisan serve
# API Endpoints
This API has the following endpoints:

- /api/auth/register: Register a new user
- /api/auth/login: Login with existing user credentials
- /api/auth/logout: Logout a user
- /api/auth/reset-password: Reset user password
- /api/books: Get all articles or create a new one
- /api/books/{id}: Get, update or delete an article
- /api/categories: Get all categories or create a new one
- /api/categories/{id}: Get, update or delete a category
- /api/roles: Get all roles or create a new one
- /api/roles/{id}: Get, update or delete a role
- ...
For more details on how to use each endpoint, please refer to the API documentation.

# API Documentation
The API documentation is available in docs folder. It provides detailed information on how to use each endpoint and the expected responses.
