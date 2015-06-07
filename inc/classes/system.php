<?php
/***********
 **** @license http://opensource.org/licenses/gpl-2.0.php The GNU General Public License (GPL)
 **** @author Jan Petry 
 ***********/
    class System {
		public $messages = array();
		public $errors = array();
		
       	public function __construct($config) {
            $this->db = $config['dbconnect'];
			
			// if user tried to log out
			if(isset($_GET['logout'])) {
				$this->Logout();
			}
        }
		
        public function Login($username, $password) {
            $stmt = $this->db->prepare('SELECT * FROM user WHERE username = :username AND password = :password');
            $stmt->execute(array(':username' => $username, ':password' => $password));
            
            $result = $stmt->fetchAll();
            
            if($result != null) {
                foreach($result as $row) {
                    if($row['locked'] != 1) {
                        // Set SESSIONS
                        $_SESSION['logged'] = TRUE;
                        $_SESSION['username'] = $row['username'];
                        
						
						echo $this->messages[] = MESSAGE_LOGGED_IN;
                        print '<script type="text/javascript">setTimeout(function(){location.href="index.php?site=admin";}, 1500);</script>';
					} else {
                        echo $this->errors[] = ERROR_LOCKED;
						print '<script type="text/javascript">setTimeout(function(){location.href="index.php?site=login";}, 1500);</script>';
					}
                }
            } else {
                echo $this->errors[] = ERROR_PASSWORD_USERNAME_INCORRECT;
				print '<script type="text/javascript">setTimeout(function(){location.href="index.php?site=login";}, 1500);</script>';
            }
        }

		public function Logout() {
			$_SESSION = array();
			session_destroy();
			
			echo $this->messages[] = MESSAGE_LOGGED_OUT;
			print '<script type="text/javascript">setTimeout(function(){location.href="index.php";}, 1500);</script>';
		}
		
        public function addUser($username, $password) {
            $stmt = $this->db->prepare('INSERT INTO user (username, password) VALUES (:username, :password)');
            $stmt->execute(array(':username' => $username, ':password' => $password));
			
            echo $this->messages[] = MESSAGE_ADMIN_REGISTRATION;
        }

		public function deleteUser($username) {
			$stmt = $this->db->prepare('DELETE FROM user WHERE username = :username');
			$stmt->execute(array(':username' => $username));
			
			echo $this->messages[] = MESSAGE_ADMIN_DELETED;
		}

		public function fetchFiveArticle() {
            $stmt = $this->db->prepare('SELECT * FROM news ORDER by newsID DESC LIMIT 0,5');
            $stmt->execute();

            // Get Result
            $result = $stmt->fetchAll();
            
            foreach($result as $row) {
                echo '
                	<div class="panel panel-default" onclick="toggle_news('.$row['newsID'].');">
                        <div class="panel-heading">'.$row['title'].'
						    <span style="float: right; width: 100px; text-align: left;" data-toggle="tooltip" data-placement="right" title="Der Beitrag wurde am '. date('d.m.Y', strtotime($row['date'])) .' veröffentlicht"><i class="fa fa-calendar fa-1" style="padding-right: 3px;"></i> ' . date('d.m.Y', strtotime($row['date'])) . '</span> 
                            <span style="float: right; padding-right: 20px; text-align: left; width: 120px;" data-toggle="tooltip" data-placement="right" title="Der Autor dieses Beitrages ist der Nutzer: '.$row['author'].'"><i class="fa fa-user fa-1" style="padding-right: 3px;"></i> ' . $row['author']. '</span>
                        </div>
						<div class="panel-body" id="newstext_'.$row['newsID'].'">'.$row['text'].'</div>
					</div>
				';
            }
        }
        
        public function addArticle($articleHeadline, $text, $date, $author) {
            $stmt = $this->db->prepare('INSERT INTO news (title, text, date, author) VALUES (:title, :text, :date, :author)');

            $author = $_SESSION['username'];

            $stmt->execute(array(':title' => $articleHeadline, ':text' => $text, ':date' => $date, ':author' => $author));
            
          	echo $this->messages[] = MESSAGE_ADD_ARTICLE;
        }

		public function deleteArticle($articleHeadline) {
  			$stmt = $this->db->prepare('DELETE FROM news WHERE title = :title');
  			$stmt->execute(array(':title' => $articleHeadline));

  			echo $this->messages[] = MESSAGE_DELETE_ARTICLE;
		}

        public function breadcrumbs($separator = ' / ', $home = 'Home') {
            $path = array_filter(explode('/', $_SERVER['REQUEST_URI']));
            $base_url = ($_SERVER['HTTPS'] ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
            $breadcrumbs = array(''.$home.'');

            $x = array_keys($path);
            $last = end($x);

            foreach ($path as $x => $crumb) {
                $title = ucwords(str_replace(array('.php', '_', '-'), array(' ', ' '), $crumb));
                if ($x!= $last){
                    $breadcrumbs[] = ''.$title.'';
                } else{
                    $breadcrumbs[] = $title;
                }
            }

            return implode($separator, $breadcrumbs);
        }
    }
        
?>
