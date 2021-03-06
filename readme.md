<p align="center"><img src="https://raw.githubusercontent.com/infinitypaul/carcrash/master/public/clogo.png" /></p>
<p align="center">Get information about crash test ratings for vehicles. .</p>
<p align="center"><a href="#">Creator</a> | I Craft Ideas Into Realities</p>

<p>&nbsp;</p>

## Download Instruction

> Application Requirements
* PHP >= 7.1.3
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension

1. Clone the project.

```
git clone https://github.com/infinitypaul/carcrash.git projectname
```

2. Install dependencies via composer.

```
composer install 
```

4. Run php server.

```
php artisan serve
```

<p>&nbsp;</p>

> You can also install the Application via Docker:

## Pre-requisites

- Docker running on the host machine.
- Docker compose running on the host machine.

1. Clone the project.

```
git clone https://github.com/infinitypaul/carcrash.git projectname
```

2. Run the testrig.sh file on the Project Root Folder on your terminal/Command Prompt, This script does everything you need to run your this project. It starts up the servers, ensures the database is booted, installs dependencies. These services are exposed to your computer on the standard ports, then you can access your website on http:localhost

## Troubleshooting

- Port number might be already in use, change from `80` to another number in your `docker-compose.yml` file.
- If you have any other issues, [report them](https://github.com/infinitypaul/carcrash/issues).

Enjoy!


## Api Usage

> Using Get Request:

```
GET http://localhost/vehicles/<MODEL YEAR>/<MANUFACTURER>/<MODEL>?withRating=true
```

> Using Post Request:

```
POST http://localhost/vehicles
```

Where:
* http://localhost/ is your Base Url, You Can Replace it with yours
* MODEL YEAR, MANUFACTURER and MODEL are variables that are used when calling the NHTSA API. Example values for these are:
* MODEL YEAR: 2015  MANUFACTURER: Audi  MODEL: A3

### License

The  Find Your Service App is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)



