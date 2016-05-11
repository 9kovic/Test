<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
//		$users=array(
//			// username => password
//			'demo'=>'demo',
//			'admin'=>'admin',
//			'admin'=>'admin123',
//		);
//		if(!isset($users[$this->username]))
//			$this->errorCode=self::ERROR_USERNAME_INVALID;
//		else if($users[$this->username]!==$this->password)
//			$this->errorCode=self::ERROR_PASSWORD_INVALID;
//		else
//			$this->errorCode=self::ERROR_NONE;
//		return !$this->errorCode;
		$admin_model = Admin::model()->find('username=:name',array(':name'=>$this->username));
		$user_model = User::model()->find('username=:name',array(':name'=>$this->username));
		//如果用户名不存在

		if($admin_model === null && $user_model === null){
			$this -> errorCode = self::ERROR_USERNAME_INVALID;
			return false;

		}else if(isset($admin_model)){
			if($admin_model->password !== md5($this -> password)){
				//密码判断
				$this->errorCode=self::ERROR_PASSWORD_INVALID;
				return false;
			}else{
				$this->errorCode = self::ERROR_NONE;
				return true;
			}
		}else if(isset($user_model)){
			if($user_model->password !== $this -> password){
				//密码判断
				$this->errorCode=self::ERROR_PASSWORD_INVALID;
				return false;
			}else{
				$this->errorCode = self::ERROR_NONE;
				return true;
			}
		}




	}
}