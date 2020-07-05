<?php include_once "partials/header.php" ?>
    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
    <?php include_once "partials/sidebar.php" ?>
      <div class="page-content">
        <!-- Page Header-->
        <div class="page-header no-margin-bottom">
          <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Basic forms</h2>
          </div>
        </div>
        <!-- Breadcrumb-->
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Profile     </li>
          </ul>
        </div>
        <section class="no-padding-top">
          <div class="container-fluid">
            <div class="">
              <!-- Form Elements -->
              <div class="col-lg-12">
                <div class="block">
                  <div class="title"><strong>User Profile</strong></div>
                  <div class="block-body">
                   <form action="<?php echo SITE_URL ?>/articles/_edit" method="post" enctype="multipart/form-data">
                      <div class="form-group ">
                        <div class="col-sm-12">
                           Title
                          <input type="text" class="form-control"  name="title" value="<?php echo htmlentities($article['title']) ?>">
                        </div>
                      </div>
                      <div class="form-group ">
                      <div class="col-sm-12">
                           Lead
                          <input type="text" class="form-control"  name="lead" value="<?php echo htmlentities($article['lead']) ?>">
                        </div>
                      </div>
                      <div class="form-group ">
                        <div class="col-sm-12">
                          <div class="row">
                            <div class="col-md-3">
                                Writer
                              <input type="text" placeholder="" class="form-control" name="username" value="<?php echo $article['user_name'] ?>">
                            </div>
                            <div class="col-md-4">
                                Date
                              <input type="date" placeholder="" class="form-control" name="date" value="<?php echo  date( 'Y-m-d', strtotime($article['updated'])) ?>">
                            </div>
                            <div class="col-md-5">
                                Time
                              <input type="time" placeholder=".col-md-4" class="form-control" placeholder="" name="time" value="<?php echo date( 'H:i', strtotime($article['updated'])) ?>">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group ">
                        <div class="col-sm-12">
                          Body
                          <textarea style="height:500px" class="form-control" name="body" placeholder="" name="body" ><?php echo $article['body']; ?></textarea>
                        </div>
                      </div>
                      <div class="form-group ">
                      <div class="col-md-3">
                          Image
                          <input type="hidden" name="image" value="<?php echo $article['image'] ?>">
                          <input type="file" name="file" id="file" onchange="loadFile(event)" style="display: none;" class="form-control" >
                          <label class="form-control" for="file" style="cursor: pointer;">Upload Image <i class="fa fa-image" style="float: right;"></i></label>
                          <img id="output" width="200" src="<?php echo "../public/upload/articles/".$article['image'] ?>">
                        </div>
                      </div>
                      </div>
                      <div class="form-group ">
                      <div class="col-md-3">
                          Status
                         <select type="checkbox" placeholder="" class="form-control"  name="status" >
                         <option class="dropdown-menu show" value="1">  Active   </option>
                         <option class="dropdown-menu show" value="0" selected="<?php $article['status']== 0 ? print "selected" : '' ?>"> Deactive </option>
                         </select>
                        </div>
                      </div>
                      <div class="form-group ">
                          <button style="float:center; margin-left: 80px;" type="submit" name="article_id" value="<?php echo $article['id'] ?>" class="btn btn-primary">Save changes</button>
                      </div>
                    </form>
                    <a href="<?php echo SITE_URL ?>/articles/list">
                     <button type="submit" class="btn btn-secondary" style="margin-top: -100px;">Cancel</button>
                   </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
  <script>
  var loadFile = function(event) {
    var image = document.getElementById('output');
    image.src = URL.createObjectURL(event.target.files[0]);
  };
  </script>
</section>

<?php include_once "partials/footer.php" ?>