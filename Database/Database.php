<?php
/**
* DATABASE
*
* BAsed on youtube videos:
*     part01: https://www.youtube.com/watch?v=qZARqGduS8M
*     part02: https://www.youtube.com/watch?v=NVQ-yyz2t_Q
*     part03: https://www.youtube.com/watch?v=NUiNA7zg_QM
*     part04: https://www.youtube.com/watch?v=NLTO82RXlpQ
*     How to ise it: https://www.youtube.com/watch?v=gv8hfcNl-uU&t=32s
*/
class Database{
  
    public $isConn; // is connected
    public $datab; // database connection



  // CONNECT TO DB
     public function __construct( $username = "root", 
                                  $password = "", 
                                  $host="localhost", 
                                  $dbName="sports", 
                                  $options=[])
          {
               $this->isConn = TRUE;
               try{
                  // establish connection
                    $this->datab = $pdo = new PDO ("mysql:host={$host};dbname={$dbName}; charset=utf8", $username, $password, $options);
                    $this->datab->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
                    $this->datab->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC );
       
               }catch (PDOException $e){
                    throw new Exception($e->getMessage());
               } 
           }
   
  // DISCONNECT from DB
    public function Disconnect(){
        $this->datab = NULL;
        $this->isConn = FALSE;
    }
    
  // GET A SINGLE row
    public function getRow($query, $params=[]){
          try{
                $stmt = $this->datab->prepare($query);
                $stmt->execute($params);
                return $stmt->fetch();
           }catch (PDOException $e){
                throw new Exception ($e->getMessage());
           } 
    }
  
  // Get multiple ROWS
    public function getRows($query, $params=[]){
          try{
                $stmt = $this->datab->prepare($query);
                $stmt->execute($params);
                return $stmt->fetchAll();
           }catch (PDOException $e){
                throw new Exception($e->getMessage());
           } 
    }
  //INSERT insertRow
    public function insertRow($query, $params=[]){
          try{
              $stmt = $this->datab->prepare($query);
              $stmt->execute($params);
              return TRUE;
    
           }catch (PDOException $e){
                throw new Exception($e->getMessage());
           } 
    }
  
  //UPDATE updateRow
    public function updateRow($query, $params=[]){
         return $this->insertRow($query, $params);
    }
  
  
  // DELETE deleteRow
    public function deleteRow($query, $params=[]){
          return $this->insertRow($query, $params);
    }
  

}// end class