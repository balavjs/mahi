<?php
  $title = "Profile Details | Zriya Solutions";
?>

<?php include('header.php'); ?>
<?php include('class/class_users.php'); ?>
<style type="text/css">
.table thead th{
  vertical-align: top;
}
</style>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <?php 
 
    $result_usr = new User();      
    $sql_usr = $result_usr->getonerecord($id);

    foreach ($sql_usr as $list_data) {  
      $id = $list_data['id'];                  
      $name1 = $list_data['fullname'];
      $role = $list_data['role'];

    ?>

    

	  <!-- Main content -->
	  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">             

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Profile Details</h3>
              </div>
              <div class="card-header">
              	<a href="profile_view.php">
	                <button class="btn btn-primary"><i class="fas fa-chevron-left"></i> Back to Profile</button>
	              </a>
              </div>
              <!-- /.card-header -->


              <div class="card-body">

                <div class="card card-success">
                  <div class="card-header">
                    <h3 class="card-title">Profile Details</h3>
                  </div>                 

                  <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                      
                        <?php 
                        $str = $_GET['id'];

                        $str1 = substr($str,5,-5);
                        //echo $str1;
                        
                        $id = $str1;
                        //$id = $_GET['id'];
                        $result = new DB_user();
                        $sql = $result->get_one_user($id);   
                        $i=0;             
                        foreach ($sql as $list) { 
                          $i++;
                                       
                        ?>                      
                      
                      <tr>
                        <td rowspan="7" width="230" style="vertical-align: middle; text-align: center;">
                          <?php
                          if($list['profile_image'] != ""){ ?>  
                            <img src="uploads/img/<?php echo $list['profile_image'];?>" width="180" height="200" style="border: 2px solid #b0b2b5; border-radius: 4px; box-shadow: 0px 2px 5px #a59f9f;">
                          <?php  
                          }
                          else{
                          ?>
                            <img src="http://localhost/zriya/zriya_app/dist/img/placeholder.jpg" width="180" height="200" style="border: 2px solid #b0b2b5; border-radius: 4px; box-shadow: 0px 2px 5px #a59f9f;">
                          <?php
                          }
                          ?>
                        </td>                        
                      </tr>
                      <tr>                    
                        <th width="200">Employee ID</th>
                        <td><?php echo $list['emp_id'];?></td>
                      </tr>
                      <tr>                    
                        <th>Name</th>
                        <td><?php echo $list['fname'];?> <?php echo $list['lname'];?></td>
                      </tr>
                      <tr>                    
                        <th>Email</th>
                        <td><?php echo $list['email'];?></td>
                      </tr>
                      <tr>                    
                        <th>Phone</th>
                        <td><?php echo $list['phone'];?></td>
                      </tr>
                      <tr>                    
                        <th>Address</th>
                        <td><?php echo $list['address'];?></td>
                      </tr>                     
                      <?php  
                      }
                      ?>            
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>

    <?php
    }
    ?>
    <!-- /.content -->
  </div>



<?php include('footer.php'); ?>



