Certainly, here's your translated paragraph in English:

## Project Setup
The project is developed with "Laravel 10". Depending on the operating system you're using, I hope you'll find the setup guide below.

Regardless of the operating system, you should create a .env file:
```shell
cp .env.example .env
```

### Docker (Recommended)
If you're using Docker, it will be much easier for you to test the project. All the extensions and software have already been packaged into an image. You can complete the installation by following the steps below:
* Since it's the recommended method, in the .env file, simply changing to `DB_PASSWORD=root` is sufficient.
* Lastly, you should start the project:
```shell
docker-compose up -d
```
**Note**: Downloading image files might take some time depending on your internet speed. If you see the `ERR_EMPTY_RESPONSE` error in the browser, please wait a few more minutes.

### Windows
Testing the project on the Windows operating system might be somewhat time-consuming. Please follow the steps below:
* First, you should install `php` on your device. XAMPP is recommended for the WAMP (Windows, Apache, MySQL, PHP) stack. [From this link](https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/8.1.17/xampp-windows-x64-8.1.17-0-VS16-installer.exe), install XAMPP on your device. This will automatically install PHP version 8.1.17 on your computer. If there's a problem, detailed information is available [here](https://www.apachefriends.org/download.html).
* To download the dependencies of the Laravel project, you must have `composer` on your computer. [From this link](https://getcomposer.org/Composer-Setup.exe), you can install the composer package manager on your device.
  If the program asks you to restart your device, please do so.
```shell
composer -v
```
* With the command above, you can ensure both `php` and `composer` were successfully installed. If you see the composer logo in the terminal, everything has been installed.
  If you get the error `'composer' is not recognized as an internal or external command`, try closing and reopening your terminal. If the error persists, search for `edit the system environment variables` in the Windows search panel, and add both `php` and `composer` there. Detailed information is available [here](https://dinocajic.medium.com/add-xampp-php-to-environment-variables-in-windows-10-af20a765b0ce).
* Enter the database details in the `.env` file.
* Activate the necessary extensions. For Laravel to work properly, some extensions need to be active. You can see the list [here](https://laravel.com/docs/10.x/deployment#server-requirements). Follow the steps below:
    * Open the `php.ini` file in the notepad text editor.
  ```shell
  notepad C:\xampp\php\php.ini
  ```
    * Uncomment the following extensions (remove the semicolon (;) in front of them):
        * bz2
        * curl
        * fileinfo
        * gd2
        * gettext
        * mbstring
        * exif
        * mysqli
        * pdo_mysql
        * soap
* Start the development server:
  ```shell
  php artisan serve
  ```

If you get the `'php' is not recognized as an internal or external command` error, try closing and reopening your terminal. If the error persists, search for `edit the system environment variables` in the Windows search panel, and add both `php` and `composer` there. Detailed information is available [here](https://dinocajic.medium.com/add-xampp-php-to-environment-variables-in-windows-10-af20a765b0ce).

### UNIX(Linux)
#### For Debian-based operating systems (Debian, Ubuntu, Pop!_OS, SparkyLinux, Kali Linux):
* Enter the database details in the `.env` file.
* Install `php` and its helper software:
```shell 
sudo apt install python-software-properties
sudo add-apt-repository ppa:ondrej/php
sudo apt-get update
sudo apt-get install -y git curl libpng-dev libonig-dev libxml2-dev zip unzip wget zlib1g-dev libicu-dev nano php8.1 php8.1-mcrypt php8.1-gd php8.1-mbstring php8.1-xml php8.1-mysql php8.1-json php8.1-tokenizer php8.1-zip
``` 
* Install `composer`:
```shell 
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
sudo chmod +x /usr/local/bin/composer
``` 
* Activate the necessary extensions. The list of extensions is mentioned above.

```shell 
  sudo nano /etc/php/8.1/apache2/php.ini
``` 
* Start the development server:
```shell 
  php artisan serve
  ```

#### Visit the web page: http://localhost:8000/. If you get a 404 error, don't worry. Access to the `/` endpoint has been restricted.
