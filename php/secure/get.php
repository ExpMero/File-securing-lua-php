<?php
$id = $_GET['id'];
$ip = get_client_ip();

if (!empty($id) && is_numeric($id)) {
    include 'db.php';

    $step = "SELECT * FROM `scripts` WHERE id = $id AND ip = '$ip'";
    $result = mysqli_query($conn, $step);

    if (mysqli_num_rows($result) > 0) {
       $row = mysqli_fetch_row($result);
       $dd = json_encode(array($row[2],$row[1]));
       echo $dd;
            
    }else{
        $dd = json_encode(array(0,'\10\32\32\112\114\105\110\116\40\39\67\97\108\108\32\69\120\112\32\111\110\32\100\105\115\99\111\114\100\39\41\10\10'));
        echo $dd;
    }
}


function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
?>