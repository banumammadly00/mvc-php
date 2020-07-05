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
            <div class="row">
              <!-- Form Elements -->
              <div class="col-lg-4">
                <div class="user-block block text-center">
                <form method="post" action="<?php echo SITE_URL ?>/profile/file_upload" enctype="multipart/form-data">
                  <div class="" >
                    <input type="hidden" name="image" value="<?php echo $user['image'] ?>">
                    <img  src="<?php echo "../public/upload/profile/".$user['image'] ?>" alt="Select photo" class="img-fluid" style="border-radius: 50%; width:200px">
                  </div>
                  <div style="margin-top: 17px;">
                   <h3 class="h5"> <?php echo $user['login'] ?> </h3>
                   </div>
                  <div class="details">
                    <div class="form-group ">
                      <div class="input-group">
                         <input type="file" name="file" id="file" style="display: none;" class="form-control">
                         <label class="form-control" for="file" style="cursor: pointer; ">Choose profile photo <i class="fa fa-image" ></i></label>
                       <div class="input-group-append">
                          <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-image"></i> save</button>
                      </div>
                    </div>
                 </div>
                  </div>
                </form>
                </div>
              </div>
              <div class="col-lg-8">
                <div class="block">
                  <div class="title"><strong>User Profile</strong></div>
                  <?php if(isset($profile_error)) { ?>
                           <?php foreach($profile_error as $values) {
                                  foreach($values as $key=>$value) {?>
                                  <div class="form-group">
                                  <span style="font-size: medium; color: #cc7070; margin-left: 26%; "> <?php print_r($value); ?> </span></br>
                                 </div>
                           <?php } }?>
                         <?php } ?>
                  <div class="block-body">
                    <form action="<?php echo SITE_URL ?>/profile/edit" method="post">
                      <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Username</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="username" placeholder="" value="<?php echo $user['login'] ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Mail Address</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="email" value="<?php echo $user['email']; ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 form-control-label"></label>
                        <div class="col-sm-9">
                          <div class="row">
                            <div class="col-md-3">
                                Role
                              <input type="text" placeholder=".col-md-4" class="form-control" name="role" value="<?php echo $user['role']; ?>">
                            </div>
                            <div class="col-md-4">
                                Mobile
                              <input type="mobile" placeholder=".col-md-5" class="form-control" name="mobile" value="<?php echo $user['mobile']; ?>">
                            </div>
                            <div class="col-md-5">
                                Birthdate
                              <input type="date" placeholder=".col-md-4" class="form-control" name="birthday" value="<?php echo $user['birthday']; ?>">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 form-control-label">About</label>
                        <div class="col-sm-9">
                          <textarea class="form-control" placeholder="" name="about" style="height: 200px;"><?php echo $user['about']; ?></textarea>
                        </div>
                      </div>
                      <div class="line"></div>

                      <div class="line"></div>
                      <div class="form-group row">
                        <div class="col-sm-9 ml-auto">
                          <!-- <button type="submit" class="btn btn-secondary">Cancel</button> -->
                          <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
 </section>

<?php include_once "partials/footer.php" ?>