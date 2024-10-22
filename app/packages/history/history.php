<?php

	class history extends users {

		public function __construct($id, $uid, $hdate) {
			$this->id = $id;
			$this->uid = $uid;
			$this->hdate = $hdate;
		}

		function getUid() {
			return ($this->uid);
		}

		function getHdate() {
			return ($this->hdate);
		}

		function getId() {
			return ($this->id);
		}

/*		static function loadHist($uid) {
			$db = getDB();
			$db->where('uid', $uid);
			$db->orderBy('hdate', 'desc');
			$exs = $db->get(PREFIX . '_userhist');
			if ($exs) {
				$us = array();
				for ($i = 0; $i < sizeof($exs); $i++) {
					$us[] = history::load($exs[$i]["id"]);
				}
				return ($us);
			}
			return null;
		}
*/

static function loadHist($uid) {
    $db = getDB();
    $db->where('uid', $uid);
    $db->orderBy('hdate', 'desc');  // Order by hdate in descending order (newest first)
    $exs = $db->get(PREFIX . '_userhist');

    if ($exs) {
        // If there are more than 30 entries, show only the last 30
        if (sizeof($exs) > 30) {
            $us = array_slice($exs, 0, 50); // Extract the first 30 (newest) entries
        } else {
            // If there are 30 or fewer entries, keep all of them
            $us = $exs;
        }

		// Load each entry using history::load() (assuming it exists)
        $uhistory = array(); // Initialize an empty array for user history

		// Load each entry using history::load() (assuming it exists)
        foreach ($us as $entry) {
        // Do something with each entry
		$loadedEntry = history::load($entry["id"]);
		if (!in_array($loadedEntry, $uhistory)) {
			// Avoid duplicates by checking if the entry is already in $uhistory
			$uhistory[] = $loadedEntry;
		}
        }

        return $uhistory;
    }

    return null;
}

		static function load($id) {
			$db = getDB();
			$db->where('id', $id);
			$h = $db->get(PREFIX . '_userhist');
			if ($h) {
			    //pr($u);
				return (new history($h[0]["id"], $h[0]["uid"], $h[0]["hdate"]));
			}
		}

	}

?>