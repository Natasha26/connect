<?php
class User extends Model
{
    public $userId = 0;
    public $firstName = "";
    public $lastName = "";
    public $middleName = "";
    public $email = "";
    public $phone = "";
    public $groupId = 0;
    public $groupName = "";
    public $departmentId = 0;
    public $departmentName = "";
    public $departmentShortName = "";
    public $establishmentId = 0;
    public $establishmentName = "";
    public $establishmentShortName = "";
  
  
    function __construct($userID = 0) 
    {
        if ($userID>0) {
            $sql = "SELECT a.*, "
                    . "b.group_name, b.department_id, "
                    . "c.department_name, c.short_name as department_short_name, c.establishment_id, "
                    . "d.establishment_name, d.short_name as establishment_short_name FROM users AS a "
                    . "LEFT JOIN groups AS b ON b.group_id=a.group_id "
                    . "LEFT JOIN departments AS c ON c.department_id=b.department_id "
                    . "LEFT JOIN establishments AS d ON d.establishment_id=c.establishment_id "
                    . "WHERE a.user_id=?";
            $stmt = DB::$connection->prepare($sql);
            $stmt->execute([(int)$userID]);
            $this->initObjectFromArray($stmt->fetch());
        }
    }
    
    public function update() 
    {
        $sql = "UPDATE users SET first_name=?, last_name=?, "
                . "middle_name=?, email=?, "
                . "phone=?, group_id=? "
                . "WHERE user_id=?;";
        $stmt = DB::$connection->prepare($sql);
        $result = $stmt->execute([
            $this->firstName,
            $this->lastName,
            $this->middleName,
            $this->email,
            $this->phone,
            $this->groupId,
            (int)$this->userId,
        ]);
        return $result;
    }
    
    public function create() 
    {
        $sql = "INSERT INTO users"
                . "(first_name, last_name, middle_name, "
                . "email, phone, group_id) "
                . "VALUES  (?, ?, ?, ?, ?, ?)";
        $stmt = DB::$connection->prepare($sql);
        $result = $stmt->execute([
            $this->firstName,
            $this->lastName,
            $this->middleName,
            $this->email,
            $this->phone,
            $this->groupId
        ]);
        $this->userId = DB::$connection->lastInsertId();
        return $result;
    }
    
    public static function getUsers()
    {
      $sql = "SELECT a.*, b.group_name FROM users AS a "
              . "LEFT JOIN groups AS b ON b.group_id=a.group_id";
      $stmt = DB::$connection->prepare($sql);
      $result = $stmt->execute();
      return $stmt->fetchAll();
    }
    
}