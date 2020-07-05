<?php include_once "partials/header.php" ?>

<div class="d-flex align-items-stretch">
<style>
 .switch {
  position: relative;
  display: inline-block;
  width: 55px;
  height: 25px;
 }

 .switch input {
  opacity: 0;
  width: 0;
  height: 0;
 }

 .slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
 }

 .slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
  width: 20px;
  height: 18px;
 }

 input:checked + .slider {
  background-color: #843d3d;
 }

 input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
 }

 input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
 }

 /* Rounded sliders */
 .slider.round {
  border-radius: 34px;
 }

 .slider.round:before {
  border-radius: 50%;
 }
</style>
  <!-- Sidebar Navigation-->
<?php include_once "partials/sidebar.php" ?>
  <div class="page-content">
      <!-- Page Header-->
        <div class="page-header no-margin-bottom">
          <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Articles</h2>
          </div>
        </div>
        <!-- Breadcrumb-->
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Articles </li>
          </ul>
        </div>
        <section class="no-padding-top">
          <div class="container-fluid">
            <div class="row">
            <form action="<?php echo SITE_URL ?>/articles/bulkdelete" method="post">
              <div class="col-lg-12">
                <div class="block margin-bottom-sm">
                  <div class="title"><strong>Striped Table</strong>
                   <a class="btn btn-primary"  style="float: right;" href="<?php echo SITE_URL ?>/articles/create">
                      +Add
                  </a>
                </div>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                        <th>    Id        </th>
                        <th>    Title     </th>
                        <th>    Lead      </th>
                        <th>    Writer    </th>
                        <th>    Datetime  </th>
                        <th>    Status    </th>
                        <th>    Edit      </th>
                        <th>    Delete    </th>
                        <th>
                         <button class="btn btn-primary" type="submit" name="delete-all">
                            <i style="color: #ffffff;" class="fa fa-trash-o"></i>
                        </button>
                        </th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach($search as $article) { ?>
                       <tr>
                         <th scope="row">
                          <a href="#"><?php echo $article['id']; ?> </a>
                        </th>
                         <td>
                           <?php echo $article['title']; ?>
                        </td>
                        <td>
                           <?php echo $article['lead']; ?> </a>
                        </td>
                         <td>
                           <?php echo $article['user_name']; ?>
                        </td>
                         <td style="width: 170px;">
                            <?php echo date( 'd-m-Y H:i', strtotime($article['updated'])); ?>
                        </td>
                         <td>
                         </form>
                           <form action="<?php echo SITE_URL ?>/articles/update_status" method="post">
                            <label class="switch">
                            <input type="submit" name="status" value="<?php echo $article['id']."/".$article['status']; ?>" >
                            <input type="checkbox" name="" <?php $article['status']==1 ? print 'checked' : "" ?>>
                            <span class="slider round"></span>
                          </label>
                          </form>
                        </td>
                         <td>
                            <form action="<?php echo SITE_URL ?>/articles/edit  " method="post">
                              <button class="btn" type="submit" name="id" value="<?php echo $article['id']; ?>">
                               <i style="color: #ffffff;" class="fa fa-edit"></i>
                              </button>
                            </form>
                        </td>
                         <td>
                           <form action="<?php echo SITE_URL ?>/articles/delete" method="post">
                           <button class="btn " type="submit" name="delete" value="<?php echo $article['id']; ?>">
                             <i style="color: #ffffff;" class="fa fa-trash-o"></i>
                           </button>
                           </form>
                        </td>
                         <td>
                           <input style="margin-left: 10px;" class="checkbox-template" id="checkboxCustom2"  type="checkbox" name="check[]" value="<?php echo $article['id']; ?>">
                        </td>
                        </tr>
                      <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
<?php include_once "partials/pagination.php" ?>
<?php include_once "partials/footer.php" ?>