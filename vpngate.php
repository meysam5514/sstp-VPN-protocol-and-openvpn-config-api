<?php
error_reporting(false);
header('Content-type: application/json;'); 
/*
• Channel  » @Sidepath «
• Writer  » @meysam_s71 «

// ===== اگه مادرت برات محترمه منبع رو پاک نکن عزیزم ===== \\
*/
$read=file_get_contents('https://www.vpngate.net/en/',true);


preg_match_all('#<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="(.*?)" />

<input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="(.*?)" />
<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="(.*?)" />#is',$read,$sidepathdata);    


$data=['__VIEWSTATE'=>$sidepathdata[1][0] ,'__VIEWSTATEGENERATOR'=>$sidepathdata[2][0] ,'__EVENTVALIDATION'=>$sidepathdata[3][0] ,'C_L2TP'=> 'on' ,'Button3'=>'Refresh Servers List'];
/*
• Channel  » @Sidepath «
• Writer  » @meysam_s71 «

// ===== اگه مادرت برات محترمه منبع رو پاک نکن عزیزم ===== \\
*/
//====================================================curl
$ch = curl_init();
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
curl_setopt($ch, CURLOPT_URL,"https://www.vpngate.net/en/");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEJAR,"cookie.txt");
curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
curl_setopt($ch, CURLOPT_HEADER, false);
$meysam1= curl_exec($ch);
curl_close($ch);    
//====================================================get sstp and openvpn

preg_match_all("#<a href='do_openvpn.aspx(.*?)'><(.*?)>SSTP Hostname :<br /><b><span style='color: (.*?)006600;' >(.*?)</span>#is",$meysam1,$sidepath1);

for($i=0;$i<=count($sidepath1[1])-1;$i++){
    $open1="https://www.vpngate.net/en/do_openvpn.aspx".$sidepath1[1][$i];
    $open2[]=$open1;




$sidepath4[$i]=['sstp'=>$sidepath1[4][$i] , 'username'=>'vpn' , 'password'=>'vpn' , 'openvpn'=>html_entity_decode($open2[$i])];
}

//====================================================get openvpn links config
$urlside=rand(0,count($sidepath4)-1);
if($urlside!=null && is_numeric($urlside)){
    
$ch = curl_init();
//curl_setopt($ch, CURLOPT_POST, true);
//curl_setopt($ch, CURLOPT_POSTFIELDS,$sidepath3ta);
curl_setopt($ch, CURLOPT_URL,$sidepath4[$urlside]['openvpn']);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEJAR,"cookie.txt");
curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
curl_setopt($ch, CURLOPT_HEADER, false);
$meysam2= curl_exec($ch);
curl_close($ch);    

preg_match_all('#<a href="/common/openvpn_download.aspx(.*?)">
							<strong>
							(.*?)</strong>#is',$meysam2,$sidepath2);    

for($i=0;$i<=count($sidepath2[1])-1;$i++){
    $open5="https://www.vpngate.net/common/openvpn_download.aspx".html_entity_decode($sidepath2[1][$i]);

$sidepath3[$i]=['type'=>$sidepath2[2][$i] , 'link'=>$open5];

/*
• Channel  » @Sidepath «
• Writer  » @meysam_s71 «

// ===== اگه مادرت برات محترمه منبع رو پاک نکن عزیزم ===== \\
*/
}
$sidepath4["$urlside"]['openvpn config link']=$sidepath3;
    
}

/*
• Channel  » @Sidepath «
• Writer  » @meysam_s71 «

// ===== اگه مادرت برات محترمه منبع رو پاک نکن عزیزم ===== \\
*/
echo json_encode(['ok' => true, 'channel' => '@SIDEPATH','writer' => '@meysam_s71', 'openvpnnum' => "$urlside", 'Results' =>$sidepath4], 448);


