# Vulnerable website for CSRF attack
---
## Databse configuration
- File manager.php
   - host : localhost
   - dbName : madb
   - dbUser : root
   - dbPwd : root
- Creation of the database
    - Database name : madb
    - Table name : users
        - column 1 : username -> Varchar(255), primary key
        - column 2 : password -> Varchar(255)

## Routes 
- /CSRF-Attack/
- /CSRF-Attack/login
- /CSRF-Attack/logout
- /CSRF-Attack/register
- /CSRF-Attack/change/password equivalent to /CSRF-Attack/change/password/level1
- /CSRF-Attack/change/password/level2 (add a csrf token to the form)

## CSRF vulnerability
When a user is connected to the website, a session cookie is created.

He has the possibility to change his password thanks to routes dedicated. The original request is a POST with his new password. The request is accepted only if the user is connected.

Another possibility, is to change the password with the method GET. The request looks like : /CSRF-Attack/change/password?pwd=newPwd
