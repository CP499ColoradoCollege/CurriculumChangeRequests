## FILESYSTEM
![filesystem](https://github.com/CP499ColoradoCollege/CurriculumChangeRequests/blob/master/presentation/filesystem.png)

Here is an explanation of each of the directories, as well as each file in the directory:
+ **Views:** contains the HTML structure for our each of our web-application’s web pages.
+ **Classes**: contains the Class .php files for each of our three classes (User, Course, and Proposal)
+ **Config**: contains the files needed to configure the system, such as the database connection (in connection.php), the setup of all important variables and importing of necessary files (in setup.php), all of our necessary Javascript code (in js.php), all of our CSS styling for HTML elements (in css.php), and the back-end functionality that is implemented whenever a form is submitted from a web-page (in queries.php).
+ **databaseConnection:** this contains all necessary JAR files for running the Java-related functions of our application (i.e. updating our database via a .csv file from the Banner database). ExtractExcelData.java and ExtractExcelData.class are used to read in a .csv file, and then write to the Courses table in our application’s MySQL database.
+ **Functions:** contains any functions that aren’t necessarily class related, such as reading the current web-page’s slug (i.e. the identifier for the web-page). These functions are contained inside the helpers.php file; originally this folder also contained our query-related functions, but that implementation was instead moved into the related Class for each function.
+ **Scripts:** these files are bash scripts, including a build script. Others can be used to keep a server’s code up-to-date with the code in our Git Repository, or for other utility named by file.
+ **Tests:** contains all of the test files for ensuring that the functionality of our web-application is as expected.

## System Architecture
![alt text](https://github.com/CP499ColoradoCollege/CurriculumChangeRequests/blob/master/presentation/Architecture.jpg)
### External Components:
**Banner Course Database:**  
  A database which holds records for all courses at CC. We should receive an Excel spreadsheet that we must parse for this data by putting it into the databaseConnection directory.
### Internal Components:
**Linux OS**  
  A linux machine running Ubuntu 20.04 LTS  
**Apache:**  
  Used for web hosting. Handles https requests and serves the browser of the client  
**CAS**  
  The project is currently not integrate with CAS.
**Webpages:**  
  Our webpages use HTML and CSS for front end UI. Backend functionality for the webpages is written in PHP. PHP also queries our proposal-tool SQL database to fill in relevant information in course proposal web forms, and course proposal documents.  
**Java:**  
  Java is used to continually update our database. The ExtractExcelData program reads a .csv file containing the course catalog data, and pushes that information into our proposaltoolDB SQL database. In addition, Java is also used to produce a .csv file containing all accepted changes, which can be sent to Banner.  
**Cron:**  
Cron or someother task scheduler should be used to run ExtractExcelData


