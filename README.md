# ArduBridge
ArduBridge is a lightweight RESTful backend that acts as a bridge between Arduino devices and data dashboards. It captures sensor input sent via HTTP requests, stores it in a database, and provides clean API endpoints for real-time visualization and analysis.

# Setup: Laravel on WSL + PostgreSQL

## Packages

```bash
sudo apt update
sudo apt install -y git unzip curl php php-cli php-mbstring php-xml php-curl php-zip php-intl php-bcmath php-pgsql
sudo apt install -y postgresql postgresql-contrib
# Composer
cd ~ && php -r "copy('https://getcomposer.org/installer','composer-setup.php');"
php composer-setup.php --install-dir=/usr/local/bin --filename=composer
rm composer-setup.php && composer --version
```

## Start Postgres & create DB/user

```bash
sudo service postgresql start
# Create role and DB
sudo -u postgres psql <<'SQL'
CREATE ROLE ardu LOGIN PASSWORD 'strongpassword';
CREATE DATABASE ardubridge OWNER ardu TEMPLATE template1;
ALTER DATABASE ardubridge SET timezone TO 'UTC';
SQL
```

## Edit .env

```
APP_NAME=ArduBridge
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=ardubridge
DB_USERNAME=ardu
DB_PASSWORD=strongpassword
```

# Running ArduBridge

```bash
php artisan migrate
php artisan serve --host=0.0.0.0 --port=8000
```
