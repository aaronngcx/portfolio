- Made with Laravel, React and Ant Design
- JWT Authentication
- Single Page Application
- Modern and Responsive Design
- Multiple Templates
- Theme Color Customization
- Custom Scripting
- Visitor Tracking
- Location Tracking
- Google Analytics
- Maintenance Mode
- Contact Form
- Search Engine Optimization
- Section Visibility

## Installation

### With Docker
- Run ```cp .env.example .env```.
- Run the below command to install Composer dependencies:
    ```sh
    docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v $(pwd):/var/www/html \
        -w /var/www/html \
        laravelsail/php81-composer:latest \
        composer install --ignore-platform-reqs
    ```
- Run ```./vendor/bin/sail up -d```.
- Run ```./vendor/bin/sail artisan migrate --seed```. If you face error `Connection refused`, set `DB_HOST=mysql` in .env file.
- Run ```./vendor/bin/sail npm install```.
- Run ```./vendor/bin/sail npm run prod``` or ```./vendor/bin/sail npm run watch```.

`sail` is equivalent of `docker-compose`, read [`laravel/sail`](https://laravel.com/docs/8.x/sail) doc.


### Without Docker

- Run ```cp .env.example .env```
- Run ```composer install```
- Provide db name, username and password in .env
- Run ```php artisan migrate --seed```
- Run ```npm install```
- Run ```npm run prod``` or ```npm run watch```

Admin credentials:

```
Email: admin@admin.com
Password: 12345
```
