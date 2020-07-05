<?php
class Auth extends Base{

    public function __construct (){
       parent:: __construct();
    }

    public function login(){
        $this->load->view("auth/login");
    }

    public function _login(){

        $form= new Form();
        $form->post('username')->isEmpty();
        $form->post('password')->isEmpty();

        if($form->submit()){

          $model= $this->load->model("AuthModel");
          $bind= array(
            'login'  =>  $form->values['username'],
            'pass'   =>  Hash::crypt($form->values['password'])
           );

              $data= $model->login($bind);
              if(!empty($data)){

              //---------------Session set---------------
               Session::init();
               Session::set("id", $data['id']);
               Session::set("username", $form->values['username']);
               Session::set("password", Hash::crypt($form->values['password']));
               Session::set("timeout", time());

               //--------------Log set--------------------
               $this->log("User logged in to the site");

               header("Location:".SITE_URL."/profile/user");
              }else{
                  $data["form_error"]= "Your username or password are invalid";
                  $this->load->view("auth/login",$data);
              }
        }else{
            $data["form_error"]= $form->errors;
            $view= $this->load->view("auth/login",$data);
        }
    }

    public function logout(){

        Session::init();
        $this->log("User log out from the site");

        Session::end();
        header("Location:". SITE_URL."/auth/login");
    }

    public function signup(){

       $view= $this->load->view("auth/signup");
    }

    public function _signup(){

        $form= new Form();
        $form->post('username')->isEmpty();
        $form->post('email')->isEmpty()->email();
        $form->post('password')->isEmpty()->length(8,50)->password();
        $form->post('confirm-pass')->isEmpty()->confirm_pass('password');

        if($form->submit()){

         $model= $this->load->model("AuthModel");
         $user_bind= array ( 'login'   =>   $form->values['username'] );
         $user_check= $model->user_check($user_bind);

         if(!isset($user_check[0]['login'])) {

            $password= Hash::crypt($form->values['password']);
            $data= array(
                'login' =>  $form->values['username'],
                'pass'  =>  $password,
                'email' =>  $form->values['email']
            );
            $model->signup($data);
            $data["success"]= "Please Login";
            $this->load->view("auth/login",$data);
         }else{
            $data["user_error"]= "Username is used";
            $view= $this->load->view("auth/signup",$data);
         }
        }else{

            $data["form_error"]= $form->errors;
            $view= $this->load->view("auth/signup",$data);

        }

    }
}