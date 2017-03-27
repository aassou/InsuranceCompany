<?php
class AppManager{

    //attributes
    protected $_db;
    protected $_source;
    protected $_table;
    protected $_formInputs;
    protected $_objectName;

    //constructor
    public function __construct($db, $source){
        $this->_db = $db;
        $this->_source = $source;
        $this->_table = 't_'.strtolower($source);
        $this->_formInputs = array();
        $this->_objectName = ucfirst($source);
    }

    //BASIC CRUD OPERATIONS
    public function add($formInputs){
        $object = new $this->_objectName($formInputs);
        $objectArray = (array) $object;
        foreach ( $formInputs as $key => $value ) {
            if ( $key != "action" and $key != "source" and $key != "pageNumber" ) {
                $this->_formInputs[$key] = $value;    
            } 
        }
        //prepare SQL statement
        $statement = 'INSERT INTO '.$this->_table.' (';
        foreach ( $this->_formInputs as $key => $value ) {
            $statement .= $key.',';
        }
        $statement = substr($statement, 0, -1);
        $statement .= ') VALUES (';
        foreach ( $this->_formInputs as $key => $value ) {
            $statement .= ":".$key.',';
        }
        $statement = substr($statement, 0, -1);
        $statement .= ')';
        //execute statement
        //$statement .= "\$query = \$this->_db->prepare(\$statement) or die (print_r(\$this->_db->errorInfo()));";
        $query = $this->_db->prepare($statement) or die (print_r($this->_db->errorInfo()));;
        foreach ( $this->_formInputs as $key => $value ) {
            $bindKey = ":".$key;;
            //$statement .= "\$query->bindValue($bindKey, $value);";
            $query->bindValue($bindKey, $value);
        }
        //$statement .= "\$query->execute();";
        //$statement .= "\$query->closeCursor();";
        //return $statement;
        $query->execute();
        $query->closeCursor();
    }

    public function update($formInputs){
        $object = new $this->_objectName($formInputs);
        $objectArray = (array) $object;
        foreach ( $formInputs as $key => $value ) {
            if ( $key != "action" and $key != "source" and $key != "pageNumber" ) {
                $this->_formInputs[$key] = $value;    
            } 
        }
        //prepare SQL statement
        $statement = 'UPDATE '.$this->_table.' SET';
        foreach ( $this->_formInputs as $key => $value ) {
            $statement .= $key.':'.$key;
        }
        $statement = substr($statement, 0, -1);
        $statement .= 'WHERE id=:id';
        //execute statement
        //$statement .= "\$query = \$this->_db->prepare(\$statement) or die (print_r(\$this->_db->errorInfo()));";
        //$query = $this->_db->prepare($statement) or die (print_r($this->_db->errorInfo()));;
        //foreach ( $this->_formInputs as $key => $value ) {
          //  $bindKey = ":".$key;;
            //$statement .= "\$query->bindValue($bindKey, $value);";
            //$query->bindValue($bindKey, $value);
        //}
        //$statement .= "\$query->execute();";
        //$statement .= "\$query->closeCursor();";
        return $statement;
        //$query->execute();
        //$query->closeCursor();
    }

    public function delete($id){
        $statement = 'DELETE FROM '.$this->_table.' WHERE id=:id';
        $query = $this->_db->prepare($statement) or die (print_r($this->_db->errorInfo()));
        $query->bindValue(':id', $id);
        $query->execute();
        $query->closeCursor();
    }

    public function getOneById($id){
        $statement = 'SELECT * FROM '.$this->_table.' WHERE id=:id';
        $query = $this->_db->prepare($statement) or die (print_r($this->_db->errorInfo()));
        $query->bindValue(':id', $id);
        $query->execute();      
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();
        return new $this->_objectName($data);
    }

    public function getAll(){
        $rows = array();
        $statement = 'SELECT * FROM '.$this->_table.' ORDER BY id ASC';
        $query = $this->_db->query($statement);
        while($data = $query->fetch(PDO::FETCH_ASSOC)){
            $rows[] = new $this->_objectName($data);
        }
        $query->closeCursor();
        return $rows;
    }

    public function getAllByLimits($begin, $end){
        $rows = array();
        $statement = 'SELECT * FROM '.$this->_table.' ORDER BY id DESC LIMIT '.$begin.', '.$end;
        $query = $this->_db->query($statement);
        while($data = $query->fetch(PDO::FETCH_ASSOC)){
            $rows[] = new $this->_objectName($data);
        }
        $query->closeCursor();
        return $rows;
    }
    
    public function getAllNumber(){
        $statement = 'SELECT COUNT(*) AS number FROM '.$this->_table;
        $query = $this->_db->query($statement);
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $number = $data['number'];
        return $number;
    }

    public function getLastId(){
        $statement = 'SELECT id AS last_id FROM '.$this->_table.' ORDER BY id DESC LIMIT 0, 1';
        $query = $this->_db->query($statement);
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $id = $data['last_id'];
        return $id;
    }

}