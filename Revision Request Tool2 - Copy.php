
<?php
//index.php

$error = '';
$RequestorName = '';
$SESAID = '';
$Q2C = '';
$Line = '';
$ExpectedDate = '';
$ReasonList = '';
$Description = '';
$checkbox = '';

function clean_text($string)
{
 $string = trim($string);
 $string = stripslashes($string);
 $string = htmlspecialchars($string);
 return $string;
}

if(isset($_POST["submit"]))
{
if(empty($_POST["RequestorName"]))
 {
  $error .= '<p><label class="text-danger">Please Enter Requestor Name</label></p>';
 }
 else
 {
  $RequestorName = clean_text($_POST["RequestorName"]);
 }
if(empty($_POST["SESAID"]))
 {
  $error .= '<p><label class="text-danger">Please Enter SESAID</label></p>';
 }
 else
 {
  $SESAID = clean_text($_POST["SESAID"]);
 }

 if(empty($_POST["Q2C"]))
 {
  $error .= '<p><label class="text-danger">Please Enter Q2C Number</label></p>';
 }
 else
 {
  $Q2C = clean_text($_POST["Q2C"]);
 }
 if(empty($_POST["Line"]))
 {
  $error .= '<p><label class="text-danger">Please Enter Line Number</label></p>';
 }
 else
 {
  $Line = clean_text($_POST["Line"]);
 }
 if(empty($_POST["ExpectedDate"]))
 {
  $error .= '<p><label class="text-danger">Expected Date is required</label></p>';
 }
 else
 {
  $ExpectedDate = clean_text($_POST["ExpectedDate"]);
 }
 if(!isset($_POST["ReasonList"]))
 {
  $error .= '<p><label class="text-danger">Please select a reason</label></p>';
 }
else
 {
  $ReasonList = clean_text($_POST["ReasonList"]);
 }

 if(empty($_POST["Description"]))
 {
  $error .= '<p><label class="text-danger">Description is required</label></p>';
 }
 else
 {
  $Description = clean_text($_POST["Description"]);
 }
if(!isset($_POST["checkbox"]))
 {
  $error .= '<p><label class="text-danger">Please upload all the files</label></p>';
 }

 if($error == '')
 {
  $file_open = fopen("Revision_Tracker.csv", "a");
  $no_rows = count(file("Revision_tracker.csv"));
  if($no_rows > 1)
  {
   $no_rows = ($no_rows - 1) + 1;
  }
  $form_data = array(
   'sr_no'  => $no_rows,
   'RequestorName' => $RequestorName,
   'SESAID' => $SESAID,
   'Q2C'  => $Q2C,
   'Line'  => $Line,
   'ExpectedDate' => $ExpectedDate,
   'ReasonList'  => $ReasonList,  
   'Description' => $Description
  );
  fputcsv($file_open, $form_data);
  $error = '<label class="text-success">Thank you!</label>';
  $RequestorName = '';
  $SESAID = '';
  $Q2C = '';
  $Line = '';
  $ExpectedDate = '';
  $ReasonList = '';
  $Description = '';
}
}

?>
<!DOCTYPE html>
<html>
 <head>
  <title>Revision Request Tool</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>
  <br />
  <div class="container">
   <h2 align="center">Revision Request Tool</h2>
   <br />
   <div class="col-md-6" style="margin:0 auto; float:none;">
    <form method="post">
     <?php echo $error; ?>
     <div class="form-group">
      <div class="form-group">
      <label>Requestor Name</label>
      <input type="text" name="RequestorName" placeholder="Enter Name" class="form-control" value="<?php echo $RequestorName; ?>" />
     </div>
      <div class="form-group">
      <label>SESA ID of Requestor</label>
      <input type="text" name="SESAID" placeholder="Enter SESA ID" class="form-control" value="<?php echo $SESAID; ?>" 
      </div>
      <label>Q2C</label>
      <input type="text" name="Q2C" placeholder="Enter Q2C" class="form-control" value="<?php echo $Q2C; ?>" />
      </div>
     <div class="form-group">
      <label>Line Number</label>
      <input type="text" name="Line" class="form-control" placeholder="Enter Line Number" value="<?php echo $Line; ?>" />
     </div>
     <div class="form-group">
      <label>Expected Date (mm/dd/yyyy)</label>
      <input type="text" name="ExpectedDate" class="form-control" placeholder="Enter Expected Date" value="<?php echo $ExpectedDate; ?>" />
     </div>
     <div class="form-group">
      <label>Select Reason for Request</label>
             
               <select id = "ReasonList" name="ReasonList" class="form-control" value="<?php echo $ReasonList; ?>" />
               </n>
               <option value = "">Select...</option>
               <option value = "Original Engineer has left the company">Original Engineer has left the company</option>
               <option value = "Actively involved in field work on customer site">Actively involved in field work on customer site</option>
               <option value = "No capacity due to customer mandated deadlines">No capacity due to customer mandated deadlines</option>
               <option value = "Exception request by manager">Exception request by manager</option>
             </select>
              </div>
      <label>Describe scope of revision and any additional information required to complete</label>
      <textarea name="Description" class="form-control" placeholder="Enter Description"><?php echo $Description; ?></textarea>
     </div>
       <label>I have created a 'Revision' folder and uploaded the following files on eJobs</label> 
       <input type="checkbox" name="checkbox" class="form-control" align="right" value="<?php echo $checkbox; ?>"/>
      <p style="text-align:Left;">Initial Study Report</p>
      <p style="text-align:Left;">New Information Received</p>
      <p style="text-align:Left;">Initial Study Model</p>
       </div>
      <div class="form-group" align="center">
      <input type="submit" name="submit" class="btn btn-info" value="Submit" />
     </div>
    </form>
   </div>
  </div>
 </body>
</html>
