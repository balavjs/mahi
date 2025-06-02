<?php
$htmlContent = ' 
       
          <table style="border: 1px solid #a6a6a6; width: 600px; border-collapse: collapse;" > 
          ';

      $email = $_POST['email'];
                
        $result = new DB_time_accounts();
        $sql = $result->get_one_time_accounts($id);   
        $i=0;             
        foreach ($sql as $list) { 
          $i++;
          $emp_id = $list['emp_id'];  

          $result1 = new DB_user();
            $sql1 = $result1->get_emp_id_user($emp_id);

            if (is_array($sql1) || is_object($sql1)){
              foreach ($sql1 as $list1) {

                $emp_id1 = $list1['emp_id'];
                $fname1 = $list1['fname'];
                $lname1 = $list1['lname'];
                $email1 = $list1['email'];

    $htmlContent .= '

              <tr> 
                  <th colspan="2" style="border: 1px solid #a6a6a6; padding:10px; text-align:center;">
                    <img src="https://zriyasolutions.com/employee_portal/zriya_app/dist/img/logo.png">
                  </th>
              </tr>
              <tr> 
                  <th colspan="2" style="border: 1px solid #a6a6a6; padding:10px; text-align:center;">
                    Hi! Here the Time Accounts details for you.
                  </th>
              </tr>
              <tr> 
                  <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Employee ID</th>
                  <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$emp_id1.'</td> 
              </tr> 
              <tr> 
                  <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Employee Name</th>
                  <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$fname1." ".$lname1.'</td> 
              </tr>
              <tr> 
                  <th style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">Email</th>
                  <td style="border: 1px solid #a6a6a6; padding:10px; text-align:left;">'.$email1.'</td> 
              </tr>
              
              ';
          }
      }
  }

      $htmlContent .= '
          </table> 
      '; 
   
      $to = $email1; 
      $from = 'bala@zriyasolutions.com'; 
      $fromName = 'Zriya Solutions'; 
       
      $subject = "Zriya Report"; 

      // Set content-type header for sending HTML email 
      $headers = "MIME-Version: 1.0" . "\r\n"; 
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
       
      // Additional headers 
      $headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 
       
      $success = mail($to, $subject, $htmlContent, $headers);
      // Send email 
      if($success){  
       //echo "<script>if(confirm('Email Sent Sucessfully!'));</script>";
       $esMessage = true;
      }else{ 
         //echo 'Email sending failed.'; 
         $esMessage = false;
      }

       if($esMessage){
        echo'<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                Email sent successfully
            </div>';
        exit;
    }else{
        echo'<div class="alert alert-danger alert-dismissible"> 
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                Email not sent to Please try again or type correct email!
            </div>';
        exit;           
    }
    }
    ?>