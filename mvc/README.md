# Model-View-Controller

MVC is a popular Design Pattern that separates the project into three main parts: Models, Views, and Controllers.
<br>
This folder contains PHP projects using the MVC architecture.

## How does it work?

A PHP project with the MVC architecture usually follows this structure:
1. Use mod_rewrite in .htaccess file to convert the website URL into a PHP variable.
1. A PHP script will handle this variable content and instantiate the correct controller and the correct action inside the controller. This script is the core of your MVC design.
1. The controller will manage everything that is necessary for that page to load correctly and then load the correct view.
1. The view will display the page content.

## Example

#### [Hello World](https://github.com/ivanfilho21/PHP_Tests/edit/master/mvc/hello-world)
