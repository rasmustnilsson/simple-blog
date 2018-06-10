# Simple Blog

Built on symfony.

## Requrements

  * PHP 7.2+ (php7.2-xml, php-mysql + common modules)
  * MySQL
  * Composer

## Project setup

```sh
$ git clone
$ cd simple-blog
$ composer require symfony/web-server-bundle --dev
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

#### Dummy posts and comments can be created by (posts can also be created at /createPost):
```sql
INSERT INTO `post` (`id`, `title`, `body`, `date`) VALUES (NULL, [TITLE], [BODY], [DATE ex('2018-06-08 00:00:00'));
INSERT INTO `comment` (`id`, `username`, `body`, `date`, `hostid`) VALUES (NULL, [USERNAME], [BODY], [DATE ex('2018-06-08 00:00:00'), [ID_OF_PARENT_POST]);
```
#### run server with php bin/console server:run
```sh
$ php bin/console server:run
```
