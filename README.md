# PHP initial Project
Main structure of php project. Folders / files:
- **app**
  - **controllers**
  - **models**
  - **views**
- **config**
- **lib**
  - **base**
- **web**

## Description

This project is a task management (TO-DO) application enabling users to create, update, delete, and list tasks. Tasks feature a status (pending, in progress, or completed), start and end times, and track the user who created them. Data persistence is handled using JSON files.

## Features

* New user registration.
* Existing user login.
* Add new tasks associated with the logged-in user.
* List all tasks for the logged-in user.
* Display task status (pending, in progress, completed).
* Record start and end times for each task.
* Track the user who created each task.
* Update existing tasks.
* Delete tasks.
* Display details for a specific task.

## Technologies Used

* **Backend:** PHP (Version X.X or higher recommended - *specify your version*)
* **Frontend:** HTML, Tailwind CSS
* **Persistence:** JSON Files
* **Architecture:** MVC (Model-View-Controller) Pattern
* **Web Server Requirement:** Apache, Nginx, or any web server capable of running PHP.

## Installation

To run this project locally, you'll need a PHP development environment. Here are the general steps:

### Prerequisites

* **PHP:** Ensure you have PHP installed (Version X.X or higher recommended - *specify your version*).
* **Web Server:** You need a web server (like Apache or Nginx) configured to run PHP applications.
* **Git:** Required to clone the repository.
* **(Optional) Composer:** If external PHP libraries were added (check for a `composer.json` file).

### Setup Steps

1.  **Get the Code:**
    * Clone the repository to a location on your computer:
        ```bash
        git clone [Your GitHub repository URL]
        cd [project-folder-name]
        ```

2.  **Configure Your Web Server (Crucial Step):**
    * The core requirement is that your web server's **document root** (the public-facing directory) must point to the `web/` subdirectory *inside* the project folder you just cloned.
    * **Goal:** Web requests (e.g., to `http://your-local-domain/`) should be handled by the `[project-folder]/web/index.php` file.
    * **How to achieve this depends on your environment:**
        * **Using Bundled Environments (like XAMPP, WAMP, MAMP):**
            * *Option A (Subdirectory):* Place the `[project-folder-name]` inside the environment's main web directory (e.g., `htdocs`, `www`). You would then access the project via `http://localhost/[project-folder-name]/web/`.
            * *Option B (Virtual Host - Recommended for cleaner URLs):* Configure a Virtual Host within your environment's Apache settings. Set the `DocumentRoot` of this Virtual Host to the full path of the `[project-folder-name]/web/` directory (e.g., `C:/path/to/your-project-name/web/`). This allows access via a custom URL like `http://todo-project.test/`. Consult your specific environment's documentation for creating Virtual Hosts.
        * **Using Native Apache/Nginx:**
            * You will need to configure a new Virtual Host. Edit your Apache (`httpd.conf`, `.conf` files in `sites-available`) or Nginx (`nginx.conf`, files in `sites-available`) configuration.
            * Set the `DocumentRoot` (Apache) or `root` (Nginx) directive for the Virtual Host to the full path of the project's `web/` folder (e.g., `/var/www/your-project-name/web/`).
            * Remember to restart your web server after making configuration changes.

3.  **Configure Persistence (JSON Files):**
    * The application saves user and task data to JSON files, expected to be in a specific directory within the project (e.g., `data/` - *verify and specify the exact path in your code*).
    * **Very Important:** The **web server process** (e.g., `www-data`, `apache`, `nobody`) needs **write permissions** on this data directory (e.g., `data/`) and potentially the JSON files within it. The application needs this to save new users, tasks, updates, etc.
    * Check and adjust permissions using your operating system's tools (e.g., `chmod`, `chown` on Linux/macOS, or folder Security Properties on Windows).
    * If the data directory or initial JSON files (`users.json`, `tasks.json`) do not exist, you may need to create them manually. Empty files might need initial content like `[]` or `{}`.

4.  **(Optional) Install Dependencies:**
    * If a `composer.json` file exists in the project root, navigate to the project directory in your terminal and run:
        ```bash
        composer install
        ```

5.  **Start Server & Access:**
    * Ensure your web server (Apache/Nginx, or via XAMPP/WAMP/MAMP Control Panel) is running.
    * Open your web browser and navigate to the URL you configured in Step 2 (e.g., `http://localhost/[project-folder-name]/web/` or `http://todo-project.test/`).

### Usage

The web/index.php is the heart of the system.
This means that your web applications root folder is the “web” folder.

All requests go through this file and it decides how the routing of the app
should be.
You can add additional hooks in this file to add certain routes.

### Project Structure

The root of the project holds a few directories:
**/app** This is the folder where your magic will happen. Use the views, controllers and models folder for your app code.
**/config** this folder holds a few configuration files. Currently only the connection to the database.
**/lib** This is where you should put external libraries and other external files.
**/lib/base** The library files. Don’t change these :)
**/web** This folder holds files that are to be “downloaded” from your app. Stylesheets, javascripts and images used. (and more of course)

The system uses a basic MVC structure, with your web app’s files located in the
“app” folder.

#### app/controllers
Your application’s controllers should be defined here.

All controller names should end with “Controller”. E.g. TestController.
All controllers should inherit the library’s “Controller” class.
However, you should generally just make an ApplicationController, which extends
the Controller. Then you can defined beforeFilters etc in that, which will get run
at every request.

#### app/models
Models handles database interaction etc.

All models should inherit from the Model class, which provides basic functionality.
The Model class handles basic functionality such as:

Setting up a database connection (using PDO)
fetchOne(ID)
save(array) → both update/create
delete(ID)
app/views
Your view files.
The structure is made so that having a controller named TestController, it looks
in the app/views/test/ folder for it’s view files.

All view files end with .phtml
Having an action in the TestController called index, the view file
app/views/test/index.phtml will be rendered as default.

#### config/routes.php
Your routes around the system needs to be defined here.
A route consists of the URL you want to call + the controller#action you want it
to hit.

An example is:
$routes = array(
‘/test’ => ‘test#index’ // this will hit the TestController’s indexAction method.
);

#### Error handling
A general error handling has been added.

If a route doesn’t exist, then the error controller is hit.
If some other exception was thrown, the error controller is hit.
As default, the error controller just shows the exception occured, so remember
to style the error controller’s view file (app/views/error/error.phtml)


### Utilities
- [PHP Developers Guide](https://www.php.net/manual/en/index.php).
- .gitignore file configuration. [See Official Docs](https://docs.github.com/en/get-started/getting-started-with-git/ignoring-files).
- Git branches. [See Official Docs](https://git-scm.com/book/en/v2/Git-Branching-Branches-in-a-Nutshell).
