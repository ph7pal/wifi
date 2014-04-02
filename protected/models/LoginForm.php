<?php

class LoginForm extends CFormModel {

    public $username;
    public $password;
    public $rememberMe;
    public $verifyCode;
    private $_identity;

    public function rules() {
        return array(
            // username and password are required
            array('username, password', 'required'),
            // rememberMe needs to be a boolean
            array('rememberMe', 'boolean'),
            // password needs to be authenticated
            array('password', 'authenticate'),
            array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'username' => '用户昵称',
            'password' => '用户密码',
            'rememberMe' => '记住我',
            'verifyCode'=>'验证码',
        );
    }

    /**
     * Authenticates the password.
     * This is the 'authenticate' validator as declared in rules().
     */
    public function authenticate($attribute, $params) {
//            echo $this->username;
//		echo $this->password;
        $this->_identity = new U($this->username, $this->password);
        if (!$this->_identity->authenticate())
            $this->addError('password', '用户名或密码不正确.');
    }

    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    public function login() {
        if ($this->_identity === null) {
            $this->_identity = new U($this->username, $this->password);
            $this->_identity->authenticate();
        }
        //echo $this->username;
        //echo $this->password;
        //print_r($this->_identity);	
        //exit;	
        if ($this->_identity->errorCode === U::ERROR_NONE) {
            //$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
            Yii::app()->user->login($this->_identity);
            return true;
        } else
            return false;
    }

}
