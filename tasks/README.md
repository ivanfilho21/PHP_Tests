# Task Manager
> Short description of commands, concepts and good practices used in "tasks.php".

### Foreach
This command goes through all indexes of an array variable. It assigns each index to a temporary variable.

### SuperGlobals
There are some global variables that can be accessed by any page, function, class, etc. in PHP. They are called "superglobals". $_GET and $_SESSION are two of the superglobals used in "tasks.php".

#### $_GET
* An array of variables passed to the current PHP script via the URL parameters.
#### $_SESSION
* An array of variables available to the current script. This uses cookies to store sessions.
##### Example:
```php
<?php
  session_start(); # This initializes the session array.
  
  ...
  
  # To assign values
  if (isset($_GET['task_name']))
  {
    $_SESSION['session'][] = $_GET['task_name']; # Session is assigned with the $_GET array values.
  }
?>
```

### Good practices:
For readability purposes, one should not use curly braces to open or close PHP commands when these codes are mixed with HTML markup codes.
> Example:
```php
...
<?php foreach ($array as $a) : ?>
  <h3><?php echo "Content: " . $a; ?></h3>
<?php endforeach; ?>
```
> Example of the same code with curly braces:
```php

...

<?php
  foreach ($array as $a) {
    echo "<h3>Content: {$a}</h3>";
  }
?>
```

## Author:
> Ivanfilho21
