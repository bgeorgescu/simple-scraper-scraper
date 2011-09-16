<?php
/*
 Simple scraper scraper

 Copyright (c) 2011, Mircea "Bobby" Georgescu
 All rights reserved.
 
 Redistribution and use in source and binary forms, with or without
 modification, are permitted provided that the following conditions are met:
 * Redistributions of source code must retain the above copyright
 notice, this list of conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright
 notice, this list of conditions and the following disclaimer in the
 documentation and/or other materials provided with the distribution.
 * Neither the name of Simple scraper scraper nor the
 names of its contributors may be used to endorse or promote products
 derived from this software without specific prior written permission.
 
 THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
 ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 DISCLAIMED. IN NO EVENT SHALL Mircea "Bobby" Georgescu BE LIABLE FOR ANY
 DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
 ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
*/

error_reporting(E_ALL);
require('lib/simple_html_dom.php');


/**
 * Cleans up the title of a scraped post. This needs to be tweaked for your
 * individual site
 * @param string $title
 * @return string 
 */
function cleanTitle($title) {
	return str_ireplace(array("&#8211;", "ifans"), array("",""), $title);
}

/**
 * Given a bunch of identifying data about a WordPress post, generates
 * the permalink for the post. It might be best to actually use WordPress'
 * built-in permalink functions instead of this, but this was quicker and
 * worked for me.
 * 
 * The parameters in this correspond respectively to the columns in the result
 * of running the following query on your WordPress post table:
 *  select post_title, ID, post_date, guid from wp_posts
 * @param string $title
 * @param integer $id
 * @param string $guid
 * @param type $date
 * @return string 
 */
function post_permalink($title, $id, $guid, $date) {
	return str_ireplace(array("/?p=","ipodtouchfans"),array("/blog/","ifans"), $guid);
}


/**
 * Given a URL and a selector for article links, extracts linke anchor text
 * and URLs and adds them to the output hash table (passed by reference)
 * 
 * @param string $url
 * @param string $selector
 * @param array& $output 
 */
function processUrl($url, $selector, &$output) {
	$html = file_get_html($url);
	$ret = $html->find($selector);
	for($i = 0; $i < count($ret); $i++) {
		$output[] = array("title" => cleanTitle($ret[$i]->plaintext), "url" => $ret[$i]->href);
		$ret[$i]->clear();
	}
	$html->clear();
}


/**
 * Wrapper that takes a URL pattern of the form http://site.com/page/{page}/
 * and calls processUrl with {page} replaced for each page number in a given
 * page range.
 * 
 * @param string $url_pattern
 * @param string $selector
 * @param integer $first_page
 * @param integer $last_page
 * @param array& $output 
 */
function processPaginatedUrlPattern($url_pattern, $selector, $first_page, $last_page, &$output) {
	for($i = $first_page; $i <= $last_page; $i++) {
		processUrl(str_replace("{page}", strval($i), $url_pattern), $selector, $output);
	}
}


/**
 * Matches the scraped articles with the originals based on similarity between
 * the titles as determined by MySQL fulltext search. Note that WordPress
 * does not automatically add a FULLTEXT index on the post_title column, so 
 * you need to run a query like the following to add one:
 * 
 *  ALTER TABLE wp_posts ADD FULLTEXT(post_title);
 * 
 * @param array& $output
 * @param mysqli& $mysqli 
 */
function matchOutputWithArticles(&$output, &$mysqli) {
	$stmt = $mysqli->prepare('select post_title, ID, post_date, guid from wp_posts where post_status = "publish" and match(post_title) against (?) limit 1');
	
	for($i = 0; $i < count($output); $i++) {
		$stmt->bind_param("s", $output[$i]["title"]);
		$stmt->execute();
		$stmt->bind_result($title, $id, $date, $guid);
		if($stmt->fetch()) {
			$output[$i]["orig_title"] = $title;
			$output[$i]["orig_url"] = post_permalink($title, $id, $guid, $date);
		}
	}
}

/**
 * Prints the output in a format that is easy to copy and paste into web forms
 * 
 * @param array& $output 
 */
function printOutputCopyAndPaste(&$output) {
	$c = count($output);

	echo "SOURCE:\n";
	for($i = 0; $i < $c; $i++) {
		if(!empty($output[$i]["orig_url"]))
			echo $output[$i]["orig_url"];
		else
			echo "http://www.ifans.com/";
		echo "\n";
	}

	echo "COPY:\n";
	for($i = 0; $i < $c; $i++) {
		echo $output[$i]["url"];
		echo "\n";
	}
}


/**
 * Prints JavaScript code that automatically fills Google's DMCA form 
 * 
 * @param array& $output 
 */
function printOutputJavascriptForm(&$output) {
	$c = count($output);
	
	echo "var good_urls = [";
	for($i = 0; $i < $c; $i++) {
		if($i > 0) echo ",";
		echo '"';
		if(!empty($output[$i]["orig_url"]))
			echo $output[$i]["orig_url"];
		else
			echo "http://www.ifans.com/";
		echo '"';
	}
	echo "]; var bad_urls = [";
	for($i = 0; $i < $c; $i++) {
		if($i > 0) echo ",";
		echo '"';
		echo $output[$i]["url"];
		echo '"';
	}
	echo "]; for(i = 0; i < bad_urls.length; i++) { if(i > 0) addFieldRow('request_table_package_adsense_copyright_table',true); l = i+1; document.getElementById('extra.adsense_copyright_source_'+l).value = good_urls[i]; document.getElementById('extra.adsense_copyright_url_'+l).value = bad_urls[i]; }";
        echo "\n";

}

?>
