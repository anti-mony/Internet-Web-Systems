<?php 
include('config.php'); 
session_start();
$sqla = "SELECT * from questions" ;
$content = mysqli_query($db,$sqla);
if($_GET['BMV']==0){
	if( mysqli_num_rows($content) > 0 ){
		while($row = mysqli_fetch_assoc($content)){
			$x = $row['UserID'] ;
			$usql = "SELECT * FROM users WHERE UserID = '$x'" ;
			$tres = mysqli_query($db,$usql);
			$tusr = mysqli_fetch_array($tres,MYSQLI_ASSOC); 
			?>
			<div class="card">
				<small class="card-header"><?php echo "Tags: " . $row['Tag1'] . ", " . $row['Tag2'] ?></small>
				<div class="card-body">
					<h4 class="card-title"><?php echo $row['Question'] ?></h4>
					<div class="media">
						<img class="d-flex mr-3" src="ic_person_48px.svg" alt="Generic placeholder image">
						<div class="media-body">
							<h6 class="mt-0"><?php echo $tusr['FirstName'] . ", " . $tusr['Designation'] ?></h6>
							Answered on <?php echo $row['Time'] ?> 
						</div>
					</div>
					<p class="card-text"><?php echo $row['Answer'] ?></p>
					<div class="btn-group" aria-label="Basic example" data-toggle="buttons">
						<label class="btn btn-outline-success btn-sm">
							<input type="radio" name="options" id="option1" autocomplete="off"> <i class="fa fa-arrow-up" aria-hidden="true"></i>
						</label>
						<label class="btn btn-outline-danger btn-sm">
							<input type="radio" name="options" id="option2" autocomplete="off"> <i class="fa fa-arrow-down" aria-hidden="true"></i>
						</label>
						<button type="button" class="btn btn-outline-warning btn-sm"><i class="fa fa-times" aria-hidden="true"></i></button>
					</div>
					<button type="button" onclick="addBMark(<?php echo $row['SNo'] ?>)" class="btn btn-outline-primary btn-sm" data-toggle="button" aria-pressed="false" autocomplete="off"><i class="fa fa-bookmark" aria-hidden="true"></i></button>
				</div>
			</div>

			<?php
		} } }
		else if($_GET['BMV'] == 1){
			$uid = $_SESSION['login_user'];
			$bq = "SELECT DISTINCT * FROM bookmarks WHERE Username='$uid' ";
			$dat = mysqli_query($db,$bq);
			if(mysqli_num_rows($dat) > 0 ){
				while($row = mysqli_fetch_assoc($dat)){
					$rid = $row['QID'];
					$nq = "SELECT * FROM questions WHERE SNo= '$rid' ";
					$ndat = mysqli_query($db,$nq);
					$row =  mysqli_fetch_assoc($ndat);
					$nx = $row['UserID'] ;
					$nusql = "SELECT * FROM users WHERE UserID = '$nx'" ;
					$ntres = mysqli_query($db,$nusql);
					$ntusr = mysqli_fetch_array($ntres,MYSQLI_ASSOC); 
					?>			
					<div class="card">
						<small class="card-header"><?php echo "Tags: " . $row['Tag1'] . ", " . $row['Tag2'] ?></small>
						<div class="card-body">
							<h4 class="card-title"><?php echo $row['Question'] ?></h4>
							<div class="media">
								<img class="d-flex mr-3" src="ic_person_48px.svg" alt="Generic placeholder image">
								<div class="media-body">
									<h6 class="mt-0"><?php echo $ntusr['FirstName'] . ", " . $ntusr['Designation'] ?></h6>
									Answered on <?php echo $row['Time'] ?> 
								</div>
							</div>
							<p class="card-text"><?php echo $row['Answer'] ?></p>
							<div class="btn-group" aria-label="Basic example" data-toggle="buttons">
								<label class="btn btn-outline-success btn-sm">
									<input type="radio" name="options" id="option1" autocomplete="off"> <i class="fa fa-arrow-up" aria-hidden="true"></i>
								</label>
								<label class="btn btn-outline-danger btn-sm">
									<input type="radio" name="options" id="option2" autocomplete="off"> <i class="fa fa-arrow-down" aria-hidden="true"></i>
								</label>
								<button type="button" class="btn btn-outline-warning btn-sm"><i class="fa fa-times" aria-hidden="true"></i></button>
							</div>
							<button type="button" onclick="addBMark(<?php echo $row['S.No'] ?>)" class="btn btn-outline-primary btn-sm" data-toggle="button" aria-pressed="false" autocomplete="off"><i class="fa fa-bookmark" aria-hidden="true"></i></button>
						</div>
					</div>


<?php
				}
			}
		}
		?>