<?php
	$ps = notes::loadAllEntries();
        foreach ( $ps as $p ) {
          $nid = $p->getID();
          $desc = $p->getentDesc();
          $stripdesc = ereplace($desc);
          $newdesc = core_crypto::encrypt($stripdesc);
          $by = $p->getentBy();
          //$id = bst_users::loadFullName($by)->getId();
          $newby = bst_users::load($by)->getFullName();

          print "Entry: " . $nid . "<br>\r\n";
          print "Desc: " . $desc . "<br>\r\n";
          print "By: " . $by . "<br>\r\n";
/*		$db = getDB();
        $data = Array(
            'entDesc' => $newdesc,
            'entBy' => $id
        );
        $db->where('id',$nid);
		$result = $db->update('notes',$data);

		if($result){
			print "SUCCESS";
		}else{
            print "FAILED";
        } */
         print "---<br>\r\n";
        }

    exit;

    function ereplace($text) {
      $txt = stripslashes($text);
      $txt = preg_replace('/[\r\n]+/', '\n', $txt);
      $txt = str_replace("<br>", '\n', $txt);
      $txt = str_replace("<br/>", '\n', $txt);

      return $txt;
    }
?>