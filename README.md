# Know Your Kanoon
An easy service platform connecting you to the top lawyers in your city. Built entirely using PHP.

## Getting Started
These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Local Testing Environment

1) XAMPP setup: https://www.wikihow.com/Install-XAMPP-for-Windows.
2) CDN version of Bootstrap with Popper (https://getbootstrap.com/) and Material Design (https://material.io/) is used. Active Internet connectivity required for few styling features.
3) Create a database on phpMyAdmin (default: know-your-kanoon). Update your admin specific credentials in the `db.inc.php` (database config file) file present in the `resources/includes` folder.

### Database Schema

#### Users Table
![Users table](https://github.com/dhruvshettty/know-your-kanoon/blob/master//public_html/img/users_table.jpg?raw=true)

#### SQL Code
```
CREATE TABLE users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(5) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
```

## Acknowledgments
1) Title of this project was inspired from Amber Rana's podcast called <em>Know Your Kanoon</em>: https://ivmpodcasts.com/know-your-kanoon.
2) Motivation for this project was part of our Web Applications laboratory (2020-2021) under Prof. Arya S S, PESIT-Bengaluru South Campus
3) The project structure and code covention is in accordance to the PSR-1 (PHP Standards Recommendation): https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md