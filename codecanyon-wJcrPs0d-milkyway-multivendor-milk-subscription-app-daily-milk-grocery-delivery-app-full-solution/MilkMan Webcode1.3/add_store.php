<?php 
include 'controller/header.php';
if (isset($_SERVER['HTTPS']) &&
    ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
    isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
    $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
  $protocol = 'https://';
}
else {
  $protocol = 'http://';
}
?>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <!-- Page Header Start-->
     <?php 
	 include 'controller/topbar.php';
	 ?>
      <!-- Page Header Ends                              -->
      <!-- Page Body Start-->
      <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        <?php 
		include 'controller/sidebar.php';
		?>
        <!-- Page Sidebar Ends-->
        <div class="page-body">
          <div class="container-fluid">        
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h3>Store Management</h3>
                </div>
                <div class="col-6">
                  
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid default-page">
		   <div class="row">
             
             <div class="col-sm-12">
                <div class="card">
                 <?php 
				 if(isset($_GET['id']))
				 {
					 $data = $medi->query("select * from service_details where id=".$_GET['id']."")->fetch_assoc();
					 ?>
					 <div class="card-body">
					<h5 class="h5_set"><i class="fa fa-cutlery"></i>  Store  Information</h5>
				<form method="post"  enctype="multipart/form-data">
                                       <div class="row">
									    <div class="form-group mb-3 col-4">
                                            <label><span class="text-danger">*</span> Store Name</label>
                                            <input type="text" class="form-control " placeholder="Enter Store Name"  value="<?php echo $data['title'];?>" name="cname" required="">
											<input type="hidden" name="type" value="edit_Store"/>
										<input type="hidden" name="id" value="<?php echo $_GET['id'];?>"/>
                                        </div>
										
                                      <div class="form-group mb-3 col-4">
                                            <label><span class="text-danger">*</span> Store Image</label>
                                            <div class="custom-file">
                                                <input type="file" name="kit_img" class="custom-file-input form-control" >
                                                <label class="custom-file-label">Choose Store Image</label>
												<br>
												<img src="<?php echo $data['rimg'];?>" width="100" height="100"/>
                                            </div>
                                        </div>
										
										<div class="form-group mb-3 col-4">
                                            <label><span class="text-danger">*</span> Store Cover Image</label>
                                            <div class="custom-file">
                                                <input type="file" name="cover_img" class="custom-file-input form-control" >
                                                <label class="custom-file-label">Choose Store Cover Image</label>
												<br>
												<img src="<?php echo $data['cover_img'];?>" width="100" height="100"/>
                                            </div>
                                        </div>
										
										<div class="form-group mb-3 col-4">
                                            <label> <span class="text-danger">*</span> Store Status</label>
                                            <select name="status" class="form-control" required>
											<option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
											<option value="0" <?php if($data['status'] == 0){echo 'selected';}?>>UnPublish</option>
											</select>
                                        </div>
										
										<div class="form-group mb-3 col-4">
                                            <label><span class="text-danger">*</span> Rating</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Rating"  value="<?php echo $data['rate'];?>" name="arate" required="">
                                        </div>
										
										
										
										
										
										<div class="form-group mb-3 col-4">
                                            <label>Certificate/License Code</label>
                                            <input type="text" class="form-control " placeholder="Enter Certificate/License Code" value="<?php echo $data['lcode'];?>"  name="lcode">
                                        </div>
										
										<div class="form-group mb-3 col-4">
                                            <label><span class="text-danger">*</span> Mobile number(With country code + sign)</label>
                                            <input type="text" class="form-control" placeholder="Enter Mobile number"  value="<?php echo $data['mobile'];?>" name="mobile" required="">
                                        </div>
										
										<div class="form-group mb-3 col-4">
                                            <label><span class="text-danger">*</span> Slogan Title</label>
                                            <input type="text" class="form-control" placeholder="Enter Slogan Title"  value="<?php echo $data['slogan'];?>"name="slogan" required="">
                                        </div>
										
										<div class="form-group mb-3 col-4">
                                            <label><span class="text-danger">*</span> Slogan Subtitle</label>
                                            <input type="text" class="form-control" placeholder="Enter Slogan Sub-Title" value="<?php echo $data['slogan_title'];?>"  name="slogan_title" required="">
                                        </div>
										
										<div class="form-group mb-3 col-4">
                                            <label><span class="text-danger">*</span> Store Open Time</label>
                                            <input type="time" class="form-control" placeholder="Enter Slogan Sub-Title" value="<?php echo $data['opentime'];?>" name="opentime" required="">
                                        </div>
										
										<div class="form-group mb-3 col-4">
                                            <label><span class="text-danger">*</span> Store Close Time</label>
                                            <input type="time" class="form-control" placeholder="Enter Slogan Sub-Title" value="<?php echo $data['closetime'];?>" name="closetime" required="">
                                        </div>
										
										<div class="form-group mb-3 col-4">
                                            <label> <span class="text-danger">*</span> Store Pickup Status</label>
                                            <select name="is_pickup" class="form-control" required>
											<option value="1" <?php if($data['is_pickup'] == 1){echo 'selected';}?>>Yes</option>
											<option value="0" <?php if($data['is_pickup'] == 0){echo 'selected';}?>>No</option>
											</select>
                                        </div>
										
										<div class="form-group mb-3 col-12">
                                            <label><span class="text-danger">*</span>Tags</label>
                                            <input type="text" class="form-control" data-role="tagsinput" value="<?php echo $data['sdesc'];?>"   name="sdesc" required="">
                                        </div>
										
										<div class="form-group mb-3 col-12">
                                            <label><span class="text-danger">*</span>Short Description</label>
											<textarea class="form-control" rows="5"  name="cdesc" style="resize: none;"><?php echo $data['cdesc'];?></textarea>
                                           
                                        </div>
										
										<div class="form-group mb-3 col-12">
                                            <label><span class="text-danger">*</span>Cancel Policy</label>
											<textarea class="form-control" rows="5"  name="cancle_policy" style="resize: none;"><?php echo $data['cancle_policy'];?></textarea>
                                           
                                        </div>
										
										
										
	
	
	
	<div class="form-group mb-3 col-12">
										<h5 class="h5_set"><i class="fa fa-sign-in"></i> Store  Login Information</h5>
										</div>
										<div class="form-group mb-3 col-6">
                                            <label><span class="text-danger">*</span>Email Address</label>
                                            <input type="email" class="form-control " placeholder="Enter Email Address" value="<?php echo $data['email'];?>"  name="email" required="">
                                        </div>
										
										<div class="form-group mb-3 col-6">
                                            <label><span class="text-danger">*</span>Password</label>
                                            <input type="text" class="form-control " placeholder="Enter Password" value="<?php echo $data['password'];?>" name="password" required="">
                                        </div>
	<div class="form-group mb-3 col-12">
										<h5 class="h5_set"><i class="fa fa-list-alt"></i> Store  Category Information</h5>
										</div>
										<div class="form-group mb-3 col-12">
                                            <label> <span class="text-danger">*</span> Store Category(Multiple Select)</label>
                                           
                                        <select name="catsearch[]" id="product" class="select2-multi-select form-control" required multiple>
									  <?php 
$clist = $medi->query("select * from tbl_category");
$people = explode(',',$data['catid']);
while($row = $clist->fetch_assoc())
{
	?>
	<option value="<?php echo $row['id'];?>" <?php if(in_array($row['id'], $people)){echo 'selected';}?>><?php echo $row['title'];?></option>
	<?php 
}
?>
									   </select>
                                        </div>
										
										
										<div class="form-group mb-3 col-12">
										<h5 class="h5_set"><i class="fa fa-map-pin"></i> Store  Address Information</h5>
										</div>
										<div class="form-group mb-3 col-12">
                                            <label><span class="text-danger">*</span>Full Address</label>
                                            <input type="text" class="form-control " placeholder="Enter Full Address"  value="<?php echo $data['full_address'];?>"  name="FullAddress" required="">
                                        </div>
										


										<div class="form-group mb-3 col-6">
                                            <label><span class="text-danger">*</span>Pincode</label>
                                            <input type="text" class="form-control " placeholder="Enter Pincode"  value="<?php echo $data['pincode'];?>" name="pincode" required="">
                                        </div>
										
										<div class="form-group mb-3 col-6">
                                            <label><span class="text-danger">*</span>Landmark</label>
                                            <input type="text" class="form-control " placeholder="Enter Landmark"  value="<?php echo $data['landmark'];?>" name="landmark" required="">
                                        </div>
										
										<div class="form-group mb-3 col-6">
										 <label><span class="text-danger">*</span>Select Zone</label>
										<select name="zone_id" id="choice_zones" required class="form-control select2-single" data-placeholder="Select Zone" onchange="get_data(this.value)">
<option value="" selected disabled>Select
Zone</option>
<?php 
$zone = $medi->query("select * from zones");
while($row = $zone->fetch_assoc())
{
	?>
	<option value="<?php echo $row['id'];?>" <?php if($data['zone_id'] == $row['id']){echo 'selected';}?>><?php echo $row['title'];?></option>
	<?php 
}
?>
</select>


 <label style="margin-top:20px;"><span class="text-danger">*</span>Latitude</label>
                                            <input type="text" class="form-control " placeholder="Enter Latitude"  value="<?php echo $data['lats'];?>" id="latitude" name="latitude" required="">
											<br>
											<label><span class="text-danger">*</span>Longitude</label>
                                            <input type="text" class="form-control " placeholder="Enter Longitude"  value="<?php echo $data['longs'];?>" id="longitude" name="longitude" required="">
</div>

<div class="form-group mb-3 col-6">
<div id="map" style="width: 100%; height: 335px;"></div>
</div>
										
										
										

										

<div class="form-group mb-3 col-12">
										<h5 class="h5_set"><i class="fa fa-motorcycle"></i> Select  Service Charge Type</h5>
										</div>
										
										<div class="form-group mb-3 col-12">
                                            <label><span class="text-danger">*</span> Service Charge Type</label>
                                             <select name="charge_type" id="ctype" class="form-control" required>
											 <option value="">Select Type</option>
											<option value="1" <?php if($data['charge_type'] == 1){echo 'selected';}?>>Fixed Charge</option>
											<option value="2" <?php if($data['charge_type'] == 2){echo 'selected';}?>>Dynamic Charge</option>
											</select>
                                        </div>
										
										<div class="form-group mb-3 col-12">
                                            <label id="no1"><span class="text-danger">*</span> Service Charge</label>
                                            <input type="text" class="form-control numberonly" value="<?php echo $data['dcharge'];?>" placeholder="Enter Service Charge"  id="dcharge" name="dcharge">
                                        </div>
										
										<div class="form-group mb-3 col-4">
                                            <label id="no2"><span class="text-danger">*</span> Base Service Distance</label>
                                            <input type="text" class="form-control numberonly" value="<?php echo $data['ukm'];?>" placeholder="Enter Base Service Distance"  id="ukms" name="ukms">
                                        </div>
										
										<div class="form-group mb-3 col-4">
                                            <label id="no3"><span class="text-danger">*</span> Base Service Charge</label>
                                            <input type="text" class="form-control numberonly" value="<?php echo $data['uprice'];?>" placeholder="Enter Base Service Charge"  id="uprice" name="uprice">
                                        </div>
										
										<div class="form-group mb-3 col-4">
                                            <label id="no4"><span class="text-danger">*</span> Extra Service Charge</label>
                                            <input type="text" class="form-control numberonly" value="<?php echo $data['aprice'];?>" placeholder="Enter Service Charge"  id="aprice" name="aprice">
                                        </div>
										
<div class="form-group mb-3 col-12">
										<h5 class="h5_set"><i class="fa fa-motorcycle"></i> Store  Service Information</h5>
										</div>
										
										<div class="form-group mb-3 col-4">
                                            <label><span class="text-danger">*</span> Store Charge (Packing/Extra)</label>
                                            <input type="text" class="form-control numberonly" value="<?php echo $data['store_charge'];?>" placeholder="Enter Store Charge (Packing/Extra)"  name="scharge" required="">
                                        </div>
										
										
										
										
										
										<div class="form-group mb-3 col-4">
                                            <label><span class="text-danger">*</span>Min.Order Price</label>
                                            <input type="text" class="form-control numberonly" value="<?php echo $data['morder'];?>" placeholder="Enter Min.Order Price"  name="morder" required="">
                                        </div>
										
										<div class="form-group mb-3 col-12">
										<h5 class="h5_set"><i class="fa fa-percent"></i> Store  Admin Commission</h5>
										</div>
										<div class="form-group mb-3 col-12">
                                            <label><span class="text-danger">*</span>Commission Rate %</label>
                                            <input type="text" class="form-control numberonly" value="<?php echo $data['commission'];?>" placeholder="Enter Commission Rate %"  name="commission" required="">
                                        </div>
										<div class="form-group mb-3 col-12">
										<h5 class="h5_set"><i class="fa fa-money"></i> Store  Payout Information</h5>
										</div>
										<div class="form-group mb-3 col-6">
                                            <label><span class="text-danger">*</span>Bank Name</label>
                                            <input type="text" class="form-control " placeholder="Enter Bank Name" value="<?php echo $data['bank_name'];?>"  name="bname" required="">
                                        </div>
										
										<div class="form-group mb-3 col-6">
                                            <label><span class="text-danger">*</span>Bank Code/IFSC</label>
                                            <input type="text" class="form-control " placeholder="Enter Bank Code/IFSC" value="<?php echo $data['ifsc'];?>" name="ifsc" required="">
                                        </div>
										
										<div class="form-group mb-3 col-6">
                                            <label><span class="text-danger">*</span>Recipient Name</label>
                                            <input type="text" class="form-control " placeholder="Enter Recipient Name"  value="<?php echo $data['receipt_name'];?>" name="rname" required="">
                                        </div>
										
										<div class="form-group mb-3 col-6">
                                            <label><span class="text-danger">*</span>Account Number</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Account Number" value="<?php echo $data['acc_number'];?>" name="ano" required="">
                                        </div>
										
										<div class="form-group mb-3 col-6">
                                            <label><span class="text-danger">*</span>Paypal ID</label>
                                            <input type="text" class="form-control " placeholder="Enter Paypal ID" value="<?php echo $data['paypal_id'];?>" name="paypal" required="">
                                        </div>
										
										<div class="form-group mb-3 col-6">
                                            <label><span class="text-danger">*</span>UPI ID</label>
                                            <input type="text" class="form-control " placeholder="Enter UPI ID"   value="<?php echo $data['upi_id'];?>" name="upi" required="">
                                        </div>
										<div class="col-12">
                                                <button type="submit" name="add_rest" class="btn btn-primary mb-2">Edit Store</button>
                                            </div>
											</div>
                                    </form>
									</div>
					 <?php 
				 }
				 else 
				 {
				 ?>
				  <div class="card-body">
                  <h5 class="h5_set"><i class="fa fa-cutlery"></i>  Store  Information</h5>
				<form method="post"  enctype="multipart/form-data">
                                       <div class="row">
									    <div class="form-group mb-3 col-4">
                                            <label><span class="text-danger">*</span> Store Name</label>
                                            <input type="text" class="form-control " placeholder="Enter Store Name"  name="cname" required="">
											<input type="hidden" name="type" value="add_Store"/>
                                        </div>
										
                                      <div class="form-group mb-3 col-4">
                                            <label><span class="text-danger">*</span> Store LOGO</label>
                                            <div class="custom-file">
                                                <input type="file" name="kit_img" class="custom-file-input form-control" required>
                                                <label class="custom-file-label">Choose Store Image</label>
                                            </div>
                                        </div>
										
										<div class="form-group mb-3 col-4">
                                            <label><span class="text-danger">*</span> Store Cover Image</label>
                                            <div class="custom-file">
                                                <input type="file" name="cover_img" class="custom-file-input form-control" required>
                                                <label class="custom-file-label">Choose Store Cover Image</label>
                                            </div>
                                        </div>
										
										<div class="form-group mb-3 col-4">
                                            <label> <span class="text-danger">*</span> Store Status</label>
                                            <select name="status" class="form-control" required>
											<option value="">Select Option</option>
											<option value="1">Publish</option>
											<option value="0">UnPublish</option>
											</select>
                                        </div>
										
										<div class="form-group mb-3 col-4">
                                            <label><span class="text-danger">*</span> Rating</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Rating"  name="arate" required="">
                                        </div>
										
										
										
										
										
										<div class="form-group mb-3 col-4">
                                            <label>Certificate/License Code</label>
                                            <input type="text" class="form-control " placeholder="Enter Certificate/License Code"  name="lcode">
                                        </div>
										
										<div class="form-group mb-3 col-4">
                                            <label><span class="text-danger">*</span> Mobile number(With country code + sign)</label>
                                            <input type="text" class="form-control" placeholder="Enter Mobile number"  name="mobile" required="">
                                        </div>
										
										<div class="form-group mb-3 col-4">
                                            <label><span class="text-danger">*</span> Slogan Title</label>
                                            <input type="text" class="form-control" placeholder="Enter Slogan Title"  name="slogan" required="">
                                        </div>
										
										<div class="form-group mb-3 col-4">
                                            <label><span class="text-danger">*</span> Slogan Subtitle</label>
                                            <input type="text" class="form-control" placeholder="Enter Slogan Sub-Title"  name="slogan_title" required="">
                                        </div>
										
										<div class="form-group mb-3 col-4">
                                            <label><span class="text-danger">*</span> Store Open Time</label>
                                            <input type="time" class="form-control" placeholder="Enter Slogan Sub-Title"  name="opentime" required="">
                                        </div>
										
										<div class="form-group mb-3 col-4">
                                            <label><span class="text-danger">*</span> Store Close Time</label>
                                            <input type="time" class="form-control" placeholder="Enter Slogan Sub-Title"  name="closetime" required="">
                                        </div>
										
										<div class="form-group mb-3 col-4">
                                            <label> <span class="text-danger">*</span> Store Pickup Status</label>
                                            <select name="is_pickup" class="form-control" required>
											<option value="">Select Option</option>
											<option value="1">Yes</option>
											<option value="0">No</option>
											</select>
                                        </div>
										
										<div class="form-group mb-3 col-12">
                                            <label><span class="text-danger">*</span>Tags</label>
                                            <input type="text" class="form-control" data-role="tagsinput"    name="sdesc" required="">
                                        </div>
										
										<div class="form-group mb-3 col-12">
                                            <label><span class="text-danger">*</span>Short Description</label>
											<textarea class="form-control" rows="5"  name="cdesc" style="resize: none;"></textarea>
                                           
                                        </div>
										
										<div class="form-group mb-3 col-12">
                                            <label><span class="text-danger">*</span>Cancel Policy</label>
											<textarea class="form-control" rows="5"  name="cancle_policy" style="resize: none;"></textarea>
                                           
                                        </div>
										
										
	
	
	<div class="form-group mb-3 col-12">
										<h5 class="h5_set"><i class="fa fa-sign-in"></i> Store  Login Information</h5>
										</div>
										<div class="form-group mb-3 col-6">
                                            <label><span class="text-danger">*</span>Email Address</label>
                                            <input type="email" class="form-control " placeholder="Enter Email Address"  name="email" required="">
                                        </div>
										
										<div class="form-group mb-3 col-6">
                                            <label><span class="text-danger">*</span>Password</label>
                                            <input type="text" class="form-control " placeholder="Enter Password"  name="password" required="">
                                        </div>
	<div class="form-group mb-3 col-12">
										<h5 class="h5_set"><i class="fa fa-list-alt"></i> Store  Category Information</h5>
										</div>
										<div class="form-group mb-3 col-12">
                                            <label> <span class="text-danger">*</span> Store Category(Multiple Select)</label>
                                           
                                        <select name="catsearch[]" id="product" class="select2-multi-select form-control" required multiple>
									  <?php 
$zone = $medi->query("select * from tbl_category");
while($row = $zone->fetch_assoc())
{
	?>
	<option value="<?php echo $row['id'];?>"><?php echo $row['title'];?></option>
	<?php 
}
?>
									   </select>
                                        </div>
										
										
										<div class="form-group mb-3 col-12">
										<h5 class="h5_set"><i class="fa fa-map-pin"></i> Store  Address Information</h5>
										</div>
										<div class="form-group mb-3 col-12">
                                            <label><span class="text-danger">*</span>Full Address</label>
                                            <input type="text" class="form-control " placeholder="Enter Full Address"  name="FullAddress" required="">
                                        </div>
										


										<div class="form-group mb-3 col-6">
                                            <label><span class="text-danger">*</span>Pincode</label>
                                            <input type="text" class="form-control " placeholder="Enter Pincode"  name="pincode" required="">
                                        </div>
										
										<div class="form-group mb-3 col-6">
                                            <label><span class="text-danger">*</span>Landmark</label>
                                            <input type="text" class="form-control " placeholder="Enter Landmark"  name="landmark" required="">
                                        </div>
										
										<div class="form-group mb-3 col-6">
										 <label><span class="text-danger">*</span>Select Zone</label>
										<select name="zone_id" id="choice_zones" required class="form-control select2-single" data-placeholder="Select Zone" onchange="get_data(this.value)">
<option value="" selected disabled>Select
Zone</option>
<?php 
$zone = $medi->query("select * from zones");
while($row = $zone->fetch_assoc())
{
	?>
	<option value="<?php echo $row['id'];?>"><?php echo $row['title'];?></option>
	<?php 
}
?>
</select>


 <label style="margin-top:20px;"><span class="text-danger">*</span>Latitude</label>
                                            <input type="text" class="form-control " placeholder="Enter Latitude"  id="latitude" name="latitude" required="">
											<br>
											<label><span class="text-danger">*</span>Longitude</label>
                                            <input type="text" class="form-control " placeholder="Enter Longitude"  id="longitude" name="longitude" required="">
</div>

<div class="form-group mb-3 col-6">
<div id="map" style="width: 100%; height: 335px;"></div>
</div>
										
										
										

										

<div class="form-group mb-3 col-12">
										<h5 class="h5_set"><i class="fa fa-motorcycle"></i> Select  Service Charge Type</h5>
										</div>
										
										<div class="form-group mb-3 col-12">
                                            <label><span class="text-danger">*</span> Service Charge Type</label>
                                             <select name="charge_type" id="ctype" class="form-control" required>
											 <option value="">Select Type</option>
											<option value="1">Fixed Charge</option>
											<option value="2">Dynamic Charge</option>
											</select>
                                        </div>
										
										<div class="form-group mb-3 col-12">
                                            <label id="no1"><span class="text-danger">*</span> Service Charge</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Service Charge"  id="dcharge" name="dcharge">
                                        </div>
										
										<div class="form-group mb-3 col-4">
                                            <label id="no2"><span class="text-danger">*</span> Base Service Distance</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Base Service Distance"  id="ukms" name="ukms">
                                        </div>
										
										<div class="form-group mb-3 col-4">
                                            <label id="no3"><span class="text-danger">*</span> Base Service Charge</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Base Service Charge"  id="uprice" name="uprice">
                                        </div>
										
										<div class="form-group mb-3 col-4">
                                            <label id="no4"><span class="text-danger">*</span> Extra Service Charge</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Service Charge"  id="aprice" name="aprice">
                                        </div>
										
<div class="form-group mb-3 col-12">
										<h5 class="h5_set"><i class="fa fa-motorcycle"></i> Store  Service Information</h5>
										</div>
										
										<div class="form-group mb-3 col-4">
                                            <label><span class="text-danger">*</span> Store Charge (Packing/Extra)</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Store Charge (Packing/Extra)"  name="scharge" required="">
                                        </div>
										
										
										
										
										
										<div class="form-group mb-3 col-4">
                                            <label><span class="text-danger">*</span>Min.Order Price</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Min.Order Price"  name="morder" required="">
                                        </div>
										
										<div class="form-group mb-3 col-12">
										<h5 class="h5_set"><i class="fa fa-percent"></i> Store  Admin Commission</h5>
										</div>
										<div class="form-group mb-3 col-12">
                                            <label><span class="text-danger">*</span>Commission Rate %</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Commission Rate %"  name="commission" required="">
                                        </div>
										<div class="form-group mb-3 col-12">
										<h5 class="h5_set"><i class="fa fa-money"></i> Store  Payout Information</h5>
										</div>
										<div class="form-group mb-3 col-6">
                                            <label><span class="text-danger">*</span>Bank Name</label>
                                            <input type="text" class="form-control " placeholder="Enter Bank Name"  name="bname" required="">
                                        </div>
										
										<div class="form-group mb-3 col-6">
                                            <label><span class="text-danger">*</span>Bank Code/IFSC</label>
                                            <input type="text" class="form-control " placeholder="Enter Bank Code/IFSC"  name="ifsc" required="">
                                        </div>
										
										<div class="form-group mb-3 col-6">
                                            <label><span class="text-danger">*</span>Recipient Name</label>
                                            <input type="text" class="form-control " placeholder="Enter Recipient Name"  name="rname" required="">
                                        </div>
										
										<div class="form-group mb-3 col-6">
                                            <label><span class="text-danger">*</span>Account Number</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Account Number"  name="ano" required="">
                                        </div>
										
										<div class="form-group mb-3 col-6">
                                            <label><span class="text-danger">*</span>Paypal ID</label>
                                            <input type="text" class="form-control " placeholder="Enter Paypal ID"  name="paypal" required="">
                                        </div>
										
										<div class="form-group mb-3 col-6">
                                            <label><span class="text-danger">*</span>UPI ID</label>
                                            <input type="text" class="form-control " placeholder="Enter UPI ID"  name="upi" required="">
                                        </div>
										<div class="col-12">
                                                <button type="submit" name="add_rest" class="btn btn-primary mb-2">Add Store</button>
                                            </div>
											</div>
                                    </form>
									</div>
				 <?php } ?>
                </div>
              
                
              </div>
              
              
              
              
              
              
              
            </div>
		  </div>
          <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->
        
      </div>
    </div>
	<script type="text/javascript">
           var map;
var bounds;
 var polytototo = null;
let myLatlng = {
            lat: 21.2266,
            lng: 72.8312
        };
		
function initMap() {

  map = new google.maps.Map(document.getElementById('map'), {
    zoom: 13,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
    
  });
  bounds = new google.maps.LatLngBounds();
  map.fitBounds(bounds);
  infoWindow = new google.maps.InfoWindow({
            content: "Click the map to get Lat/Lng!",
            position: myLatlng,
        });
		infoWindow.open(map);
}



		function get_data(id) {
	
	
			
			$("#rider_id").val('').trigger('change');
			
            $.get({
                url: 'sety.php?id='+ id,
                dataType: 'json',
                success: function(data) {
				
                    if (polytototo) {
                        polytototo.setMap(null);
                    }
                    polytototo = new google.maps.Polygon({
                        paths: data.coordinates,
                        strokeColor: "#FF0000",
                        strokeOpacity: 0.8,
                        strokeWeight: 2,
                        fillColor: 'white',
                        fillOpacity: 0,
                    });
                    polytototo.setMap(map);
                    map.setCenter(data.center);
					map.setZoom(10);
                    google.maps.event.addListener(polytototo, 'click', function(mapsMouseEvent) {
                        infoWindow.close();
                        var coordinates = JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2);
                        var coordinates = JSON.parse(coordinates);

                       document.getElementById('latitude').value = coordinates['lat'];
                        document.getElementById('longitude').value = coordinates['lng'];
					   infoWindow = new google.maps.InfoWindow({
                            position: mapsMouseEvent.latLng,
                            content: JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2),
                        });
						infoWindow.open(map);
                    });
					
				
                },
            });
			
		
			
        }
		
		

        </script>
		<script src="<?php echo $protocol; ?>maps.google.com/maps/api/js?key=<?php echo $set['gkey']; ?>&callback=initMap" type="text/javascript" async defer></script>
    <!-- latest jquery-->
     <?php 
		include 'controller/pharma.php';
		?>
    
	<script>
	$(document).ready(function() { 
            var id = $('#choice_zones').val();
			
            $.get({
                url: 'sety.php?id=' + id,
                dataType: 'json',
                success: function(data) {
					
                    if (polytototo) {
                        polytototo.setMap(null);
                    }
                    polytototo = new google.maps.Polygon({
                        paths: data.coordinates,
                       strokeColor: "#FF0000",
                        strokeOpacity: 0.8,
                        strokeWeight: 2,
                        fillColor: 'white',
                        fillOpacity: 0,
                    });
                    polytototo.setMap(map);
                    polytototo.getPaths().forEach(function(path) {
                        path.forEach(function(latlng) {
                            bounds.extend(latlng);
                            map.fitBounds(bounds);
                        });
                    });
                    map.setCenter(data.center);
					map.setZoom(10);
                    google.maps.event.addListener(polytototo, 'click', function(mapsMouseEvent) {
                        
                        // Create a new InfoWindow.
                        
                        var coordinates = JSON.stringify(mapsMouseEvent.latLng.toJSON(), null,
                            2);
                        var coordinates = JSON.parse(coordinates);

                        document.getElementById('latitude').value = coordinates['lat'];
                        document.getElementById('longitude').value = coordinates['lng'];
						infoWindow.close();
						 infoWindow = new google.maps.InfoWindow({
                            position: mapsMouseEvent.latLng,
                            content: JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2),
                        });
                        infoWindow.open(map);
                    });
                },
            });
        });
		
		
	</script>
	 <?php 
	 if(isset($_GET['id']))
	 {
		 if($data['charge_type'] == 1)
		 {
			 ?>
			  <script>
	 	$("#no1").show();
	$("#no2").hide();
	$("#no3").hide();
	$("#no4").hide();
	$("#dcharge").show();
		$("#ukms").hide();
		$("#uprice").hide();
		$("#aprice").hide();
		$("#dcharge").attr("required","required");
		$("#ukms").removeAttr("required");
	$("#uprice").removeAttr("required");
	$("#aprice").removeAttr("required");
	 </script>
			 <?php 
		 }
		 else if($data['charge_type'] == 2)
		 {
			 ?>
			 <script>
	 	$("#no1").hide();
	$("#no2").show();
	$("#no3").show();
	$("#no4").show();
	$("#dcharge").hide();
		$("#ukms").show();
		$("#uprice").show();
		$("#aprice").show();
		$("#dcharge").removeAttr("required");
		$("#ukms").attr("required","required");
	$("#uprice").attr("required","required");
	$("#aprice").attr("required","required");
	 </script>
			 <?php 
		 }
		 else 
		 {
		 
	 
	 ?>
	 <script>
	 	$("#no1").hide();
	$("#no2").hide();
	$("#no3").hide();
	$("#no4").hide();
	$("#dcharge").hide();
		$("#ukms").hide();
		$("#uprice").hide();
		$("#aprice").hide();
		$("#dcharge").removeAttr("required");
		$("#ukms").removeAttr("required");
	$("#uprice").removeAttr("required");
	$("#aprice").removeAttr("required");
	 </script>
	 <?php } } else {?>
	  <script>
	 	$("#no1").hide();
	$("#no2").hide();
	$("#no3").hide();
	$("#no4").hide();
	$("#dcharge").hide();
		$("#ukms").hide();
		$("#uprice").hide();
		$("#aprice").hide();
		$("#dcharge").removeAttr("required");
		$("#ukms").removeAttr("required");
	$("#uprice").removeAttr("required");
	$("#aprice").removeAttr("required");
	 </script>
	 <?php } ?>
	<script>

	$(document).on('change','#ctype',function(){
	if($(this).val() == 1)
	{
		$("#dcharge").show();
		$("#ukms").hide();
		$("#uprice").hide();
		$("#aprice").hide();
		$("#no1").show();
	$("#no2").hide();
	$("#no3").hide();
	$("#no4").hide();
	$("#dcharge").attr("required","required");
	$("#ukms").removeAttr("required");
	$("#uprice").removeAttr("required");
	$("#aprice").removeAttr("required");
	}
	else if($(this).val() == 2)
	{
		$("#dcharge").hide();
		$("#ukms").show();
		$("#uprice").show();
		$("#aprice").show();
		$("#no1").hide();
	$("#no2").show();
	$("#no3").show();
	$("#no4").show();

$("#dcharge").removeAttr("required");
	$("#ukms").attr("required","required");
	$("#uprice").attr("required","required");
	$("#aprice").attr("required","required");
	}
	else 
	{
		$("#no1").hide();
	$("#no2").hide();
	$("#no3").hide();
	$("#no4").hide();
	$("#dcharge").hide();
		$("#ukms").hide();
		$("#uprice").hide();
		$("#aprice").hide();
		$("#dcharge").removeAttr("required");
		$("#ukms").removeAttr("required");
	$("#uprice").removeAttr("required");
	$("#aprice").removeAttr("required");
	}
	});
	</script>
  </body>


</html>