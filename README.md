##Filesystem
![alt text](https://github.com/CP499ColoradoCollege/CurriculumChangeRequests/image1.png)

Here is an explanation of each of the directories, as well as each file in the directory:

+Classes : contains the Class .php files for each of our three classes (User, Course, and Proposal)
+Config : contains the files needed to configure the system, such as the database connection (in connection.php), the setup of all important variables and importing of necessary files (in setup.php), all of our necessary Javascript code (in js.php), all of our CSS styling for HTML elements (in css.php), and the back-end functionality that is implemented whenever a form is submitted from a web-page (in queries.php).
+databaseConnection : this contains all necessary JAR files for running the Java-related functions of our application (i.e. updating our database via a .csv file from the Banner database). ExtractExcelData.java and ExtractExcelData.class are used to read in a .csv file, and then write to the Courses table in our application’s MySQL database.
+Functions : contains any functions that aren’t necessarily class related, such as reading the current web-page’s slug (i.e. the identifier for the web-page). These functions are contained inside the sandbox.php file; originally this folder also contained our query-related functions, but that implementation was instead moved into the related Class for each function.
+Scripts : these files are bash scripts, some of which are run in order to keep our server’s code up-to-date with the code in our Git Repository, and the rest of which are used to configure the development environment we utilized during this project.
+Tests : contains all of the test files for ensuring that the functionality of our web-application is as expected.
+Vendor : contains all of the PHP dependencies necessary for our web-application to function properly, such as PHPWord.
+Views : contains the HTML structure for our each of our web-application’s web pages.
+##System Architecture
![alt text](https://github.com/CP499ColoradoCollege/CurriculumChangeRequests/Architecture.png)
###External Components:
**Banner Course Database:**
  A database which holds records for all courses at CC.
**Banner:**
  The point of interface between our application data and the Banner Course Database
###Internal Components:
**Linux Server:**
  A linux machine running CentOS 7.6
**Apache:**
  Used for web hosting. Handles https requests and serves the browser of the client
**CAS**
  CAS is Colorado college’s single sign in authentication system. Our web server checks for an authentication token, which is produced by CAS. If this token is not present or invalid, the user is routed to cas.coloradocollege.edu. There, they are prompted to provide their CC username and password. If their credentials are good, an access token is produced and they are redirected once again to our domain - proposal-tool.coloradocollege.edu
**Webpages:**
  Our webpages use HTML and CSS for front end UI. Backend functionality for the webpages is written in PHP. PHP also queries our proposal-tool SQL database to fill in relevant information in course proposal web forms, and course proposal documents.
**Java:**
  Java is used to continually update our server. Once a day, the ExtractExcelData program reads a .csv file containing the course catalog data, and pushes that information into our proposal-tool SQL database. In addition, Java is also used to produce a .csv file containing all accepted changed, which is sent to Banner.  
**Cron:**
Cron is used to schedule the ExtractExcelData program to run once per day.


