<?php
/***********
 **** @license http://opensource.org/licenses/gpl-2.0.php The GNU General Public License (GPL)
 **** @author Jan Petry
 ***********/
    class FireFighters {
        /**
	     * @var array $messages Collection of success / neutral messages
	     */
		public $messages = array();
	    /**
	     * @var array $errors Collection of error messages
	     */
		public $errors = array();
		
		/**
		 * the function "__construct()" automatically starts whenever an object of this class is created,
		 * you know, when you do "$system = new System($config) or whatever;"
		 */
        public function __construct($config) {
        	$this->db = $config['dbconnect'];
      	}

		public function getUserData($userID) {
			$stmt = $this->db->prepare("SELECT * FROM member WHERE userID = :userID");
			$stmt->execute(array(':userID' => $userID));

			// result
			$result = $stmt->fetchAll();

			if($result == null) {
				header('location: index.php');
				exit();
			}

			foreach($result as $row) {
				$userData = array();

				$userData['username'] = $row['username'];
				$userData['rang'] = $row['rang'];
			}

			return $userData;
		}	

		/**
		 * Herewith you are able to add Youth Firebrigade members
		 */
		public function addYouthFirefighterMember($username, $rang) {
			$stmt = $this->db->prepare("INSERT INTO member (username, rang) VALUES (:username, :rang)");
			$stmt->execute(array(':username' => $username, ':rang' => $rang));
			
			$userid = $this->db->lastInsertId();

			// Badges
			$stmta = $this->db->prepare("INSERT INTO links (userid, badgeid) VALUES (:userid, :badgeid)");

			for($i = 1; $i < 5; $i++) {
				$badges_check = $_POST['badge_check_'.$i];

				if($badges_check === 'on') {
					$stmta->execute(array(':userid' => $userid, ':badgeid' => $i));
				}
			}

			echo $this->messages[] = MESSAGE_ADD_YOUTHFIREFIGHTER;
		}

		/**
		 * Herewith you are able to delete Youth Firebrigade members out of database
		 */
		public function deleteYouthFirefighterMember($username) {
			$stmt = $this->db->prepare("SELECT userID FROM member WHERE username = :username");
			$stmt->execute(array(':username' => $username));

			// Caching in a variable
			$fetch = $stmt->fetch(PDO::FETCH_OBJ);
			$userid = $fetch->userID;

			// Delete the user based on the determined ID
			$stmta = $this->db->prepare("DELETE FROM member WHERE userid = :userid");
			$stmta->execute(array(':userid' => $userid));

			// Delete all entries in the "left"-table with the corresponding userid
			$stmtb = $this->db->prepare("DELETE FROM links WHERE userid = :userid");
			$stmtb->execute(array(':userid' => $userid));

			echo $this->messages[] = MESSAGE_DELETE_YOUTHFIREFIGHTER;
		}

		/**
		 * Herewith you are able to add / register new Youth Leaders
		 */
		public function addYouthLeader($username, $rang) {
			$stmt = $this->db->prepare("INSERT INTO betreuer (username, rang) VALUES (:username, :rang)");
			$stmt->execute(array(':username' => $username, 'rang' => $rang));
			
			$userid = $this->db->lastInsertId();

			// Badges
			$stmta = $this->db->prepare("INSERT INTO links_betreuer (userid, badgeid) VALUES (:userid, :badgeid)");

			for($i = 1; $i < 10; $i++) {
				$badges_check = $_POST['badge_check_'.$i];

				if($badges_check === 'on') {
					$stmta->execute(array(':userid' => $userid, 'badgeid' => $i));
				}
			}

			echo $this->messages[] = MESSAGE_ADD_YOUTHLEADER;
		}

		/**
		 * Herewith you are able to delete YouthLeaders out of database
		 */
		public function deleteYouthLeader($username){
			$stmt = $this->db->prepare("DELETE FROM betreuer WHERE username = :username");
			$stmt->execute(array(':username' => $username));

			// Caching in a variable
			$fetch = $stmt->fetch(PDO::FETCH_OBJ);
			$userid = $fetch->userID;

			// Delete the youth leader based on the determined ID
			$stmta = $this->db->prepare("DELETE FROM betreuer WHERE userid = :userid");
			$stmta->execute(array(':userid' => $userid));

			// Delete all entries in the "left"-table with the corresponding userid
			$stmtb = $this->db->prepare("DELETE FROM links_betreuer WHERE userid = :userid");
			$stmtb->execute(array(':userid' => $userid));

			echo $this->messages[] = MESSAGE_DELETE_YOUTHLEADER;
		}
		
		/**
		 * Get entries out of betreuer database and returns a list of them
		 */
		public function listYouthLeaders() {
            $stmt = $this->db->prepare('SELECT * FROM betreuer');
            $stmt->execute();
            
            $result = $stmt->fetchAll();
            
            foreach($result as $row) {
                $userData['id'] = $row['userID'];
                $userData['username'] = $row['username'];
                $userData['rang'] = $row['rang'];
                
            	echo '<b>'.$row['username'].'</b>'; 

                foreach($this->getBadges2($row['userID']) as $badge) {
                    echo '<img src="'.$badge['link'].'" alt="'.$badge['name'].'" />';
                } 

                echo '<br />'.$row['rang'].'<br />';
            }
        }
        
		/**
		 * Get entries out of members database and returns a list of all members
		 */
		public function listMembers() {
            $stmt = $this->db->prepare('SELECT * FROM member');
            $stmt->execute();
            
            $result = $stmt->fetchAll();
            
            foreach($result as $row) {
                $userData['id'] = $row['userID'];
                $userData['username'] = $row['username'];
                $userData['rang'] = $row['rang'];
                
				echo '<b>'.$row['username'].'</b>';			
				
				foreach($this->getBadges($row['userID']) as $badge) {
					echo '<img src="'.$badge['link'].'" alt="'.$badge['name'].'" />';
				}
				
				echo '<br />'.$row['rang'].'<br />';
            }
        }

		private function getBadges($id) {
			$stmt = $this->db->prepare('SELECT badges.name, badges.link FROM member INNER JOIN links ON links.userid = member.userID INNER JOIN badges ON links.badgeid = badges.id WHERE member.userID='.$id.';');
			$stmt->execute();
			
            $i = 0;

			while($get = $stmt->fetch(PDO::FETCH_OBJ)) {
				$badges[$i]['link'] = $get->link;
				$badges[$i]['name'] = $get->name;
				$i++;
			}
			
			return $badges;
		}

		public function getAllBadges() {
			$stmt = $this->db->prepare('SELECT * FROM badges ORDER BY id ASC;');
			$stmt->execute();
			
			$i = 0;
			
			while($get = $stmt->fetch(PDO::FETCH_OBJ)) {
				$badges[$i]['link'] = $get->link;
				$badges[$i]['name'] = $get->name;
				$i++;
			}
			return $badges;
		}

        private function getBadges2($id) {
            $stmt = $this->db->prepare('SELECT badges_betreuer.name, badges_betreuer.link FROM betreuer INNER JOIN links_betreuer ON links_betreuer.userid = betreuer.userID INNER JOIN badges_betreuer ON links_betreuer.badgeid = badges_betreuer.id WHERE betreuer.userID='.$id.';');
            $stmt->execute();
            
            $i = 0;

            while($get = $stmt->fetch(PDO::FETCH_OBJ)) {
                $badges[$i]['link'] = $get->link;
                $badges[$i]['name'] = $get->name;
                $i++;
            }
            return $badges;
        }

        public function getAllBadges2() {
            $stmt = $this->db->prepare('SELECT * FROM badges_betreuer ORDER BY id ASC;');
            $stmt->execute();
            
            $i = 0;
            
            while($get = $stmt->fetch(PDO::FETCH_OBJ)) {
                $badges[$i]['link'] = $get->link;
                $badges[$i]['name'] = $get->name;
                $i++;
            }
            return $badges;
        }
	}
?>
