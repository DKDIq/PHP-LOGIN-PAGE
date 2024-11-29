# PHP User Authentication Script  

This PHP script handles **user registration, login**, and **session management** using a MySQL database and cookies. It ensures that users must log in to access protected pages, with session validation based on unique tokens stored in cookies. **Bypassing the login page is not possible** without a valid token, ensuring secure access control.

## Features  

- **Secure User Registration**  
  - Validates user input (username, email, password).  
  - Generates a unique session token using `random_bytes()`.  
  - Stores user data and token in a MySQL database.  

- **User Login**  
  - Verifies email and password against database records.  
  - Sets a session token cookie upon successful authentication.  

- **Session Management**  
  - Validates session tokens stored in cookies.  
  - Automatically logs out users with expired or invalid tokens.  

- **Security Measures**  
  - Prevents SQL injection by sanitizing input with `real_escape_string()`.  
  - Uses secure cookies (`HttpOnly`) to protect tokens from client-side access.  

## Cookies and Session Management  

- Upon successful login or registration, a **unique token** is generated and stored in a cookie (`user_token`).  
- This cookie is used to validate the user’s session across different pages.  
- If the cookie is missing or invalid, the script **redirects the user to the login page**, ensuring that access to protected pages is not possible without authentication.  
- The session expires after a set time, requiring users to log in again, enhancing security.

## Prerequisites  

To use this script, you need:  

- **PHP 7.0+**  
- **MySQL database** with the following structure:  

```sql
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nick VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE,
  haslo VARCHAR(255) NOT NULL,
  token VARCHAR(64) NOT NULL
);
