# Gestaltungsprinzipien sicherer Softwareentwicklung: prototypische Entwicklung eines Lernspiels
## Local development environment
When developing on a Windows operating system, a **WSL2 (Windows Subsystem for Linux 2)** must be used.

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
- adjust the variables to the database with the access for the external database or use the database dump for the use of a local database.

### Start Project:
start docker container
```
vendor/bin/sail up -d
```
start the application with hot reload
```
npm run dev
```

### Stop Project:
```
Ctrl + c
vendor/bin/sail down
```

## Use of the server:
1. Log in to the server ei-dmz-vm-srv188.th-luebeck.de
```
ssh ee@ei-dmz-vm-srv188.th-luebeck.de
```
2. Tunnel port 8080 of the server to the localhost
```
ssh -L 8080:localhost:8080 ei-dmz-vm-srv188.th-luebeck.de
```
3. open http://localhost:8080/ to see the application

----------
## License:

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).