### Project Description

This project is aimed at developing a community-focused cooking recipe platform. It is designed to cater to a wide range of users, from home cooks looking for meal inspiration to professional chefs interested in sharing their signature recipes. The platform also introduces a competitive element by hosting events where users can earn points, making the cooking experience more engaging and interactive. Additionally, it offers tailored search functionalities to accommodate users with specific dietary requirements.

### Key Features:

- Access to a wide range of recipes from professional chefs.
- Competitive events for users to earn points.
- Ability for users to review and rate recipes.
- Advanced search functionality to cater to dietary needs.
- Data analysis on user preferences and event popularity.

### Technology Stack:

- Front-end: JavaScript, HTML, CSS.
- Back-end: PHP.
- Database: PostgreSQL.

### Prerequisites

To run this project, ensure you have the following installed:

Apache Server: Necessary for hosting the PHP backend.
PostgreSQL Database: Set up and configured to store and manage the application data.
Composer: A dependency manager for PHP, used for installing the necessary libraries and dependencies.

### Setup Instructions

- Install Dependencies: Navigate to the root directory of the repository and run the following command to install the PHP dependencies:
composer install

- Environment Configuration: Create a .env file in the root directory and specify the following environment variables to configure the database connection:

DB_HOST=<your_database_host> 

DB_NAME=<your_database_name> 

DB_USER=<your_database_username> 

DB_PASS=<your_database_password> 

Replace the placeholders with your actual PostgreSQL database details.

- Run Apache Server: Start the Apache server to host the PHP backend. This process will vary depending on your operating system and the Apache installation method.

- Access the Application: Open a web browser and navigate to the URL of your local repository. This URL will depend on your Apache server's configuration, typically something like http://localhost/<repository_name>.

### Real-life Applications
This platform serves multiple real-life applications, including:

- Assisting home cooks in discovering new recipes and planning meals.
- Enabling professional chefs to share their signature recipes with a wider audience.
- Helping users with specific dietary restrictions find suitable recipes easily.
- Engaging the community through competitive cooking events and interactive features.
