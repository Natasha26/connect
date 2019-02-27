<?php
class Department extends Model
{
    public $departmentId = 0;
    public $departmentName = "";
    public $shortName = "";
    public $establishmentId = 0;
    public $establishmentName = "";
    public $establishmentShortName = "";
    public $groups = [];
  
  
    function __construct($departmentID = 0) 
    {
        if ($departmentID>0) {
            $sql = "SELECT a.*, b.establishment_name, b.short_name as establishmentShortName FROM departments AS a "
                    . "LEFT JOIN establishments AS b ON b.establishment_id=a.establishment_id "
                    . "WHERE a.department_id=?";
            $stmt = DB::$connection->prepare($sql);
            $stmt->execute([(int)$departmentID]);
            $this->initObjectFromArray($stmt->fetch());
            $this->getGroups();
        }
    }
    
    public function update() 
    {
        $sql = "UPDATE departments SET department_name=?, short_name=?, establishment_id=? "
                . "WHERE department_id=?;";
        $stmt = DB::$connection->prepare($sql);
        $result = $stmt->execute([
            $this->departmentName,
            $this->shortName,
            $this->establishmentId,
            (int)$this->departmentId,
        ]);
        return $result;
    }
    
    public function create() 
    {
        $sql = "INSERT INTO departments"
                . "(department_name, short_name, establishment_id) "
                . "VALUES  (?, ?, ?)";
        $stmt = DB::$connection->prepare($sql);
        $result = $stmt->execute([
            $this->departmentName,
            $this->shortName,
            $this->establishmentId
        ]);
        $this->departmentId = DB::$connection->lastInsertId();
        return $result;
    }
    
    public static function getDepartments()
    {
      $sql = "SELECT a.*, b.establishment_name FROM departments AS a "
              . "LEFT JOIN establishments AS b ON b.establishment_id=a.establishment_id";
      $stmt = DB::$connection->prepare($sql);
      $result = $stmt->execute();
      return $stmt->fetchAll();
    }
    
    private function getGroups()
    {
      $sql = "SELECT * FROM groups WHERE department_id=?";
      $stmt = DB::$connection->prepare($sql);
      $result = $stmt->execute([$this->departmentId]);
      $this->groups = $stmt->fetchAll();
    }
    
}