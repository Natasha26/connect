<?php
class Group extends Model
{
    public $groupId = 0;
    public $groupName = "";
    public $departmentId = 0;
    public $departmentName = "";
    public $departmentShortName = "";
    public $establishmentId = 0;
    public $establishmentName = "";
    public $establishmentShortName = "";
    public $users = [];
  
  
    function __construct($groupID = 0) 
    {
        if ($groupID>0) {
            $sql = "SELECT a.*, "
                    . "b.department_name, b.short_name as department_short_name, b.establishment_id, "
                    . "c.establishment_name, c.short_name as establishment_short_name "
                    . "FROM groups AS a "
                    . "LEFT JOIN departments AS b ON b.department_id=a.department_id "
                    . "LEFT JOIN establishments AS c ON c.establishment_id=b.establishment_id "
                    . "WHERE a.group_id=?";
            $stmt = DB::$connection->prepare($sql);
            $stmt->execute([(int)$groupID]);
            $this->initObjectFromArray($stmt->fetch());
            $this->getUsers();
        }
    }
    
    public function update() 
    {
        $sql = "UPDATE groups SET group_name=?, department_id=? "
                . "WHERE group_id=?;";
        $stmt = DB::$connection->prepare($sql);
        $result = $stmt->execute([
            $this->groupName,
            $this->departmentId,
            (int)$this->groupId,
        ]);
        return $result;
    }
    
    public function create() 
    {
        $sql = "INSERT INTO groups"
                . "(group_name, department_id) "
                . "VALUES  (?, ?)";
        $stmt = DB::$connection->prepare($sql);
        $result = $stmt->execute([
            $this->groupName,
            $this->departmentId
        ]);
        $this->groupId = DB::$connection->lastInsertId();
        return $result;
    }
    
    public static function getGroups()
    {
      $sql = "SELECT a.*, b.department_id, b.short_name as department_short_name, "
              . "c.establishment_id, c.short_name as establishment_short_name "
              . "FROM groups AS a "
              . "LEFT JOIN departments AS b ON b.department_id=a.department_id "
              . "LEFT JOIN establishments AS c ON c.establishment_id=b.establishment_id";
      $stmt = DB::$connection->prepare($sql);
      $result = $stmt->execute();
      return $stmt->fetchAll();
    }
    
    private function getUsers()
    {
      $sql = "SELECT * FROM users WHERE group_id=?";
      $stmt = DB::$connection->prepare($sql);
      $result = $stmt->execute([$this->groupId]);
      $this->users = $stmt->fetchAll();
    }
    
}