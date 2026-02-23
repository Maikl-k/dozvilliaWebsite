## Tech stack

**-PHP 8.4**
**-MYSQL 8.4**
**-PDO**
**-HTML**
**-CSS**
**-Javascript**
**-composer 2.9**

## How to run webiste locally

You must insatll all necessary (PHP, MYSQL, Composer) and libraries such as:  
**-twig**
**-altorouter**  
to install this you need do next steps:  
### Linux Ubuntu/Debian
`sudo apt update && sudo apt install wget` resynchronize your local index files with the remote servers and install wget(if you do not have already).  
`wget https://dev.mysql.com/get/mysql-apt-config_0.8.32-1_all.deb` download repository setup package.  
`sudo apt install ./mysql-apt-config_0.8.32-1_all.deb` install the configuration package.  
`sudo apt update` update package infromation.  
`sudo apt install mysql-community-server` isntall mysql server.
`sudo apt install php8.4 php-cli php8.4-mysql` install php required version and mysql extention for php and one extention for php.  
`sudo systemctl status mysqld` verify servise status.  
if mysql server is not active run `sudo systemctl start mysql`  

### Linux RHEL/Fedora
`sudo dnf update` update your system  
Go to the official MySQL Yum Repository page fro instaing mysql 8.4 version:  
https://dev.mysql.com/downloads/repo/yum/  
Select your platform (e.g., "Red Hat Enterprise Linux 9 / Oracle Linux 9" for RHEL 9, or "Fedora 42" for Fedora 42)  
Download the mysql84-community-release-elX-Y.noarch.rpm or mysql84-community-release-fcX-Y.noarch.rpm file.  
`sudo dnf install /path/to/downloaded-mysql84-repo-package.rpm` install repository  
`sudo dnf install mysql-community-server` install mysql server  
`sudo dnf install https://dl.fedoraproject.org/pub/epel/epel-release-latest-9.noarch.rpm` install epel repository (fedora).  
Or `sudo dnf install https://rpms.remirepo.net/enterprise/remi-release-9.rpm` install remi repository (for RHEL).  
`sudo dnf module enable php:remi-8.4` enable php stream from repository.  
`sudo dnf install php php-cli php-mysqlnd` install php8.4 and extention for mysql.  
`sudo systemctl status mysqld` verify servise status  
if mysql server is not active run `sudo systemctl start mysql`  

### MacOS
Before installing PHP, ensure you have the following:  
`xcode-select` install Homebrew: If not already installed, you can install it by  
following the instructions on the official Homebrew website.  
`brew tap shivammathur/php` tap the php version repository.
`brew install php@8.4` install php 8.4 version.  
`brew unlink php` Unlink any other default PHP version  
`brew link php@8.4` force  
`brew install mysql@8.4` install mysql 8.4 version  
`php -m | grep pdo_mysql` PHP installations via Homebrew typically include the  
necessary MySQL extensions (mysqli and pdo_mysql) enabled by default  
`brew services start mysql@8.4` start mysql

### Windows

Open Terminal as Administrator and type  
`winget install PHP.PHP.8.4` install php 8.4.  
Prerequisites. Ensure you have the Microsoft Visual C++ 2019 Redistributable  
Package installed. Download the Windows (x86, 64-bit) ZIP Archive  
(not the MSI Installer) from the official MySQL Downloads page.  
1. Extract the Archive  
Extract the downloaded ZIP file to your desired installation location, for example, C:\mysql.  
2. Create an Option File (Optional but Recommended) 
Create a text file named my.ini in your installation directory (C:\mysql).  
This file can be used to specify server options. A minimal file might look like this:  
```
[mysqld]
# set basedir to your installation path
basedir=C:/mysql
# set datadir to the location of your data directory
datadir=C:/mysql/data
```
3. Initialize the Data Directory  
Open a Command Prompt or PowerShell window as an administrator  
and run the following command to initialize the data directory  
`C:\mysql\bin\mysqld --initialize`  
The server will generate an initial root password and print it to the console.  
Make sure to save this temporary password.  
Steps to Enable MySQL Extensions  
Download PHP 8.4: Get the appropriate zip file (e.g., Thread Safe x64 for Apache/Nginx)  
from the official PHP download page.  
Locate php.ini: Find your php.ini file (often in the PHP installation directory or C:\Windows).  
Enable Extensions: Open php.ini and uncomment (remove the semicolon ;) these lines:  
```
extension=mysqli
extension=pdo_mysql
```
Restart Web Server: Restart Apache or Nginx for changes to take effect.  
Verify: Create a phpinfo() file to confirm mysqli and PDO_MySQL are listed as enabled.  
`NET START mysql` start mysql server  

To install libraries need install composer. For it need next steps:  
### Windows
Install PHP: Ensure PHP is installed and in your system's PATH.  
Download Installer: Go to the official Composer download page and download Composer-Setup.exe.  
Run Installer: Open the .exe file and follow the setup wizard, pointing it to your PHP executable if prompted.  
Restart Terminal: Close and reopen your command prompt or PowerShell to refresh the PATH.  
Verify: Type `composer --version` to confirm installation.  

### Linux/MacOS
download and run installer by running command.  
`php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"`
`php composer-setup.php`
`php -r "unlink('composer-setup.php');"`
Move to PATH: Move the composer.phar file to a directory in your PATH (e.g., /usr/local/bin).  
`sudo mv composer.phar /usr/local/bin/composer`  
Verify: Type `composer --version` in a new terminal window  

Next step must be installing required libraries using composer in terminal or command prompt.  
`cd /path/to/your/project`  
run command `composer install`  
then need create db with name **dozvilliadb**  
you need chenge in next file in root_directory/src/models/database.php  
propertity user to your database user, and change to your user`s password.  
then go to root_directory/src/models/ and run UsersTable.php using next command:  
`php UsersTable.php` it`s create local table in local database «dozvilliadb»,  
next run itemsTable.php using command `php itemsTable.php`

To run webiste type in terminal in root folder `php -S localhost:8000 -t public/`  
and go in browser to  localhost:8000