# Gestaltungsprinzipien sicherer Softwareentwicklung: prototypische Entwicklung eines Lernspiels

## Clone Project and install required modules
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

## .env
copy the .env.example file and rename it to .env

## Start Project:
```
vendor/bin/sail up -d
npm run dev
```

## Stop Project
```
Ctrl + c
vendor/bin/sail down
```