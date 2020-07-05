<?php
class Gallery extends Base{

    public function __construct(){
        parent::__construct();
    }


    public function images(){

        Session::init();

        $model= $this->load->model("GalleryModel");
        $bind= array(
            'user_id'  =>  Session::get('id')
        );
        $page_count= $model->count();

        $data = [
            "images"       =>  $model->images($bind, Page::current(), Page::per(9)),
            "page_number"  =>  Page::count($page_count),
            "page"         =>  Page::current()
        ];


        $this->load->view("gallery", $data);
   }

    public function upload(){

        Session::init();
        $model= $this->load->model("GalleryModel");

        $file = $_FILES['file'];
        $count_file = count($_FILES['file']['name']);

        for ($i=0; $i<$count_file; $i++){
          if($_FILES['file']['name'][$i]) {
            $fileName = $_FILES['file']['name'][$i];
            $fileType = $_FILES['file']['type'][$i];
            $fileSize = $_FILES['file']['size'][$i];
            $fileTmpName = $_FILES['file']['tmp_name'][$i];

            $fileExt = explode('.', $fileName);
            $fileExtName = strtolower(end($fileExt));
            $file_type = array('jpg', 'png', 'jpeg', 'svg');

            if (in_array($fileExtName, $file_type)) {
                if ($fileSize < 20000000) {

                 $file_name_new = uniqid('', true) . "." . $fileExtName;
                 $file_destination = "public/upload/gallery/" . $file_name_new;
                 move_uploaded_file($fileTmpName, $file_destination);

                 $bind= array(
                    'user_id' => Session::get('id'),
                    'image'   =>  $file_name_new,
                    'created' =>  date("Y-m-d")
                    );
                 $model->upload_images($bind);

                 header("Location:". SITE_URL."/gallery/images");
               }
            }
        }else{
            header("Location:". SITE_URL."/gallery/images");
        }
     }
  }

    public function delete(){

        Session::init();

        $id= $_POST['delete'];

        $model= $this->load->model("GalleryModel");
        $bind= array(
          'id'       =>   $id,
          'user_id'  =>   Session::get('id')
        );
        $data= $model->image_by_id($bind);

        if(isset($data['image'])){

          $model->delete_image($bind);
          $file_destination= "public/upload/gallery/".$data['image'];

          if(file_exists($file_destination)){
               unlink($file_destination);
               header("Location:". SITE_URL."/gallery/images");
          }else{
             $data["delete_error"]= "No such file directory";
             $view= $this->load->view("gallery", $data);
           }
       }
    }

    public function bulkdelete(){

        Session::init();

        $id="";
        isset($_POST['check']) ? $id=$_POST['check'] : $id="";
        $count_file = count($id);

        $model= $this->load->model("GalleryModel");

        for($i=0; $i<$count_file; $i++) {

            $bind= array(
            'id'       =>   isset($id[$i]) ? $id[$i] : '',
            'user_id'  =>   Session::get('id')
            );
             $data= $model->image_by_id($bind);
               if (isset($data['image'])){

                $model->delete_image($bind);
                $file_destination= "public/upload/gallery/".$data['image'];

              if(file_exists($file_destination)){
                    unlink($file_destination);
                    header("Location:". SITE_URL."/gallery/images");
              }
             }else{
               header("Location:". SITE_URL."/gallery/images");
           }
        }
    }
}