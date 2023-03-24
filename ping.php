<?php header('Access-Control-Allow-Origin: *');

$json = file_get_contents('config.json');
$json_data = json_decode($json,true);
	
	
$host=$json_data['ip_server'];
$output=shell_exec('ping -n 1 '.$host);

// echo "<pre>$output</pre>"; //for viewing the ping result, if not need it just remove it

if (strpos($output, 'out') !== false) {
    echo " <span class='dotred'></span> OFFLINE";
}
    elseif(strpos($output, 'expired') !== false)
{
    echo " <span class='dotred'></span> OFFLINE";
}
    elseif(strpos($output, 'data') !== false)
{
    echo " <span class='dotgreen'></span> ONLINE";
}
else
{
    echo " <span class='dotred'></span> OFFLINE";
}

?> 
 
 