<?php
/**
**********************
** BTManager v3.0.1 **
**********************
** http://www.btmanager.org/
** https://github.com/blackheart1/BTManager
** http://demo.btmanager.org/index.php
** Licence Info: GPL
** Copyright (C) 2018
** Formerly Known As phpMyBitTorrent
** Created By Antonio Anzivino (aka DJ Echelon)
** And Joe Robertson (aka joeroberts/Black_Heart)
** Project Leaders: Black_Heart, Thor.
** File imdb.class.php 2018-07-07 14:32:00 joeroberts
**
** CHANGES
**
** 07-07-18 - bug fix for function count()
**/

 require_once (dirname(__FILE__)."/browseremulator.class.php");
 require_once (dirname(__FILE__)."/imdb_config.php");
 require_once (dirname(__FILE__)."/imdb_request.class.php");

 #=================================================[ The IMDB class itself ]===
 /** Accessing IMDB information
  * @package Api
  * @class imdb
  * @extends imdb_config
  * @author Georgos Giagas
  * @author Izzy (izzysoft AT qumran DOT org)
  * @copyright (c) 2002-2004 by Giorgos Giagas and (c) 2004-2008 by Itzchak Rehberg and IzzySoft
  * @version $Revision: 1.1 $ $Date: 2008/09/21 02:34:43 $
  */
function get_image_extension($filename, $include_dot = true, $shorter_extensions = true) {
  $image_info = @getimagesize($filename);
  if (!$image_info || empty($image_info[2])) {
    return false;
  }

  if (!function_exists('image_type_to_extension')) {
    /**
     * Given an image filename, get the file extension.
     *
     * @param $imagetype
     *   One of the IMAGETYPE_XXX constants.
     * @param $include_dot
     *   Whether to prepend a dot to the extension or not. Default to TRUE.
     * @param $shorter_extensions
     *   Whether to use a shorter extension or not. Default to TRUE.
     * @return
     *   A string with the extension corresponding to the given image type, or
     *   FALSE on failure.
     */
    function image_type_to_extensiona ($imagetype, $include_dot = true) {
      // Note we do not use the IMAGETYPE_XXX constants as these will not be
      // defined if GD is not enabled.
      $extensions = array(
        1  => 'gif',
        2  => 'jpeg',
        3  => 'png',
        4  => 'swf',
        5  => 'psd',
        6  => 'bmp',
        7  => 'tiff',
        8  => 'tiff',
        9  => 'jpc',
        10 => 'jp2',
        11 => 'jpf',
        12 => 'jb2',
        13 => 'swc',
        14 => 'aiff',
        15 => 'wbmp',
        16 => 'xbm',
      );

      // We are expecting an integer between 1 and 16.
      $imagetype = (int)$imagetype;
      if (!$imagetype || !isset($extensions[$imagetype])) {
        return false;
      }

      return ($include_dot ? '.' : '') . $extensions[$imagetype];
    }
  }

  $extension = image_type_to_extension($image_info[2], $include_dot);
  if (!$extension) {
    return false;
  }

  if ($shorter_extensions) {
    $replacements = array(
      'jpeg' => 'jpg',
      'tiff' => 'tif',
    );
    $extension = strtr($extension, $replacements);
  }
  return $extension;
}
 class imdb extends imdb_config {

 #---------------------------------------------------------[ Debug helpers ]---
  function debug_scalar($scalar) {
    if ($this->debug) echo "<b><font color='#ff0000'>$scalar</font></b><br>";
  }
  function debug_object($object) {
    if ($this->debug) {
      echo "<font color='#ff0000'><pre>";
      print_r($object);
      echo "</pre></font>";
    }
  }
  function debug_html($html) {
    if ($this->debug) echo "<b><font color='#ff0000'>".htmlentities($html)."</font></b><br>";
  }

 #-------------------------------------------------------------[ Open Page ]---
  /** Load an IMDB page into the corresponding property (variable)
   * @method private openpage
   * @param string wt
   */
  function openpage ($wt) {
   if (strlen($this->imdbID) != 7){
    $this->debug_scalar("not valid imdbID: ".$this->imdbID."<BR>".strlen($this->imdbID));
    $this->page[$wt] = "cannot open page";
    return;
   }
   switch ($wt){
    case "Title"       : $urlname="/"; break;
    case "Credits"     : $urlname="/fullcredits"; break;
    case "CrazyCredits": $urlname="/crazycredits"; break;
    case "Plot"        : $urlname="/plotsummary"; break;
    case "Taglines"    : $urlname="/taglines"; break;
    case "Episodes"    : $urlname="/episodes"; break;
    case "Quotes"      : $urlname="/quotes"; break;
    case "Trailers"    : $urlname="/videogallery/"; break;
    case "Trailer"    : $urlname="/video/screenplay"; break;
    case "Goofs"       : $urlname="/goofs"; break;
    case "Trivia"      : $urlname="/trivia"; break;
    case "Soundtrack"  : $urlname="/soundtrack"; break;
    case "MovieConnections" : $urlname="/movieconnections"; break;
    case "ExtReviews"  : $urlname="/externalreviews"; break;
    case "MPAA"  : $urlname="/parentalguide"; break;
    default            :
      $this->page[$wt] = "unknown page identifier";
      $this->debug_scalar("Unknown page identifier: $wt");
      return;
   }
   
   if ($this->usecache) {
    $fname = $this->cachedir . 'imdb_' . $this->imdbID . $wt;
    if ( $this->usezip ) {
     if ( ($this->page[$wt] = @join("",@gzfile($fname))) ) {
      if ( $this->converttozip ) {
       @$fp = fopen ($fname,"r");
       $zipchk = fread($fp,2);
       fclose($fp);
       if ( !($zipchk[0] == chr(31) && $zipchk[1] == chr(139)) ) { //checking for zip header
         /* converting on access */
         $fp = @gzopen ($fname, "w");
         @gzputs ($fp, $this->page[$wt]);
         @gzclose ($fp);
       }
      }
      return;
     }
    } else { // no zip
	//die($fname);
     @$fp = fopen ($fname, "r");
     if ($fp) {
      $temp="";
      while (!feof ($fp)) {
	 $temp .= fread ($fp, 1024);
	 $this->page[$wt] = $temp;
      }
      return;
     }
    }
   } // end cache

   $req = new IMDB_Request('');
   $url = "https://www.imdb.com/title/tt".$this->imdbID.$urlname;
   //die($url);
   $req->setURL($url);
   $req->sendRequest();
   $this->page[$wt]=str_replace(array('  ',"\r\n", "\r", "\n"), '',$req->getResponseBody());
   if( $this->page[$wt] ){ //storecache
    if ($this->storecache) {
    $fname = $this->cachedir . 'imdb_' . $this->imdbID . $wt;
     if ( $this->usezip ) {
      $fp = gzopen ($fname, "w");
      gzputs ($fp, $this->page[$wt]);
      gzclose ($fp);
     } else { // no zip
      $fp = fopen ($fname, "w");
      fputs ($fp, $this->page[$wt]);
      fclose ($fp);
     }
    }
    return;
   }
   $this->page[$wt] = "cannot open page";
   $this->debug_scalar("cannot open page: $url");
  }

 #-------------------------------------------------------[ Get current MID ]---
  /** Retrieve the IMDB ID
   * @method imdbid
   * @return string id
   */
  function imdbid () {
   return $this->imdbID;
  }

 #--------------------------------------------------[ Start (over) / Reset ]---
  /** Setup class for a new IMDB id
   * @method setid
   * @param string id
   */
  function setid ($id) {
   $this->imdbID = $id;

   $this->page["Title"] = "";
   $this->page["Credits"] = "";
   $this->page["CrazyCredits"] = "";
   $this->page["Amazon"] = "";
   $this->page["Goofs"] = "";
   $this->page["Trivia"] = "";
   $this->page["Plot"] = "";
   $this->page["Comments"] = "";
   $this->page["Quotes"] = "";
   $this->page["Taglines"] = "";
   $this->page["Plotoutline"] = "";
   $this->page["Trivia"] = "";
   $this->page["Directed"] = "";
   $this->page["Episodes"] = "";
   $this->page["Quotes"] = "";
   $this->page["Trailers"] = "";
   $this->page["Trailer"] = "";
   $this->page["MovieConnections"] = "";
   $this->page["ExtReviews"] = "";

   $this->akas = array();
   $this->countries = array();
   $this->crazy_credits = array();
   $this->credits_cast = array();
   $this->credits_composer = array();
   $this->credits_director = array();
   $this->credits_producer = array();
   $this->credits_writing = array();
   $this->extreviews = array();
   $this->goofs = array();
   $this->langs = array();
   $this->main_comment = "";
   $this->main_genre = "";
   $this->main_language = "";
   $this->main_photo = "";
   $this->main_plotoutline = "";
   $this->main_rating = -1;
   $this->main_runtime = "";
   $this->main_title = "";
   $this->main_votes = -1;
   $this->main_year = -1;
   $this->main_tagline = "";
   $this->moviecolors = array();
   $this->movieconnections = array();
   $this->moviegenres = array();
   $this->moviequotes = array();
   $this->movieruntimes = array();
   $this->mpaas = array();
   $this->plot_plot = array();
   $this->seasoncount = -1;
   $this->season_episodes = array();
   $this->sound = array();
   $this->soundtracks = array();
   $this->split_comment = array();
   $this->split_plot = array();
   $this->taglines = array();
   $this->trailers = array();
   $this->trivia = array();
   $this->main_trailer = "";
  }

 #-----------------------------------------------------------[ Constructor ]---
  /** Initialize class
   * @constructor imdb
   * @param string id
   */
  function __construct($id) {
   $this->imdb_config();
   $this->setid($id);
   if ($this->storecache && ($this->cache_expire > 0)) $this->purge();
  }
    public function imdb($id)
    {
        self::__construct($id);
    }

 #---------------------------------------------------------[ Cache Purging ]---
  /** Check cache and purge outdated files
   *  This method looks for files older than the cache_expire set in the
   *  imdb_config and removes them
   * @method purge
   */
  function purge() {
	  return;
    if (is_dir($this->cachedir))  {
      $thisdir = dir($this->cachedir);
      $now = time();
      while( $file=$thisdir->read() ) {
        if ($file!="." && $file!="..") {
          $fname = $this->cachedir . $file;
	  if (is_dir($fname)) continue;
          $mod = filemtime($fname);
          if ($mod && ($now - $mod > $this->cache_expire)) unlink($fname);
        }
      }
    } elseif (!empty($this->cachedir)) {
      $this->debug_scalar("Cache directory (".$this->cachedir.") does not exist - purge aborted.");
    }
  }

 #-----------------------------------------------[ URL to movies main page ]---
  /** Set up the URL to the movie title page
   * @method main_url
   * @return string url
   */
  function main_url(){
   return "https://".$this->imdbsite."/title/tt".$this->imdbid()."/";
  }

 #-------------------------------------------[ Movie title (name) and year ]---
  /** Setup title and year properties
   * @method private title_year
   */
  function title_year() {
    if ($this->page["Title"] == "") $this->openpage ("Title");
    if (preg_match("/<title>(.*?)\((.*?)\) - IMDb<\/title>/",$this->page["Title"],$match)) {
		//die(print_r($match));
      $this->main_title = $match[1];
      $this->main_year  = $match[2];
    }
  }

  /** Get movie title
   * @method title
   * @return string title
   */
  function title () {
    if ($this->main_title == "") $this->title_year();
    return $this->main_title;
  }

  /** Get year
   * @method year
   * @return string year
   */
  function year () {
    if ($this->main_year == -1) $this->title_year();
    return $this->main_year;
  }

 #---------------------------------------------------------------[ Runtime ]---
  /** Get general runtime
   * @method private runtime_all
   * @return string runtime complete runtime string, e.g. "150 min / USA:153 min (director's cut)"
   */
  function runtime_all() {
    if ($this->main_runtime == "") {
      if ($this->page["Title"] == "") $this->openpage ("Title");
      if (@preg_match("/<\/span><\/li><li role=\"presentation\" class=\"ipc-inline-list__item\">([0-9][h].*?)min<\/li><\/ul>/m",$this->page["Title"],$match))
        $this->main_runtime = $match[1];
		//die(print_r($match));
    }
    return $this->main_runtime;
  }

  /** Get overall runtime (first one mentioned on title page)
   * @method runtime
   * @return mixed string runtime in minutes (if set), NULL otherwise
   */
  function runtime() {
    if (empty($this->movieruntimes)) $runarr = $this->runtimes();
    else $runarr = $this->movieruntimes;
    if (isset($runarr[0]["time"])) return $runarr[0]["time"];
    return NULL;
  }

  /** Retrieve language specific runtimes
   * @method runtimes
   * @return array runtimes (array[0..n] of array[time,country,comment])
   */
  function runtimes(){
    if (empty($this->movieruntimes)) {
      if ($this->runtime_all() == "") return array();
      if (preg_match_all("/[\/ ]*((\D*?):|)([\d]+?) min( \((.*?)\)|)/",$this->main_runtime,$matches))
        for ($i=0;$i<count($matches[0]);++$i) $this->movieruntimes[] = array("time"=>$matches[3][$i],"country"=>$matches[2][$i],"comment"=>$matches[5][$i]);
    }
    return $this->movieruntimes;
  }

 #----------------------------------------------------------[ Movie Rating ]---
  /** Setup votes
   * @method private rate_vote
   */
  function rate_vote() {
    if ($this->page["Title"] == "") $this->openpage ("Title");
	
	if(preg_match("/<span class=\"AggregateRatingButton__RatingScore-sc-1ll29m0-1 iTLWoV\">(.*?)<\/span>/m",$this->page["Title"],$match)){
		//die(print_r($match));
      $this->main_rating = $match[1];
	}
	unset($match);
	if(preg_match("/<div class=\"AggregateRatingButton__TotalRatingAmount-sc-1ll29m0-3 jkCVKJ\">(.*?)<\/div>/m",$this->page["Title"],$match)){
      $this->main_votes = $match[1];
	}
  }

  /** Get movie rating
   * @method rating
   * @return string rating
   */
  function rating () {
    if ($this->main_rating == '-1') $this->rate_vote();
    return $this->main_rating;
  }

  /** Return votes for this movie
   * @method votes
   * @return string votes
   */
  function votes () {
    if ($this->main_votes == -1) $this->rate_vote();
    return $this->main_votes;
  }

 #------------------------------------------------------[ Movie Comment(s) ]---
  /** Get movie main comment (from title page)
   * @method comment
   * @return string comment
   */
  function comment () {
    if ($this->main_comment == "") {
      if ($this->page["Title"] == "") $this->openpage ("Title");
      if (@preg_match("/\<div class=\"comment-meta\">(.*?)&ndash;(.*?)<\/div>(.*?)<div>(.*?)<\/div>/ms",$this->page["Title"],$match))
	  //print_r($match);
	  $this->main_comment = $match[0];
        //$this->main_comment = preg_replace("/a href\=\"\//i","a href=\"http://".$this->imdbsite."/",$match[2]);
    }
    return $this->main_comment;
  }

  /** Get movie main comment (from title page - split-up variant)
   * @method comment_split
   * @return array comment array[string title, string date, array author, string comment]; author: array[string url, string name]
   */
  function comment_split() {
    if (empty($this->split_comment)) {
      if ($this->main_comment == "") $comm = $this->comment();
      if (@preg_match("/<b>(.*?)<\/b>, (.*)<br>.*?<a href=\"(.*)\">(.*?)<\/a>.*<p>(.*?)<\/p>/ms",$this->main_comment,$match))
        $this->split_comment = array("title"=>$match[1],"date"=>$match[2],"author"=>array("url"=>$match[3],"name"=>$match[4]),"comment"=>trim($match[5]));
    }
    return $this->split_comment;
  }

 #--------------------------------------------------------[ Language Stuff ]---
  /** Get movies original language
   * @method language
   * @return string language
   * @brief There is not really a main language on the IMDB sites (yet), so this
   *  simply returns the first one
   */
  function language () {
   if ($this->main_language == "") {
    if (empty($this->langs)) $langs = $this->languages();
    $this->main_language = $this->langs[0];
   }
   return $this->main_language;
  }

  /** Get all langauges this movie is available in
   * @method languages
   * @return array languages (array[0..n] of strings)
   */
  function languages () {
   if (empty($this->langs)) {
    if ($this->page["Title"] == "") $this->openpage ("Title");
    if (preg_match_all("/<a href=\"\/language\/(.*?)>(.*?)<\/a>/",$this->page["Title"],$matches))
	//print_r($matches); 
      $this->langs = array($matches[2][0]);
   }
   return $this->langs;
  }

 #--------------------------------------------------------------[ Genre(s) ]---
  /** Get the movies main genre
   *  Since IMDB.COM does not really now a "Main Genre", this simply means the
   *  first mentioned genre will be returned.
   * @method genre
   * @return string genre
   * @brief There is not really a main genre on the IMDB sites (yet), so this
   *  simply returns the first one
   */
  function genre () {
   if (empty($this->main_genre)) {
    if (empty($this->moviegenres)) $genres = $this->genres();
    if (!empty($genres)) $this->main_genre = $this->moviegenres[0];
   }
   return $this->main_genre;
  }

  /** Get all genres the movie is registered for
   * @method genres
   * @return array genres (array[0..n] of strings)
   */
  function genres () {
    if (empty($this->moviegenres)) {
      if ($this->page["Title"] == "") $this->openpage ("Title");
    if (preg_match_all("/\<a class=\"ipc-metadata-list-item__list-content-item ipc-metadata-list-item__list-content-item--link\" rel=\"\" href=\"\/search\/title\/\?genres.*?>(.*?)<\/a>/",$this->page["Title"],$matches))
        $this->moviegenres = $matches[1];
		//die(print_r($matches[1]));
    }
    return $this->moviegenres;
  }

 #----------------------------------------------------------[ Color format ]---
  /** Get colors
   * @method colors
   * @return array colors (array[0..1] of strings)
   */
  function colors () {
    if (empty($this->moviecolors)) {
      if ($this->page["Title"] == "") $this->openpage ("Title");
      if (preg_match_all("/\/List\?color-info.*?>(.*?)<span class=\"see-more inline\">/",$this->page["Title"],$matches))
        $this->moviecolors = $matches[1];
    }
    return $this->moviecolors;
  }

 #---------------------------------------------------------------[ Tagline ]---
  /** Get the main tagline for the movie
   * @method tagline
   * @return string tagline
   */
  function tagline () {
    if ($this->main_tagline == "") {
      if ($this->page["Title"] == "") $this->openpage ("Title");
      if (@preg_match("/<h4 class=\"inline\">Taglines:<\/h4>([^&]*)<span class=\"see-more inline\">/",$this->page["Title"],$match)) {
        if(@preg_match("/^(.*?)\<a class\=\"tn15more/ms",$match[1],$match2)) $this->main_tagline = $match2[1];
        else $this->main_tagline = $match[1];
      }
    }
    return $this->main_tagline;
  }

 #---------------------------------------------------------------[ Seasons ]---
  /** Get the number of seasons or 0 if not a series
   * @method seasons
   * @return int seasons
   */
  function seasons() {
    if ( $this->seasoncount == -1 ) {
      if ( $this->page["Title"] == "" ) $this->openpage("Title");
      if ( preg_match_all('|<a href="episodes#season-\d+">(\d+)</a>|Ui',$this->page["Title"],$matches) ) {
        $this->seasoncount = count($matches[0]);
      } else {
        $this->seasoncount = 0;
      }
    }
    return $this->seasoncount;
  }

 #--------------------------------------------------------[ Plot (Outline) ]---
  /** Get the main Plot outline for the movie
   * @method plotoutline
   * @return string plotoutline
   */
  function plotoutline () {
    if ($this->main_plotoutline == "") {
      if ($this->page["Title"] == "") $this->openpage ("Title");
      if (@preg_match("/<div class=\"ipc-html-content ipc-html-content--base\"><div>(.*?)\<a/ms",$this->page["Title"],$match))
        $this->main_plotoutline = $match[1];
    }
    return $this->main_plotoutline;
  }
	function release_date () {
      if ($this->page["Title"] == "") $this->openpage ("Title");
	 // die($this->page["Title"]);
    //if (preg_match_all("/\<a class=\"ipc-metadata-list-item__list-content-item ipc-metadata-list-item__list-content-item--link\" rel=\"\" href=\"\/search\/title\/\?genres.*? >(.*?)<\/a>/",$this->page["Title"],$matches))
      preg_match("/\<a class=\"ipc-metadata-list-item__list-content-item ipc-metadata-list-item__list-content-item--link\" rel=\"\" href=\"\/title\/tt(.*?)\/releaseinfo\?ref_=tt_dt_rdat\">(.*?)<\/a>/ms",$this->page["Title"],$match);
	  //die(print_r($match));
      if (empty($match[2])) return FALSE;
	  //print_r($match);
	  return $match[2];
	}
 #--------------------------------------------------------[ Photo specific ]---
  /** Get cover photo
   * @method photo
   * @return mixed photo (string url if found, FALSE otherwise)
   */
  function photo () {
    if (empty($this->main_photo)) {
      if ($this->page["Title"] == "") $this->openpage ("Title");
      preg_match("/\<div class=\"ipc-poster ipc-poster--baseAlt ipc-poster--dynamic-width ipc-sub-grid-item ipc-sub-grid-item--span-2\"(.*?)>(.*?)<img(.*?)src\=\"(.*?)\"/ms",$this->page["Title"],$match);
      if (empty($match[4])) return FALSE;
	  //die(print_r($match));
      $this->main_photo = $match[4];
    }
    return $this->main_photo;
  }

  /** Save the photo to disk
   * @method savephoto
   * @param string path
   * @return boolean success
   */
  function savephoto ($path) {
    $req = new IMDB_Request("");
    $photo_url = $this->photo ();
    if (!$photo_url) return FALSE;
    $req->setURL($photo_url);
    $req->sendRequest();
    if (strpos($req->getResponseHeader("Content-Type"),'image/jpeg') === 0
      || strpos($req->getResponseHeader("Content-Type"),'image/gif') === 0
      || strpos($req->getResponseHeader("Content-Type"), 'image/bmp') === 0 ){
	$fp = $req->getResponseBody();
    }else{
	$this->debug_scalar("<BR>*photoerror* ".$photo_url.": Content Type is '".$req->getResponseHeader("Content-Type")."'<BR>");
	return false;
    }
    $fp2 = fopen ($path, "w");
    if ((!$fp) || (!$fp2)){
      $this->debug_scalar("image error...<BR>");
      return false;
    }
    fputs ($fp2, $fp);
    return TRUE;
  }

  /** Get the URL for the movies cover photo
   * @method photo_localurl
   * @return mixed url (string URL or FALSE if none)
   */
  function photo_localurl(){
    $path = $this->photodir.$this->imdbid().".jpg";
    if ( @fopen($path,"r"))      return $this->photoroot.$this->imdbid().'.jpg';
    if ($this->savephoto($path)) return $this->photoroot.$this->imdbid().'.jpg';
    return false;
  }

 #-------------------------------------------------[ Country of Production ]---
  /** Get country of production
   * @method country
   * @return array country (array[0..n] of string)
   */
  function country () {
   if (empty($this->countries)) {
    if ($this->page["Title"] == "") $this->openpage ("Title");
    $this->countries = array();
    if (preg_match_all("/<a href=\"\/country\/(.*?)>(.*?)<\/a>/",$this->page["Title"],$matches))
      for ($i=0;$i<count($matches[0]);++$i) $this->countries[$i] = $matches[2][$i];
   }
   return $this->countries;
  }

 #------------------------------------------------------------[ Movie AKAs ]---
  /** Get movies alternative names
   * @method alsoknow
   * @return array aka array[0..n] of array[title,year,country,comment]; searching
   *         on akas.imdb.com will add "lang" to the array for localized names,
   *         "comment" will hold additional countries listed along
   */
  function alsoknow () {
   if (empty($this->akas)) {
    if ($this->page["Title"] == "") $this->openpage ("Title");
    $ak_s = strpos ($this->page["Title"], "Also Known As:",0);
    if ($ak_s>0) $ak_s += 19;
    if ($ak_s == 0) $ak_s = strpos ($this->page["Title"], "Alternativ:",0);
    if ($ak_s == 0) return array();
    $alsoknow_end = strpos ($this->page["Title"], "</div>", $ak_s);
    $alsoknow_all = substr($this->page["Title"], $ak_s, $alsoknow_end - $ak_s);
    if (preg_match_all("/([^&]*)<span/",$alsoknow_all,$matches))
      for ($i=0;$i<count($matches[0]);++$i) $this->akas[] = array("title"=>$matches[1][$i],"year"=>$matches[2][$i],"country"=>$matches[3][$i],"comment"=>$matches[4][$i]);
	if (preg_match_all("/<i class=\"transl\">([^\[\(]+?) (\(\d{4}\) |)(\([^\[]+)\s*\[(.*?)\]<\/i><br>/",$alsoknow_all,$matches)) { // localized variants on akas.imdb.com
      for ($i=0;$i<count($matches[0]);++$i) {
        $country = ""; $comment = "";
        if (preg_match_all("/\((.*?)\)/",$matches[3][$i],$countries)) {
          $country = $countries[1][0];
          for ($k=1;$k<count($countries[0]);++$k) $comment .= ", ".$countries[1][$k];
        }
        $this->akas[] = array("title"=>$matches[1][$i],"year"=>$matches[2][$i],"country"=>$country,"comment"=>@substr($comment,2),"lang"=>$matches[4][$i],"orig"=>$matches[0][$i]);
      }
    }
   }
   return $this->akas;
  }

 #---------------------------------------------------------[ Sound formats ]---
  /** Get sound formats
   * @method sound
   * @return array sound (array[0..n] of strings)
   */
  function sound () {
   if (empty($this->sound)) {
    if ($this->page["Title"] == "") $this->openpage ("Title");
    if (preg_match_all("/\/List\?sound.*?>(.*?)</",$this->page["Title"],$matches))
      $this->sound = $matches[1];
   }
   return $this->sound;
  }

 #-------------------------------------------------------[ MPAA / PG / FSK ]---
  /** Get the MPAA data (also known as PG or FSK)
   * @method mpaa
   * @return array mpaa (array[country]=rating)
   */
  function mpaa () {
   if (empty($this->mpaas)) {
    if ($this->page["MPAA"] == "") $this->openpage ("MPAA");
	//die($this->page["MPAA"]);
    if (preg_match_all("/\ipl-inline-list.*?><a.*?>(.*?):(.*?)<\//",$this->page["MPAA"],$matches)) {
	//die(print_r($matches));
      $cc = count($matches[0]);
      for ($i=0;$i<$cc;++$i) $this->mpaas[$matches[1][$i]] = $matches[2][$i];
    }
   }
   //die(print_r($this->mpaas));
   return $this->mpaas;
  }

 #-----------------------------------------------------[ /plotsummary page ]---
  /** Get the movies plot(s)
   * @method plot
   * @return array plot (array[0..n] of strings)
   */
  function plot () {
   if (empty($this->plot_plot)) {
    if ( $this->page["Title"] == "" ) $this->openpage ("Title");
    if ( $this->page["Title"] == "" ) return array(); // no such page
	//die($this->page["Title"]);
    if (preg_match_all("/\<div class=\"inline canwrap\"><p><span>(.*?)<\/span><\/p><\/div>/ms",$this->page["Title"],$matches))
	//die(print_r($matches));
      for ($i=0;$i<count($matches[1]);++$i)
        $this->plot_plot[$i] = strip_tags($matches[1][$i]);
   }
   return $this->plot_plot;
  }

  /** Get the movie plot(s) - split-up variant
   * @method plot_split
   * @return array array[0..n] of array[string plot,array author] - where author consists of string name and string url
   */
  function plot_split() {
    if (empty($this->split_plot)) {
      if (empty($this->plot_plot)) $plots = $this->plot();
      for ($i=0;$i<count($this->plot_plot);++$i) {
        if (preg_match("/(.*?)<i>.*<a href=\"(.*?)\">(.*?)<\/a>/",$this->plot_plot[$i],$match))
          $this->split_plot[] = array("plot"=>$match[1],"author"=>array("name"=>$match[3],"url"=>$match[2]));
      }
    }
    return $this->split_plot;
  }

 #--------------------------------------------------------[ /taglines page ]---
  /** Get all available taglines for the movie
   * @method taglines
   * @return array taglines (array[0..n] of strings)
   */
  function taglines () {
   if (empty($this->taglines)) {
    if ( $this->page["Taglines"] == "" ) $this->openpage ("Taglines");
    if ( $this->page["Taglines"] == "cannot open page" ) return array(); // no such page
    if (preg_match_all("/<div class=\"soda .*?\">(.*?)<\/div>/",$this->page["Taglines"],$matches))
	//die(print_r($matches));
      $this->taglines = $matches[1];
   }
   return $this->taglines;
  }

 #-----------------------------------------------------[ /fullcredits page ]---
  /** Get rows for a given table on the page
   * @method private get_table_rows
   * @param string html
   * @param string table_start
   * @return mixed rows (FALSE if table not found, array[0..n] of strings otherwise)
   * @see used by the methods director, cast, writing, producer, composer
   */
  function get_table_rows ( $html, $table_start ){
  $html = str_replace(array('  ',"\r\n", "\r", "\n"), '',$html);
  $row_s = strpos ( $html, ">".$table_start."");
   $row_e = $row_s;
   if ( $row_s == 0 )  return FALSE;
   $endtable = strpos($html, "</table>", $row_s);
  $pattern = str_replace(array('  ',"\r\n", "\r", "\n"), '',substr($html,$row_s,$endtable - $row_s));
   if (preg_match_all("/<tr>(.*?)<\/tr>/",$pattern,$matches)) {
     $mc = count($matches[1]);
     for ($i=0;$i<$mc;++$i) if ( strncmp( trim($matches[1][$i]), "<td class=",10) == 0 ) $rows[] = $matches[1][$i];
   }
   return $rows;
  }

  /** Get rows for the cast table on the page
   * @method private get_table_rows_cast
   * @param string html
   * @param string table_start
   * @return mixed rows (FALSE if table not found, array[0..n] of strings otherwise)
   * @see used by the method cast
   */
  function get_table_rows_cast ( $html, $table_start ){
   $row_s = strpos ( $html, '<table class="cast_list">');
   $row_e = $row_s;
   if ( $row_s == 0 )  return FALSE;
   $endtable = strpos($html, "</table>", $row_s);
  // echo substr($html,$row_s,$endtable - $row_s);
  $pattern = str_replace(array('  ',"\r\n", "\r", "\n"), '',substr($html,$row_s,$endtable - $row_s));
   if (preg_match_all("/<tr.*?(<td class=\"primary_photo\".*?)<\/tr>/",$pattern,$matches))
   //die(print_r($matches));
     return $matches[1];
   return array();
  }

  /** Get content of table row cells
   * @method private get_row_cels
   * @param string row (as returned by imdb::get_table_rows)
   * @return array cells (array[0..n] of strings)
   * @see used by the methods director, cast, writing, producer, composer
   */
  function get_row_cels ( $row ){
	// die($row);
   if (preg_match_all("/<td.*?>(.*?)<\/td>/",$row,$matches))
   return $matches[1];
   if (preg_match_all("/<a href=\"(.*?)\"> (.*?)<\/a>/",$row,$matches))
   die(print_r($matches));
   return $matches[1];
   return array();
  }

  /** Get the IMDB ID from a names URL
   * @method private get_imdbname
   * @param string href
   * @return string
   * @see used by the methods director, cast, writing, producer, composer
   */
  function get_imdbname( $href){
   if ( strlen( $href) == 0) return $href;
   $name_s = 15;
   $name_e = strpos ( $href, '"', $name_s);
   if ( $name_e != 0) return substr( $href, $name_s, $name_e -1 - $name_s);
   else	return $href;
  }

  /** Get the director(s) of the movie
   * @method director
   * @return array director (array[0..n] of arrays[imdb,name,role])
   */
  function director () {
   if (empty($this->credits_director)) {
    if ( $this->page["Credits"] == "" ) $this->openpage ("Credits");
    if ( $this->page["Credits"] == "cannot open page" ) return array(); // no such page
   }
   //die($this->page["Credits"]);
   $director_rows = $this->get_table_rows($this->page["Credits"], "Directed by&nbsp;");
   if(!is_array($director_rows))$director_rows = $this->get_table_rows($this->page["Credits"], "Series Directed by&nbsp;");
	if(!is_array($director_rows))$director_rows = array($director_rows);
   for ( $i = 0; $i < count ($director_rows); $i++){
	$cels = $this->get_row_cels ($director_rows[$i]);
	if (!isset ($cels[0])) return array();
	$dir["imdb"] = $this->get_imdbname($cels[0]);
	$dir["name"] = strip_tags($cels[0]);
	$role = trim(strip_tags($cels[2]));
	if ( $role == "") $dir["role"] = NULL;
	else $dir["role"] = $role;
	$this->credits_director[$i] = $dir;
   }
   return $this->credits_director;
  }
  
  function store_cast_image($img,$path)
  {
	  if($img != '')
	  {
			$pretype = preg_replace('/(gif|jpg|jpeg|png)/','',$img);
			$type = str_replace ($pretype,'',$img);
			if(!file_exists($this->photodir.urlencode($path) . '.' . $type))
			{
				$OUTPUT = file_get_contents($img);
				$fp = fopen($this->photodir.urlencode($path) . '.' . $type,"w");
				fputs($fp, $OUTPUT);
				fclose($fp);
				@chmod($this->photodir.urlencode($path) . '.' . $type, 0755);
			}
			return $this->photodir.urlencode($path) . '.' . $type;
		}
	
  }
  
  function get_cast_image($herf, $offset)
  {
	  $html = $this->page["Credits"];
    $row_s = strpos ( $html, '<table class="cast_list">');
   $row_e = $row_s;
   if ( $row_s == 0 )  return FALSE;
   $endtable = strpos($html, "</table>", $row_s);
  // echo substr($html,$row_s,$endtable - $row_s);
  $pattern = str_replace(array('  ',"\r\n", "\r", "\n"), '',substr($html,$row_s,$endtable - $row_s));
 // die($pattern);
 $tb = array();
 $i = 0;
       if (preg_match_all("/<img height=\"44\" width=\"32\" alt=\"(.*?) src=\"(.*?)\"(.*?)>/",$pattern,$match)){
		   foreach($match[0] as $var){
			   //die(print_r($var));
			   if (preg_match_all("/<img .*?loadlate=\"(.*?)\".*?>/",$var,$mat))
			   {
				   //die(print_r($mat));
				   $tb[] = $mat[1][0];
			   }
			   else
			   $tb[] = $match[2][$i];
			   $i++;
		   }
		//die(print_r($tb));
		//return $match[2];
		return $tb;
		}
  }

  /** Get the actors
   * @method cast
   * @return array cast (array[0..n] of arrays[imdb,name,role])
   */
  function cast () {
   if (empty($this->credits_cast)) {
    if ( $this->page["Credits"] == "" ) $this->openpage ("Credits");
    if ( $this->page["Credits"] == "cannot open page" ) return array(); // no such page
   }
   $cast_rows = $this->get_table_rows_cast($this->page["Credits"], "Cast");
	$cast_imgs = $this->get_cast_image(strip_tags($cels[0]), $i);
	//die(print_r($cast_imgs));
   for ( $i = 0; $i < count ($cast_rows); $i++){
               if ($i > 9) {
                break;
               }
	$cels = $this->get_row_cels ($cast_rows[$i]);
	if (!isset ($cels[0])) return array();
	$dir["imdb"] = $this->get_imdbname($cels[0]);
	$dir["name"] = strip_tags($cels[1]);
	if($cast_imgs[$i] != '' )$dir["img"] = $this->store_cast_image($cast_imgs[$i],strip_tags($cels[1]));
	$role = strip_tags($cels[3]);
	if ( $role == "") $dir["role"] = NULL;
	else $dir["role"] = $role;
	$this->credits_cast[$i] = $dir;
   }
   return $this->credits_cast;
  }

  /** Get the writer(s)
   * @method writing
   * @return array writers (array[0..n] of arrays[imdb,name,role])
   */
  function writing () {
   if (empty($this->credits_writing)) {
    if ( $this->page["Credits"] == "" ) $this->openpage ("Credits");
    if ( $this->page["Credits"] == "cannot open page" ) return array(); // no such page
   }
   $this->credits_writing = array();
   $writing_rows = $this->get_table_rows($this->page["Credits"], "Writing Credits");
	if($writing_rows == '')$writing_rows = $this->get_table_rows($this->page["Credits"], "Series Writing Credits");
	if(!is_array($writing_rows))$writing_rows = array($writing_rows);
  for ( $i = 0; $i < count ($writing_rows); $i++)
  {
     $cels = $this->get_row_cels ($writing_rows[$i]);
     if ( count ( $cels) > 1)
	 {
       $wrt["imdb"] = $this->get_imdbname($cels[0]);
       $wrt["name"] = strip_tags($cels[0]);
       $role = strip_tags($cels[2]);
       if ( $role == "") $wrt["role"] = NULL;
       else $wrt["role"] = $role;
       $this->credits_writing[$i] = $wrt;
     }
   }
   return $this->credits_writing;
  }

  /** Obtain the producer(s)
   * @method producer
   * @return array producer (array[0..n] of arrays[imdb,name,role])
   */
  function producer () {
   if (empty($this->credits_producer)) {
    if ( $this->page["Credits"] == "" ) $this->openpage ("Credits");
    if ( $this->page["Credits"] == "cannot open page" ) return array(); // no such page
   }
   $this->credits_producer = array();
   $producer_rows = $this->get_table_rows($this->page["Credits"], "Produced by");
   if($producer_rows == '')$producer_rows = $this->get_table_rows($this->page["Credits"], "Series Produced by");
   if(!is_array($producer_rows))$producer_rows = array($producer_rows);
   for ( $i = 0; $i < count ($producer_rows); $i++){
    $cels = $this->get_row_cels ($producer_rows[$i]);
    if ( count ( $cels) > 2){
     $wrt["imdb"] = $this->get_imdbname($cels[0]);
     $wrt["name"] = strip_tags($cels[0]);
     $role = strip_tags($cels[2]);
     if ( $role == "") $wrt["role"] = NULL;
     else $wrt["role"] = $role;
     $this->credits_producer[$i] = $wrt;
    }
   }
   return $this->credits_producer;
  }

  /** Obtain the composer(s) ("Original Music by...")
   * @method composer
   * @return array composer (array[0..n] of arrays[imdb,name,role])
   */
  function composer () {
   if (empty($this->credits_composer)) {
    if ( $this->page["Credits"] == "" ) $this->openpage ("Credits");
    if ( $this->page["Credits"] == "cannot open page" ) return array(); // no such page
   }
   $this->credits_composer = array();
   $composer_rows = $this->get_table_rows($this->page["Credits"], "Original Music by");
   for ( $i = 0; $i < count ($composer_rows); $i++){
    $cels = $this->get_row_cels ($composer_rows[$i]);
    if ( count ( $cels) > 2){
     $wrt["imdb"] = $this->get_imdbname($cels[0]);
     $wrt["name"] = strip_tags($cels[0]);
     $role = strip_tags($cels[2]);
     if ( $role == "") $wrt["role"] = NULL;
     else $wrt["role"] = $role;
     $this->credits_composer[$i] = $wrt;
    }
   }
   return $this->credits_composer;
  }

 #----------------------------------------------------[ /crazycredits page ]---
  /** Get the Crazy Credits
   * @method crazy_credits
   * @return array crazy_credits (array[0..n] of string)
   */
  function crazy_credits() {
    if (empty($this->crazy_credits)) {
      if (empty($this->page["CrazyCredits"])) $this->openpage("CrazyCredits");
      if ( $this->page["CrazyCredits"] == "cannot open page" ) return array(); // no such page
      $tag_s = strpos ($this->page["CrazyCredits"],"<li><tt>");
      $tag_e = strpos ($this->page["CrazyCredits"],"</ul>",$tag_s);
      $cred  = str_replace ("<br>"," ",substr ($this->page["CrazyCredits"],$tag_s, $tag_e - $tag_s));
      $cred  = str_replace ("  "," ",str_replace ("\n"," ",$cred));
      if (preg_match_all("/<li><tt>(.*?)<\/tt><\/li>/",$cred,$matches))
        $this->crazy_credits = $matches[1];
    }
    return $this->crazy_credits;
  }

 #--------------------------------------------------------[ /episodes page ]---
  /** Get the series episode(s)
   * @method episodes
   * @return array episodes (array[0..n] of array[0..m] of array[imdbid,title,airdate,plot])
   */
  function episodes() {
    if ( $this->seasons() == 0 ) return null;
    if ( empty($this->season_episodes) ) {
      if ( $this->page["Episodes"] == "" ) $this->openpage("Episodes");
      if ( $this->page["Episodes"] == "cannot open page" ) return array(); // no such page
      if ( preg_match_all('|<h4>Season (\d+), Episode (\d+): <a href="/title/tt(\d{7})/">(.*)</a></h4><b>Original Air Date: (.*)</b><br>(.*)<br/><br/>|Ui',$this->page["Episodes"],$matches) ) {
	for ( $i = 0 ; $i < count($matches[0]); $i++ ) {
          $this->season_episodes[$matches[1][$i]][$matches[2][$i]] = array("imdbid" => $matches[3][$i],"title" => $matches[4][$i], "airdate" => $matches[5][$i], "plot" => $matches[6][$i]);
        }
      }
    }
    return $this->season_episodes;
  }

 #-----------------------------------------------------------[ /goofs page ]---
  /** Get the goofs
   * @method goofs
   * @return array goofs (array[0..n] of array[type,content]
   */
  function goofs() {
    if (empty($this->goofs)) {
      if (empty($this->page["Goofs"])) $this->openpage("Goofs");
      if ($this->page["Goofs"] == "cannot open page") return array(); // no such page
      $tag_s = strpos($this->page["Goofs"],'<ul class="trivia">');
      $tag_e = strrpos($this->page["Goofs"],'<ul class="trivia">'); // maybe more than one
      $tag_e = strrpos($this->page["Goofs"],"</ul>");
      $goofs = substr($this->page["Goofs"],$tag_s,$tag_e - $tag_s);
      if (preg_match_all("/<li><b>(.*?)<\/b>(.*?)<br><br><\/li>/",$goofs,$matches)) {
        $gc = count($matches[1]);
        for ($i=0;$i<$gc;++$i) $this->goofs[] = array("type"=>$matches[1][$i],"content"=>$matches[2][$i]);
      }
    }
    return $this->goofs;
  }

 #----------------------------------------------------------[ /quotes page ]---
  /** Get the quotes for a given movie
   * @method quotes
   * @return array quotes (array[0..n] of string)
   */
  function quotes() {
    if ( empty($this->moviequotes) ) {
      if ( $this->page["Quotes"] == "" ) $this->openpage("Quotes");
      if ( $this->page["Quotes"] == "cannot open page" ) return array(); // no such page
      if (preg_match_all("/<a name=\"qt.*?<\/a>\s*(.*?)<hr/",str_replace("\n"," ",$this->page["Quotes"]),$matches))
        $this->moviequotes = $matches[1];
    }
    return $this->moviequotes;
  }

 #--------------------------------------------------------[ /trailers page ]---
  /** Get the trailer URLs for a given movie
   * @method trailers
   * @return array trailers (array[0..n] of string)
   */
  function trailers() {
    if (empty($this->trailers) ) {
      if ( $this->page["Trailers"] == "" ) $this->openpage("Trailers");
      if ( $this->page["Trailers"] == "cannot open page" ) return array(); // no such page
      $tag_s = strpos($this->page["Trailers"], 'results-item slate');
	 // die(print($tag_s));
      if (!empty($tag_s)) { // trailers on the IMDB site itself
        $tag_e = strpos($this->page["Trailers"],"</ol></div>",$tag_s);
        $trail = substr($this->page["Trailers"], $tag_s, $tag_e - $tag_s +1);
        if (preg_match_all("/<h2><a href=\"(.*?)\"/",$trail,$matches))
          for ($i=0;$i<count($matches[0]);++$i) $this->trailers[] = "https://".$this->imdbsite.$matches[1][$i];
      }
      $tag_s = strpos($this->page["Trailers"], "<h3>Trailers on Other Sites</h3>");
      if (empty($tag_s)) return FALSE;
      $tag_e = strpos($this->page["Trailers"], "<h3>Related Links</h3>", $tag_s);
      $trail = substr($this->page["Trailers"], $tag_s, $tag_e - $tag_s);
      if (preg_match_all("/<a href=\"(.*?)\">/",$trail,$matches))
        $this->trailers = array_merge($this->trailers,$matches[0]);
    }
    return $this->trailers;
  }
function trailer () {
   if ($this->main_trailer == "") {
      if ($this->page["Title"] == "") $this->openpage ("Title");
         $trailer_s = strpos ($this->page["Title"], "strip toplinks");
            if ( $trailer_s == 0) return false;
               $trailer_s = strpos ($this->page["Title"], "trailers-", $trailer_s);
               $trailer_e = strpos ($this->page["Title"], "\"", $trailer_s);
               $this->main_trailer = substr ($this->page["Title"], $trailer_s+9, $trailer_e - $trailer_s-9);
            if (substr($this->main_trailer, 0, 2) != "me")
              $this->main_trailer = "notrailer";
   }
   return $this->main_trailer;
   }
 #----------------------------------------------------------[ /trivia page ]---
  /** Get the trivia info
   * @method trivia
   * @return array trivia (array[0..n] string
   */
  function trivia() {
    if (empty($this->trivia)) {
      if (empty($this->page["Trivia"])) $this->openpage("Trivia");
      if ($this->page["Trivia"] == "cannot open page") return array(); // no such page
      $tag_s = strpos($this->page["Trivia"],'<ul class="trivia">');
      $tag_e = strrpos($this->page["Trivia"],'<ul class="trivia">'); // maybe more than one
      $tag_e = strrpos($this->page["Trivia"],"</ul>");
      $goofs = substr($this->page["Trivia"],$tag_s,$tag_e - $tag_s);
      if (preg_match_all("/<li>(.*?)<br><br><\/li>/",$goofs,$matches)) {
        $gc = count($matches[1]);
        for ($i=0;$i<$gc;++$i) $this->trivia[] = str_replace('href="/','href="https://'.$this->imdbsite."/",$matches[1][$i]);
      }
    }
    return $this->trivia;
  }

 #------------------------------------------------------[ /soundtrack page ]---
  /** Get the soundtrack listing
   * @method soundtrack
   * @return array soundtracks (array[0..n] of array(soundtrack,array[0..n] of credits)
   * @brief Usually, the credits array should hold [0] written by, [1] performed by.
   *  But IMDB does not always stick to that - so in many cases it holds
   *  [0] performed by, [1] courtesy of
   */
  function soundtrack() {
   if (empty($this->soundtracks)) {
    if (empty($this->page["Soundtrack"])) $this->openpage("Soundtrack");
    if ($this->page["Soundtrack"] == "cannot open page") return array(); // no such page
    if (preg_match_all("/<li>(.*?)<\/b><br>(.*?)<br>(.*?)<br>.*?<\/li>/",str_replace("\n"," ",$this->page["Soundtrack"]),$matches)) {
      $mc = count($matches[0]);
      for ($i=0;$i<$mc;++$i) $this->soundtracks[] = array("soundtrack"=>$matches[1][$i],"credits"=>array(
                                                           str_replace('href="/','href="https://'.$this->imdbsite.'/',$matches[2][$i]),
                                                           str_replace('href="/','href="https://'.$this->imdbsite.'/',$matches[3][$i])));
    }
   }
   return $this->soundtracks;
  }

 #-------------------------------------------------[ /movieconnection page ]---
  /** Parse connection block (used by method movieconnection only)
   * @method private parseConnection
   * @param string conn connection type
   * @return array [0..n] of array mid,name,year,comment - or empty array if not found
   */
  function parseConnection($conn) {
    $tag_s = strpos($this->page["MovieConnections"],"<h5>$conn</h5>");
    if (empty($tag_s)) return array(); // no such feature
    $tag_e = strpos($this->page["MovieConnections"],"<h5>",$tag_s+4);
    if (empty($tag_e)) $tag_e = strpos($this->page["MovieConnections"],"<hr/><h3>",$tag_s);
    $block = substr($this->page["MovieConnections"],$tag_s,$tag_e-$tag_s);
    if (preg_match_all("/\<a href=\"(.*?)\"\>(.*?)\<\/a\> \((\d{4})\)(.*\<br\/\>\&nbsp;-\&nbsp;(.*))?/",$block,$matches)) {
      $mc = count($matches[0]);
      for ($i=0;$i<$mc;++$i) {
        $mid = substr($matches[1][$i],9,strlen($matches[1][$i])-10); // isolate imdb id from url
        $arr[] = array("mid"=>$mid, "name"=>$matches[2][$i], "year"=>$matches[3][$i], "comment"=>$matches[5][$i]);
      }
    }
    return $arr;
  }

  /** Get connected movie information
   * @method movieconnection
   * @return array connections (versionOf, editedInto, followedBy, spinOff,
   *         spinOffFrom, references, referenced, features, featured, spoofs,
   *         spoofed - each an array of mid, name, year, comment or an empty
   *         array if no connections of that type)
   */
  function movieconnection() {
    if (empty($this->movieconnections)) {
      if (empty($this->page["MovieConnections"])) $this->openpage("MovieConnections");
      if ($this->page["MovieConnections"] == "cannot open page") return array(); // no such page
      $this->movieconnections["versionOf"]  = $this->parseConnection("Version of");
      $this->movieconnections["editedInto"] = $this->parseConnection("Edited into");
      $this->movieconnections["followedBy"] = $this->parseConnection("Followed By");
      $this->movieconnections["spinOffFrom"] = $this->parseConnection("Spin off from");
      $this->movieconnections["spinOff"] = $this->parseConnection("Spin off");
      $this->movieconnections["references"] = $this->parseConnection("References");
      $this->movieconnections["referenced"] = $this->parseConnection("Referenced in");
      $this->movieconnections["features"] = $this->parseConnection("Features");
      $this->movieconnections["featured"] = $this->parseConnection("Featured in");
      $this->movieconnections["spoofs"] = $this->parseConnection("Spoofs");
      $this->movieconnections["spoofed"] = $this->parseConnection("Spoofed in");
    }
    return $this->movieconnections;
  }

 #------------------------------------------------[ /externalreviews page ]---
  /** Get list of external reviews (if any)
   * @method extReviews
   * @return array [0..n] of array [url, desc] (or empty array if no data)
   */
  function extReviews() {
    if (empty($this->extreviews)) {
      if (empty($this->page["ExtReviews"])) $this->openpage("ExtReviews");
      if ($this->page["ExtReviews"] == "cannot open page") return array(); // no such page
      if (preg_match_all("/\<li\>\<a href=\"(.*?)\"\>(.*?)\<\/a\>/",$this->page["ExtReviews"],$matches)) {
        $mc = count($matches[0]);
        for ($i=0;$i<$mc;++$i) {
          $this->extreviews[$i] = array("url"=>$matches[1][$i], "desc"=>$matches[2][$i]);
        }
      }
    }
    return $this->extreviews;
  }

 } // end class imdb

 #====================================================[ IMDB Search class ]===
 /** Search the IMDB for a title and obtain the movies IMDB ID
  * @package Api
  * @class imdbsearch
  * @extends imdb_config
  */
 class imdbsearch extends imdb_config{
  var $page = "";
  var $name = NULL;
  var $resu = array();
  var $url = "https://www.imdb.com/";
  var $main_trailer = "";

  /** Read the config
   * @constructor imdbsearch
   */
  function __construct() {
    $this->imdb_config();
    $this->search_episodes(FALSE);
  }
	function imdbsearch()
	{
		self::__construct();
	}

  /** Search for episodes or movies
   * @method search_episodes
   * @param boolean enabled TRUE: Search for episodes; FALSE: Search for movies (default)
   */
  function search_episodes($enable) {
    $this->episode_search = $enable;
  }

  /** Set the name (title) to search for
   * @method setsearchname
   * @param string searchstring what to search for - (part of) the movie name
   */
  function setsearchname ($name) {
   $this->name = $name;
   $this->page = "";
   $this->url = NULL;
  }

  /** Set the URL (overwrite default search URL and run your own)
   *  This URL will be reset if you call the setsearchname() method
   * @method seturl
   * @param string URL to use
   */
  function seturl($url){
   $this->url = $url;
  }

  /** Create the IMDB URL for the movie search
   * @method private mkurl
   * @return string url
   */
  function mkurl () {
   if ($this->url !== NULL){
    $url = $this->url;
   }else{
     if (!isset($this->maxresults)) $this->maxresults = 20;
     if ($this->maxresults > 0) $query = ";mx=20";
     if ($this->episode_search) $url = "https://".$this->imdbsite."/find?q=".urlencode($this->name).$query.";s=ep";
     else {
       switch ($this->searchvariant) {
         case "moonface" : $query = ";more=tt;nr=1"; // @moonface variant (untested)
         case "sevec"    : $query = "&restrict=Movies+only&GO.x=0&GO.y=0&GO=search;tt=1"; // Sevec ori
         default         : $query = ";tt=on"; // Izzy
       }
       $url = "https://".$this->imdbsite."/find?q=".urlencode($this->name).$query;
     }
   }
   return $url;
  }

  /** Setup search results
   * @method results
   * @param optional string URL Replace search URL by your own
   * @return array results
   */
  function results ($url="") {
   if ($this->page == "") {
     if (empty($url)) $url = $this->mkurl();
     $be = new IMDB_Request($url);
     $be->sendrequest();
     $fp = $be->getResponseBody();
     if ( !$fp ){
       if ($header = $be->getResponseHeader("Location")){
        if (strpos($header,$this->imdbsite."/find?")) {
          return $this->results($header);
          //break(4);
        }
        $url = explode("/",$header);
        $id  = substr($url[count($url)-2],2);
        $this->resu[0] = new imdb($id);
        return $this->resu;
       }else{
        return NULL;
       }
     }
     $this->page = $fp;
   } // end (page="")

   $searchstring = array( '<A HREF="/title/tt', '<A href="/title/tt', '<a href="/Title?', '<a href="/title/tt');
   $i = 0;
   foreach($searchstring as $srch){
    $res_e = 0;
    $res_s = 0;
    $mids_checked = array();
    $len = strlen($srch);
    while ((($res_s = strpos ($this->page, $srch, $res_e)) > 10)) {
      if ($i == $this->maxresults) break(2); // limit result count
      $res_e = strpos ($this->page, "(", $res_s);
      $imdb_id = substr($this->page, $res_s + $len, 7);
      $ts = strpos($this->page, ">",$res_s) +1; // >movie title</a>
      $te = strpos($this->page,"<",$ts);
      $title = substr($this->page,$ts,$te-$ts);
      if (($title == "") || (in_array($imdb_id,$mids_checked))) continue; // empty titles just come from the images
      $mids_checked[] = $imdb_id;
      $tmpres = new imdb ($imdb_id); // make a new imdb object by id
      $tmpres->main_title = $title;
      $ts = strpos($this->page,"(",$te) +1;
      $te = strpos($this->page,")",$ts);
      $tmpres->main_year=substr($this->page,$ts,$te-$ts);
      $i++;
      $this->resu[$i] = $tmpres;
    }
   }
   return $this->resu;
  }
} // end class imdbsearch

?>