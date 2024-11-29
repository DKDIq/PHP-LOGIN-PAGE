PHP User Authentication Script Description
This script handles user registration, login, and session management using a MySQL database and cookies. It ensures secure user access by generating unique tokens and validating credentials. Users are required to log in to access protected pages, and bypassing the login page is not possible due to cookie-based session management.

Key Features and Requirements:
Database Connection:
The script connects to a MySQL database using predefined credentials (host, user, password, and database).

Requirement: A database with a users table containing columns for nick, email, password, and token.
Token Generation:

A unique token is generated for each user using PHP’s random_bytes() function and stored in both the database and a cookie.
This token is used for session management and user verification.
User Registration:

Process:
Validates input fields (nick, email, password).
Ensures the email format is correct using PHP’s filter_var() function.
Inserts the user's details and token into the database.
Sets a cookie with the generated token to maintain the session.
Security: Prevents SQL injection by sanitizing inputs with real_escape_string().
User Login:

Process:
Verifies if the provided email exists in the database.
Compares the entered password with the stored password.
If credentials match, a token is set in a cookie to allow access to protected pages.
Redirects users to a dashboard upon successful login, passing nick and password as URL parameters.
Session Management:

The script checks for a valid user_token cookie.
If the token is valid and matches the database record, the user is logged in.
If the token is invalid or missing, the user is redirected to the login page.
Expired sessions automatically clear the cookie, requiring re-authentication.
Security Measures:

Cookies: Secure cookies (HttpOnly flag) store the user’s token, preventing client-side access.
SQL Injection Prevention: All input data is sanitized using real_escape_string().
Actions Handled by the Script:

Registration (reje action): Inserts new users into the database.
Login (log and pobierz actions): Authenticates users and sets session tokens.
Session Validation (sprawdz_dane action): Verifies active user sessions based on cookies.
Error Handling:

The script returns user-friendly error messages for invalid credentials, missing data, or expired sessions.
System Requirements:
A MySQL database with a users table containing the following fields:

nick (VARCHAR)
email (VARCHAR)
haslo (VARCHAR)
token (VARCHAR)
PHP 7.0+ for compatibility with functions like random_bytes().

This setup ensures that users must log in to access protected resources, with cookies controlling session validity. Without a valid token, users are automatically redirected to the login page, enforcing security and session control.


by Tomasz Filipczuk
