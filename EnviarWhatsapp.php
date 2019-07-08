<?php
$GLOBALS['link'] = mysqli_connect("localhost", "root", "", "odontologo") or die (mysqli_error()); //Connect to server
$url = 'https://www.waboxapp.com/api/send/chat';
$token = '9c7949166b64c152041eb9d30d52f7c95d160c23c972d';
$uid = '59891886681';
$to = '59899465511';
$numId = getId();
$cuid = 'msg'.$numId;
$text = 'Este mensaje se envia desde la pagina';
envio($url, $token, $uid, $to, $numId, $cuid, $text);


function envio($url, $token, $uid, $to, $numId, $cuid, $text){
$response = enviarMensaje($url, $token, $uid, $to, $cuid, $text);
if(isset(json_decode($response, true)['success'])){
	$link = $GLOBALS['link'];
	$sql ="Update numeracionmensaje set num=$numId";
	//print $sql.'<br>';
	mysqli_query($link, $sql);
	print "Se envio <br>";
	//print json_decode($response, true)['custom_uid'];
}
else{
	$error = json_decode($response, true)['error'];
	print $error.' '.$cuid.'<br>';
	if($error == "Parameter 'custom_uid' must be unique and already exists")
	{
		$numId+=1;
		$cuid='msg'.$numId;
		envio($url, $token, $uid, $to, $numId, $cuid, $text);
	}
}
}


function enviarMensaje($url, $token, $uid, $to, $cuid, $text){
$fields = [
    'token'      => $token,
    'uid' => $uid,
    'to' => $to,
    'custom_uid' => $cuid,
    'text' => $text
    //'t'         => 'Submit'
];

$fields_string = http_build_query($fields);

//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
curl_setopt($ch, CURLOPT_POST, 1); 
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); 
curl_setopt($ch, CURLOPT_MAXREDIRS, 5); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_TIMEOUT, 20); 
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 25); 

//So that curl_exec returns the contents of the cURL; rather than echoing it
//curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
//execute post
$response = curl_exec($ch); 
curl_close ($ch);
return $response;
}


function getId(){
	$link = $GLOBALS['link'];
	$query = mysqli_query($link, "Select num from numeracionmensaje");
	while($row = mysqli_fetch_array($query))
	{
		return $row['num']+1;
	}
}
?>
