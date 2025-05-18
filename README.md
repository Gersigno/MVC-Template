# MVC Template
A lightweight, docker ready **M**odel **V**iew **C**ontroller *(MVC)* template using PHP 8.4 (Apache).

![Static Badge](https://img.shields.io/badge/PHP-8.4-%23777BB4.svg?style=plastic&logo=php&logoColor=white)
![Static Badge](https://img.shields.io/badge/Docker-Compose-%232496ED.svg?style=plastic&logo=docker&logoColor=white)

## 🧩 Features

- **CSRF** Token
- **Auto-loader**
- Fully automated **router**
- **View rendering** engine with data injection
- **Config file** to easely change the project behavor
- CSS **Light/Dark** mode linked to **system color scheme**
- Exemple **API controller** *(with exemple json data/fetchs in js)*

## 🧰 Pre-Requisites 

- Some PHP/OOP Concept
- Docker & Docker compose *(Docker compose is now integrated to docker)*
- WSL 2 **for Windows users only**

## 🐋 Build the docker container

```powershell
docker-compose up -d
```

You are now ready to go !

## 📋Naming convention *(For controllers & Views)*

- Your **controller/view** names **NEED** to begin with a capital letter and end with the word **`View`** or **`Controller`**
    - For exemple, a view and a controller for your "home" page should be named **`HomeView`** and **`HomeController`**

## 🤖 Router's documentation

### Quick summarize

- **Controller Resolution**
    - The first URL segment *(e.g., `/home`)* is used to determine **which controller** to use for the page, in this case, `HomeController`

- **Method invocation**
    - The second segment of the URL, if it exists, is used as the method to invoke, for example, `/home/test` will call the `test` method of the `HomeController` *(if it exists)*.
    - Any remaining URL segments *(if any exists)* will be passed as arguments to the invoked method.

### Exemple

For the url http://localhost/template/testFunction/arg1/arg2<br>
The router will instanciate the [template controller](https://github.com/Gersigno/MVC-Template/blob/main/src/controllers/TemplateController.php) *(first url segment)*, which will create our [template view](https://github.com/Gersigno/MVC-Template/blob/main/src/views/TemplateView.php).
The router will then call the [template controller](https://github.com/Gersigno/MVC-Template/blob/main/src/controllers/TemplateController.php)'s `testFunction` *(second url segment)* and pass `arg1` and `arg2` as function's arguments *(you can pass none or as many arguments as you want !)*

### How does it work *(deeper explainations)*
- Our `.htaccess` file *(located in our `/public` directory)* will rewrite our current url to our entry file *(which is `public/index.php`)* and will pass all our url segments as an url parameter.
    - So the url `http://localhost/`**`home/test/arg`** will became `http://localhost/`**`index.php?p=/home/test/arg`**.
- Our entry file *(index.php)* will then instanciate our **Router** which will parse our url parameter `p` as described in the Quick summarize.

## 📦 Auto-loader documentation
To include other directory to the autoloder, you cn simply add theme to the `$directory` array of the `src/core/Autoloader.php` file.

```php
$directory = array(
    'core/', 
    'models/', 
    'controllers/'
);
```

## 🧼 Todo/Improvements
- Use namespaces and PSR-4 autoloading
- Add flash messaging or error reporting to views
- Integrate unit tests
- More secured API ?

## 🧾 License
This project is licensed under the [MIT License](./LICENSE.md) © 2025 Gersigno.