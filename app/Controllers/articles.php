<?php
class Articles extends Base{

    public function __construct (){
       parent:: __construct();
    }

    public function list(){

        Session::init();
        $model= $this->load->model("ArticlesModel");
        $bind=  array( 'user_id'  =>  Session::get('id'));
        $page_count= $model->count();

        $data= [
            "articles"     =>  $model->list($bind, Page::current(), Page::per(11)),
            "page_number"  =>  Page::count($page_count),
            "page"         =>  Page::current()
          ];

         $this->load->view("articles", $data);
    }

    public function delete(){

       $id=    $_POST['delete'];
       $model= $this->load->model("ArticlesModel");
       $bind=  array( 'id'  =>  $id);
       $data=  $model->article_by_id($bind);
       $file_destination= "public/upload/articles/".$data['image'];

       if(!empty($data['id'])){

         file_exists($file_destination) ? unlink($file_destination) : "" ;
         $model->delete_article($bind);

         $this->log("User delete the article- id:$id");
         header("Location:". SITE_URL."/articles/list");
       }
    }

    public function bulkdelete(){

       $id="";
       isset($_POST['check']) ? $id=$_POST['check'] : $id="";
       $count = count($id);
       $model= $this->load->model("ArticlesModel");

       for($i=0; $i<$count; $i++) {

          $bind= array( 'id'  =>  isset($id[$i]) ? $id[$i] : '' );
          $data=  $model->article_by_id($bind);
          $file_destination= "public/upload/articles/".$data['image'];

         if(isset($data['id'])){

            file_exists($file_destination) ? unlink($file_destination) : "" ;
            $model->delete_article($bind);

            $this->log("User delete the articles- id: ".implode(",",$id));
            header("Location:". SITE_URL."/articles/list");

            }else{
            header("Location:". SITE_URL."/articles/list");
            }
       }
    }

    public function edit(){

        Session::init();
        $id=     $_POST['id'];
        $model=  $this->load->model("ArticlesModel");
        $bind=   array( 'id'  =>  $id);

        $data["article"]=  $model->article_by_id($bind);
        $this->load->view("article_edit", $data);
    }

    public function _edit(){

        $form= new Form();
        $form->post('title');
        $form->post('lead');
        $form->post('body');
        $form->post('date');
        $form->post('time');
        $form->post('image');
        $form->post('status');
        $form->post('username');

        $id=     $_POST['article_id'];
        $date=   $form->values['date'];
        $time=   $form->values['time'];
        $image=  isset($_FILES['file']['name']) ? $_FILES['file']['name'] : "" ;
        $model=  $this->load->model("ArticlesModel");

        $bind=   array(
            'id'         =>   $id,
            'title'      =>   $form->values['title'],
            'lead'       =>   $form->values['lead'],
            'body'       =>   $form->values['body'],
            'updated'    =>   date("Y-m-d H:i", strtotime("$date $time")),
            'image'      =>   $image ? $image : $form->values['image'],
            'status'     =>   $form->values['status'],
            'user_name'  =>   $form->values['username']
        );

        isset($image) ? $this->upload_image($image) : "" ;
        $model->article_update($bind);

        $this->log("User edit the article- id:".$id);
        header("Location:". SITE_URL."/articles/list");
    }

    public function create(){

        Session::init();
        $data = [
             'username' =>  Session::get('username'),
             'date'     =>  strtotime(date('d-m-Y')),
             'time'     =>  strtotime(date('H:i'))
                ];
        $this->load->view("article_create", $data);
    }

    public function _create(){

        Session::init();
        $form= new Form();
        $form->post('title');
        $form->post('lead');
        $form->post('body');
        $form->post('date');
        $form->post('time');
        $form->post('status');
        $form->post('username');

        $model= $this->load->model("ArticlesModel");
        $date=   $form->values['date'];
        $time=   $form->values['time'];
        $image=  $_FILES['file']['name'];
        $bind= [
            'title'      =>   $form->values['title'],
            'lead'       =>   $form->values['lead'],
            'body'       =>   $form->values['body'],
            'created'    =>   date("Y-m-d H:i", strtotime("$date $time")),
            'updated'    =>   date("Y-m-d H:i", strtotime("$date $time")),
            'image'      =>   $image,
            'status'     =>   $form->values['status'],
            'user_id'    =>   Session::get('id'),
            'user_name'  =>   $form->values['username']
        ];
        //if($_POST['article_id']){
        $this->upload_image($image);
        $model->article_insert($bind);

        $this->log("User create the articles- title: ".$form->values['title']);
        header("Location:". SITE_URL."/articles/list");

    }

    public function upload_image($image){

          if(isset($_FILES['file']['name'])) {

            $fileName = $_FILES['file']['name'];
            $fileType = $_FILES['file']['type'];
            $fileSize = $_FILES['file']['size'];
            $fileTmpName = $_FILES['file']['tmp_name'];

            $fileExt = explode('.', $fileName);
            $fileExtName = strtolower(end($fileExt));
            $file_type = array('jpg', 'png', 'jpeg', 'svg');

            if (in_array($fileExtName, $file_type)) {

                if ($fileSize < 20000000) {

                 //$file_name_new = $image. "." . $fileExtName;
                 $file_destination = "public/upload/articles/" .$image;
                 move_uploaded_file($fileTmpName, $file_destination);

                }
        }else{
           // header("Location:". SITE_URL."/gallery/images");
        }
     }
  }

    public function update_status(){

        $model= $this->load->model("ArticlesModel");
        $data=  explode("/", $_POST['status']);
        $bind= [ 'id'      =>   $data[0],
                 'status'  =>   $data[1] == 1 ? 0 : 1
                ];
        $model->status_edit($bind);

        $this->log("User update the article status - id: $data[0]");
        header("Location:". SITE_URL."/articles/list");

    }

    public function search(){

        $form= new Form();
        $form->post('search');
        $model= $this->load->model("ArticlesModel");
        $page_count= $model->count();

        $bind= [
              'id'     =>  $form->values['search'],
              'title'  =>  $form->values['search'],
              'lead'   =>  $form->values['search'],
              'body'   =>  $form->values['search']
        ];
        $data= [
            "search"       =>  $model->article_search($bind,Page::current(), Page::per(11)),
            "page_number"  =>  Page::count($page_count),
            "page"         =>  Page::current()
        ];
        $this->load->view("search", $data);
        $this->log("User search the articles- ".$form->values['search']);
    }
}