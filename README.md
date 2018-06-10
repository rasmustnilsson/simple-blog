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
CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, parent_post_id INT DEFAULT NULL, username VARCHAR(255) NOT NULL, body VARCHAR(1024) NOT NULL, date DATETIME NOT NULL, INDEX IDX_9474526C39C1776A (parent_post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB;
ALTER TABLE comment ADD CONSTRAINT FK_9474526C39C1776A FOREIGN KEY (parent_post_id) REFERENCES post (id);
```

#### Dummy posts and comments can be created with (posts and comments can also be created at /createPost and /post/{id} respectively):
```sql
INSERT INTO `post` (`id`, `title`, `body`, `date`) VALUES (NULL, [TITLE], [BODY], [DATE (ex '2018-06-08 00:00:00'));
INSERT INTO `comment` (`id`, `username`, `body`, `date`, `parent_post_id`) VALUES (NULL, [USERNAME], [BODY], [DATE (ex '2018-06-08 00:00:00'), [ID_OF_PARENT_POST]);
```

## Run
default server runs on localhost:8000

```sh
$ php bin/console server:run
```
