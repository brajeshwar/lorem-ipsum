<?php
/*
Plugin Name: Show Top Commentators
Plugin URI: http://www.pfadvice.com/wordpress-plugins/show-top-commentators/
Description: Encourage more feedback and discussion from readers, by rewarding them every time they post a comment! Readers with the most comments are displayed on your Wordpress blog, with their names (linked to their website if they provided one).
Version: 1.04
Author: Nate Sanden
Author URI: http://www.savingadvice.com

Installation Instructions:
http://www.pfadvice.com/wordpress-plugins/show-top-commentators/#install

Shameless Begging: While this plugin is completely free to use, we would greatly appreciate a post telling your readers that you are using this new plugin. By doing so you will encourage us to make other great plugins for WordPress that you can also use in the future!
*/

$ns_options = array(
                    "reset" => "all", //reset hourly, daily, weekly, monthly, yearly, all OR # (eg 30 days)
                    "limit"  => 5, //maximum number of commentator's to show
                    "filter_users" => "Administrator,admin,Admin,Brajeshwar,Anonymous,o! Just Me", //commma seperated list of users ("nate,jeff,etc").
                    "filter_urls" => "", //commma seperated list of full or partial URL's (www.badsite.com,etc)
                    "none_text" => "None yet!", //if there are no commentators, what should we display?
                    "make_links" => 1, //link the commentator's name to thier website?
                    "name_limit" => 28, //maximum number of characters a commentator's name can be, before we cut it off with an ellipse
                    "start_html" => "<li>",
                    "end_html"   => "</li>",
                   );

//first we need to format options so they are useable
$ns_options = ns_format_options($ns_options);

function ns_substr_ellipse($str, $len) {
   if(strlen($str) > $len) {
      $str = substr($str, 0, $len-3) . "...";
   }
   return $str;
}

//temporary until i can condense this into one query in $commenters
function ns_get_user_url($user) {
   global $wpdb, $ns_options;
	$url = $wpdb->get_var("
	   SELECT comment_author_url, COUNT(comment_author_url) AS comment_author_url_count
	   FROM $wpdb->comments
	   WHERE comment_author = '".addslashes($user)."'
	   $options[filter_urls]
	   GROUP BY comment_author_url
	   ORDER BY comment_author_url_count DESC LIMIT 1
   ");
   return $url;
}

function ns_show_top_commentators() {

   global $wpdb, $ns_options;

   if($ns_options["reset"] != '') {
      if(!is_numeric($ns_options["reset"])) {
         $reset_sql = "DATE_FORMAT(comment_date, '$ns_options[reset]') = DATE_FORMAT(CURDATE(), '$ns_options[reset]')";
      } else {
         $reset_sql = "comment_date >= CURDATE() - INTERVAL $ns_options[reset] DAY"; 
      }
   } else {
      $reset_sql = "1=1";
   }

	$commenters = $wpdb->get_results("
	   SELECT COUNT(comment_author) AS comment_comments, comment_author
	   FROM $wpdb->comments
	   WHERE $reset_sql
	      AND comment_author NOT IN($ns_options[filter_users])
	      AND comment_author != ''
	      AND comment_type != 'pingback'
	      AND comment_approved = '1'
	   GROUP BY comment_author
	   ORDER BY comment_comments DESC LIMIT $ns_options[limit]
   ");

   if(is_array($commenters)) {
	   foreach ($commenters as $k) {
	      if($ns_options["make_links"] == 1) {
            $url = ns_get_user_url($k->comment_author);
	      }
	      echo $ns_options["start_html"];
	      if(trim($url) != '' && $ns_options["make_links"] == 1) {
	         echo "<a href='" . $url . "'>";
	      }
	      echo ns_substr_ellipse($k->comment_author, $ns_options["name_limit"]);
	      if(trim($url) != '' && $ns_options["make_links"] == 1) {
	         echo "</a>";
	      }
	      echo " (" . $k->comment_comments . ")\n";
	      echo $ns_options["end_html"] . "\n";
	      unset($url);
	   }
	} else {
      echo $ns_options["start_html"] . $ns_options["none_text"] . $ns_options["end_html"];;
	}

}

function ns_format_options($options) {
   //$reset needs to turn into %sql format
	if($options["reset"] == "hourly") {
      $options["reset"] = "%Y-%m-%d %H";
   } elseif($options["reset"] == "daily") {
      $options["reset"] = "%Y-%m-%d";
   } elseif($options["reset"] == "weekly") {
      $options["reset"] = "%Y-%v";
   } elseif($options["reset"] == "monthly") {
      $options["reset"] = "%Y-%m";
   } elseif($options["reset"] == "yearly") {
      $options["reset"] = "%Y";
   } elseif($options["reset"] == "all") {
      $options["reset"] = "";
   } elseif(is_numeric($options["reset"])) {
       $options["reset"] = $options["reset"]; //last x days
   } else {
      $options["reset"] = "%Y-%m"; //just use monthly
   }
   //$filter urls needs to be comma seperated with single quotes
   $filter_urls = trim($options["filter_urls"]);
   $filter_urls = explode(",", $filter_urls);
   for($i=0; $i<count($filter_urls); $i++) {
      $new_urls .= " AND comments_author_url NOT LIKE '%" . trim($filter_urls[$i]) . "%'";
   }
   //echo $new_urls;
   $options["filter_urls"] = $new_urls;
   //lets trim $limit just for the hell of it. (you never know)
   $options["limit"] = trim($options["limit"]);
   $options["name_limit"] = trim($options["name_limit"]);
   //$filter_users needs to be comma seperated with single quotes
   $filter_users = trim($options["filter_users"]);
   $filter_users = explode(",", $filter_users);
   for($i=0; $i<count($filter_users); $i++) {
      $new_users[] = "'" . trim($filter_users[$i]) . "'";
   }
   $options["filter_users"] = implode(",", $new_users);
   return $options;
}

?>