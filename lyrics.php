<?php

    require('simple_html_dom.php');
    
	$loading=TRUE;
    $i=0;    
	$webToken="396863599:AAHKG4zEDj2NPVWm9ifqFkOObGz3QeXHI1s";
     $url="https://api.telegram.org/bot".$webToken;

     $update=file_get_contents($url."/getupdates");
	 $updateArray=json_decode($update,TRUE);
	 $chat_id=$updateArray["result"][0]["message"]["chat"]["id"];//
	 $num=(sizeof($updateArray["result"]))-1;
	 $chat_text=$updateArray["result"][$num]["message"]["text"];
	 
	 print_r($chat_text);
	 
	 
	 
     $html =file_get_html('http://www.lyricsol.com/?s='.str_replace(' ','+',$chat_text));
  
     print_r(str_replace(' ','+',$chat_text));
     
    $div=$html->find('div.post-listing',0);
  
     foreach($div->find('article.item-list') as $lyric){
	  
	  $a=$lyric->find('a',0);
	  
	  $href=$a->href;
	    
		print_r ($href);
		
	  $text=" ";
	  
	  $htmly=file_get_html($href);
	  $div_lyric=$htmly->find('div.lyric',0);
	  foreach($div_lyric->find('p') as $lyric_para){
		  $text=($lyric_para->plaintext);
		 
		  file_get_contents($url."/sendmessage?chat_id=".$chat_id."&text=".$text);
		 } 
	  
	  break;
	  
  }	 

?>
