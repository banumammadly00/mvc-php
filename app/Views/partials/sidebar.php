<nav id="sidebar">
   <div class="sidebar-header d-flex align-items-center">
    <div class="title">
       <h1 class="h5"><?php echo $_SESSION['username'] ?></h1>
     </div>
    </div>
      <span class="heading">Main</span>
       <ul class="list-unstyled">
       <li class="<?php $_SERVER['REQUEST_URI'] == SITE_URL."/profile/user" ? print "active" : ""; ?>">
         <a href="<?php echo SITE_URL ?>/profile/user"> <i class="icon-home"> </i> Profile </a>
      </li>
       <li class="<?php $_SERVER['REQUEST_URI'] == SITE_URL."/gallery/images" ? print "active" : ""; ?>">
         <a href="<?php echo SITE_URL ?>/gallery/images"> <i class="icon-windows"></i> Gallery  </a>
      </li>
       <li class="<?php $_SERVER['REQUEST_URI'] == SITE_URL."/articles/list" ? print "active" : ""; ?>">
         <a href="<?php echo SITE_URL ?>/articles/list"> <i class="icon-new-file"></i>  Articles </a>
       </li>
       <li class="<?php $_SERVER['REQUEST_URI'] == SITE_URL."/logs/list" ? print "active" : ""; ?>">
         <a href="<?php echo SITE_URL ?>/logs/list"> <i class="icon-new-file"></i> Logs </a>
       </li>
     <!--  <li><a href="tables.html"> <i class="icon-grid"></i>Tables </a></li>
          <li><a href="charts.html"> <i class="fa fa-bar-chart"></i>Charts </a></li>
          <li class="active"><a href="forms.html"> <i class="icon-padnote"></i>Forms </a></li>
          <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Example dropdown </a>
            <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
              <li><a href="#">Page</a></li>
              <li><a href="#">Page</a></li>
              <li><a href="#">Page</a></li>
            </ul>
          </li>
          <li><a href="login.html"> <i class="icon-logout"></i>Login page </a></li>
        </ul><span class="heading">Extras</span>
        <ul class="list-unstyled">
          <li> <a href="#"> <i class="icon-settings"></i>Demo </a></li>
          <li> <a href="#"> <i class="icon-writing-whiteboard"></i>Demo </a></li>
          <li> <a href="#"> <i class="icon-chart"></i>Demo </a></li> -->
  </ul>
</nav>