# ERP-System

 # ERP System

## Table of Contents
- [Introduction](#introduction)
- [Features](#features)
- [Technologies Used](#technologies-used)
- [Installation](#installation)
  - [Prerequisites](#prerequisites)
- [Usage](#usage)
  - [Dashboard Panel](#dashboard-panel)
  - [Customer and Item Management](#customer-and-item-management)
  - [Reports](#reports)
- [Contact](#contact)

## Introduction
The ERP System is a robust web application designed to streamline business operations, including customer management, inventory management, and reporting. Developed in PHP with a MySQL backend, this system offers an intuitive interface, making it easier to manage various business processes efficiently.

## Features
- **Customer Management**: Add, edit, view, and manage customer records.
- **Item Management**: Add, edit, view, and manage inventory items and their categories.
- **Report Generation**: Generate and export CSV reports for invoices, items, and inventory statistics.
- **Dashboard**: Overview of key metrics such as total customers, items, and invoices.

## Technologies Used
- **Backend**: PHP, MySQL
- **Frontend**: HTML, CSS, JavaScript
- **Frameworks/Libraries**: Bootstrap, Font Awesome
- **Tools**: Apache/Nginx, Composer

## Installation

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache or Nginx server

### Steps to Set Up Locally

1. **Create the Database**
   - Open your MySQL client (e.g., phpMyAdmin) and create a new database, for example, `erp_system`.
   - Import the SQL schema file into this database to set up the necessary tables and relationships.

2. **Configure Database Connection**
   - Edit the `src/connection.php` file to set your database connection parameters:
     ```php
     <?php
     $host = 'localhost'; // Your database host
     $user = 'root'; // Your database username
     $password = ''; // Your database password
     $dbname = 'erp_system'; // Your database name

     $con = mysqli_connect($host, $user, $password, $dbname);

     if (!$con) {
         die("Connection failed: " . mysqli_connect_error());
     }
     ?>
     ```
  
2. **Paste the project folder into Server directory **
   - Place the project directory in your web server’s root directory. For Apache, this is usually `htdocs` (e.g., `C:\wampp\www` for WAMP).
  - Ensure that your web server is configured to serve PHP files and that the document root points to the `index.php` file of this project.
  - 
3. **Access the Application**
   - Start your web server and navigate to `http://localhost/erp-system/index.php` in your web browser to access the dashboard.

4. **Verify Dependencies**
   - Ensure you have an internet connection to load external resources like Bootstrap and Font Awesome.
   - There are no additional local dependencies required for this project.

## Usage

### Dashboard Panel
The Dashboard panel provides tools to manage the ERP system effectively. Administrators can:
- **Manage Customers**: Add, edit, view, and delete customer records.
- **Manage Items**: Add, edit, view, and delete inventory items and their categories.
- **Generate Reports**: Create and download CSV reports for invoices, items, and inventory statistics.
- **Dashboard Overview**: View key metrics such as total customers, total items, and total invoices.

### Customer and Item Management
Administrators can manage:
- **Customer Information**: Access customer details, update records, and view customer lists.
- **Item Information**: Manage inventory items, including adding new items, updating existing ones, and viewing item lists.

### Reports
- **Invoice Report**: Generate reports for invoices with details like invoice number, date, customer information, item count, and amount.
- **Invoice Item Report**: Get detailed reports on items included in invoices.
- **Item Report**: View reports on item quantities, categories, and subcategories.

## Contact
For any questions or support, please contact:

Name: Muhammed abdullah 
Email: mohamedabdullah93@gmail.com 
Linkedin: https://www.linkedin.com/in/muhammed-abdullah93


---

Thank you for using the ERP System! We hope it helps streamline your business operations and reporting needs.

