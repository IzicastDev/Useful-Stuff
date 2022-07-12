<?php 

/***************************************************************************
*  UTILS
* 
* Utils functions we can use in any projects to help us develop.
*
***************************************************************************/

/**
 * 
 * CONSTANT
 * STRING MAXIMUM CHARACTERES SIZE
 *
 * Some function in PHP are limited to 1024 caracteres. 
 * If a string is bigger them this, it will not analyse the rest.
 * Is important to analise the character size when user input or from DB
 *******************************************************************************************************************************/
      define("STRING_MAX_CHAR", 1000);
      
      
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

/**
 * SHOW X CARACTERES
 *
 * Imagine a string is 200 cHaracteres
 * And we want to return just 50 charateres.
 *      __ss($string, 50);
***************************************************************************/
    function _s( $string, $length=50){  
        // MAX chars 1000
        if( $length >= STRING_MAX_CHAR ){
          $length = STRING_MAX_CHAR;
        }
        if(mb_strlen($string) > $length){
          echo mb_substr($string, 0, $length, 'UTF-8') . "<small>(...)</small>";
        } else {
          echo mb_substr($string, 0, $length, 'UTF-8');
        }
    }
        
      


/**
 * Debug function with VAR_DUMP
 *
 * @param string $msg
 * @param [type] $value
 * @param integer $exit
 * @return void
 *******************************************************************************************************************************/
        function _dv($msg = "Value", $value="", $exit = 0){
            echo '<h4 style="color: red">' . $msg . ": ". "</h4><pre>";
              var_dump($value);
            echo '</pre><p style="color: red"">* end *<p>';
            if ($exit) {exit;}
        }


/**
 * DEBUG with PRINT_R with BOOT STRAP ALERT
 *
 * @param string $msg   - The message to show. Normally is the variable name
 * @param [type] $value - the variable to show
 * @param integer $exit - enter "1" if you pretend to stop the code execution
 * @return void
 *******************************************************************************************************************************/
        function _dp($msg = "Value", $value="", $exit = 0){
            echo '<div class="alert alert-warning" role="alert">' . $msg . ": ". "<pre>";
              print_r($value);
            echo '</pre><p style="color: red"">* end *<p></div>';
            
            if ($exit) {exit;}
        }



/**
* ESCAPE the data 
*
* We should use it to show any data from PHP.
* Never use echo without sanitizing the data.
* will produce:
*
* HTML 5 (recognizes "all" valid character entities):
* ampersand(&), double quote("), single quote('), less than(<), greater than(>), numeric entities(&"'<>), HTML 5 entities(+,!$(ņ€)
*
* @param [string] $msg - the string to show
* @return string the sanitized string
*************************************************************************************************************************/
          function __($msg){
                echo htmlspecialchars( $msg, ENT_NOQUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8', /*double_encode*/false );
          }




/**
 * OPEN JSON FILE
 *
 * It will return an assoc array like this:
 * JSON file: :
 *         Array
 *         (
 *             [1] => Array
 *                 (
 *                     [photoName] => card_DayOneMorning01
 *                     [vimeoEventnumber] => 707451759
 *                     [categorie] => Session 1
 *                     [date] => 2022-05-04T22:00:00.000Z
 *                     [title] => Jeudi - Matin 01
 *                     [author] => 
 *                     [btnLink] => video01
 *                     [description] => -
 *                     [cardMaxDescriptionChars] => 0
 *                 )
 *         
 *             [02] => Array
 *                 (
 *                     [photoName] => card_DayOneMorning02
 *                     [vimeoEventnumber] => 707451817
 *                     [categorie] => Session 1
 *                     [date] => 2022-05-04T22:00:00.000Z
 *                     [title] => Jeudi - Matin 02
 *                     [author] => 
 *                     [btnLink] => video02
 *                     [description] => -
 *                     [cardMaxDescriptionChars] => 0
 *                 )
 *         )
 *
 *--------------------------------------------
 *
 *  To show the value: echo "<br> Value: " . $archive["DayOneMorning01"]["photoName"] . "<br>";
 * 
 *+++++++++++++++++++++++++++++++++++++++++***
 * @param string $file - filename with path
 * @return json file
 */
        function openJsonFile($file){
          //file_get_contents($file, FILE_USE_INCLUDE_PATH);
          return json_decode(file_get_contents($file, FILE_USE_INCLUDE_PATH), true);
        }