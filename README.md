# Simple CRM Web App 
![Screenshot from 2024-06-09 17-45-28](https://github.com/nicholsonz/Simple-CRM/assets/77360596/c628d162-4d34-4430-808d-8ad100b96f98)
![Screenshot from 2024-06-12 16-45-36](https://github.com/nicholsonz/Simple-CRM/assets/77360596/f1477db7-3d42-4925-9b37-5de0dd92f2f9)

Simple-CRM was designed for licensed insurance agents or anyone who needs to track their client/lead generation.

## Features
* Complete task system with notification
* Multi-user environment with assigned rights
* Responsive
* Searchable and sortable tables
* Easy to setup and use
  
## Requirements - May or may not work on earlier versions of apps
* Apache or Nginx
* PHP 7.4 +
* MariaDB 10 + 

## Installation

You don't need any fancy package managers here. Just create the "clientdb" database, import the clientdb.sql file into your database, and then edit the dbconfig.php file for your database variables. 

Create a user and assign a password for the database. Be sure to change the username and password for your system.

(MySQL/MariaDB)

Login to your server and run the code below or use phpMyAdmin instead:

    sudo mysql
Then
    
    CREATE DATABASE clientdb; 
    GRANT SELECT, INSERT, UPDATE, DELETE ON clientdb.* to 'user'@'localhost' IDENTIFIED BY 'password';
    FLUSH PRIVILEGES;
    EXIT;

Next, import the clientdb.sql file

    sudo mysql clientdb < clientdb.sqlf

Visit the login page and select SignUp at the bottom. You will be  greeted with a new user registration page.

That's it!
