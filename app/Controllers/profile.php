<?php
class Profile extends Base{

    public function __construct(){
        parent::__construct();
    }

    public function user(){

         Session::init();
         $model= $this->load->model("ProfileModel");
         $bind= array(
             'login' =>  Session::get('username'),
             'pass'  =>   Session::get('password')
         );

         $data["user"] = $model->user_info($bind);
         $view= $this->load->view("profile", $data);

    }

    public function edit(){
        Session::init();
        $form= new Form();
        $form->post('email')->email();
        $form->post('mobile')->length(10,30);
        $form->post('birthday')->date_limit(1930,2002);
        $form->post('about');
        $form->post('role');

        $model= $this->load->model("ProfileModel");

        if($form->submit()){

           $bind= array(
            'login'    =>   Session::get('username'),
            'pass'     =>   Session::get('password'),
            'email'    =>   $form->values['email'],
            'mobile'   =>   $form->values['mobile'],
            'birthday' =>   date("Y-m-d", strtotime($form->values['birthday'])),
            'about'    =>   $form->values['about'],
            'role'     =>   $form->values['role']
            );
           $model->user_edit($bind);
           header("Location:". SITE_URL."/profile/user");

        }else{

            $bind= array(
                'login' =>  Session::get('username'),
                'pass'  =>   Session::get('password')
            );
            $data= [
               "user"          => $model->user_info($bind),
               "profile_error" => $form->errors
                ];

           $view= $this->load->view("profile",$data);
      }
   }

    public function file_upload(){

        Session::init();

        $file= $_FILES['file'];

        $fileName= $_FILES['file']['name'];
        $fileType= $_FILES['file']['type'];
        $fileSize= $_FILES['file']['size'];
        $fileTmpName= $_FILES['file']['tmp_name'];

        $fileExt= explode('.', $fileName);
        $fileExtName= strtolower(end($fileExt));
        $file_type= array('jpg', 'png', 'jpeg','svg');

        if(in_array($fileExtName, $file_type)){
            if($fileSize < 20000000) {

                $file_name_new= uniqid('',true).".".$fileExtName;
                $file_destination= "public/upload/profile/" .$file_name_new;
                move_uploaded_file($fileTmpName, $file_destination);

                $previous_file= "public/upload/profile/".$_POST['image'];
                file_exists($previous_file) ? unlink($previous_file) : "" ;

                $model= $this->load->model("ProfileModel");
                $bind= array(
                 'login'    =>   Session::get('username'),
                 'pass'     =>   Session::get('password'),
                 'image'    =>  $file_name_new
                 );
                $model->file_edit($bind);
                header("Location:". SITE_URL."/profile/user");
            }
        }else {
            header("Location:". SITE_URL."/profile/user");
        }
     }
}