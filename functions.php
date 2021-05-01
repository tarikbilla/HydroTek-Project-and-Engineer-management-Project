<?php 
//index page
 function total_project($db){
	$total=0;
	foreach ($db->query('SELECT * FROM projects') as $row)
	{
		$total ++;
	}
	echo $total;
 }

 function total_kd($db){
	$total=0;
	foreach ($db->query('SELECT * FROM products') as $row)
	{
		$total = $total + $row["total_kd"];
	}
	echo $total;
 }

 function total_delivery($db){
	$total=0;
	foreach ($db->query('SELECT * FROM products') as $row)
	{
		$total = $total + $row["delivery"];
	}
	echo $total;
 }

 function total_due($db){
	$totalkd=0;
	$totalDelivary=0;
	foreach ($db->query('SELECT * FROM products') as $row)
	{
		$totalkd = $totalkd + $row["total_kd"];
		$totalDelivary = $totalDelivary + $row["delivery"];
	}
	echo $totalkd-$totalDelivary;
 }


//view project page
function total_KD_of_a_Project($db,$id)
{
	$total=0;
	foreach ($db->query('SELECT * FROM products WHERE project_id='.$id) as $row)
	{
		$total = $total + $row["total_kd"];
	}
	echo $total;
}


function total_delivery_a_Project($db,$id)
{
	$total=0;
	foreach ($db->query('SELECT * FROM products WHERE project_id='.$id) as $row)
	{
		$total = $total + $row["delivery"];
	}
	echo $total;
}

function total_installatin_a_Project($db,$id)
{
	$total=0;
	foreach ($db->query('SELECT * FROM products WHERE project_id='.$id) as $row)
	{
		$total = $total + $row["installatin"];
	}
	echo $total;
}

function total_commissioning_a_Project($db,$id)
{
	$total=0;
	foreach ($db->query('SELECT * FROM products WHERE project_id='.$id) as $row)
	{
		$total = $total + $row["commissioning"];
	}
	echo $total;
}


function total_progress_a_Project($db,$id)
{
	$total=0;
	foreach ($db->query('SELECT * FROM products WHERE project_id='.$id) as $row)
	{
		$total = $total + $row["total_progress"];
	}
	echo $total;
}

function total_invoice_a_Project($db,$id)
{
	$total=0;
	foreach ($db->query('SELECT * FROM products WHERE project_id='.$id) as $row)
	{
		$total = $total + $row["total_invoice"];
	}
	echo $total;
}

function total_BTBI_a_Project($db,$id)
{
	$total=0;
	foreach ($db->query('SELECT * FROM products WHERE project_id='.$id) as $row)
	{
		$total = $total + $row["balance_tobe_invoiced"];
	}
	echo $total;
}

function total_balance_work_a_Project($db,$id)
{
	$total=0;
	foreach ($db->query('SELECT * FROM products WHERE project_id='.$id) as $row)
	{
		$total = $total + $row["balance_work"];
	}
	echo $total;
}


function total_due_a_Project($db,$id)
{
	$totalKD=0;
	$totalDelivary=0;
	$total=0;
	foreach ($db->query('SELECT * FROM products WHERE project_id='.$id) as $row)
	{
		$totalKD = $totalKD + $row["total_kd"];
		$totalDelivary = $totalDelivary + $row["delivery"];
	}
	echo $totalKD-$totalDelivary;
}


function total_percent_a_Project($db,$id)
{
	$totalKD=0;
	$totalDelivary=0;
	$total=0;
	foreach ($db->query('SELECT * FROM products WHERE project_id='.$id) as $row)
	{
		$totalKD = $totalKD + $row["total_kd"];
		$totalDelivary = $totalDelivary + $row["delivery"];
	}
	echo intval(($totalDelivary/$totalKD)*100);
}



//check project access for a user
 function is_project_access($db,$projectID,$username){
	$total=0;
	foreach ($db->query("SELECT * FROM project_access WHERE project_id=$projectID and username='$username'") as $row)
	{
		$total ++;
	}
	if ($total>0) {
		return true;
	}else{
		return false;
	}
 }


// get ip address
// Function to get the client IP address
function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

//for log data
function setLogData($db, $pid, $details){

try {
      //insert into database with a prepared statement
      $stmt = $db->prepare('INSERT INTO log(date_log,time_log,username,ip_address,project_id,details) VALUES (:date_log, :time_log, :username, :ip_address, :project_id, :details)');
      $stmt->execute(array(
        'date_log' => date('d-m-Y'),
        'time_log' => date("h:i:s"),
        'username' => $_SESSION['username'],
        'ip_address' => get_client_ip(),
        'project_id' => $pid,
        'details' => $details
      ));

    //else catch the exception and show the error.
    } catch(PDOException $e) {
        $error[] = $e->getMessage();
    }
}
?>