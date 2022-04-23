<?php 

class Validator {

  private $data = [];
  private $errors = [];
  // Fields in this form
  private static $fields = ['username', 'email', 'intvalue', 'range', 'str'];
  
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
        $this->validateUsername($this->data['username']);
        $this->validateEmail($this->data['email']);
        $this->validateInteger($this->data['intvalue']);
        $this->validateIntRange($this->data['range'], 10, 20);
        $this->whiteListString($this->data['str'], $this->allowedChars);
        return $this->errors;

  }//end function



/**
 * VALIDATE USERNAME
 * 
 * user name needs to be between 6-12 characters
 * @return void
 ***************************************************************************/
  private function validateUsername($val){
        
        $val = trim($val);
        
        if(empty($val)){
          $this->addError('username', 'username cannot be empty');
        } else {
          if(!preg_match('/^[a-zA-Z0-9]{6,20}$/', $val)){
            $this->addError('username','username must be 6-12 chars & alphanumeric');
          }
        }     
  } // end function



/**
 * VALIDATE EMAIL
 *
 * @return void
 ***************************************************************************/
  private function validateEmail($val){

        $val = trim($val);
    
        if(empty($val)){
            $this->addError('email', 'email cannot be empty');
        } else {
          if(!filter_var($val, FILTER_VALIDATE_EMAIL)){
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
        
        } elseif ( !ctype_alnum(str_replace($validArray, '', $str)) ){
            $this->addError('str','caracteres not allowed');
          
        }     
  } // end function




/**
 * VALIDATE STRING SIZE
 * 
 * STEP 2) to validate a string
 * 
 * @param [string] $str - Enter the string
 * @param [int]    $size - the maximum size allowed for this string
 * @return void
  ***************************************************************************/
    public function validateStringSize($str, $size){
    
          //$str = trim($str);

          if( mb_strlen($str,'utf-8') > $size ){
            $this->addError('intvalue', 'Value exceded');
          
          } 
    
}// end function




/**
 * IS INTEGER
 *
 * @param [int] $val - Value to be checked us integer
 * 
 * @return void
  ***************************************************************************/
  public function validateInteger($val){
  
        $val = (int) trim($val);
        
        if( !($val >= PHP_INT_MIN  && $val <= PHP_INT_MAX ) && !($val === 0) ){
          $this->addError('intvalue', 'Value exceded');
        
        } elseif (is_string($val) && !ctype_digit($val)) {
            $this->addError('intvalue', 'contains non digit characters');
            //return false; // contains non digit characters

        } elseif (!is_int((int) $val)) {
               $this->addError('intvalue', 'You enter values not allowed');
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