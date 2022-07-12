<?php 

class Validator {

  // LIMITS
  private $maxStringLength = 1024; // Charateres

  private $data = [];
  private $errors = [];
  
  // Fields in this form
  private static $fields = ['username', 'email', 'valueint', 'range', 'str', 'date'];
  
  // Good Caracteres allowed on a string
  private $allowedChars =[
              'à', 'á', 'â', 'ä', 'æ', 'ã', 'å', 'ā', 
              'ç', 'ć', 'č', 
              'è', 'é', 'ê', 'ë', 'ē', 'ė', 'ę',
              'î', 'ï', 'í', 'ī', 'į', 'ì',
              'ñ', 'ń',
              'ô', 'ö', 'ò', 'ó', 'œ', 'ø', 'ō', 'õ',
              'ß', 'ś', 'š',
              'û', 'ü', 'ù', 'ú', 'ū',
              'ž', 'ź', 'ż',
              ' ', '-', "'", ',', '.', ';', ':', '!', '?', 
              '@', '%', '(', ')', '+', '/', '\\', '=', '_',
              '$', '£', '€', '@'
  ];

/**
 * FOR TEST PROPOSES ONLY
 ***************************************************************************/
  private $badRequest = [ 
          "'ampersand(&amp;), double quote(&quot;), single quote(&apos;), less than(&lt;), greater than(&gt;), numeric entities(&#x26;&#x22;&#x27;&#x3C;&#x3E;), HTML 5 entities(&plus;&comma;&excl;&dollar;&lpar;&ncedil;&euro;)'",
          "POST /user?id=1",
          "password=\"abc\";--",
          "../../../etc/passwd",
          "script>alert(0);</script",
          "“ onblur=javascript:alert(0) “ or “>",
          "123); alert(0);",
          "onblur=javascript:alert(0)",
          "",
          "",
    ];


/**
 * CONSTRUCT
 *
 * @param [array] $post_data accepts the $_POST array
 ***************************************************************************/
    public function __construct($post_data){
          $this->data = $post_data;
          
          
         /*  echo "<pre> POST: ".print_r($post_data)."</pre> <br>";
          echo "<pre> data: ".print_r($this->data)."</pre> <br>";
          echo "<pre> fields: ".print_r(self::$fields)."</pre> <br>";
          die(); */
      
    }



/**
 *  VALIDATE FORM
 *  Validates the fields in the form
 *
 * @return void
 ***************************************************************************/
  public function validateForm(){
      // need to check if the size of the POSt array is the same 
      //of the fields allowed  
      
      
      // check if the field exists
        foreach(self::$fields as $field){
            if(!array_key_exists($field, $this->data)){
              trigger_error("'$field' is not present in the data");
              return;
            }
        }
        
        // Validate each field
        $this->validateUsername($this->data['username'], "username");
        $this->validateEmail($this->data['email']);
        $this->validateInteger($this->data['valueint']);
        $this->validateIntRange($this->data['range'], 10, 20);
        $this->whiteListString($this->data['str'], $this->allowedChars);
        $this->validateDate($this->data['date']);
        return $this->errors;

  }//end function



/**
 * VALIDATE USERNAME
 * 
 * user name needs to be:
 *              - between 6-12 characters
 *              - Can only start with a letter
 *              - can only end with a letter or number
 *              - the underscore(_) is allowed 
 *
 * @param string $val - Enter username to validate
 * @param string $fieldname - We need the field name to return the error of that specific field
 * @return void
 ***************************************************************************/
  private function validateUsername($val, $fieldname, $min=6, $max=30){
        
        $val = trim($val);
        
        if(empty($val)){
          $this->addError($fieldname, 'username cannot be empty');
        } else {
          if(!preg_match('/^[a-zA-Z][0-9a-zA-Z_]{' .$min.','.$max.'}[0-9a-zA-Z]$/', $val)){
            $this->addError($fieldname,'username must be '.$min.'-'.$max.' chars & alphanumeric & _');
          }
        }     
  } // end function



/**
 * VALIDATE EMAIL
 *
 * @return void
 ***************************************************************************/
  private function validateEmail($email){

        $val = trim($email);
        $charSize = 255;
    
        if(empty($email)){
            $this->addError('email', 'email cannot be empty');
        } elseif( $this->validateStrLength($email) ){
            $this->addError('email', 'email size is to big');    
        } else {
          if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $this->addError('email', 'email must be a valid email address');
          }
        }

  }// end function




/**
 * WHITE LIST STRING
 * 
 * STEP 1) to validate a string
 * 
 * user name needs to be between 6-12 characters
 * @return void
 ***************************************************************************/
  private function whiteListString($str, $validArray){
          
        $str = trim($str);
        
        if(empty($str)){
            $this->addError('str', 'string is empty');
        } elseif( $this->validateStrLength($str) ){
            $this->addError('str', 'String length not allowed.');
        
        
        } elseif ( !ctype_alnum(str_replace($validArray, '', $str)) ){
            $this->addError('str','caracteres not allowed');
          
        }     
  } // end function




/**
 * VALIDATE STRING SIZE
 * 
 * STEP 2) to validate a string
 * 
 * @param string $str - Enter the string
 * @param int    $size - the maximum size allowed for this string
 * @return void
  ***************************************************************************/
    public function validateStringSize($str, $size){
    
          //$str = trim($str);

          if( mb_strlen($str,'utf-8') > $size ){
            $this->addError('valueint', 'Value exceded');
          
          }   
    }// end function



/**
 * VAlidates the size of a string
 *
 * By default the size is 255 chars but it could be bigger but never bigger then 1024 char.
 * 1024 chars is the maximum chars that php "mb_" functions can accept.
 *
 * @param string $str
 * @param integer $length
 * @return void
 */
public function validateStrLength($str="", $length = 255){
  // check max length accepted by "mb_" functions
  // check the length  
  _dp("mb Length: ", mb_strlen($str, 'UTF-8'), 1);
  if( (mb_strlen($str, 'UTF-8') > $length) or ($length > 1024) ){
    return false;
  } else { return true;}
}







/**
 * VALIDATE DATE (YYYY-MM-DD)
 * 
 * user name needs to be between 6-12 characters
 * @return void
 ***************************************************************************/
      private function validateDate($date){
              
          $date = trim($date);
          
          if(empty($date)){
            $this->addError('date', 'date cannot be empty');
          } elseif (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date)) {
              $this->addError('date','date must be in the format YYYY-MM-DD');
          }
               
      } // end function





/**
 * IS INTEGER
 *
 * @param [int] $val - Value to be checked us integer
 * 
 * @return void
  ***************************************************************************/
  public function validateInteger($val){
  
        $val = (int) trim($val);
        
        if(empty($val)){
          $this->addError('valueint', 'Value cannot be empty');
        
        }elseif( !($val >= PHP_INT_MIN  && $val <= PHP_INT_MAX ) && !($val === 0) ){
          $this->addError('valueint', 'Value exceded');
        
        } elseif (is_string($val) && !ctype_digit($val)) {
            $this->addError('valueint', 'contains non digit characters');
            //return false; // contains non digit characters

        } elseif (!is_int((int) $val)) {
               $this->addError('valueint', 'You enter values not allowed');
              //return false; // other non-integer value or exceeds PHP_INT_MAX
        }
        
}// end function


/**
 * VALIDATES RANGE
 *
 *    Validates that the value entered int in the range between $min and $max
 *
 * @param [type] $int
 * @param [type] $min
 * @param [type] $max
 * @return void
  ***************************************************************************/
    public function validateIntRange($val, $min, $max){
        // we start to validate if it's a integer
          $this->validateInteger($val);
        // Check if it's in the range
          if ( ($val >= $min && $val <= $max) ){
            $this->addError('range', 'You enter values out of range');
          }
          //return ($int >= $min && $int <= $max);
    }// end function







/**
 * Manages the ERRORS
 *
 * @param [type] $key   the field name
 * @param [type] $val   the value
 * @return void
 ***************************************************************************/
  private function addError($key, $val){
        $this->errors[$key] = $val;
  }
  
}// end class

?>