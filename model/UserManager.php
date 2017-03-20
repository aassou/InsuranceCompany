<?php
class UserManager{

	//attributes
	private $_db;

	//constructor
    public function __construct($db){
        $this->_db = $db;
    }

	//BASIC CRUD OPERATIONS
	public function add(User $user){
        $query = $this->_db->prepare('INSERT INTO t_user (
		login, password, profil, status, created, createdBy)
		VALUES (:login, :password, :profil, :status, :created, :createdBy)')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':login', $user->login());
		$query->bindValue(':password', $user->password());
		$query->bindValue(':profil', $user->profil());
		$query->bindValue(':status', $user->status());
		$query->bindValue(':created', $user->created());
		$query->bindValue(':createdBy', $user->createdBy());
		$query->execute();
		$query->closeCursor();
	}

	public function update(User $user){
        $query = $this->_db->prepare('UPDATE t_user SET 
		login=:login, password=:password, profil=:profil, status=:status, 
		updated=:updated, updatedBy=:updatedBy
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $user->id());
		$query->bindValue(':login', $user->login());
		$query->bindValue(':password', $user->password());
		$query->bindValue(':profil', $user->profil());
		$query->bindValue(':status', $user->status());
		$query->bindValue(':updated', $user->updated());
		$query->bindValue(':updatedBy', $user->updatedBy());
		$query->execute();
		$query->closeCursor();
	}
    
    public function updateProfil(User $user){
        $query = $this->_db->prepare('UPDATE t_user SET 
        profil=:profil, updated=:updated, updatedBy=:updatedBy
        WHERE id=:id')
        or die (print_r($this->_db->errorInfo()));
        $query->bindValue(':id', $user->id());
        $query->bindValue(':profil', $user->profil());
        $query->bindValue(':updated', $user->updated());
        $query->bindValue(':updatedBy', $user->updatedBy());
        $query->execute();
        $query->closeCursor();
    }

    public function updateStatus(User $user){
        $query = $this->_db->prepare('UPDATE t_user SET status=:status, updated=:updated, updatedBy=:updatedBy 
        WHERE id=:id');
        $query->bindValue(':id', $user->id());
        $query->bindValue(':status', $user->status());
        $query->bindValue(':updated', $user->updated());
        $query->bindValue(':updatedBy', $user->updatedBy());
        $query->execute();
        $query->closeCursor();
    }
    
    public function changePassword($newPassword, $login){
        $query = $this->_db->prepare('UPDATE t_user SET password =:newPassword
        WHERE login=:login') or die(print_r($this->_db->errorInfo()));;
        $query->bindValue(':newPassword', $newPassword);
        $query->bindValue(':login', $login);
        $query->execute();
        $query->closeCursor();
    }

	public function delete($id){
        $query = $this->_db->prepare(' DELETE FROM t_user WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();
		$query->closeCursor();
	}

	public function getUserById($id){
        $query = $this->_db->prepare(' SELECT * FROM t_user WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$query->closeCursor();
		return new User($data);
	}

	public function getUsers(){
        $users = array();
		$query = $this->_db->query('SELECT * FROM t_user ORDER BY id DESC');
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$users[] = new User($data);
		}
		$query->closeCursor();
		return $users;
	}

	public function getUsersByLimits($begin, $end){
        $users = array();
		$query = $this->_db->query('SELECT * FROM t_user ORDER BY id DESC LIMIT '.$begin.', '.$end);
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$users[] = new User($data);
		}
		$query->closeCursor();
		return $users;
	}

	public function getLastId(){
        $query = $this->_db->query(' SELECT id AS last_id FROM t_user ORDER BY id DESC LIMIT 0, 1');
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$id = $data['last_id'];
		return $id;
	}
    
    public function getUsersNumber(){
        $query = $this->_db->query('SELECT COUNT(*) AS userNumbers FROM t_user');
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();
        return $data['userNumbers'];
    }
    
    public function getStatus($login){
        $query = $this->_db->prepare('SELECT status FROM t_user WHERE login=:login');
        $query->bindValue(":login", $login);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();
        return $data['status'];
    }
    
    public function getStatusById($idUser){
        $query = $this->_db->prepare('SELECT status FROM t_user WHERE id=:idUser');
        $query->bindValue(":idUser", $idUser);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();
        return $data['status'];
    }
    
    public function getUserByLoginPassword($login, $password){
        $query = $this->_db->prepare('SELECT * FROM t_user WHERE login=:login AND password=:password');
        $query->bindValue(':login', $login);
        $query->bindValue(':password', $password);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();
        return new User($data);
    }
    
    public function getUserByLogin($login){
        $query = $this->_db->prepare('SELECT * FROM t_user WHERE login=:login');
        $query->bindValue(':login', $login);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();
        return new User($data);
    }
    
    public function getPasswordByLogin($login){
        $query = $this->_db->prepare('SELECT password FROM t_user WHERE login=:login');
        $query->bindValue(':login', $login);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();
        return $data['password'];
    }
    
    public function exists($login, $password){
        $query = $this->_db->prepare('SELECT COUNT(*) FROM t_user WHERE login=:login AND password=:password');
        $query->bindValue(':login', $login);
        $query->bindValue(':password', $password);
        $query->execute();
        return (bool) $query->fetchColumn();
    }
    
    public function exist2($login){
        $query = $this->_db->prepare('SELECT COUNT(*) FROM t_user WHERE login=:login');
        $query->bindValue(':login', $login);
        $query->execute();
        return (bool) $query->fetchColumn();
    }
    

}