# Blank Docker Project

A blank docker project using PHP7.3, MySQL and NginX

## Startup

Run `docker-compose up --build`

Navigate to `localhost:88`

Database name is `tech-test` which can be changed in `docker-compose.yml` on line 46. 
It will then also need to be changed in `.env` which _has_ been committed on purpose for
speed of development.

NginX is setup so that all calls will go to `public/index.php`