# Online Voting System

**Online Voting System** An online platform that facilitates secure, efficient, and user-friendly voting for individuals.
This project implements a robust authentication system and ensures that only authorized voters can cast their votes.

# Deployed Link 

[Online-Voting-System](https://online-voting-system.42web.io/)

## Table of Contents
1. [Features](#features)
2. [Technologies Used](#technologies-used)
3. [Project Structure](#project-structure)
4. [Getting Started](#getting-started)
5. [Usage](#usage)
6. [Deployed Links](#deployed-links)
7. [Contributing](#contributing)
8. [License](#license)

## Features

### For Admin:
- **Login and Authentication**: Admins can securely log in to manage the voting system.
- **Group Management**: Create and delete groups and Assign unique photos and initial vote counts to groups
- **User Management**: Monitor user registration and voting activity.

### For Voters:
- **User Registration**: Students can browse all available courses.
- **Voting**: 1) Vote for a candidate or group in real-time.
              2) Voting eligibility is verified, ensuring users can vote only once.

## Technologies Used

The project is built using the **PHP** with the following key technologies:

- **Frontend:**: HTML, CSS, JavaScript
- **Backend**: PHP
- **Database**: MYSQL
- **Server Environment**: Apache (via XAMPP/WAMP)
- **Tools**: Visual Studio Code

## Project Structure

### `/Root Directory`
- **index.php**: Landing page for user login/registration.
- **admin.php**: Admin panel for managing groups and users.
- **view_groups.php**: Displays all groups and their current vote counts.
- **api/connect.php**: Handles database connection.
- **uploads/**: Directory for uploaded group photos.
  
### `/Key Directories and Files:`
- **api/**: Backend scripts for database interactions.
- **css/ **: Custom stylesheets for enhanced UI.
- **js/**: JavaScript files for added interactivity.

## Getting Started

To get the project up and running locally, follow these steps:

### Prerequisites

- Install XAMPP or WAMP for local server hosting.
- Basic knowledge of PHP and MySQL.


### Installation

# 1. Clone the repository:
git clone https://github.com/mansiwalia/online-voting-system.git

# 2. Set Up the Project:
Move the project files to the htdocs directory of your XAMPP installation.

# 3. Database Configuration:
- open phpMyAdmin and create a new database named voting_system.
- Import the voting_system.sql file (available in the project repository).

# 4. Edit the Database Connection:
# Update api/connect.php with your database credentials:
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "voting_system";

# 5. Start the Local Server:
- Launch XAMPP/WAMP and start the Apache and MySQL modules.
- Navigate to http://localhost/online-voting-system.


## Usage

- **Admin:**: - Log in to manage voting groups and monitor user activity.
              - Add groups with photos and initial votes.
  
- **Voters:**: - Register, log in, and vote for a group of your choice.
               - Track real-time updates to the voting process.
  
## Deployed Links
Hosted on Infinity Free Web Hotsing: [Online Voting System](https://online-voting-system.42web.io/)

## Contributing

Contributions are welcome! If you’d like to contribute, please fork the repository and use a feature branch. Pull requests are warmly welcome.

## License
This project is licensed under the MIT License - see the LICENSE file for details.
