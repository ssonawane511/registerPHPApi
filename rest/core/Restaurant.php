<?php
namespace Core\Data;

class Restaurant {

    public $id = null;
    public $fname = null;
    public $lname = null;
    public $email = null;
    public $phone = null;
    public $age = null;
   
    private $table_name = null;
    private $conn = null;

    public function __construct($conn) {
        $this->conn = $conn;
        $this->table_name = TABLE;
    }

    public function getRegistration() {
        $sql = "SELECT * FROM {$this->table_name} ORDER BY id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt;
    }

    public function getRegistrationById() {
        $sql = "SELECT * FROM {$this->table_name} WHERE id like ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        return $stmt;
    }

    public function update() {
        $sql = "UPDATE
                    {$this->table_name}
                SET
                
                    fname = :fname,
                    lname = :lname,
                    
                    email = :email,
                    phone = :phone,
                    age = :age
                WHERE
                    id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id',$this->id);
        $stmt->bindParam(':fname',$this->fname);
        $stmt->bindParam(':lname',$this->lname);
        $stmt->bindParam(':phone',$this->phone);
        $stmt->bindParam(':email',$this->email);
        $stmt->bindParam(':age',$this->age);

        $stmt->execute();
       
        return $stmt->rowCount();
        
    }
    public function insert() {
     

   $sql = "INSERT INTO  {$this->table_name} (`id`, `fname`, `lname`, `email`, `phone`, `age`) 
           VALUES 
           (:id, 
           :fname, 
           :lname,  
          :email, 
           :phone, 
         :age)"; 

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id',$this->id);
        $stmt->bindParam(':fname',$this->fname);
        $stmt->bindParam(':lname',$this->lname);
        $stmt->bindParam(':phone',$this->phone);
        $stmt->bindParam(':email',$this->email);
        $stmt->bindParam(':age',$this->age);
        try {
             $stmt->execute();
        }catch(\PDOException $exp) {
            echo "Connection Error: " . $exp->getMessage();
        }
        return $stmt->rowCount();
        
    }
    function delete() {
        $sql = "DELETE FROM {$this->table_name} WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $this->id = \htmlspecialchars($this->id);
      
        $stmt->bindParam(1,$this->id);

      
        $stmt->execute();
        return $stmt->rowCount();
    }



}
?>