<div align="center">
    <img src="https://github.com/PaingMinSoe/trainee-test/assets/61079619/6c17ab7f-93b7-487f-aea2-959e2ecc0bb3" width="100px" height="100px"/> 
</div>

# **Web Developer Laravel Trainee Assignment by Paing Min Soe**

This is a Laravel Project for Web Developer Trainee test by **Better HR**. Features are implemented as assigned.

-   User Register & Login using Laravel Passport
-   Employee Creation
-   Employee Listing
-   Employee Update
-   Employee Delete

## Setup

Run the command shown below in the terminal first to install all necessary packages for the project.

```
composer install
```

After all necessary packages are installed, create .env file by referring to .env.example file and create a database for the project.
After all the steps are done. Run the commands below and project setup will be completed.

```
php artisan key:generate
```

```
php artisan migrate --seed
```

```
php artisan passport:install
```

## Project Overview

### **User Register - <span style="color: goldenrod;">POST</span>**

```http
POST http://127.0.0.1:8000/api/register
```

Name, Email and Password are validated firstly. Upon successful validation, the data is saved in users table with encrypted password. API access token is generated. The access token must be included in header as `Authorization: Bearer <access token>`.

### **User Login - <span style="color: goldenrod;">POST</span>**

```http
POST http://127.0.0.1:8000/api/login
```

Users can login using Email and Password. Upon successful login, API token is generated. The access token must be included in header as `Authorization: Bearer <access token>`.

### **User Logout - <span style="color: goldenrod;">POST</span>**

```http
POST http://127.0.0.1:8000/api/logout
```

The user's API token is revoked and user is successfully logged out.

### **Employee List - <span style="color: green;">GET</span>**

```http
GET http://127.0.0.1:8000/api/employees
```

API middleware is applied hence user must login first to get all employees data.

### **Employee Create - <span style="color: goldenrod;">POST</span>**

```http
POST http://127.0.0.1:8000/api/employees
```

The employee's data will be saved to the employees table.

### **Employee Details - <span style="color: green;">GET</span>**

```http
POST http://127.0.0.1:8000/api/employees/{id}
```

Only the data of the employee with given id will be returned.

### **Employee Update - <span style="color: cornflowerblue;">PUT</span>**

```http
PUT http://127.0.0.1:8000/api/employees/{id}
```

The employee's data with the given id will be modified.

### **Employee Delete - <span style="color: brown;">DELETE</span>**

```http
DELETE http://127.0.0.1:8000/api/employees/{id}
```

Existing employee data with given id will be deleted.
