# Task Manager
> Short description of used commands and concepts:

### Foreach
* This command goes through all indexes of an array variable. It assigns each index to a temporary variable.

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
