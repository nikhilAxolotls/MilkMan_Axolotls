<?php 
include 'controller/header.php';
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
                  <h3>Zone Management</h3>
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
				
                  
                    <div class="default-according-page default-according" id="accordionclose">
                      <div class="card">
                        <div class="card-header pb-0" id="headingFour">
                          <h5 class="mb-0">
                            <button class="btn btn-link ps-0" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">Instruction <span>(Click Here)</span></button>
                          </h5>
                        </div>
                        <div class="collapse" id="collapseFour" aria-labelledby="headingOne" data-bs-parent="#accordionclose">
                          <div class="card-body">Create zone by click on map and connect the dots together.
										<p></p>
										<p>
										
										
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px" viewBox="0 0 20 20" version="1.1">
<g id="surface1">
<path style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,40.784314%,30.196078%);fill-opacity:1;" d="M 2.699219 5.179688 C 2.699219 3.804688 3.816406 2.6875 5.191406 2.6875 C 5.414062 2.6875 5.59375 2.503906 5.59375 2.28125 C 5.59375 2.058594 5.414062 1.878906 5.191406 1.878906 C 3.371094 1.878906 1.890625 3.359375 1.890625 5.179688 C 1.890625 5.402344 2.074219 5.582031 2.292969 5.582031 C 2.515625 5.582031 2.699219 5.402344 2.699219 5.179688 Z M 2.699219 5.179688 "/>
<path style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,40.784314%,30.196078%);fill-opacity:1;" d="M 5.191406 0.804688 C 5.414062 0.804688 5.59375 0.625 5.59375 0.402344 C 5.59375 0.179688 5.414062 0 5.191406 0 C 2.335938 0 0.0117188 2.324219 0.0117188 5.179688 C 0.0117188 5.402344 0.191406 5.582031 0.414062 5.582031 C 0.636719 5.582031 0.820312 5.402344 0.820312 5.179688 C 0.820312 2.769531 2.78125 0.804688 5.191406 0.804688 Z M 5.191406 0.804688 "/>
<path style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,40.784314%,30.196078%);fill-opacity:1;" d="M 14.808594 1.878906 C 14.585938 1.878906 14.40625 2.058594 14.40625 2.28125 C 14.40625 2.503906 14.585938 2.6875 14.808594 2.6875 C 16.183594 2.6875 17.300781 3.804688 17.300781 5.179688 C 17.300781 5.402344 17.484375 5.582031 17.707031 5.582031 C 17.925781 5.582031 18.109375 5.402344 18.109375 5.179688 C 18.109375 3.359375 16.628906 1.878906 14.808594 1.878906 Z M 14.808594 1.878906 "/>
<path style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,40.784314%,30.196078%);fill-opacity:1;" d="M 14.808594 0 C 14.585938 0 14.40625 0.179688 14.40625 0.402344 C 14.40625 0.625 14.585938 0.804688 14.808594 0.804688 C 17.21875 0.804688 19.179688 2.769531 19.179688 5.179688 C 19.179688 5.402344 19.363281 5.582031 19.585938 5.582031 C 19.808594 5.582031 19.988281 5.402344 19.988281 5.179688 C 19.988281 2.324219 17.664062 0 14.808594 0 Z M 14.808594 0 "/>
<path style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,83.137255%,76.862745%);fill-opacity:1;" d="M 16.160156 10.410156 L 16.160156 7.121094 C 16.160156 6.625 15.777344 6.222656 15.285156 6.222656 C 15.25 6.222656 15.226562 6.222656 15.191406 6.226562 C 14.734375 6.28125 14.410156 6.6875 14.410156 7.148438 L 14.410156 9.996094 C 14.410156 10.222656 14.226562 10.40625 13.996094 10.40625 L 13.988281 10.40625 C 13.738281 10.40625 13.539062 10.210938 13.539062 9.960938 L 13.539062 5.367188 C 13.539062 4.90625 13.203125 4.5 12.746094 4.449219 C 12.710938 4.441406 12.667969 4.441406 12.632812 4.441406 C 12.136719 4.441406 11.722656 4.84375 11.722656 5.339844 L 11.722656 9.976562 C 11.722656 10.214844 11.53125 10.410156 11.289062 10.410156 C 11.046875 10.410156 10.851562 10.214844 10.851562 9.972656 L 10.851562 4.074219 C 10.851562 3.613281 10.523438 3.207031 10.066406 3.152344 C 10.03125 3.148438 9.984375 3.148438 9.949219 3.148438 C 9.453125 3.148438 9.039062 3.550781 9.039062 4.046875 L 9.039062 9.972656 C 9.039062 10.214844 8.839844 10.410156 8.597656 10.410156 C 8.359375 10.410156 8.164062 10.214844 8.164062 9.976562 L 8.164062 5.367188 C 8.164062 4.90625 7.847656 4.5 7.386719 4.449219 C 7.351562 4.441406 7.300781 4.441406 7.265625 4.441406 C 6.769531 4.441406 6.351562 4.84375 6.351562 5.339844 L 6.351562 12.03125 C 6.351562 12.28125 6.171875 12.445312 5.960938 12.445312 C 5.863281 12.445312 5.773438 12.410156 5.691406 12.332031 L 4.632812 11.324219 C 4.457031 11.152344 4.234375 11.066406 4.003906 11.066406 C 3.777344 11.066406 3.550781 11.152344 3.378906 11.324219 C 3.03125 11.671875 3.03125 12.238281 3.378906 12.582031 L 7.167969 17.582031 L 7.261719 18.851562 C 7.277344 19.046875 7.441406 19.207031 7.640625 19.207031 L 14.253906 19.195312 C 14.445312 19.195312 14.601562 19.050781 14.628906 18.863281 L 14.800781 17.546875 C 14.808594 17.492188 14.804688 17.4375 14.832031 17.390625 C 15.84375 15.816406 16.160156 13.21875 16.160156 10.410156 Z M 16.160156 10.410156 "/>
<path style=" stroke:none;fill-rule:nonzero;fill:rgb(0%,0%,0%);fill-opacity:1;" d="M 15.285156 5.414062 C 15.21875 5.414062 15.164062 5.417969 15.097656 5.425781 C 14.8125 5.460938 14.546875 5.5625 14.34375 5.714844 L 14.34375 5.367188 C 14.34375 4.484375 13.699219 3.746094 12.839844 3.648438 C 12.773438 3.640625 12.707031 3.636719 12.640625 3.636719 C 12.289062 3.636719 11.953125 3.742188 11.671875 3.9375 C 11.609375 3.117188 10.984375 2.449219 10.167969 2.355469 C 10.101562 2.347656 10.035156 2.34375 9.96875 2.34375 C 9.515625 2.34375 9.085938 2.519531 8.765625 2.84375 C 8.46875 3.140625 8.292969 3.527344 8.269531 3.941406 C 8.046875 3.785156 7.785156 3.679688 7.5 3.648438 C 7.433594 3.640625 7.367188 3.636719 7.300781 3.636719 C 6.84375 3.636719 6.390625 3.8125 6.070312 4.136719 C 5.746094 4.457031 5.542969 4.886719 5.542969 5.339844 L 5.542969 11.121094 L 5.171875 10.746094 C 4.855469 10.433594 4.445312 10.257812 3.996094 10.257812 C 3.542969 10.257812 3.121094 10.433594 2.800781 10.753906 C 2.15625 11.402344 2.144531 12.445312 2.761719 13.109375 L 6.382812 17.878906 L 6.457031 18.90625 C 6.503906 19.519531 7.023438 20 7.640625 20 L 14.253906 19.996094 C 14.847656 19.992188 15.351562 19.550781 15.425781 18.964844 L 15.585938 17.742188 C 16.09375 16.921875 16.445312 15.832031 16.679688 14.503906 C 16.886719 13.34375 16.964844 11.964844 16.964844 10.410156 L 16.964844 7.121094 C 16.964844 6.179688 16.226562 5.414062 15.285156 5.414062 Z M 14.628906 18.859375 C 14.601562 19.046875 14.445312 19.195312 14.253906 19.195312 L 7.640625 19.207031 C 7.441406 19.207031 7.277344 19.046875 7.261719 18.851562 L 7.167969 17.585938 C 7.167969 17.585938 7.167969 17.582031 7.167969 17.582031 L 3.378906 12.585938 C 3.03125 12.238281 3.03125 11.671875 3.378906 11.324219 C 3.550781 11.152344 3.78125 11.066406 4.007812 11.066406 C 4.234375 11.066406 4.464844 11.152344 4.636719 11.324219 L 5.703125 12.332031 C 5.785156 12.410156 5.863281 12.445312 5.960938 12.445312 C 6.171875 12.445312 6.351562 12.28125 6.351562 12.03125 L 6.351562 5.339844 C 6.351562 4.84375 6.78125 4.441406 7.273438 4.441406 C 7.308594 4.441406 7.339844 4.441406 7.375 4.449219 C 7.832031 4.5 8.164062 4.90625 8.164062 5.367188 L 8.164062 9.976562 C 8.164062 10.214844 8.359375 10.410156 8.597656 10.410156 C 8.839844 10.410156 9.035156 10.214844 9.035156 9.972656 L 9.035156 4.046875 C 9.035156 3.550781 9.457031 3.148438 9.953125 3.148438 C 9.988281 3.148438 10.023438 3.148438 10.058594 3.152344 C 10.515625 3.207031 10.851562 3.613281 10.851562 4.074219 L 10.851562 9.972656 C 10.851562 10.214844 11.046875 10.410156 11.289062 10.410156 C 11.53125 10.410156 11.722656 10.214844 11.722656 9.976562 L 11.722656 5.339844 C 11.722656 4.84375 12.136719 4.441406 12.632812 4.441406 C 12.667969 4.441406 12.707031 4.441406 12.742188 4.449219 C 13.199219 4.5 13.539062 4.90625 13.539062 5.367188 L 13.539062 9.960938 C 13.539062 10.210938 13.738281 10.40625 13.988281 10.40625 L 13.996094 10.40625 C 14.226562 10.40625 14.410156 10.222656 14.410156 9.996094 L 14.410156 7.148438 C 14.410156 6.6875 14.746094 6.28125 15.203125 6.226562 C 15.238281 6.222656 15.25 6.222656 15.285156 6.222656 C 15.777344 6.222656 16.15625 6.625 16.15625 7.121094 L 16.15625 10.410156 C 16.15625 13.21875 15.84375 15.816406 14.832031 17.386719 C 14.804688 17.4375 14.796875 17.488281 14.789062 17.546875 Z M 14.628906 18.859375 "/>
</g>
</svg>


 Use this to drag map to find proper area.</p>
										
										<p></p>
										<p></p>
										<p style="    margin-top: 16px;">
										
										
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px" viewBox="0 0 20 20" version="1.1">
<g id="surface1">
<path style=" stroke:none;fill-rule:nonzero;fill:rgb(90.980392%,90.980392%,90.980392%);fill-opacity:1;" d="M 14.6875 0 L 2.5 0 L 2.5 20 L 17.5 20 L 17.5 3.125 L 14.6875 3.125 Z M 14.6875 0 "/>
<path style=" stroke:none;fill-rule:nonzero;fill:rgb(60%,60%,60%);fill-opacity:1;" d="M 14.6875 3.125 L 17.5 3.125 L 14.6875 0 Z M 14.6875 3.125 "/>
<path style=" stroke:none;fill-rule:nonzero;fill:rgb(20%,20%,20%);fill-opacity:1;" d="M 12.503906 8.996094 L 7.660156 11.390625 L 7.386719 10.828125 L 12.226562 8.433594 Z M 12.503906 8.996094 "/>
<path style=" stroke:none;fill-rule:nonzero;fill:rgb(20%,20%,20%);fill-opacity:1;" d="M 12.550781 14.125 L 12.269531 14.679688 L 7.382812 12.222656 L 7.660156 11.664062 Z M 12.550781 14.125 "/>
<path style=" stroke:none;fill-rule:nonzero;fill:rgb(4.313725%,64.313725%,87.843137%);fill-opacity:1;" d="M 8.453125 11.519531 C 8.453125 12.371094 7.761719 13.0625 6.90625 13.0625 C 6.050781 13.0625 5.359375 12.371094 5.359375 11.519531 C 5.359375 10.664062 6.050781 9.972656 6.90625 9.972656 C 7.761719 9.972656 8.453125 10.664062 8.453125 11.519531 Z M 8.453125 11.519531 "/>
<path style=" stroke:none;fill-rule:nonzero;fill:rgb(4.313725%,64.313725%,87.843137%);fill-opacity:1;" d="M 14.640625 8.359375 C 14.640625 9.214844 13.945312 9.90625 13.09375 9.90625 C 12.238281 9.90625 11.546875 9.214844 11.546875 8.359375 C 11.546875 7.507812 12.238281 6.8125 13.09375 6.8125 C 13.945312 6.8125 14.640625 7.507812 14.640625 8.359375 Z M 14.640625 8.359375 "/>
<path style=" stroke:none;fill-rule:nonzero;fill:rgb(4.313725%,64.313725%,87.843137%);fill-opacity:1;" d="M 14.625 14.675781 C 14.625 15.53125 13.933594 16.222656 13.078125 16.222656 C 12.222656 16.222656 11.53125 15.53125 11.53125 14.675781 C 11.53125 13.824219 12.222656 13.128906 13.078125 13.128906 C 13.933594 13.128906 14.625 13.824219 14.625 14.675781 Z M 14.625 14.675781 "/>
</g>
</svg>

 Click this icon to start pin points in the map and connect them to draw a zone . Minimum 3 points required</p>
										
										<p></p>
										<p><img src="images/map/idea.gif" alt="instructions"></p></div>
                        </div>
                      </div>
                      
                    </div>
                  
               
              
								
                 <?php 
				 if(isset($_GET['id']))
				 {
					 $data = $medi->query("select * from zones where id=".$_GET['id']."")->fetch_assoc();
					 ?>
					  <div class="card-body">
					<form method="post" enctype="multipart/form-data">
                                            <div class="row">
											<div class="form-group mb-3">
												<label for="a2" class="il-gray fs-14 fw-500 align-center">Zone Name</label>
                                                   
                                                    <input type="text" class="form-control" placeholder="Enter Zone Name" value="<?php echo $data['title'];?>" name="zname" required>
													<input type="hidden" name="type" value="edit_zone"/>
										<input type="hidden" name="id" value="<?php echo $_GET['id'];?>"/>
                                                </div>
												
												
												<div class="form-group mb-3">
												<label for="a2" class="il-gray fs-14 fw-500 align-center">Zone Status</label>
                                                    
                                                    <select name="status" class="form-control" required>
													<option value="">Select Status</option>
											<option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
											<option value="0" <?php if($data['status'] == 0){echo 'selected';}?>>UnPublish</option>
											</select>
                                                </div>
												
												
												<div class="form-group mb-3">
<label class="input-label" for="exampleFormControlInput1">Coordinates<span class="input-label-secondary" title="(draw your zone area on the map)">(draw your zone area on the map)</span></label>
<textarea type="text" rows="8" name="coordinates" id="coordinates" class="form-control" readonly="" style="height: 40px;"><?php echo $data['alias'];?></textarea>
</div>
												
												<div class="form-group mb-3" style="height:500px;">
												<input id="pac-input" class="controls rounded" style="height: 3em;width:fit-content;" title="Search your location here" type="text" placeholder="Search here" />
<div id="map-canvas" style="height: 100%; margin:0px; padding: 0px;"></div>
												</div>
                                                </div>
                                                <div class="form-group mb-0">
                                                    <button type="submit" name="edit_restban" class="btn btn-primary w-md">Edit  Zone</button>
                                                </div>
                                            
                                        </form>
										</div>
					 <?php 
				 }
				 else 
				 {
				 ?>
				 <div class="card-body">
                  <form method="post" enctype="multipart/form-data">
                                            <div class="row">
											
                                                <div class="form-group mb-3">
												<label for="a2" class="il-gray fs-14 fw-500 align-center">Zone Name</label>
                                                   
                                                    <input type="text" class="form-control" placeholder="Enter Zone Name" name="zname" required>
													<input type="hidden" name="type" value="add_zone"/>
                                                </div>
												
												
												<div class="form-group  mb-3">
												<label for="a2" class="il-gray fs-14 fw-500 align-center">Zone Status</label>
                                                    
                                                    <select name="status" class="form-control" required>
													<option value="">Select Status</option>
											<option value="1">Publish</option>
											<option value="0">UnPublish</option>
											</select>
                                                </div>
												
												<div class="form-group  mb-3">
<label class="input-label" for="exampleFormControlInput1">Coordinates<span class="input-label-secondary" title="(draw your zone area on the map)">(draw your zone area on the map)</span></label>
<textarea type="text" rows="8" name="coordinates" id="coordinates" class="form-control" readonly="" style="height: 40px;"></textarea>
</div>
												
												<div class="form-group  mb-3" style="height:500px;">
												<input id="pac-input" class="controls rounded" style="height: 3em;width:fit-content;" title="Search your location here" type="text" placeholder="Search here" />
<div id="map-canvas" style="height: 100%; margin:0px; padding: 0px;"></div>
												</div>
                                                </div>
                                                <div class="form-group mb-0">
                                                    <button type="submit" name="add_ban" class="btn btn-primary w-md">Add  Zone</button>
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
    <!-- latest jquery-->
     <?php 
		include 'controller/pharma.php';
		?>
    <?php      if(!isset($_GET['id']))
				{
					?>
		<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $set['gkey']; ?>&libraries=drawing,places&v=3.45.8"></script> 			
		<script>
		
        var map; // Global declaration of the map
        var drawingManager;
        var lastpolygon = null;
        var polygons = [];

        function resetMap(controlDiv) {
            // Set CSS for the control border.
            const controlUI = document.createElement("div");
            controlUI.style.backgroundColor = "#fff";
            controlUI.style.border = "2px solid #fff";
            controlUI.style.borderRadius = "3px";
            controlUI.style.boxShadow = "0 2px 6px rgba(0,0,0,.3)";
            controlUI.style.cursor = "pointer";
            controlUI.style.marginTop = "8px";
            controlUI.style.marginBottom = "22px";
            controlUI.style.textAlign = "center";
            controlUI.title = "Reset map";
            controlDiv.appendChild(controlUI);
            // Set CSS for the control interior.
            const controlText = document.createElement("div");
            controlText.style.color = "rgb(25,25,25)";
            controlText.style.fontFamily = "Roboto,Arial,sans-serif";
            controlText.style.fontSize = "10px";
            controlText.style.lineHeight = "16px";
            controlText.style.paddingLeft = "2px";
            controlText.style.paddingRight = "2px";
            controlText.innerHTML = "X";
            controlUI.appendChild(controlText);
            // Setup the click event listeners: simply set the map to Chicago.
            controlUI.addEventListener("click", () => {
                lastpolygon.setMap(null);
                $('#coordinates').val('');
                
            });
        }

        function initialize() {
                                    var myLatlng = { lat: 21.2408, lng: 72.8806 };


            var myOptions = {
                zoom: 13,
                center: myLatlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);
            drawingManager = new google.maps.drawing.DrawingManager({
                drawingMode: google.maps.drawing.OverlayType.POLYGON,
                drawingControl: true,
                drawingControlOptions: {
                position: google.maps.ControlPosition.TOP_CENTER,
                drawingModes: [google.maps.drawing.OverlayType.POLYGON]
                },
                polygonOptions: {
                editable: true
                }
            });
            drawingManager.setMap(map);


            //get current location block
            // infoWindow = new google.maps.InfoWindow();
            // Try HTML5 geolocation.
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                    const pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude,
                    };
                    map.setCenter(pos);
                });
            }

            google.maps.event.addListener(drawingManager, "overlaycomplete", function(event) {
                if(lastpolygon)
                {
                    lastpolygon.setMap(null);
                }
                $('#coordinates').val(event.overlay.getPath().getArray());
                lastpolygon = event.overlay;
                auto_grow();
            });

            const resetDiv = document.createElement("div");
            resetMap(resetDiv, lastpolygon);
            map.controls[google.maps.ControlPosition.TOP_CENTER].push(resetDiv);

            // Create the search box and link it to the UI element.
            const input = document.getElementById("pac-input");
            const searchBox = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);
            // Bias the SearchBox results towards current map's viewport.
            map.addListener("bounds_changed", () => {
                searchBox.setBounds(map.getBounds());
            });
            let markers = [];
            // Listen for the event fired when the user selects a prediction and retrieve
            // more details for that place.
            searchBox.addListener("places_changed", () => {
                const places = searchBox.getPlaces();

                if (places.length == 0) {
                return;
                }
                // Clear out the old markers.
                markers.forEach((marker) => {
                marker.setMap(null);
                });
                markers = [];
                // For each place, get the icon, name and location.
                const bounds = new google.maps.LatLngBounds();
                places.forEach((place) => {
                if (!place.geometry || !place.geometry.location) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                const icon = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25),
                };
                // Create a marker for each place.
                markers.push(
                    new google.maps.Marker({
                    map,
                    icon,
                    title: place.name,
                    position: place.geometry.location,
                    })
                );

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
                });
                map.fitBounds(bounds);
            });
        }

function auto_grow() {
        let element = document.getElementById("coordinates");
        element.style.height = "5px";
        element.style.height = (element.scrollHeight)+"px";
    }
        google.maps.event.addDomListener(window, 'load', initialize);
		</script>
				<?php } else { ?>
		<script src="https://maps.googleapis.com/maps/api/js?v=3.45.8&key=<?php echo $set['gkey']; ?>&libraries=drawing,places"></script>
	<script>
    auto_grow();
    function auto_grow() {
        let element = document.getElementById("coordinates");
        element.style.height = "5px";
        element.style.height = (element.scrollHeight)+"px";
    }

</script>
<script>
    var map; // Global declaration of the map
    var lat_longs = new Array();
    var drawingManager;
    var lastpolygon = null;
    var bounds = new google.maps.LatLngBounds();
    var polygons = [];


    function resetMap(controlDiv) {
        // Set CSS for the control border.
        const controlUI = document.createElement("div");
        controlUI.style.backgroundColor = "#fff";
        controlUI.style.border = "2px solid #fff";
        controlUI.style.borderRadius = "3px";
        controlUI.style.boxShadow = "0 2px 6px rgba(0,0,0,.3)";
        controlUI.style.cursor = "pointer";
        controlUI.style.marginTop = "8px";
        controlUI.style.marginBottom = "22px";
        controlUI.style.textAlign = "center";
        controlUI.title = "Reset map";
        controlDiv.appendChild(controlUI);
        // Set CSS for the control interior.
        const controlText = document.createElement("div");
        controlText.style.color = "rgb(25,25,25)";
        controlText.style.fontFamily = "Roboto,Arial,sans-serif";
        controlText.style.fontSize = "10px";
        controlText.style.lineHeight = "16px";
        controlText.style.paddingLeft = "2px";
        controlText.style.paddingRight = "2px";
        controlText.innerHTML = "X";
        controlUI.appendChild(controlText);
        // Setup the click event listeners: simply set the map to Chicago.
        controlUI.addEventListener("click", () => {
            lastpolygon.setMap(null);
            $('#coordinates').val('');

        });
    }

    function initialize() {
        var myLatlng = new google.maps.LatLng(9.92860128540477, 78.12647712771778);
        var myOptions = {
            zoom: 13,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);

        
		$.get({
		
		url:'setzone.php',
data:
				{
				id:<?php echo $_GET['id'];?>
				},
                dataType: 'json',
                success: function(data) {
        const polygonCoords = data;

        var zonePolygon = new google.maps.Polygon({
            paths: polygonCoords,
            strokeColor: "#FF0000",
                        strokeOpacity: 0.8,
                        strokeWeight: 2,
                        fillColor: "#FF0000",
                        fillOpacity: 0.1,
        });

        zonePolygon.setMap(map);

        zonePolygon.getPaths().forEach(function(path) {
            path.forEach(function(latlng) {
                bounds.extend(latlng);
                map.fitBounds(bounds);
            });
        });
		}
		});


        drawingManager = new google.maps.drawing.DrawingManager({
            drawingMode: google.maps.drawing.OverlayType.POLYGON,
            drawingControl: true,
            drawingControlOptions: {
            position: google.maps.ControlPosition.TOP_CENTER,
            drawingModes: [google.maps.drawing.OverlayType.POLYGON]
            },
            polygonOptions: {
            editable: true
            }
        });
        drawingManager.setMap(map);

        google.maps.event.addListener(drawingManager, "overlaycomplete", function(event) {
            var newShape = event.overlay;
            newShape.type = event.type;
        });

        google.maps.event.addListener(drawingManager, "overlaycomplete", function(event) {
            if(lastpolygon)
                {
                    lastpolygon.setMap(null);
                }
                $('#coordinates').val(event.overlay.getPath().getArray());
                lastpolygon = event.overlay;
                auto_grow();
        });
        const resetDiv = document.createElement("div");
        resetMap(resetDiv, lastpolygon);
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(resetDiv);

        // Create the search box and link it to the UI element.
        const input = document.getElementById("pac-input");
            const searchBox = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);
            // Bias the SearchBox results towards current map's viewport.
            map.addListener("bounds_changed", () => {
                searchBox.setBounds(map.getBounds());
            });
            let markers = [];
            // Listen for the event fired when the user selects a prediction and retrieve
            // more details for that place.
            searchBox.addListener("places_changed", () => {
                const places = searchBox.getPlaces();

                if (places.length == 0) {
                return;
                }
                // Clear out the old markers.
                markers.forEach((marker) => {
                marker.setMap(null);
                });
                markers = [];
                // For each place, get the icon, name and location.
                const bounds = new google.maps.LatLngBounds();
                places.forEach((place) => {
                if (!place.geometry || !place.geometry.location) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                const icon = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25),
                };
                // Create a marker for each place.
                markers.push(
                    new google.maps.Marker({
                    map,
                    icon,
                    title: place.name,
                    position: place.geometry.location,
                    })
                );

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
                });
                map.fitBounds(bounds);
            });
    }
    google.maps.event.addDomListener(window, 'load', initialize);



</script>
				<?php } ?>
  </body>


</html>