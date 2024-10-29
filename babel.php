<?php
/*
Plugin Name: Babel
Plugin URI: http://p.osting.it/my-works/babel/
Description: Babel permit you to write your post in multi language. 
Version: 0.65
Author: gh3
Author URI: http://p.osting.it

*/

add_action("admin_menu","babel_config_menu");

function babel_config_menu()
{
	if (function_exists("add_submenu_page"))
		add_submenu_page("plugins.php", __("Babel"), __("Babel"), "manage_options", "config-babel_", "babel_config");
} 

function babel_config()
{
	echo "ok";
}

$titleTag="h1";

$arrayLang = array(
	0 => array ( 'lang' => 'it',
				 'default' => '1',
				 'title' => 'Italiano'),
	1 => array ( 'lang' => 'en',
				 'default' => '0',
				 'title' => 'English'));
				 
function babel_styles() {

    $babel_path =  get_settings('siteurl')."/wp-content/plugins/babel/";

	echo "\n<script type=\"text/javascript\" src=\"".$babel_path."babel.js\"></script>\n";
	
}

function default_lang()
{
	global $arrayLang;
	
	$a = $arrayLang;

	$c = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,2);
	
	if($_COOKIE["babel"]) $c = $_COOKIE["babel"];

	$override = 0;

	for ($i=0;$i<count($a);$i++)
	{
		if($c == $a[$i]['lang'] ) $override = 1;
	}
	
	if($override)
	{
		for ($i=0;$i<count($a);$i++)
		{
			if($a[$i]['lang']==$c) 	$a[$i]['default']=1;
		
			else $a[$i]['default']=0;
		}
	}
	
	return $a;
}

function taggerZ($m, $d, $r)
{
	if($d==1) return "<div class='$r' style=''>\n".$m."\n</div>";
    else return "<div class='$r' style='display:none;'>\n".$m."\n</div>";
}

function babelized_Content($content)
{
	
	$languages = default_lang();

	foreach ($languages as $lang)
	{
		$replace="%\[".$lang['lang'].".*(?:/([^'/]*)/)?\s*(?:/([^'/]*)/)?\s*\](.*)\[/".$lang['lang']."\]%isU";
  			
		$content = preg_replace($replace, taggerZ('\\3', $lang['default'], $lang['lang']), $content );
		
	}

	return $content;
}

function babelized_Title($title)
{
	global $titleTag;
	
	$id=get_the_ID();
	
	if(is_single() || is_page() || is_home() || is_category())
	{
			
		global $arrayLang;
			
		$default = 0;
	
		$c = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,2);
	
		if($_COOKIE["babel"]) $c = $_COOKIE["babel"];
		
		
			
		foreach ($arrayLang as $lang)
		{
			$l = get_post_custom($id);
						
			if($l[$lang['lang']][0])
			{
				$titolo .= '<a href="'.get_permalink().'" class="'.$lang['lang'].'" style="display:';
			
				if($lang['lang']==$c) 
				{
					$titolo.= 'block;">';
					$default = 1;
				}
				else $titolo.= 'none;">';
						
				$titolo.= $l[$lang['lang']][0]."</a>";
			}
		}
		
		if(empty($titolo)) return '<a href="'.get_permalink().'">'.$title.'</a>';
		
		foreach ($arrayLang as $lang)
		{
			if($lang['default']==1) 
			{
				$titolo .= '<a href="'.get_permalink().'" class="'.$lang['lang'].'" style="display:';
			
				if($lang['lang']==$c || $default==0) $titolo.= 'block;">';
				else $titolo.= 'none;">';
						
				$titolo .= $title."</a>";
			}	
		}
	
		return $titolo;
	}

	//else return '<'.$titleTag.'><a href="'.get_permalink().'">'.$title.'</a></'.$titleTag.'>';
	else return $title;
}

function _b($testo,$link,$lang)
{
	$arrayLang = default_lang();

	foreach($arrayLang as $l)
	{
		if($l['lang']==$lang)
		{
			if($l['default']==1) $status="block;";
			else $status="none;";
		}
	}
	
	echo "<h2><a href='".$link."' class='".$lang."' style='display:".$status."'>";
	
	echo $testo;

	echo "</a></h2>";
}

function babelize()
{

		global $titleTag;
		
		$home = get_settings('siteurl');

		$languages = default_lang();
	
		foreach ($languages as $l)
		{
			
			echo " <a href=\"javascript:void(null);\" onclick=\"";
  							
			foreach ($languages as $u)
  	
				if($u['lang']!=$l['lang']) echo "babel('".$u['lang']."',document.getElementById('".$u['lang']."u'),'$home',1,'$titleTag');";
  														
  			echo "babel('".$l['lang']."', this,'$home',0,'$titleTag');\" id=\"".$l['lang']."u\" title=\"".$l['title']."\">";
			echo "<img src=\"".get_settings('siteurl')."/wp-content/plugins/babel/";
			if($l['default']!=1) echo "d";
			echo $l['lang'].".gif\" id='".$l['lang']."i' border='0' alt='".$l['title']."' /></a>";
  		}  				
}	

  
function banner()
{
	echo '<div align="center">This blog is multi language by <a href="http://p.osting.it">p.osting.it</a>\'s <a href="http://p.osting.it/my-works/babel/">Babel</a></div>';
}

add_action('wp_head', 'babel_styles');
add_action('wp_footer', 'banner');
add_filter('the_content', 'babelized_Content', 2);
add_filter('the_title', 'babelized_Title');
?>