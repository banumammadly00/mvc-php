<?php include_once "partials/header.php" ;?>

<div class="d-flex align-items-stretch">
  <!-- Sidebar Navigation-->
<?php include_once "partials/sidebar.php" ?>
  <div class="page-content">
      <!-- Page Header-->
        <div class="page-header no-margin-bottom">
          <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">logs</h2>
          </div>
        </div>
        <!-- Breadcrumb-->
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">logs </li>
          </ul>
        </div>
        <section class="no-padding-top">
          <div class="container-fluid">
            <div class="">
            <form action="<?php echo SITE_URL ?>/logs/bulkdelete" method="post">
              <div class="col-lg-12">
                <div class="block margin-bottom-sm">
                  <div class="title"><strong>Striped Table</strong>

                </div>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                        <th>    Id        </th>
                        <th>    Name      </th>
                        <th>    Action    </th>
                        <th>    Datetime  </th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach($logs as $log) { ?>
                       <tr>
                         <th scope="row">
                         <a href="#"><?php echo $log['id']; ?></a>
                        </th>
                         <td>
                           <?php echo $log['name']; ?>
                        </td>
                        <td>
                           <?php echo $log['action']; ?> </a>
                        </td>
                         <td style="width: 170px;">
                            <?php echo date( 'd-m-Y H:i', strtotime($log['date'])); ?>
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