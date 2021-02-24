## I.	PROJECT ARCHITECTURE
Before discussing how to build this project for local development, let’s briefly talk about it’s structure. The application proper is a set of PHP scripts and html pages that can be found under html/. There is also a Java file in databaseConnection/ named “ExtractExcelData.java” that parses an Excel spreadsheet from Banner and populates the local database. Insofar as we have provided .sql files under resources/, this program is not necessary for development, as one can simply load the .sql into the database. In a production environment, one would need to set up a script to run the java program with a regularly updated excel file to keep the production database up to date. 

To serve our project locally, we installed XAMPP, which is an easy-to-use web stack package containing Apache, MariaDB (a fork of MySQL), and PHP. 
We developed on a VM using Ubuntu 20.04 LTS. 

## II.	PROJECT BUILD
Look for the file build.sh in the root directory. Download this file into the directory you would like to contain the project directory and run it. NOTE: We recommend setting up a shared folder on your VM so you can write code on your host machine. How to use a shared folder in VirtualBox.
On the VM, run the command ./build.sh, and theoretically this should:
1. Resynchronize your APT package index and update packages to newest versions
2. Clone the repo
3. Download and install XAMPP (version 8.0.1) to /opt/lampp by default.
4. Download and install Java Openjdk 14, set java environment variables appropriately, and move external jar project dependencies to java path.
5. Install PHP project dependencies from composer.lock file, which contains exact versions of all PHP packages we are using 
6. Copy project files to web server document root /opt/lampp/htdocs
7. Set correct permissions for directory access and all files in /opt/lampp/htdocs
8. Start XAMPP
9. Create the local database proposaltoolDB and the test database testproposaltoolDB
Populate the databases from respective .sql files 

If all this works fine, then you should be able to open a browser in the VM and localhost/home should display the project. To manage the databases and other PHP information, you can use localhost/phpmyadmin. Alternatively, we recommend using a bridged connection between the host OS and guest OS, and using the webpage on your host OS for improved speed. To find your guest IPv4, run hostname -I in the VM, and on your host machine navigate to <guest-ip>/home to see the project. 

## III. 	BUILD ISSUES
If the above script doesn’t work, don’t panic and assume you are in dependency hell and start reinstalling things and moving things around like I did, because you will probably put yourself into dependency hell (like I did). First check why the install failed. Which step failed? Is the java path not getting set? Is the composer install giving you an error? Are files not copying to XAMPP? Is MySQL not starting? There is probably a simple fix for all of these, but pay attention to the error and check relevant logs. Logs for Apache and MySQL can be found easily through the GUI. 

Make sure there are no duplicate programs running on the guest that should be running from the webstack. For example, mysql-server, mysql-common, mysql-client, or httpd. If the MySQL install is somehow corrupted, you can delete the mysql database from /opt/lampp/var/mysql/ and reinstall with ./opt/lampp/bin/mysql_upgrade -u root -p, or simply uninstall XAMPP with ./opt/lampp/uninstall and reinstall from the provided link in the install script. 

Make sure the /opt/lampp/htdocs directory and all files in it is owned by your user, which is not set by default because XAMPP requires sudo to install. Set that with chown -R user:user /opt/lampp/htdocs.

Run composer install from the root directory containing the lock file. This should create a vendor/ directory containing 3rd party resources. If for some reason the composer.lock file is giving you issues, you can delete or move the lock files and run composer upgrade to see if newer installations of dependencies will help. Composer documentation can be found here: 
Composer: https://getcomposer.org/ 

## IV. 	RUNNING TESTS
Make sure the test database is set up with the name testproposaltoolDB, and that it is populated with the testproposaltoolDB.sql file found in tests/_data/. You can manually import the file into the database using phpmyadmin. 

There are two kinds of tests: unit and acceptance. They are found in tests/unit and tests/acceptance. They are run using the Codeception package which should be installed by composer. Codeception is an extensible PHP testing tool, but for our purposes we use it for two features: the included php webdriver and framework for running acceptance tests that interact with the webpage, and for the PHPUnit wrapper for unit tests. (We aren’t using anything special about codeception for the unit tests, it just makes it easier to run PHPUnit tests and acceptance tests in one framework). Suite configuration is found in tests/unit.suite.yml and tests/acceptance.suite.yml. Here you can list any modules you would like included in the respective tests. The root directory should contain codeception.yml which contains the filepaths to tests.  Codeception documentation can be found here: https://codeception.com/

!** Before running the tests **!, make sure to point your bash to the XAMPP version of PHP, not any pre-installed version. To do this, delete /usr/bin/php and run ln -s /opt/lampp/bin/php-<version>   /usr/bin/php to create a symlink from XAMPP’s php binary to the bash path to php which is used by Codeception.
Now, run the tests using vendor/bin/codecept run unit and vendor/bin/codecept run acceptance. There might be some false negatives on the acceptance tests due to weird flaws with PhpBrowser, but the unit tests should all pass. 
  
Note that test dependencies for the unit tests are contained in tests/unit/dependencies.php. All the tests require this file. The imports are hardcoded paths to the Php classes, so if the classes get moved around, dependencies.php needs to reflect that. 
