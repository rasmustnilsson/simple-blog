# Simple Blog

Built on symfony.

## Requrements

  * PHP 7.2+ (php-xml, php-mysql)
  * MySQL
  * Composer

## Project setup

```sh
$ git clone https://github.com/tachnik/simple-blog
$ cd simple-blog
$ composer install
```

## Database setup

#### With doctrine
1. change database url in .env to match MySQL settings
2. ```sh
    $ php bin/console doctrine:database:create
    $ php bin/console doctrine:migrations:migrate
    ```

#### With SQL

```sql
CREATE DATABASE blog;
CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, body VARCHAR(2048) NOT NULL, date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB;
CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, body VARCHAR(1024) NOT NULL, date DATETIME NOT NULL, hostid INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB;
```

#### Dummy posts and comments can be created with (posts and comments can also be created at /createPost and /post/{id} respectively):
```sql
INSERT INTO `post` (`id`, `title`, `body`, `date`) VALUES (NULL, [TITLE], [BODY], [DATE ex('2018-06-08 00:00:00'));
INSERT INTO `comment` (`id`, `username`, `body`, `date`, `hostid`) VALUES (NULL, [USERNAME], [BODY], [DATE ex('2018-06-08 00:00:00'), [ID_OF_PARENT_POST]);
```

## Run
default runs on localhost:8000

```sh
$ php bin/console server:run
```
