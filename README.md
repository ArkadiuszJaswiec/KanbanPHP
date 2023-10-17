# KanbanPHP

## About Project

The project was created for study purposes. It was made in php, html, ajax and css. It uses the MySQL database. The aim of the project was to create a tool that facilitates the management of tasks and their statuses by a logged-in user

## Database

The database consists of two tables connected relationally:
-users table, information about registered users is stored here
-tasks table contains tasks assigned to the user and their current status

## index.php
This is the login and registration page for new users. After successful login, the user is redirected to the kanban.php website
![image](https://github.com/ArkadiuszJaswiec/KanbanPHP/assets/120305012/2bb3ba88-814d-4435-82b5-705f01b5bd06)

## kanban.php
The user sees his current tasks here. Below the kanban there is a form that can be used to add new tasks. Kanban tasks are colored depending on the level of difficulty. Transferring tasks between statuses was done thanks to Ajax and the drag and drop mechanism. When you drop a task in a column with a specific status, Ajax technology automatically updates the task in the database.

![image](https://github.com/ArkadiuszJaswiec/KanbanPHP/assets/120305012/e358275d-33cd-42dc-bad4-1db854853d38)
