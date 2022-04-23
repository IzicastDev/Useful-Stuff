<?php 

/***************************************************************************
*  UTILS
* 
* Utils functions we can use in any projects to help us develop.
*
***************************************************************************/


// Function that returns the variable name
/**
 * RETURNS VARIABLE NAME
 *
 * Function that returns the variable name
 *
 * Example:
 *
 * // Declare and initialize a variable
 *     > $test = "This is a string";
 *
 * // Function call and display the
 * // variable name
 *     > print getVariavleName($test);
 *
 * //Output:
 *     > test
 *
 * @param [string] $var
 * @return [string] $varName <> Returns the variable name
 ***************************************************************************/
    function getVariavleName($var) {
        foreach($GLOBALS as $varName => $value) {
            if ($value === $var) {
                return $varName;
            }
        }
        return;
    }// end function
  
