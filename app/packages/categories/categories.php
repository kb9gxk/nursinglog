<?php

	class categories {

		public function __construct($id, $description, $first, $second, $third, $status) {
			$this->id = $id;
			$this->description = $description;
            $this->first = $first;
            $this->second = $second;
            $this->third = $third;
			$this->status = $status;
        }

		function getId() {
			return ($this->id);
		}

        function getFirst() {
            return ($this->first);
        }

        function getSecond() {
            return ($this->second);
        }

        function getThird() {
            return ($this->third);
        }

		function getDescription() {
		    if (!empty($this->first)) {
		        $desc = $this->first;
                $desc .= ' - ' . $this->second;
                if (!empty($this->third)) {
                    $desc .= ' - ' . $this->third;
                }
            } else {
                $desc = $this->description;
            }
			return ($desc);
		}
		
		function getActive() {
			return ($this->status);
		}


		static function loadCategories() {
			$db = getDB();
			//$db->orderBy('description', 'asc');
			$exs = $db->get(PREFIX.'_categories', null, 'id');
			if ($exs) {
				$us = array();
				for ($i = 0; $i < sizeof($exs); $i++) {
					$us[] = categories::load(PREFIX, $exs[$i]["id"]);
				}
			$uss = categories::loadCommonCategories();
				$cats = array_merge($us, $uss);
				//prd($cats);
				return ($cats);
			}
			return null;
		}
		
		static function loadCommonCategories() {
			$db = getDB();
			//$db->orderBy('description', 'asc');
			$exs = $db->get('core_categories', null, 'id');
			if ($exs) {
				$uss = array();
				for ($i = 0; $i < sizeof($exs); $i++) {
					$uss[] = categories::load('core', $exs[$i]["id"]);
				}
				return ($uss);
			}
			return null;
		}

		static function load($prefix, $id) {
			$db = getDB();
			$db->where('id', $id);
			$u = $db->get($prefix . '_categories');
			if ($u) {
				return (new categories($u[0]["id"], $u[0]["description"], $u[0]["first"], $u[0]["second"], $u[0]["third"], $u[0]["status"]));
			}
		}

	}

?>
