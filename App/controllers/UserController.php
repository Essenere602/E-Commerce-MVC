<?php   
class UserController {
    //vue
    public function RegisterForm () {
        require_once (VIEW. 'RegisterForm.php');
    }
    //model
    public function UserSave () {
       $ins =$this->pdo();
    }
}