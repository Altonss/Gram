## Install Gram

Gram is build on Laravel and very easy to install. You do need the following:

- PHP 8.1.x
- MySQL / SQLLite
- Nginx or Apache webserver
- Composer
- Node 16.x or up


## Setup

Start with cloning the repo to your server:

`git clone https://github.com/mstdn/Gram.git`



Install the composer dependencies:

`cd goldfish && composer install`


Copy the example .env and fillout your details like URL, database, email:

`cp .env.example .env`

`nano .env`


One time only, you need to generate the secret APP_KEY:

`php artisan key:generate`


One time only, the storage/ directory must be linked to the application:

`php artisan storage:link`


Database migrations must be run:

`php artisan migrate --force`



Compile the app with Node:

`npm run build`




After that setup a webserver (apache or nginx) and browse to your new platform!

## Admin

Not yet!
