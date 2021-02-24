## Filesystem
├── build.sh
├── codeception.yml
├── composer.json
├── composer.lock
├── databaseConnection
│   ├── commons-collections4-4.2.jar
│   ├── commons-compress-1.18.jar
│   ├── example.xlsx
│   ├── ExtractExcelData.class
│   ├── ExtractExcelData.java
│   ├── mysql-connector-java-5.1.46-bin.jar
│   ├── poi-4.0.1.jar
│   ├── poi-ooxml-4.0.1.jar
│   ├── poi-ooxml-schemas-4.0.1.jar
│   └── xmlbeans-3.0.2.jar
├── html
│   ├── banner.JPG
│   ├── classes
│   │   ├── Course.php
│   │   ├── Proposal.php
│   │   └── User.php
│   ├── config
│   │   ├── connection.php
│   │   ├── css.php
│   │   ├── js.php
│   │   ├── queries.php
│   │   └── setup.php
│   ├── functions
│   │   └── helpers.php
│   ├── index.php
│   ├── template
│   │   ├── header.php
│   │   └── navigation.php
│   └── views
│       ├── add_feedback.php
│       ├── approve_proposal.php
│       ├── change_course_proposal.php
│       ├── change_course_proposal_select.php
│       ├── delete_proposal.php
│       ├── download_CCdocx.php
│       ├── download_docx_2.php
│       ├── download_docx_3.php
│       ├── download_docx.php
│       ├── download_FancyGEdocx.php
│       ├── download_GEdocx.php
│       ├── download_genEddocx.php
│       ├── download_proposals
│       │   ├── download_docx_2.php
│       │   └── download_docx.php
│       ├── edit_proposal_add.php
│       ├── edit_proposal_drop.php
│       ├── edit_proposal.php
│       ├── edit_proposal_revise.php
│       ├── history.php
│       ├── home.php
│       ├── login.php
│       ├── new_course_proposal.php
│       ├── new_proposal.php
│       ├── remove_course_proposal.php
│       ├── submit_proposal.php
│       └── view_feedback.php
├── presentation
│   ├── Architecture.jpg
│   ├── Getting Started.md
│   ├── image1.png
│   ├── image2.png
│   ├── image3.png
│   └── image4.png
├── README.md
├── resources
│   ├── bootstrap.php
│   ├── deploy.md
│   ├── proposal-toolDB.sql
│   └── proposaltoolDB.sql
├── script
│   ├── build.sh
│   ├── cp_files_to_xampp.sh
│   ├── deploy_development.sh
│   ├── deploy_server.sh
│   ├── fetch_server_errors.sh
│   ├── migratedb.sh
│   └── open_xampp.sh
└── tests
    ├── acceptance
    │   ├── EditCourseCest.php
    │   ├── HomeCest.php
    │   ├── NewCourseCest.php
    │   ├── NewProposalCest.php
    │   ├── RemoveCourseCest.php
    │   ├── SubmitFeedbackCest.php
    │   └── ViewFeedbackCest.php
    ├── acceptance.suite.yml
    ├── _data
    │   └── testproposaltoolDB.sql
    ├── unit
    │   ├── CourseTest.php
    │   ├── dependencies.php
    │   ├── EditHistoryTest.php
    │   ├── ProposalTest.php
    │   ├── SandboxFunctionTests.php
    │   ├── SubmitTest.php
    │   └── UserTest.php
    └── unit.suite.yml

Here is an explanation of each of the directories, as well as each file in the directory:

+ **Classes**: contains the Class .php files for each of our three classes (User, Course, and Proposal)
+ **Config**: contains the files needed to configure the system, such as the database connection (in connection.php), the setup of all important variables and importing of necessary files (in setup.php), all of our necessary Javascript code (in js.php), all of our CSS styling for HTML elements (in css.php), and the back-end functionality that is implemented whenever a form is submitted from a web-page (in queries.php).
+ **databaseConnection:** this contains all necessary JAR files for running the Java-related functions of our application (i.e. updating our database via a .csv file from the Banner database). ExtractExcelData.java and ExtractExcelData.class are used to read in a .csv file, and then write to the Courses table in our application’s MySQL database.
+ **Functions:** contains any functions that aren’t necessarily class related, such as reading the current web-page’s slug (i.e. the identifier for the web-page). These functions are contained inside the helpers.php file; originally this folder also contained our query-related functions, but that implementation was instead moved into the related Class for each function.
+ **Scripts:** these files are bash scripts, including a build script. Others can be used to keep a server’s code up-to-date with the code in our Git Repository, or for other utility named by file.
+ **Tests:** contains all of the test files for ensuring that the functionality of our web-application is as expected.
+ **Views:** contains the HTML structure for our each of our web-application’s web pages.
## System Architecture
![alt text](https://github.com/CP499ColoradoCollege/CurriculumChangeRequests/blob/master/presentation/Architecture.jpg)
### External Components:
**Banner Course Database:**  
  A database which holds records for all courses at CC  
**Banner:**  
  The point of interface between our application data and the Banner Course Database  
### Internal Components:
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


