<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require 'vendor/autoload.php';
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase\Messaging\AndroidConfig;
use Kreait\Auth\Request\UpdateUser;

class Firebase
{
	protected $db;
	protected $Auth;
	protected $Pesan;
	protected $gantiUser;
	protected $dbuser = "user";
	protected $OrderMaterial = "OrderMaterial";
	function __construct(){
		$serviceAccount = ServiceAccount::fromJsonFile('admin.json');
		$firebase = (new Factory)
			->withServiceAccount($serviceAccount)
			->withDatabaseUri('https://ftdocs-328a8.firebaseio.com')
			->create();
		$this->db = $firebase->getDatabase();
	
		$this->Auth = $firebase->getAuth();
		$this->Pesan =$firebase->getMessaging();
	}
	public function createUser(array $data){
		if(empty($data) || !isset($data)){return FALSE;}
		try{
			$this->Auth->createUser($data);
			return TRUE;
		}   catch(Exception $e) 
           {
			return FALSE;
		}
	}
	public function saveHak($email,$data){
		 $x = $this->Auth->getUserByEmail($email);
		$uid = $x->uid;
		 $this->Auth->setCustomUserAttributes('RZ1Gt6kP01Y5TgNCAL08pWQENJs2', $data);
		return TRUE;
	}
	public function getAllUser(){
		$data = $this->Auth->listUsers();
		$u = array();
		foreach ($data as $d) {
			$x = array(
			'nama'=>$d->displayName,
			'email'=>$d->email,
			'id'=>$d->uid,
			'hak'=>$d->uid		
			);
			$u[]= $x;
		}
		return $u;
	}
	public function getAllUser2(){
		$data = $this->Auth->listUsers();
		return $data;
	}
	public function saveData(array $data,$table){
		if(empty($data) || !isset($data)){return FALSE;}
		$this->db->getReference()->getChild($table)->push($data);
		return TRUE;
	}
	public function deleteUser($uid){
		$this->Auth->deleteUser($uid);
	}
	public function cek_user($email){
    	return	$this->Auth->getUserByEmail($email);
	}
	public function kirim_pesan($token,$body){
		foreach($token as $t)
		{
			$title = 'Permohonan Pengeluaran Budgeting';
			if($t->token != null || $t->token != "")
			{
				try {
    					$message = CloudMessage::withTarget('token', $t->token)->withNotification(
							['title' => $title, 
							 'body' =>$body,
							 'sound'=>'ring'
							]);
						$this->Pesan->send($message);
					}
					catch (exception $e) {
						//code to handle the exception
					}
					finally {
						//optional code that always runs
					}
			}
		}
	}
	public function ganti_nama($nama,$uid)
	{
		$properties = [
			'displayName' => $nama
		];
		$updatedUser = $this->Auth->updateUser($uid, $properties);
		return $updatedUser;
	}
	
	public function ganti_password($uid,$password)
	{
		$updatedUser = $this->Auth->changeUserPassword($uid, $password);
		return $updatedUser;
	}
	
	public function ganti_email($uid,$email)
	{
		$updatedUser = $this->Auth->changeUserEmail($uid, $email);;
		return $updatedUser;
	}
}