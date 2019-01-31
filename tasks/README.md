# Task Manager
> A very simple PHP script I made to learn some basic commands, concepts ands good practices.

## What I learned:
1. Basic Commands.
1. Concepts.
1. Good Practices.

### Basic Commands
* <strong>For:</strong>
> This command loops a block of code **n** times. It can be used to iterate through the contents of an array variable.
* <strong>Foreach:</strong>
> This command goes through all indexes of an array variable. It assigns each index to a temporary variable.

#### Examples with For:
> Looping a block of code 5 times.
```php
<?php
  for ($i = 0; $i < 5; $i++)
  {
    echo ($i + 1) . "  ";
  }
  # Output =>  1  2  3  4  5
?>
```
> Going through all positions of an array.
```php
<?php
  $names = array("Ivan", "Ricardo", "Daniela", "Toninho");
  $size = count($names);
  
  echo "Names: ";
  for ($i = 0; $i < $size; $i++)
  {
    if ($i < $size - 1)
      echo $names[$i] . ",  ";
    else
      echo "and {$names[$i]}.";
  }
  # Output =>  Names: Ivan, Ricardo, Daniela, and Toninho.
?>
```
### Concepts
* SuperGlobals
> There are some global variables that can be accessed by any page, function, class, etc. in PHP. They are called "superglobals". $_GET and $_SESSION are two of the superglobals used in "tasks.php".
* $_GET
> An array of variables passed to the current PHP script via the URL parameters.
* $_SESSION
> An array of variables available to the current script. This uses cookies to store sessions.

#### Example:
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

### Author:
> Ivan Filho
