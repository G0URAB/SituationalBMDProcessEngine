# Installation Requirements
- PHP version >= 7.2
- Composer (Its a dependency management software for php)
- Symfony version >= 4.4

## Installation in Windows 10
#### 1. Install PHP ([Video Guidance](https://www.youtube.com/watch?v=iW0B9NTId2g))
  - Ignore if PHP is already installed
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
  - Ignore if composer is already installed.
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
#### 3. Install Symfony
   - Run command `wget https://get.symfony.com/cli/installer -O - | bash`
   - Then move the symfony binary to global bin folder, with the command `sudo mv /home/{your_username}/.symfony/bin/symfony /usr/local/bin/symfony`.
#### 4. Project Setup
 - Download the project as zip file from https://github.com/G0URAB/LightWeightEngine and extract it.
 - Go inside the folder and open a command prompt and type the command `composer install --no-scripts`
 - Next, run the command `symfony server:ca:install` to enable TLS for the server.
 - Finally, the app can be started by running the server with the command `symfony server:start`. The app can be stopped, by typing CTRL+C and `symfony server:stop`.
 - The app can be opened with the route of 127.0.0.1:8000 in any web browser.

 
