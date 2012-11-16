<?
// Examples of a Zend Framework Model class
// application/models/UserMapper.php

class Users extends Zend_Db_Table_Abstract
{
    protected $_name = 'users';
 
}
 
    
class Model_UserMapper
{
    protected $_dbTable;
    protected $_usermeta;
    
    // set function
    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }
 
    // get function
    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Model_DbTable_Users');
        }
        return $this->_dbTable;
    }
    
    // save function for writes
    public function save(Model_User $users)
    {
 		if (null === ($id = $users->getId())) {
				$data = array(
					'username'   => $users->getReg_username(),
					'password' => $users->getReg_password(),
					'first_name' => $users->getReg_first_name(),
					'last_name' => $users->getReg_last_name(),
					'email' => $users->getReg_email(),
					'zipcode' => $users->getReg_zipcode(),
					'user_status' => $users->getReg_user_status()
				);
				$data['activation_key'] = $users->getActivation_key();
				$data['hash'] = $users->getHash();  
				unset($data['id']);
				$this->getDbTable()->insert($data);
				return true;
            
        } else {
				if($users->getReg_password()){ 
						$data = array(
							'password' => $users->getReg_password(),
							'hash' => $users->getHash()
						);
				} else {
						$data = array(
							'first_name' => $users->getReg_first_name(),
							'last_name' => $users->getReg_last_name(),
							'email' => $users->getReg_email(),
							'zipcode' => $users->getReg_zipcode(),
							'user_status' => $users->getReg_user_status()
						);
				}
        		$n = $this->getDbTable()->update($data, 'id = '.$id);
		    	return true;
        }
    }
    
    // user activation function
    public function activate($key)
    {
    	$db = $this->getDbTable();
		$select = $db->select()->where('activation_key = ?', $key);
		$result = $db->fetchAll($select);

        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $username = $row->username;         
        
        setcookie("logged_in",$username,time()+(60*60*24),"/",".".$_SERVER['HTTP_HOST']);
    	
    	$data = array(
		    'activation_key'  => '',
		    'user_level'      => '1',
		    'registered_date' => @date('Y-m-d H:i:s')
		);
			 
		$this->getDbTable()->update($data, array('activation_key = ?' => $key));
		
		return true;
    }
    
    // get user's profile information
    public function getProfile($un, Model_User $users)
    {
    	
    	$db = $this->getDbTable();
		$select = $db->select()->where('username = ?', $un);
		$result = $db->fetchAll($select);
		if (0 == count($result)) {
            return;
        }
        $row = $result->current();
              
        
        return $row;    	

    }
 
    // find a user
    public function find($id, Model_User $users)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $users->setId($row->id)
                  ->setUsername($row->username)
                  ->setPassword($row->password)
                  ->setFirstname($row->first_name)
                  ->setLastname($row->last_name)
                  ->setEmail($row->email);
    }
   
    // get the hash for a user
    public function getHash($username)
    {
        $db = $this->getDbTable();
		$select = $db->select()->where('username = ?', $username);
		$result = $db->fetchAll($select);

        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        return $row->hash;                  
    }
 
    // fetch all users meta data
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_User();
            $entry->setId($row->id)
                  ->setUsername($row->username)
                  ->setEmail($row->email)
                  ->setFirstname($row->first_name)
                  ->setLastname($row->last_name)
                  ->setEmail($row->email);
            $entries[] = $entry;
        }
        return $entries;
    }
    
     // find user's ID by email address
     public function returnIdByEmail($email) {
    	$db = $this->getDbTable();
		$row = $db->fetchRow($db->select()->where('email = ?', $email));
		if (sizeof($row) > 0) {
			return $row->id;
        } else {
            return null;
        }
    
    }
	
	// find user's ID by username
	public function returnIdByUsername($username) {
    	$db = $this->getDbTable();
		$row = $db->fetchRow($db->select()->where('username = ?', $username));
		if (sizeof($row) > 0) {
			return $row->id;
        } else {
            return null;
        }
    
    }
    
    // get a user's facebook access token using their user id
    public function grabFbAccessToken($email) {

		$id = $this->returnIdByEmail($email);

		$db = new Zend_Db_Table('usermeta');
		$token = $db->fetchRow($db->select()->where('user_id = ?', $id)->where('meta_key = ?', 'fb_access_token'));

		if (sizeof($token) > 0) {
			return $token->meta_value;
        	} else {
            		return null;
        	}
    }
    
    // add a user's facebook token to their account
    public function addFbAccessToken($user_id,$access_token) {

		$data = array(
		    'user_id'		=> $user_id,
		    'meta_key' 		=> 'fb_access_token',
		    'meta_value'    => $access_token
		);

		$db = new Zend_Db_Table('usermeta');
        	$db->insert($data);

		return true;   
    }
    
    // grab a user's facebook data using their email address
    public function grabFbAllData($email) {

		$id = $this->returnIdByEmail($email);

		$db = new Zend_Db_Table('usermeta');
		$token = $db->fetchRow($db->select()->where('user_id = ?', $id)->where('meta_key = ?', 'fb_all_data'));

		if (sizeof($token) > 0) {
				return true;
        	} else {
            	return false;
        	}
    }
    
    // dump all of user's facebook data from the OG call into the their profile
    public function addFbAllData($user_id,$arprofile) {

		$data = array(
		    'user_id'		=> $user_id,
		    'meta_key' 		=> 'fb_all_data',
		    'meta_value'    => $arprofile
		);

		$db = new Zend_Db_Table('usermeta');
        	$db->insert($data);

		return true;   
    }
    
    // get the number of users
    public function getCount()
    {
    	$db = new Zend_Db_Table('users');
        $select = $db->select();
        $select->from($db, array('count(*) as amount'));
        $rows = $db->fetchAll($select);
       
        return($rows[0]->amount);       
    }
    
    // see if a user has any Set Notifications and return it if so
    public function checkSetNotification($username) {

		$id = $this->returnIdByUsername($username);

		$db = new Zend_Db_Table('usermeta');
		$notification = $db->fetchRow($db->select()->where('user_id = ?', $id)->where('meta_key = ?', 'new_set_notification'));

		if (sizeof($notification) > 0) {
			return $notification->meta_value;
    	} else {
        	return null;
    	}
    }
    
    // remove the user's Set Notifications (i.e. when they click on them)
    public function removeSetNotification($user_id) {

		$db = new Zend_Db_Table('usermeta');
		$data = $db->fetchRow($db->select()->where('user_id = ?', $user_id)->where('meta_key = ?', 'new_set_notification'));
		$where = $db->getAdapter()->quoteInto('umeta_id = ?', $data->umeta_id);
		$db->delete($where);

		return true;   
    }
    
    

}
