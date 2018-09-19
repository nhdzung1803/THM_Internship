<?php
 class UserController extends AppController{
	public $name = "User";
	public function login(){
		if($this->request->is('post')){
			$data = $this->User->find('first',array(
				'conditions' => array('email' => $_POST['email'], 'password' => $_POST['password'])
			));
			if( isset($data['User'])){
				$this->Session->write('id',$data['User']['id']);
				$this->Session->write('email',$data['User']['email']);
				$this->Session->write('name',$data['User']['name']);
				$this->redirect(array('controller' => 'chat', 'action' => 'feed'));
				}
			else {
				$this->set('err',"--Email or password is incorrect--");
				}
			}
		}
	public function add(){
		if($this->request->is('post')){
			$data = $this->User->find('first',array(
				'conditions' => array('email' => $_POST['email'])
			));
			if( isset($data['User'])){
				$this->set("err","--Email already exists!!--");
			}
			else 
			{
				$this->User->create();
				$this->request->data['User']['name']=$_POST['name'];
				$this->request->data['User']['email']=$_POST['email'];
				$this->request->data['User']['password']=$_POST['password'];
				if ($this->User->save($this->request->data['User'])) {
                    $this->redirect(array(
                        'controller' => 'user',
                        'action' => 'login'
                    ));
                }
            }
        }
    }
}
?>