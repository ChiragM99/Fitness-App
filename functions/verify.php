<?php
//Escape function to verify data that goes through the database. Takes a string.
function escape($string) {
    return htmlentities($string, ENT_QUOTES,'UTF-8');
}
