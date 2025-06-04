Ican apply CRUD on the contact form page 
Database Name:event_managment

Table: contacts

SQL Code:
----------
USE event_managment;

CREATE TABLE contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100),
    email VARCHAR(100) NOT NULL,
    phone_number VARCHAR(15) NOT NULL,
    comment TEXT
);

Explanation:

- `id`: A unique ID for each contact. It auto-increments with every new entry.
- `first_name`: Contact's first name. Required.
- `last_name`: Contact's last name. Optional.
- `email`: Contact’s email address. Required.
- `phone_number`: Contact’s phone number. Required.
- `comment`: Additional notes or comments. Optional.

The query `SELECT * FROM contacts;` retrieves all rows from the `contacts` table.

How to Run This Project:
1. Import the SQL:
   - Open phpMyAdmin or MySQL CLI.
   - Create the database by running:
     CREATE DATABASE event_managment;
   - Then use:
     USE event_managment;
   - Paste and execute the CREATE TABLE statement.

2. Setup Files:
   - Place all PHP files (e.g., index.php, view.php, db.php, etc.) in your web server directory (like `htdocs` in XAMPP).

3. Configuration:
   - Ensure your `db.php` file has correct credentials:
     ```
     $servername = "localhost";
     $username = "root";
     $password = "your_mysql_password";
     $dbname = "event_managment";
     ```

4. Run Project:
   - Open your browser and go to:
     http://localhost/[your-folder]/index.php

   - Use the navigation to:
     • Add new contacts
     • View, edit, or delete contacts
