<?php
date_default_timezone_set ("America/Bahia");

echo "Hello World. Today is " . date('d/m/Y');
echo " and it's " . date('H:i:s');

echo "      . Test: " . date("H:i:s a") . " " . date("M");
echo "  end";

# y means short year:  19
# Y means full year: 2019
# m means month number. M means month name abbreviated.
# H means 24 hours format.
# i means minutes.
# Apparently it is OK to use double quotes in 'echo'.
# a will display am or pm.
# A will display AM or PM.