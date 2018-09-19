<?php
    class ChatController extends AppController{
        public $name = "Chat";
        public function feed(){
            if($this->Session->check('id')){
            if(isset($_GET['id'])){
                $edit = $this->Chat->find('first',array(
                    'conditions'=>array(
                        'id'=>$_GET['id']
                    )
                ));
                $this->set('edit_item',$edit);
            }
            else if(!isset($_GET['id'])){
                $edit['Chat']['id']=NULL;
                $edit['Chat']['user_id']=NULL;
                $edit['Chat']['message']=NULL;
                $edit['Chat']['file_name']="No file selected !!";
                $this->set('edit_item',$edit);
            }
            if ($this->request->is('post')){
                date_default_timezone_set("Asia/Ho_Chi_Minh");
                if($_GET['id']==NULL){
                    $this->Chat->create();
                    $this->request->data['Chat']['create_at'] = date('Y-m-d H:i:s');
                }else{
                    $data = $this->Chat->find('first',array(
                        'conditions' => array(
                        'id' => $id
                        )
                     ));
                    $this->Chat->id=$_GET['id'];
                    $this->request->data['Chat']['update_at'] = date('Y-m-d H:i:s');
                }
                $this->request->data['Chat']['user_id'] = $this->Session->read('id');
                if($_POST['message']==NULL){
                    $this->request->data['Chat']['type']=2;
                    $this->request->data['Chat']['message']=NULL;
                    $this->request->data['Chat']['file_name']=date('YmdHis')."_".$_FILES['fileupload']['name'];
                    $target_dir="img/upload/";
                    $target_file=$target_dir.basename(date('YmdHis')."_".$_FILES['fileupload']['name']);
                    $errors= array( );
                    $check = getimagesize($_FILES["fileupload"]["tmp_name"]);
                    if($check !== false){
                    } else {
                        $errors['fileupload']="It's not an image !!!";
                    }
                    if($_FILES['fileupload']['size']>5242880){
                        $errors['fileupload']="Oversize !!!!";
                    }
                    $file_type=pathinfo($_FILES['fileupload']['name'],PATHINFO_EXTENSION);
                    $file_type_allow = array('jpg','gif','jpeg','png');
                    if(!in_array(strtolower($file_type), $file_type_allow)){
                        $errors['fileupload']="This file is not allowed !!";
                    }
                    if(empty($errors['fileupload'])){
                        if(move_uploaded_file($_FILES['fileupload']['tmp_name'], $target_file)){
                            echo "UPLOAD DONE !!";
                        }
                    }
                    else{
                        echo $errors['fileupload'];
                    }
                }
                else{
                    $this->request->data['Chat']['type']=1;
                    $this->request->data['Chat']['file_name']=NULL;
                    $this->request->data['Chat']['message'] = $_POST['message'];
                }
                if ($this->Chat->save($this->request->data['Chat'])){
                    $this->redirect(array(
                        'controller' => 'chat',
                        'action' => 'feed'
                    ));
                }
            }
            $data = $this->Chat->find('all',array(
                'order'=>'id desc'
            ));
            $this->set('text_list',$data);
            $sql = "SELECT * FROM users";
            $user_list = $this->Chat->query($sql);
            $this->set('user_list',$user_list);
            if($this->Session->check('name'))  { $this->set('name',$this->Session->read('name'));
            $this->set('user_id',$this->Session->read('id'));
        }
        }
        else {
            $this->redirect(array("controller"=>"user", "action"=>"login"));
        }
        }
        public function delete($id){
            $data = $this->Chat->find('first',array(
                'conditions' => array(
                    'id' => $id
                )
            ));
            $this->Chat->delete($id);
            if($data['Chat']['type']==2){
                $target="img/upload/".$data['Chat']['file_name'];
                unlink($target);
            }
            $this->redirect(array(
                'controller'=>'chat',
                'action'=> 'feed'
            ));
        }
        public function logout(){
            $this->Session->destroy();
            $this->redirect(array( 'controller' => 'user', 'action' =>'login'));
        }
    }
?>