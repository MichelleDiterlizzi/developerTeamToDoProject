# TO-DO Project

## Description
This project is a task management (TO-DO) application that allows users to create, update, delete, and list tasks. Each task has a status (pending, in progress, or completed), start and end times, and the user who created it.

## Functional Requirements
- Add new users
- Login one user session
- Add new tasks
- List all tasks
- Show task status (pending, in progress, or completed)
- Record start and end times for each task
- Save the user who created the task
- Update existing tasks
- Delete tasks
- List a specific task

## Project Structure
The project follows the MVC (Model-View-Controller) design pattern using a provided base structure.

## Technologies Used
- PHP as the backend programming language
- Visual Studio Code
- Tailwind CSS y HTML for frontend design and layout
- JSON file persistence
- MVC design pattern

## Data Model
The application uses an entity-relationship model (ERM) that includes:

- **Task**
  - id (unique identifier)
  - title
  - description
  - status (pending, in progress, completed)
  - start_time
  - end_time
  - user_id (reference to the user who created the task)

- **User**
  - id (unique identifier)
  - name
  - email
  - password

### GitFlow Workflow
The project follows the GitFlow workflow:

- **main**: Main branch with stable production code
- **develop**: Development branch where features are integrated
- **feature/xxx**: Branches for developing new features

## Author
- Michelle Di Terlizzi
