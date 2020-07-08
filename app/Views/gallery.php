<?php include_once "partials/header.php" ?>
<style>
    .span_style{
        float: right;
         margin-right: 132px;
         margin-top: -80px;
         color: #ff5b60;
         font-size: medium;
    }
</style>
<div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
    <?php include_once "partials/sidebar.php" ?>

    <div class="page-content">
        <div class="page-header">
            <form action="<?php echo SITE_URL ?>/gallery/upload" method="post" enctype="multipart/form-data">
            <div class="form-group row">
            <div class="col-md-3">
               <input id="file" type="file" name="file[]" multiple="multiple" accept="image/*" style="display: none;">
               <label class="form-control" for="file" style="cursor: pointer; ">Choose files<i class="fa fa-image" style="float: right;"></i></label>
            </div>
                <button class="btn btn-primary" type="submit" name="upload">Upload<i class="fa fa-download"></i> </button>
                <?php if(isset($upload_error)){ ?>
                <span style="color: #ff5b60; font-size: medium;"> <?php echo $upload_error; ?> </span>
                <?php } ?>
            </div>
           </form>
       </div>

       <form action="<?php echo SITE_URL ?>/gallery/bulkdelete" method="post">
         <button style="float: right; margin-top: -117px; margin-right: 11px" class="btn btn-primary" type="submit" name="delete-all" id="delete-all"  onclick="delete_check()">
             Delete All
        </button>
         <?php if(isset($delete_error)) { ?>
            <span class="span_style"> <?php echo $delete_error; ?> </span>
        <?php } ?>
        <section class="no-padding-bottom">
            <div class="container-fluid">
                <div class="row">
                <?php foreach ($images as $image) { ?>
                <div class="col-lg-4">
                    <div class="user-block block text-center">
                    <div> <img src="<?php echo "../public/upload/gallery/".$image['image']; ?>" alt="..." class="img-fluid">
                    <div class="details d-flex">
                        <div class="item"> <input class="checkbox-template" type="checkbox" name="check[]"  value="<?php echo $image['id']; ?>"></div>
                        <div class="item"><i class="fa fa-gg"></i><strong></strong></div>
                        <div class="item">
                        </form>
                        <form action="<?php echo SITE_URL ?>/gallery/delete" method="post">
                          <button style="float:right;" class="btn btn-primary btn-round" type="submit" name="delete" value="<?php echo $image['id']; ?>">
                           <i class="fa fa-trash-o" style="color: #ffffff;"></i>
                         </button>
                       </form>
                       </div>
                     </div>
                    </div>
                </div>
                </div>
                <?php } ?>
            </div>
         </section>
<script>
    function delete_check() {
    var checkBox = document.getElementsByName("check[]");
    var checked=0, i;
    for ( i=0; i<checkBox.length; i++) {
    if(checkBox[i].checked == true){
        checked++
        }
    }
    (checked <= 0) ? alert('Choose files for delete') : "" ;
    }
</script>
<?php include_once "partials/pagination.php" ?>
<?php include_once "partials/footer.php"    ?>