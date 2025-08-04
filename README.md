# ToDo App (Multi-User)

This is a full-stack ToDo application built with a simple PHP API and a vanilla JavaScript frontend, enhanced to support multiple users.

***

## Features
- User Authentication: The application has a dedicated `users` table to handle user accounts.
- Personalized Tasks: Each task is tied to a specific user, ensuring that users can only view and manage their own tasks.
- CRUD Functionality: Full support for creating, reading, updating, and deleting tasks.

***
## Deploy Instructions On Hostinger
1. Upload folder to `public_html`
2. Access from browser or by ssh terminal
3. API folder = `/api/`

## Technologies
### Backend
- PHP: Used for creating the API endpoints.
- MySQL: The database for storing users and tasks.
- Composer: Used for package management (e.g., for JWT).

### Frontend
- HTML5: Provides the page structure.
- CSS3: Styles the application for a clean user interface.
- JavaScript (Vanilla): Handles all client-side logic and API interactions.

***

## Setup & Configuration

### 1. Database Setup
Create a MySQL database and the following two tables.

#### `users` table
CREATE TABLE users (
id INT AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(50) NOT NULL UNIQUE,
email VARCHAR(100) NOT NULL UNIQUE,
password VARCHAR(255) NOT NULL, -- hashed password
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


#### `tasks` table
CREATE TABLE tasks (
id INT AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(255) NOT NULL,
description TEXT,
completed BOOLEAN DEFAULT FALSE,
user_id INT,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);


### 2. Backend Environment
The backend API needs to be configured to handle authentication and secure data storage.
- **Private Secrets:** Store your database credentials and JWT secret in a non-public location (e.g., a `.env` file).
- **Access Control:** The API should be configured to handle cross-origin requests (CORS) securely.
- **Dependencies:** Install any necessary Composer dependencies.
- **Authentication Logic:** Your API must handle user registration, login, and verify a user's identity via an authentication token for all task-related operations.

### 3. Frontend
The front-end code will need to be updated to include user registration and login forms. It must also be able to store the authentication token (e.g., JWT) and send it with each API request in the `Authorization` header.

***

## API Actions

The API will require an authentication mechanism to ensure that only the correct user can access or modify their tasks.

- **GET /api/tasks**: Retrieves all tasks for the authenticated user.
- **POST /api/tasks**: Creates a new task for the authenticated user.
- **PUT /api/tasks/{id}**: Toggles a task's completion status for the authenticated user.
- **DELETE /api/tasks/{id}**: Deletes a task for the authenticated user.
