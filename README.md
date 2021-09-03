# Situational BMD (Business Model Development) Process Engine

![alt text](https://github.com/G0URAB/SituationalBMDProcessEngine/blob/master/public/images/features.JPG)

> It is a web based application using which situation specific business models can be built for digital platforms. Currently, the application provides following features:
 - Method Base Management (Create/update method elements, BMD Graphs, method building blocks)
 - Utility to create and update situation specific BMD (Business Model Development) method / Process Model
 - A process engine to support enactment of any situation-specific BMD method
 - Acess control / security to restrict unauthorised usage

## Installation Requirements
- PHP version >= 7.2
- Composer (Its a dependency management software for php)
- Symfony version >= 4.4

## Installation in Windows 10
#### 1. Install PHP ([Video Guidance](https://www.youtube.com/watch?v=iW0B9NTId2g))
  - Go to https://windows.php.net/download#php-7.3 and download the zip file under **VC15 x64 Thread Safe**, or just click on this [link](https://windows.php.net/downloads/releases/php-7.3.29-Win32-VC15-x64.zip) download the zip.
  - Extract the zip and copy the content to a new folder called PHP7.3
  - Then move the PHP7.3 folder to c:/
  - Inside PHP7.3 folder, rename the file `php.ini-development` to **php.ini**.
  - Next, open this php.ini file with any text editor and search for a word `;extension_dir` (just below the line `;on windows`) and remove the `;` from `;extension_dir`. In php.ini, a `;` means a comment.
  - Next search, for two lines `extension=pdo_sqlite` and `extension=sqlite3` and make sure they are uncommented.
  - Next, go to `this pc` (your computer where you can see all your drives) and make a `right click > click propeties > click 'Advanced system settings' > click on 'Environment Variables`. In the top section, try to find a variable called **Path**.
   Click on **Path** and then click on `edit` and then click on `new`. Here type `c:/PHP7.3` which location of the php folder. Click "OK" all the way.
  - Restart computer and open a command prompt and type `php -v`. If everything was done right, then we can see a response with php version.
  - There might be an error called `vcruntime140.dll was not found`. In this case, go to https://www.microsoft.com/en-us/download/details.aspx?id=48145. Download and install the redist file
  based on your system type e.g 32 or 64 bit. If wrong type was installed, then the error will still persist. After installation, the `php -v` command will show a response.
  
#### 2. Install Composer ([Video Guidance](https://www.youtube.com/watch?v=HBDJsc2cXR4))
  - Download composer with this [link](https://getcomposer.org/Composer-Setup.exe).
  - Installation: a) Double click to install b) Ignore `Developer Mode` c) Make sure the path of php.exe is correct. In our case, it is `c:\PHP7.3\php.exe`
  d) Keep the `update this php.ini` box checked e) Ignore proxy settings f) Install
  - Open a command prompt and type `composer`. If a response is returned then composer was installed successfully.
  
#### 3. Symfony Installation
- Go to https://symfony.com/download and download and install the symfony.exe. 
- Make sure that during installation the `Add application directory to system path` box is checked. Otherwise symfony command will not be recognizable.
- If it prompts for `Symfony requires Git` then just ignore it. However if you are going to develop then it is assumed that Git is already installed on your system and hence this step can be ignored anyway. 

#### 4. Project Setup
 - Download the project as zip file from https://github.com/G0URAB/LightWeightEngine and extract it.
 - Go inside the folder and open a command prompt and type the command `composer install --no-scripts`
 - Next, run the command `symfony server:ca:install` to enable TLS for the server.
 - Finally, the app can be started by running the server with the command `symfony server:start`. The app can be stopped, by typing CTRL+C and `symfony server:stop`.
 - The app can be opened with the route of 127.0.0.1:8000 in any web browser.
 - Make sure to grant access if firewall prompts when symfony starts the application.
 - To load a bunch of test users, run command `php bin/console doctrine:fixtures:load --append --group=testUsers`. The default password for all test users is `abc123`.

## Installation in Ubuntu version >= 20.04
#### 1. Install PHP 
        - sudo apt-get update
        - sudo apt -y install software-properties-common
        - sudo add-apt-repository ppa:ondrej/php
        - sudo apt-get update
        - sudo apt -y install php7.3
        - To check if php was properly installed, run php -v
        - Next, open php.ini (/etc/php/7.3/cli/) and uncomment extension=pdo_sqlite, extension=sqlite3. Uncomment means remove ";" from the front of the line.
        - Next, install a missing extension called PHP-XML through "sudo apt-get install php7.3-xml"
        - Finally, install php's sqlite driver with command "sudo apt-get install php7.3-sqlite"
#### 2. Install Composer ([Helpful link](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-composer-on-ubuntu-18-04))
        - sudo apt update
        - cd ~
        - curl -sS https://getcomposer.org/installer -o composer-setup.php
        - copy the hash from this webpage: https://composer.github.io/pubkeys.html and paste in the terminal. An example,
          HASH=544e09ee996cdf60ece3804abc52599c22b1f40f4323403c44d44fdfdd586475ca9813a858088ffbc1f233e9b180f061. If any doubt, then refer the helpful link.
        - Now execute the following PHP script to verify that the installation script is safe to run:
          $ php -r "if (hash_file('SHA384', 'composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
        - You will see this output: "Installer verified". If you see "Installer corrupt", then you’ll need to redownload the installation script again and double check that you’re using the correct hash. Then run the command to verify the installer again. Once you have a verified installer, you can continue.
        - To install composer globally, use the following command which will download and install Composer as a system-wide command named composer, under /usr/local/bin:
          $ sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
        - You will see following output
          All settings correct for using Composer
          Downloading...

          Composer (version 1.6.5) successfully installed to: /usr/local/bin/composer
          Use it: php /usr/local/bin/composer
        - To test your installation, run:
          $ composer



#### 3. Install Symfony
   - Run command `wget https://get.symfony.com/cli/installer -O - | bash`
   - Then move the symfony binary to global bin folder, with the command `sudo mv /home/{your_username}/.symfony/bin/symfony /usr/local/bin/symfony`.
#### 4. Project Setup
 - Download the project as zip file from https://github.com/G0URAB/LightWeightEngine and extract it.
 - Go inside the folder and open a command prompt and type the command `composer install --no-scripts`
 - Next, run the command `symfony server:ca:install` to enable TLS for the server.
 - Finally, the app can be started by running the server with the command `symfony server:start`. The app can be stopped, by typing CTRL+C and `symfony server:stop`.
 - The app can be opened with the route of 127.0.0.1:8000 in any web browser.
 - To load a bunch of test users, run command `php bin/console doctrine:fixtures:load --append --group=testUsers`. The default password for all test users is `abc123`.

## Method Base Overview
![alt text](https://github.com/G0URAB/SituationalBMDProcessEngine/blob/master/public/images/MethodBaseComponentRelationships.JPG)
> Explanation coming soon!

## Roles & Access Control
> There are currently 4 roles e.g. Method Engineer, Project Manager, Team Member, Platform Owner. The "Super Admin" gets privileges of all the roles.

![alt text](https://github.com/G0URAB/SituationalBMDProcessEngine/blob/master/public/images/RoleHierarchy.JPG)

The prvileges of all roles are as follows:

1. Method Engineer Privileges
   - Manage method base
   - Create/view/update situational methods
2. Project Manager Priviledges
   - Start enactment of situational method (i.e assign/remove team members and tools on any task)
   - Add/Remove artifact from any task
   - Add comments on any task
3. Project Team Member Priviledges
   - Add/Remove artifact from the assigned tasks
   - Add comment on the assigned tasks
   - Change status of the assigned task (e.g. toDo, finished etc)
4. Platform Owner
   - View all the owned situational BMD methods
   - Inherit role as a **Project Team Member**

## Getting Started
   [![Watch the video](https://github.com/G0URAB/SituationalBMDProcessEngine/blob/master/public/images/video%20thumbnails/what_is_situational_bmd_process_engine.jpg)](https://www.youtube.com/watch?v=rbQ1sg5_a1I)
   
   [![Watch the video](https://github.com/G0URAB/SituationalBMDProcessEngine/blob/master/public/images/video%20thumbnails/software_overview.jpg)](https://www.youtube.com/watch?v=mL5jfK0sTI4)
   
   [![Watch the video](https://github.com/G0URAB/SituationalBMDProcessEngine/blob/master/public/images/video%20thumbnails/method_base_processes_and_types.jpg)](https://www.youtube.com/watch?v=rr9vgtZlJV8)
   
   [![Watch the video](https://github.com/G0URAB/SituationalBMDProcessEngine/blob/master/public/images/video%20thumbnails/method_base_roles_and_tools.jpg)](https://www.youtube.com/watch?v=cZ3jHc5ltPg)
   
## Test Users Details
> Command to create test users: `php bin/console doctrine:fixtures:load --append --group=testUsers`

| Name of member | email | password | Role |
| ------------- | ------------- | ------------- | ------------- |
| James Anderson  | james@anderson.com  | abc123  |  SUPER_ADMIN  |
| Saul Brown  | saul@brown.com  | abc123  |  PROJECT_MANAGER  |
| Alexander Belov  | alexander@belov.com  | abc123  |  PLATFORM_OWNER  |
| Walter White  | walter@white.com  | abc123  |  METHOD_ENGINEER |
| Peter Gates  | peter@gates.com  | abc123  |  WEB_DEVELOPER  |
| Adam Black | adam@black.com  | abc123  |  WEB_DEVELOPER  |
| Joyita Ambett  | joyita@ambett.com  | abc123  |  MARKETING_VP  |
| Jane Brown  | jane@brown.com  | abc123  |  MARKETING_MANAGER |
| Samir Baptist | samir@baptist.com  | abc123  |  MARKETING_EXECUTIVE  |
| Amanda Wilson  | amanda@wilson.com  | abc123  |  ROLE_SALES_VP  |
| Daniel Yeh  | daniel@yeh.com  | abc123  |  ROLE_SALES_MANAGER  |
| Xavier Selvan  | xavier@selvan.com  | abc123  |  ROLE_SALES_EXECUTIVE  |

 
