
#Getting Started
###Local Development Environment
Our team built a development kit containing all components nesesarry to run our web app on a local server.
####Step 1 - Create a virtual machine running Ubuntu 16.04
**Note**: You may skip this step if you already have a machine with Ubuntu 16.04

+ Download and install virtualbox
+ Download Ubuntu 16.04
+ Create a virtual machine running Ubuntu 16.04 in virtualbox
	+ Allocate at least 15 gb of storage

If you want to  **work in the virtual machine:**
+ Allocate at least 4gb of RAM and 2 cpu cores to your virtual machine

If you want to **work in the host OS:**
+ Configure a shared folder to move files from your host OS to the virtual machine



####Step 2 - Clone the repository
Inside the terminal of your virtual machine (henceforth devkit) run the following command to clone the repo:
`$ git clone https://github.com/CP499ColoradoCollege/CurriculumChangeRequests.git`
####Step 3 - Run ./buildDevKit.sh to install devkit software
This bash script will install the following pieces of software automatically:
+ **XAMPP**
    + An Apache distribution which includes mySql, php and perl
    + This is the software that will host and serve your **local development server**
+ **Java 8**
    * Java is used to process data from banner. See **Architecture Specification**
+ **Php extensions, libraries, and Composer**
    * **Php extensions:**
		* php-xml
		* php-zip
		* php-mbstring
	* **Composer libraries:**
		* zend-escaper
		* zend-stdlib
		* PhpWord
		* PhpUnit

Note: Composer is a piece of software that manages php dependencies. For more info: https://getcomposer.org/

####Step 4 - Configure XAMPP
XAMPP has a fun feature where it does not show up in your applications. To make it show up there, run the following commands in your devkit terminal:

`$ sudo apt-get install gksu`
`$ gksu gedit /usr/share/applications/xampp-control-panel.desktop`

gksu will open a text editor. Paste the following text in and save.

>[Desktop Entry]
Encoding=UTF-8
Name=XAMPP Control Panel
Comment=Start and Stop XAMPP
Exec=gksudo /opt/lampp/manager-linux-x64.run
Icon=/opt/lampp/htdocs/favicon.ico
Categories=Application
Type=Application
Terminal=false

Now, you can open XAMPP from your applications folder.

####Step 5 - Launch XAMPP server
If it is not already open, open the XAMPP control panel by clicking the icon in the top left of your Ubuntu taskbar and typing XAMPP. The XAMPP control panel should be the first result.

In the XAMPP control panel, open the** Manage Servers** tab and click **Start All**

You may now open Firefox in your devkit and type localhost:80 into the navbar to view the locally hosted version of the web app.

**XAMPP tips:**
Project files go in the folder opt/lampp/htdocs from the console, you can click **Go to Application Folder** to open that folder in the file browser. Alternitavely, you can get there from the command line with `cd ~/../../opt/lampp/htdocs`

###Done!
You are ready to begin development on the local server!

You may either work directly in the opt/lampp/htdocs directory to have your changes instantly update the web server at localhost:80, or, you may work in another directory and run the ./deploy_development.sh script to changes to the local web server (Recommended)

#Deployment
Our web server is hosted at https://proposal-tool.coloradocollege.edu
The server is managed by ITS. **If you have any technical problems deploying to the server contact ITS early and often**
####Step 1 - Get access to the server
Contact ITS about getting access to the server.
####Step 2 - Run ./deploy_server.sh
This script does the following:
+ Compiles ExtractCourseInfo.Java
+ Transfers php, html, css, and compiled java to the web server using sftp
+ Runs composer install to update php libraries on server
+ Starts cron service to run ExtractCourseInfo once per day to update the server database.
###Done!
Your code is now deployed. Be sure to visit https://proposal-tool.coloradocollege.edu to verify everything is working.
Note: You must be on the **CC network** and use **https**.
