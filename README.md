# Gestaltungsprinzipien sicherer Softwareentwicklung: prototypische Entwicklung eines Lernspiels

## How to access the prototype:
1. Log in to the server ei-dmz-vm-srv188.th-luebeck.de and tunnel port 8080 of the server to the localhost
```
ssh -L 8080:localhost:8080 ee@ei-dmz-vm-srv188.th-luebeck.de
```

2. open http://localhost:8080/ to see the application

## Testuser
You can use the test user to log in or create your own new user
Email: test@test.de 
PW: Test!123?

----------
<details>
<summary>Local development environment</summary>
<br>
When developing on a Windows operating system, a WSL2 (Windows Subsystem for Linux 2) must be used.

### Clone Project and go to laravel project folder:
```
cd public/learning-app-prototype/
```

### Install required modules:
laravel vendor:
```
docker run --rm \
--pull=always \
-v "$(pwd)":/opt \
-w /opt \
-u 1000 \
laravelsail/php83-composer:latest \
bash -c "composer install"
```

node modules:
```
npm install
```

#### .env
- use .env.example file as template
- adjust the variables to the database with the access for the external database **or** use the database dump for the use of a local database


### Start Project:
start docker container
```
vendor/bin/sail up -d
```
start the application with hot reload
```
npm run dev
```

The project is now running at http://localhost/
The database can be viewed via Adminer at http://localhost:8080/

##### Only if you want to use a local database:
To set up the Loakle database, the migrations must be executed, then the database dump can be inserted
```
vendor/bin/sail migrate
```
You can find the databse dump here: public/learning-app-prototype/database/20240728_databasedump.sql

### Stop Project:
```
Ctrl + c
vendor/bin/sail down
```
</details>