<?php
require('functions.php');

// Declare output array
$final_output = array();

// Scrape a bunch of scrapers
processPaginatedUrlPattern('http://digitalslife.com/search/ifans/page/{page}', '.art-PostHeader a', 1, 7, $final_output);
processPaginatedUrlPattern('http://irish.digitalslife.com/search/ifans/page/{page}', '.PostHeader a', 1, 6, $final_output);
processPaginatedUrlPattern('http://french.digitalslife.com/search/ifans/page/{page}', '.post-title a', 1, 6, $final_output);
processPaginatedUrlPattern('http://russian.digitalslife.com/search/ifans/page/{page}', '.boxcaption h3 a', 1, 7, $final_output);
processPaginatedUrlPattern('http://italy.digitalslife.com/search/ifans/page/{page}', '.boxcaption h3 a', 1, 9, $final_output);
processPaginatedUrlPattern('http://poland.digitalslife.com/search/ifans/page/{page}', '.PostHeader a', 1, 6, $final_output);

processPaginatedUrlPattern('http://french.semagan.com/search/ifans/page/{page}', '.PostHeader a', 1, 5, $final_output);
processPaginatedUrlPattern('http://italy.semagan.com/search/ifans/page/{page}', '.post-info h2 a', 1, 7, $final_output);
processPaginatedUrlPattern('http://semagan.com/search/ifans/page/{page}', '.post-info h2 a', 1, 8, $final_output);
processPaginatedUrlPattern('http://greek.semagan.com/search/ifans/page/{page}', 'h2.title a', 1, 8, $final_output);

processPaginatedUrlPattern('http://fastbuyguide.com/search/ifans/page/{page}', '.art-PostHeader a', 1, 8, $final_output);
processPaginatedUrlPattern('http://greek.fastbuyguide.com/search/ifans/page/{page}', '.boxcaption h3 a', 1, 8, $final_output);
processPaginatedUrlPattern('http://spanish.fastbuyguide.com/search/ifans/page/{page}', 'h3 a', 1, 8, $final_output);
processPaginatedUrlPattern('http://russian.fastbuyguide.com/search/ifans/page/{page}', '.PostHeader a', 1, 7, $final_output);

processPaginatedUrlPattern('http://androidlifes.com/page/{page}/?s=ifans', 'h2.title a', 1, 7, $final_output);
processPaginatedUrlPattern('http://french.androidlifes.com/search/ifans/page/{page}', '.post-info h2 a', 1, 8, $final_output);
processPaginatedUrlPattern('http://greek.androidlifes.com/search/ifans/page/{page}', '.PostHeader a', 1, 7, $final_output);
processPaginatedUrlPattern('http://irish.androidlifes.com/search/ifans/page/{page}', '.art-PostHeader a', 1, 8, $final_output);
processPaginatedUrlPattern('http://russian.androidlifes.com/search/ifans/page/{page}', '.post-info h2 a', 1, 8, $final_output);

processPaginatedUrlPattern('http://droidlifes.com/page/{page}/?s=ifans', 'h2.title a', 1, 7, $final_output);
processPaginatedUrlPattern('http://french.droidlifes.com/search/ifans/page/{page}', '.post-info h2 a', 1, 8, $final_output);
processPaginatedUrlPattern('http://greek.droidlifes.com/search/ifans/page/{page}', '.PostHeader a', 1, 7, $final_output);
processPaginatedUrlPattern('http://irish.droidlifes.com/search/ifans/page/{page}', '.art-PostHeader a', 1, 8, $final_output);
processPaginatedUrlPattern('http://russian.droidlifes.com/search/ifans/page/{page}', '.post-info h2 a', 1, 8, $final_output);

processPaginatedUrlPattern('http://greek.elecdoll.com/page/{page}/?s=ifans', 'h2.title a', 1, 8, $final_output);
processPaginatedUrlPattern('http://japan.elecdoll.com/search/ifans/page/{page}', '.post-title a', 1, 8, $final_output);
processPaginatedUrlPattern('http://poland.elecdoll.com/page/{page}/?s=ifans', 'h2.title a', 1, 8, $final_output);
processPaginatedUrlPattern('http://french.elecdoll.com/search/ifans/page/{page}', '.art-PostHeader a', 1, 10, $final_output);
processPaginatedUrlPattern('http://spanish.elecdoll.com/page/{page}/?s=ifans', 'h2.title a', 1, 10, $final_output);
processPaginatedUrlPattern('http://irish.elecdoll.com/search/ifans/page/{page}/', 'h3 a', 1, 7, $final_output);
processPaginatedUrlPattern('http://elecdoll.com/search/ifans/page/{page}/', 'postTitle a', 1, 9, $final_output);
processPaginatedUrlPattern('http://italy.elecdoll.com/search/ifans/page/{page}/', '.art-PostHeader a', 1, 8, $final_output);

processPaginatedUrlPattern('http://widgetstalk.info/search/ifans/page/{page}/', '.post-info h2 a', 1, 6, $final_output);

processPaginatedUrlPattern('http://poland.techinlifes.com/search/ifans/page/{page}', '.PostHeader a', 1, 8, $final_output);
processPaginatedUrlPattern('http://techinlifes.com/page/{page}/?s=ifans', 'h2.title a', 1, 8, $final_output);
processPaginatedUrlPattern('http://japan.techinlifes.com/page/{page}/?s=ifans', 'h2.title a', 1, 6, $final_output);
processPaginatedUrlPattern('http://russian.techinlifes.com/search/ifans/page/{page}/', 'h3 a', 1, 7, $final_output);
processPaginatedUrlPattern('http://greek.techinlifes.com/search/ifans/page/{page}', '.PostHeader a', 1, 10, $final_output);
processPaginatedUrlPattern('http://spanish.techinlifes.com/search/ifans/page/{page}/', '.postTitle a', 1, 7, $final_output);

processPaginatedUrlPattern('http://droidlifes.com/page/{page}/?s=ifans', 'h2.title a', 1, 7, $final_output);
processPaginatedUrlPattern('http://french.droidlifes.com/search/ifans/page/{page}', '.post-info h2 a', 1, 8, $final_output);
processPaginatedUrlPattern('http://greek.droidlifes.com/search/ifans/page/{page}', '.PostHeader a', 1, 7, $final_output);
processPaginatedUrlPattern('http://irish.droidlifes.com/search/ifans/page/{page}', '.art-PostHeader a', 1, 8, $final_output);
processPaginatedUrlPattern('http://russian.droidlifes.com/search/ifans/page/{page}', '.post-info h2 a', 1, 8, $final_output);
processPaginatedUrlPattern('http://elecdoll.com/search/ifans/page/{page}/', '.postTitle a', 1, 9, $final_output);

processPaginatedUrlPattern('http://digestblogs.info/search/ifans/page/{page}/', '.PostHeader a', 1, 8, $final_output);


// Match up the scraped articles with the originals
$mysqli = new mysqli("localhost", "root", "", "wordpress");
matchOutputWithArticles($final_output, $mysqli);

// Print the output in formats suitable for C&P and Google's complex DMCA form
printOutputCopyAndPaste($final_output);
printOutputJavascriptForm($final_output);

//print_r($final_output);

?>
