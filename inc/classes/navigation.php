<?php
/***********
 **** @license http://opensource.org/licenses/gpl-2.0.php The GNU General Public License (GPL)
 **** @author Jan Petry
 ***********/

class Navigation {
    
    public $link;
    
    public function link($href, $subsite, $tooltip, $title, $i) {
        $lower = strtolower($href);
        $site = 'index.php?site=';
        if(isset($subsite) && !empty($subsite)){$sub = '&'. $subsite;}else {$sub = '';}
        if($i == 0){
            if(!isset($_GET['site']) || empty($_GET['site'])){
            $this->link = '<li role="presentation"><a href="'. $site . $lower . $sub . '" title="' . $tooltip . '">' . $title . '</a></li>';
            }
            else {
                if($_GET['site'] == $lower) {
                   $this->link = '<li role="presentation" class="active"><a href="'. $site . $lower . $sub . '" title="' . $tooltip . '">' . $title . '</a></li>';
                } else {
                     $this->link = '<li role="presentation"><a href="'. $site . $lower . $sub . '" title="' . $tooltip . '">' . $title . '</a></li>';
                }
            }
        }
        else {
            $this->link = '<li role="presentation"><a href="' . $lower . $sub . '" title="' . $tooltip . '" target="_blank">' . $title . '</a></li>';
        }
        echo $this->link;
    }
}
