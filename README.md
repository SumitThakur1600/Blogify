# Blog Post Creation and Management

## Overview

The **Blog Post Creation and Management** project is a dynamic web application designed to facilitate users in creating, managing, and sharing their blog content seamlessly. With a focus on user experience and security, this application incorporates robust features for both frontend and backend operations, making it an ideal solution for bloggers and content creators.

## Table of Contents

- [Features](#features)
- [Technologies Used](#technologies-used)
- [Installation](#installation)
- [Usage](#usage)


## Features

### User Authentication
- **Sign Up**: New users can create an account with a unique username and secure password. The application ensures that passwords are stored securely using hashing techniques, protecting user data from potential breaches.
- **Login**: Existing users can log in with their credentials. The application verifies the input and grants access to the blog management functionalities.

### Blog Post Management
- **Create Blog Posts**: Users can easily create new blog posts by providing a title (up to 100 characters) and content (minimum 50 characters). This flexibility allows for rich and varied content creation.
- **View Blog Posts**: All created blog posts are displayed in a list format, showing the title, content snippet, and creation date for easy navigation and access.
- **Delete Blog Posts**: Users have the option to delete any blog post. Upon confirmation, the selected post is removed from the database, ensuring users can manage their content effectively.

## Technologies Used

- **Frontend**: 
  - **HTML**: For structuring the web pages.
  - **CSS**: For styling and enhancing the visual appeal.
  - **JavaScript**: For interactive elements and user experience improvements.

- **Backend**: 
  - **PHP**: For server-side scripting, managing user requests, and interfacing with the database.

- **Database**: 
  - **MySQL/MariaDB**: For storing user information and blog posts securely.

- **Version Control**: 
  - **Git**: For tracking changes and collaboration within the development process.

## Installation

To set up the project on your local machine, follow these steps:

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/SumitThakur1600/Blogify.git
   ```

2. **Navigate to the Project Directory**:
   ```bash
   cd blogify
   ```

3. **Import the Database Schema**:
   Locate the database schema file in the `database` folder and import it into your MySQL server using tools like phpMyAdmin or the MySQL command line.

4. **Configure Database Connection**:
   Update the database connection settings in the `security.php` file with your database credentials.

5. **Start a Local Server**:
   You can use a local server environment like XAMPP, WAMP, or any PHP-supported server to run the application.

## Usage

1. **Creating Blog Posts**: 
   - Open your web browser and navigate to `http://localhost/blog-management/addblog.php` to access the form for creating new blog posts.
  
2. **User Login**: 
   - Use the login page to enter your credentials. Upon successful login, you will be redirected to the blog management area.

3. **Managing Posts**: 
   - View existing blog posts on the designated page, where you can read content and choose to delete posts you no longer want.
