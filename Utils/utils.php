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
 *     > print getVariableName($test);
 *
 * //Output:
 *     > test
 *
 * @param [string] $var
 * @return [string] $varName <> Returns the variable name
 ***************************************************************************/
        function getVariableName($var) {
            foreach($GLOBALS as $varName => $value) {
                if ($value === $var) {
                    return $varName;
                }
            }
            return;
        }// end function
  

/**
 * GENERATE a random TOKEN
 *
 * Based on a secret Kez we generate a token 
 *
 * //usage
 *   $myRandomString = generateRandomString(5);
 *   $myRandomString = generateRandomString(5, "aqwerdfgyuhjlo512397sdfmncvl48"); 
 *
 * @param integer $length  Specify the size of the token
 * @return string $randomString  The token generated
 ***************************************************************************/
        function generateToken( $length = 25,
                                $secretKey = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
        
            $secretKeyLength = strlen($secretKey);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $secretKey[rand(0, $secretKeyLength - 1)];
            }
            return $randomString;
        }


