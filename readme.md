# eLockbox

A data management system based on PHP, Laravel5 framework, and MySQL. Developed by USC CSCI577 2016Fall Team10.

This instruction will be organized by following parts.

* [Install on local machine](#install-on-local-machine)
* [Install on server](#install-on-server)
* [Maintain the server](#maintain-the-server)
* [Uninstall](#uninstall)
* [Reinstall](#reinstall)
* [Useful command](#useful-command)
* [Authors](#authors)


## Install on Local Machine

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

These are the prerequisites for installing on local machine, if your machine do not satisfy these prerequisites or you want to install this project on server, please follow the [Install on Server](#install-on-server), there will be a detailed instructions including environment settings and project deploying.

#### Environment
* PHP ≥ 5.6.4
* Apache Server
* MySQL

#### Command Line Tools
* composer
* git

### Installing

###### 1. Clone the repository to the local.
```bash
$ git clone https://github.com/Phantomato/elockbox.git
$ cd elockbox
```

###### 2. Under the directory, then install.
```bash
$ composer install
```

###### 3. Change file '.env.example' to '.env', and create database according to the file '.env'. Basically you need to set up the database name, username and password.

###### 4. Generate a new key.
```bash
$ php artisan key:generate
```

###### 5. Migrate the database.
```bash
$ php artisan migrate
```

###### 6. Seed the initial data into the database.
```bash
$ composer dump-autoload
$ php artisan db:seed
```

###### 7. Try to run this project in browser. Use `/public/debug/create` to create the first user. Have fun :)

### Notice
If your localhost cannot handle the requests, please try to do `$ chmod -R 777 Your/local/repository/path`.

## Install on Server

These instructions will get you a copy of the project up and running on the server. The instructions based on ubuntu os.

### Installing LAMP on Ubuntu 16.04 LTS

#### 1. Installing and configuring Apache Server

Update `apt-get` and install `apache2`.

```bash
$ sudo apt-get update
$ sudo apt-get install apache2
```
Edit `apache2.conf`
```bash
$ sudo nano /etc/apache2/apache2.conf
```
Add ServerName at the bottom of the file.

> . . .

> ServerName server_domain_or_IP

Restart the Apache to implement the changes.
```bash
$ sudo systemctl restart apache2
```
Now you can test by your browser by visit `http://your_server_IP_address`.

#### 2. Installing and configuring MySQL

Install MySQL.
```bash
$ sudo apt-get install mysql-server
```
During the installation, you will be asked to set the password for MySQL root user.
Keep this password secure and do not forget.
```bash
$ sudo mysql_secure_installation
```
You will be asked to config security level of MySQL.

#### 3. Installing and configuring PHP

Install PHP and some tools.
```bash
$ sudo apt-get install php libapache2-mod-php php-mcrypt php-mysql
```
Then edit the priority of index.
```bash
$ sudo nano /etc/apache2/mods-enabled/dir.conf
```
It will look like this:
```
<IfModule mod_dir.c>
    DirectoryIndex index.html index.cgi index.pl index.php index.xhmtl index.htm
</IfModule>
```
Move index.php to the first, like this:
```
<IfModule mod_dir.c>
    DirectoryIndex index.php index.html index.cgi index.pl index.xhmtl index.htm
</IfModule>
```
Then you can use `$ sudo apt-get install` install some PHP modules.
Suggest to install `php-cli`, `php-curl`, `php-gd`, `php-pear`, `php-imagick`, `php-memcache`, `php-json`, `php-xmlrpc` and `php-mbstring`.

After these steps, you can test your php by `$ sudo nano /var/www/html/info.php` and write `<?php phpinfo(); ?>` in it.

#### 4. Installing composer, git and some basic command line tools.

Install curl and composer.
```bash
$ sudo apt install curl
$ sudo curl -sS https://getcomposer.org/installer | php
$ sudo mv composer.phar /usr/local/bin/composer
$ sudo chmod +x /usr/local/bin/composer
```

Then you can follow the [installing instructions](#installing).

Now you finish the installation. Visit `/elockboxDEV/public` to see the project and use `/elockboxDEV/public/debug/create` to create the first user.

## Maintain the Server

### Check log files

The log file named laravel.log is under /storage/logs directory. The log is self-describable.

The following action will be logged.
* Login the system.
* Logout the system.
* Create/Activate/Inactivate an account.
* Create/Activate/Inactivate/Edit a case.

In order to make log files readable, the maintainer should periodically backup and rename the old log files. There is no need to create laravel.log again. The system will generate a new log file. Recommend the following step:

```bash
$ sudo mv laravel.log laravel.log.bak1
```

This command will rename the file as laravel.log.bak1. You can add time in the file name if necessary.

### Uploaded documents

The uploaded documents is under public/uploads/case directory. Each subdirectory is named after case id.

## Uninstall
To uninstall, simply delete the project directory by using following command.
```bash
$ rm -r ProjectRootDirectory
```
If you want to delete your database as well, please read [Useful Command](#useful-command)

## Reinstall
To reinstall, simply [uninstall](#uninstall) the system, and then install it on [server](#install-on-server) or on [local](#install-on-local-machine).

## Useful Command

* Log into mysql as root with password
```bash
$ mysql -r root -p
```

* Create database named YOURDATABASE
```bash
create database YOURDATABASE;
```

* Delete database named YOURDATABASE
```bash
drop database YOURDATABASE;
```



## Authors

This project is developed by USC CSCI577 2016fall team10. For more team information, please check [Team Website](http://greenbay.usc.edu/csci577/fall2016/projects/team10/). For more class information, please check [Class Website](http://greenbay.usc.edu/csci577/spring2017/).
