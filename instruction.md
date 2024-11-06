At first Create database --
sql: CREATE DATABASE resultmanagement;

Create the tables --
sql:  CREATE TABLE admins (
        id INT AUTO_INCREMENT PRIMARY KEY,
        admin_id VARCHAR(50) NOT NULL,
        access_token VARCHAR(20) NOT NULL
    );

sql:  CREATE TABLE courses (
        c_id VARCHAR(15) PRIMARY KEY,
        c_year int,
        c_name VARCHAR(50),
        is_taken VARCHAR(10)
    );

sql:  CREATE TABLE student (
        s_id VARCHAR(20) PRIMARY KEY,
        s_name VARCHAR(50),
        access_token VARCHAR(20),
        year int
    );

sql:  CREATE TABLE teacher (
        id INT AUTO_INCREMENT PRIMARY KEY,
        t_id VARCHAR(20) ,
        t_name VARCHAR(50),
        access_token VARCHAR(20),
        t_year int,
        t_c_id VARCHAR(20)
    );

sql:  CREATE TABLE firstyear (
         s_id VARCHAR(20) PRIMARY KEY
    );

sql:  CREATE TABLE secondyear (
         s_id VARCHAR(20) PRIMARY KEY
    );

sql:  CREATE TABLE thirdyear (
         s_id VARCHAR(20) PRIMARY KEY
    );

sql:  CREATE TABLE forthyear (
         s_id VARCHAR(20) PRIMARY KEY
    );


****** don't change any table name although it seems illogical to you
****** check db.php to connect database , make sure your correct username and password


The functionality we have to add

1. To chenge access_token after longin for(student , teacher ,admin if you want)
procedur: simply create a button to the userPage 'Change Password' When the user click the button then go to a new page in where you are asked to input old password and new passworld , after filling the input you will query from (student or teacher) tabel where s_id or t_id == user_id , and match the old password to access_token of the user and after matching update access_token field using PDO and sql.

2. write a switch case programm which will convert marks into (3.25, 3.5 , 3.75) like that after converton we will insert this to database.

3. make a graph when student will see his or her result then it will apear like (A+ , A- , B+).

4. Keep the optiom in admin page a. Add course b. View course (in view courses if the course  is_taken is null then admin can delete this) these operation will perform in couses table.

5. Add a funtion Publish Result in admin page , before publishing result the student can't see his or her result the massege may be 'Your result hasn't prepared yet' after publishing result the average cgpa will add the student table and his correspond year table ;



******* This easy funtionalities can be added easily if we work together   ***** 



