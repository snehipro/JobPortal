<?php

session_start();

require_once("db.php");

$limit = 4;

if(isset($_GET["page"])) {
	$page = $_GET['page'];
} else {
	$page = 1;
}

$start_from = ($page-1) * $limit;

$sql = "SELECT * FROM job_post LIMIT $start_from, $limit";
$result = $conn->query($sql);
if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$sql1 = "SELECT * FROM company WHERE id_company='$row[id_company]'";
              $result1 = $conn->query($sql1);
              if($result1->num_rows > 0) {
                while($row1 = $result1->fetch_assoc()) 
                {
             ?>

		   <div class="attachment-block clearfix" >
             <a href="view-job-post.php?id=<?php echo $row['id_jobpost']; ?>">
		    <img class="attachment-img" src="uploads/logo/<?php echo $row1['logo']; ?>" alt="Attachment Image">
              <div class="attachment-pushed">
                <h4 class="attachment-heading"><?php echo $row['jobtitle']; ?> <span class="attachment-heading pull-right">₹ <?php echo $row['maximumsalary']; ?>/ Month</span> <hr/><a href='<?php echo $row1['website']; ?>' style="float:right;"><?php echo $row1['website']; ?></a></h4>
                <div class="attachment-text">
                    <div><strong><?php echo $row1['city']; ?> || <?php echo $row1['companyname']; ?>|| Experience <?php echo $row['experience']; ?>  Years</strong></div>
                </div>
              </div>
             </a>
             </div>
         
		<?php
			}
		}
	}
}

$conn->close();