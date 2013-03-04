<?php

$sideA = isset($_POST['source']) ? $_POST['source']: '';
$sideB = '';

if($sideA){
   $sideA = strtoupper($sideA);
   
   // create a cypher
   $search  = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789 .?,');
   $replace = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789 .?,');
   shuffle($replace);
   $cypher = array_combine($search, $replace);
   
   // encode the source
   $l=strlen($sideA);
   for($i=0; $i < $l; $i++){
      $chr = $sideA{$i};
      if(array_key_exists($chr,$cypher)) $chr = $cypher[$chr];
      $sideB.=$chr;
   }
   
}

?><html>
   <body>
      <form method='post' action='encrypt.php'>
         <textarea name='source' cols='30' rows='10'><?=$sideA?></textarea>
         <input type="submit" value="&gt;&gt;"/>
         <textarea cols='30' rows='10'><?=$sideB?></textarea>
      </form>
   </body>
</html>