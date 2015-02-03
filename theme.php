<?php
/**
 * Name: Vier-Dev
 * Version: 1.2a
 * Author: Fabio <http://kirgroup.com/profile/fabrixxm>
 * Author: Ike <http://pirati.ca/profile/heluecht>
 * Author: Beanow <https://fc.oscp.info/profile/beanow>
 * Maintainer: Ike <http://pirati.ca/profile/heluecht>
 * Description: "Vier" is a very compact and modern theme. It uses the font awesome font library: http://fortawesome.github.com/Font-Awesome/
 */

function vier_dev_init(&$a) {
set_template_engine($a, 'smarty3');

$baseurl = $a->get_baseurl();

$a->theme_info = array();

$style = get_pconfig(local_user(), 'vier', 'style');

if ($style == "")
	$style = get_config('vier', 'style');

if ($style == "flat")
	$a->page['htmlhead'] .= '<link rel="stylesheet" href="view/theme/vier/flat.css" type="text/css" media="screen"/>'."\n";
else if ($style == "netcolour")
	$a->page['htmlhead'] .= '<link rel="stylesheet" href="view/theme/vier/netcolour.css" type="text/css" media="screen"/>'."\n";
else if ($style == "breathe")
	$a->page['htmlhead'] .= '<link rel="stylesheet" href="view/theme/vier/breathe.css" type="text/css" media="screen"/>'."\n";
else if ($style == "plus")
	$a->page['htmlhead'] .= '<link rel="stylesheet" href="view/theme/vier/plus.css" type="text/css" media="screen"/>'."\n";
else if ($style == "dark")
	$a->page['htmlhead'] .= '<link rel="stylesheet" href="view/theme/vier/dark.css" type="text/css" media="screen"/>'."\n";

$a->page['htmlhead'] .= <<< EOT
<script type="text/javascript">

function insertFormatting(comment,BBcode,id) {

		var tmpStr = $("#comment-edit-text-" + id).val();
		if(tmpStr == comment) {
			tmpStr = "";
			$("#comment-edit-text-" + id).addClass("comment-edit-text-full");
			$("#comment-edit-text-" + id).removeClass("comment-edit-text-empty");
			openMenu("comment-edit-submit-wrapper-" + id);
			$("#comment-edit-text-" + id).val(tmpStr);
		}

	textarea = document.getElementById("comment-edit-text-" +id);
	if (document.selection) {
		textarea.focus();
		selected = document.selection.createRange();
		if (BBcode == "url"){
			selected.text = "["+BBcode+"]" + "http://" +  selected.text + "[/"+BBcode+"]";
			} else
		selected.text = "["+BBcode+"]" + selected.text + "[/"+BBcode+"]";
	} else if (textarea.selectionStart || textarea.selectionStart == "0") {
		var start = textarea.selectionStart;
		var end = textarea.selectionEnd;
		if (BBcode == "url"){
			textarea.value = textarea.value.substring(0, start) + "["+BBcode+"]" + "http://" + textarea.value.substring(start, end) + "[/"+BBcode+"]" + textarea.value.substring(end, textarea.value.length);
			} else
		textarea.value = textarea.value.substring(0, start) + "["+BBcode+"]" + textarea.value.substring(start, end) + "[/"+BBcode+"]" + textarea.value.substring(end, textarea.value.length);
	}
	return true;
}


function showThread(id) {
	$("#collapsed-comments-" + id).show()
	$("#collapsed-comments-" + id + " .collapsed-comments").show()
}
function hideThread(id) {
	$("#collapsed-comments-" + id).hide()
	$("#collapsed-comments-" + id + " .collapsed-comments").hide()
}


function cmtBbOpen(id) {
	$("#comment-edit-bb-" + id).show();
}
function cmtBbClose(id) {
	$("#comment-edit-bb-" + id).hide();
}
</script>
EOT;


	//get statuses of boxes at right-hand-column
	$close_pages      = get_vier_config( "close_pages", 1 );
	$close_profiles   = get_vier_config( "close_profiles", 0 );
	$close_helpers    = get_vier_config( "close_helpers", 0 );
	$close_services   = get_vier_config( "close_services", 0 );
	$close_friends    = get_vier_config( "close_friends", 0 );
	$close_lastusers  = get_vier_config( "close_lastusers", 0 );
	$close_lastphotos = get_vier_config( "close_lastphotos", 0 );
	$close_lastlikes  = get_vier_config( "close_lastlikes", 0 );

	// remove doubled checkboxes at contacts-edit-page
	if ($a->argv[0] === "contacts" && $a->argv[1] != NULL && local_user()){
		$a->page['htmlhead'] .= '
			<script>
			 $(document).ready(function() {
			$("span.group_unselected").attr("style","display: none;");
			$("span.group_selected").attr("style","display: none;");
			$("input.unticked.action").attr("style","float: left; margin-top: 5px;-moz-appearance: none;");
			$("li.menu-profile-list").attr("style","min-height: 22px;");
		});
		</script>';
	}

	//build boxes at right_aside at profile pages
	if (($a->argv[0].$a->argv[1] === "profile".$a->user['nickname']) AND ($ccCookie != "9")) {
		// COMMUNITY
		vier_community_info();
	}

/*
	//write js-scripts to the head-section:
	//load jquery.cookie.js
	$cookieJS = $a->get_baseurl($ssl_state)."/view/theme/vier/js/jquery.cookie.js";
	$a->page['htmlhead'] .= sprintf('<script type="text/javascript" src="%s"></script>', $cookieJS);
	//load jquery.ae.image.resize.js
	$imageresizeJS = $a->get_baseurl($ssl_state)."/view/theme/vier/js/jquery.ae.image.resize.min.js";
	$a->page['htmlhead'] .= sprintf('<script type="text/javascript" src="%s" ></script>', $imageresizeJS);
	//load jquery.ui.js
	if($ccCookie != "9") {
		$jqueryuiJS = $a->get_baseurl($ssl_state)."/view/theme/vier/js/jquery-ui.min.js";
		$a->page['htmlhead'] .= sprintf('<script type="text/javascript" src="%s" ></script>', $jqueryuiJS);
		$jqueryuicssJS = $a->get_baseurl($ssl_state)."/view/theme/vier/jquery-ui.min.css";
		$a->page['htmlhead'] .= sprintf('<link rel="stylesheet" type="text/css" href="%s" />', $jqueryuicssJS);
	}
*/

	$a->page['htmlhead'] .= '
		<script>
		$(function() {
			$("a.lightbox").colorbox({maxHeight:"90%"}); // Select all links with lightbox class
			$("a#closeicon").colorbox({inline:true,onClosed: function() { $("#boxsettings").attr("style","display: none;");}} );
	 	});

		$(window).load(function() {
			var footer_top = $(document).height() - 30;
			$("div#footerbox").attr("style", "border-top: 1px solid #D2D2D2; width: 70%;right: 15%;position: absolute;top:"+footer_top+"px;");
		});
		</script>';

	//check if community_home-plugin is activated and change css.. we need this, that the submit-wrapper doesn't overlay the login-panel if communityhome-plugin is active
	$nametocheck = "communityhome";
	$r = q("select id from addon where name = '%s' and installed = 1", dbesc($nametocheck));
	if(count($r) == "1" && $a->argv[0] === "home") {
		$a->page['htmlhead'] .= '
			<script>
			$(function() {
				$("div#login-submit-wrapper").attr("style","padding-top: 120px;");
			});
			</script>';
	}

	//comment-edit-wrapper on photo_view... we need this to workaround a global bug in photoview, where the comment-box is between the last comment the the comment before the last
	if ($a->argv[0].$a->argv[2] === "photos"."image"){
		$a->page['htmlhead'] .= '
			<script>
				$(function(){
					$(".comment-edit-form").css("display","table");
				});
			</script>';
	}
	//restore (only) the order right hand col at settingspage
	if($a->argv[0] === "settings" && local_user()) {
		$a->page['htmlhead'] .= '
			<script>
				function restore_boxes(){
					$.cookie("Boxorder",null, { expires: 365, path: "/" });
					alert("Boxorder at right-hand column was restored. Please refresh your browser");
 				}
			</script>';
	}

	if ($a->argv[0].$a->argv[1] === "profile".$a->user['nickname'] or $a->argv[0] === "network" && local_user()){
		$a->page['htmlhead'] .= '
			<script>
 				$(function() {
					$(".oembed.photo img").aeImageResize({height: 400, width: 400});
  				});
			</script>';

		if($ccCookie != "9") {
			$a->page['htmlhead'] .= '
				<script>
					$("right_aside").ready(function(){

						if('.$close_pages.') {
							document.getElementById( "close_pages" ).style.display = "none";
						};

						if('.$close_profiles.') {
							document.getElementById( "close_profiles" ).style.display = "none";
						};

						if('.$close_helpers.') {
							document.getElementById( "close_helpers" ).style.display = "none";
						};

						if('.$close_services.') {
							document.getElementById( "close_services" ).style.display = "none";
						};

						if('.$close_friends.') {
							document.getElementById( "close_friends" ).style.display = "none";
						};

						if('.$close_lastusers.') {
							document.getElementById( "close_lastusers" ).style.display = "none";
						};

						if('.$close_lastphotos.') {
							document.getElementById( "close_lastphotos" ).style.display = "none";
						};

						if('.$close_lastlikes.') {
							document.getElementById( "close_lastlikes" ).style.display = "none";
						};
					});

				</script>';}
		}
		//end js scripts
}


function get_vier_config($key, $default = false) {
	if (local_user()) {
		$result = get_pconfig(local_user(), "vier", $key);
		if ($result !== false)
			return $result;
	}

	$result = get_config("vier", $key);
	if ($result !== false)
		return $result;

	return $default;
}

function vier_community_info() {
	$a = get_app();

	$close_pages      = get_vier_config("close_pages", 1);
	$close_profiles   = get_vier_config("close_profiles", 0);
	$close_helpers    = get_vier_config("close_helpers", 0);
	$close_services   = get_vier_config("close_services", 0);
	$close_friends    = get_vier_config("close_friends", 0);
	$close_lastusers  = get_vier_config("close_lastusers", 0);
	$close_lastphotos = get_vier_config("close_lastphotos", 0);
	$close_lastlikes  = get_vier_config("close_lastlikes", 0);

/*	$close_pages      = 1;
	$close_profiles   = 0;
	$close_helpers    = 0;
	$close_services   = 0;
	$close_friends    = 0;
	$close_lastusers  = 0;
	$close_lastphotos = 0;
	$close_lastlikes  = 0;
*/
	// comunity_profiles
	if($close_profiles != "1") {
		$aside['$comunity_profiles_title'] = t('Community Profiles');
		$aside['$comunity_profiles_items'] = array();
		$r = q("select gcontact.* from gcontact left join glink on glink.gcid = gcontact.id
			  where glink.cid = 0 and glink.uid = 0 order by rand() limit 9");
		$tpl = get_markup_template('ch_directory_item.tpl');
		if(count($r)) {
			$photo = 'photo';
			foreach($r as $rr) {
				$profile_link = $a->get_baseurl() . '/profile/' . ((strlen($rr['nickname'])) ? $rr['nickname'] : $rr['profile_uid']);
				$entry = replace_macros($tpl,array(
					'$id' => $rr['id'],
					'$profile_link' => zrl($rr['url']),
					'$photo' => $rr[$photo],
					'$alt_text' => $rr['name'],
				));
				$aside['$comunity_profiles_items'][] = $entry;
			}
		}
	}

	// last 12 users
	if($close_lastusers != "1") {
		$aside['$lastusers_title'] = t('Last users');
		$aside['$lastusers_items'] = array();
		$sql_extra = "";
		$publish = (get_config('system','publish_all') ? '' : " AND `publish` = 1 ");
		$order = " ORDER BY `register_date` DESC ";

		$r = q("SELECT `profile`.*, `profile`.`uid` AS `profile_uid`, `user`.`nickname`
				FROM `profile` LEFT JOIN `user` ON `user`.`uid` = `profile`.`uid`
				WHERE `is-default` = 1 $publish AND `user`.`blocked` = 0 $sql_extra $order LIMIT %d , %d ",
				0, 9);

		$tpl = get_markup_template('ch_directory_item.tpl');
		if(count($r)) {
			$photo = 'thumb';
			foreach($r as $rr) {
				$profile_link = $a->get_baseurl() . '/profile/' . ((strlen($rr['nickname'])) ? $rr['nickname'] : $rr['profile_uid']);
				$entry = replace_macros($tpl,array(
					'$id' => $rr['id'],
					'$profile_link' => $profile_link,
					'$photo' => $a->get_cached_avatar_image($rr[$photo]),
					'$alt_text' => $rr['name']));
				$aside['$lastusers_items'][] = $entry;
			}
		}
	}

	// last 10 liked items
	if($close_lastlikes != "1") {
		$aside['$like_title'] = t('Last likes');
		$aside['$like_items'] = array();
		$r = q("SELECT `T1`.`created`, `T1`.`liker`, `T1`.`liker-link`, `item`.* FROM
				(SELECT `parent-uri`, `created`, `author-name` AS `liker`,`author-link` AS `liker-link`
					FROM `item` WHERE `verb`='http://activitystrea.ms/schema/1.0/like' GROUP BY `parent-uri` ORDER BY `created` DESC) AS T1
				INNER JOIN `item` ON `item`.`uri`=`T1`.`parent-uri`
				WHERE `T1`.`liker-link` LIKE '%s%%' OR `item`.`author-link` LIKE '%s%%'
				GROUP BY `uri`
				ORDER BY `T1`.`created` DESC
				LIMIT 0,5",
				$a->get_baseurl(),$a->get_baseurl());

		foreach ($r as $rr) {
			$author	 = '<a href="' . $rr['liker-link'] . '">' . $rr['liker'] . '</a>';
			$objauthor =  '<a href="' . $rr['author-link'] . '">' . $rr['author-name'] . '</a>';

			//var_dump($rr['verb'],$rr['object-type']); killme();
			switch($rr['verb']){
				case 'http://activitystrea.ms/schema/1.0/post':
					switch ($rr['object-type']){
						case 'http://activitystrea.ms/schema/1.0/event':
							$post_type = t('event');
							break;
						default:
							$post_type = t('status');
					}
					break;
				default:
					if ($rr['resource-id']){
						$post_type = t('photo');
						$m=array();
						preg_match("/\[url=([^]]*)\]/", $rr['body'], $m);
						$rr['plink'] = $m[1];
					} else
						$post_type = t('status');
			}
			$plink = '<a href="' . $rr['plink'] . '">' . $post_type . '</a>';

			$aside['$like_items'][] = sprintf( t('%1$s likes %2$s\'s %3$s'), $author, $objauthor, $plink);

		}
	}

	// last 12 photos
	if($close_lastphotos != "1") {
		$aside['$photos_title'] = t('Last photos');
		$aside['$photos_items'] = array();
		$r = q("SELECT `photo`.`id`, `photo`.`resource-id`, `photo`.`scale`, `photo`.`desc`, `user`.`nickname`, `user`.`username` FROM
				(SELECT `resource-id`, MAX(`scale`) as maxscale FROM `photo`
					WHERE `profile`=0 AND `contact-id`=0 AND `album` NOT IN ('Contact Photos', '%s', 'Profile Photos', '%s')
						AND `allow_cid`='' AND `allow_gid`='' AND `deny_cid`='' AND `deny_gid`='' GROUP BY `resource-id`) AS `t1`
				INNER JOIN `photo` ON `photo`.`resource-id`=`t1`.`resource-id` AND `photo`.`scale` = `t1`.`maxscale`,
				`user`
				WHERE `user`.`uid` = `photo`.`uid`
				AND `user`.`blockwall`=0
				AND `user`.`hidewall`=0
				ORDER BY `photo`.`edited` DESC
				LIMIT 0, 9",
				dbesc(t('Contact Photos')),
				dbesc(t('Profile Photos'))
				);
		if(count($r)) {
			$tpl = get_markup_template('ch_directory_item.tpl');
			foreach($r as $rr) {
				$photo_page = $a->get_baseurl() . '/photos/' . $rr['nickname'] . '/image/' . $rr['resource-id'];
				$photo_url = $a->get_baseurl() . '/photo/' .  $rr['resource-id'] . '-' . $rr['scale'] .'.jpg';

				$entry = replace_macros($tpl,array(
					'$id' => $rr['id'],
					'$profile_link' => $photo_page,
					'$photo' => $photo_url,
					'$alt_text' => $rr['username']." : ".$rr['desc']));

				$aside['$photos_items'][] = $entry;
			}
		}
	}

	//right_aside FIND FRIENDS
	if (($close_friends != "1") AND local_user()) {
		$nv = array();
		$nv['title'] = Array("", t('Find Friends'), "", "");
		$nv['directory'] = Array('directory', t('Local Directory'), "", "");
		$nv['global_directory'] = Array('http://dir.friendica.com/', t('Global Directory'), "", "");
		$nv['match'] = Array('match', t('Similar Interests'), "", "");
		$nv['suggest'] = Array('suggest', t('Friend Suggestions'), "", "");
		$nv['invite'] = Array('invite', t('Invite Friends'), "", "");

		$nv['search'] = '<form name="simple_bar" method="get" action="http://dir.friendica.com/directory">
						<span class="sbox_l"></span>
						<span class="sbox">
						<input type="text" name="search" size="13" maxlength="50">
						</span>
						<span class="sbox_r" id="srch_clear"></span>';

		$aside['$nv'] = $nv;
	}

	//Community_Pages at right_aside
	if(($close_pages != "1") AND local_user()) {
		$page = '
			<h3 style="margin-top:0px;">'.t("Community Pages").'<a id="closeicon" href="#boxsettings" onClick="open_boxsettings(); return false;" style="text-decoration:none;" class="icon close_box" title="'.t("Settings").'"></a></h3>
			<div id=""><ul style="margin-left: 7px;margin-top: 0px;padding-left: 0px;padding-top: 0px;">';

		$pagelist = array();

		$contacts = q("SELECT `id`, `url`, `name`, `micro`FROM `contact`
				WHERE `network`= 'dfrn' AND `forum` = 1 AND `uid` = %d
				ORDER BY `name` ASC",
				intval($a->user['uid']));

		$pageD = array();

		// Look if the profile is a community page
		foreach($contacts as $contact) {
			$pageD[] = array("url"=>$contact["url"], "name"=>$contact["name"], "id"=>$contact["id"], "micro"=>$contact['micro']);
		};


		$contacts = $pageD;

		foreach($contacts as $contact) {
			$page .= '<li style="list-style-type: none;" class="tool"><img height="20" width="20" style="float: left; margin-right: 3px;" src="' . $contact['micro'] .'" alt="' . $contact['url'] . '" /> <a href="'.$a->get_baseurl().'/redir/'.$contact["id"].'" style="margin-top: 2px; word-wrap: break-word; width: 132px;" title="' . $contact['url'] . '" class="label" target="external-link">'.
					$contact["name"]."</a></li>";
		}
		$page .= '</ul></div>';
		//if (sizeof($contacts) > 0)
			$aside['$page'] = $page;
	}
	//END Community Page

	//helpers
	if($close_helpers != "1") {
		$helpers = array();
		$helpers['title'] = Array("", t('Help or @NewHere ?'), "", "");
		$aside['$helpers'] = $helpers;
	}
	//end helpers

	//connectable services
	if ($close_services != "1") {
		$con_services = array();
		$con_services['title'] = Array("", t('Connect Services'), "", "");
		$aside['$con_services'] = $con_services;
	}
	//end connectable services

	if($ccCookie != "9") {
		$close_pages      = get_vier_config( "close_pages", 1 );
		$close_profiles   = get_vier_config( "close_profiles", 0 );
		$close_helpers    = get_vier_config( "close_helpers", 0 );
		$close_services   = get_vier_config( "close_services", 0 );
		$close_friends    = get_vier_config( "close_friends", 0 );
		$close_lastusers  = get_vier_config( "close_lastusers", 0 );
		$close_lastphotos = get_vier_config( "close_lastphotos", 0 );
		$close_lastlikes  = get_vier_config( "close_lastlikes", 0 );
		$close_or_not = array('1'=>t("don't show"),	'0'=>t("show"),);
		$boxsettings['title'] = Array("", t('Show/hide boxes at right-hand column:'), "", "");
		$aside['$boxsettings'] = $boxsettings;
		$aside['$close_pages'] = array('vier_close_pages', t('Community Pages'), $close_pages, '', $close_or_not);
		$aside['$close_profiles'] = array('vier_close_profiles', t('Community Profiles'), $close_profiles, '', $close_or_not);
		$aside['$close_helpers'] = array('vier_close_helpers', t('Help or @NewHere ?'), $close_helpers, '', $close_or_not);
		$aside['$close_services'] = array('vier_close_services', t('Connect Services'), $close_services, '', $close_or_not);
		$aside['$close_friends'] = array('vier_close_friends', t('Find Friends'), $close_friends, '', $close_or_not);
		$aside['$close_lastusers'] = array('vier_close_lastusers', t('Last users'), $close_lastusers, '', $close_or_not);
		$aside['$close_lastphotos'] = array('vier_close_lastphotos', t('Last photos'), $close_lastphotos, '', $close_or_not);
		$aside['$close_lastlikes'] = array('vier_close_lastlikes', t('Last likes'), $close_lastlikes, '', $close_or_not);
		$aside['$sub'] = t('Submit');
		$baseurl = $a->get_baseurl($ssl_state);
		$aside['$baseurl'] = $baseurl;

		if (isset($_POST['vier-settings-box-sub']) && $_POST['vier-settings-box-sub']!=''){
			set_pconfig(local_user(), 'vier', 'close_pages', $_POST['vier_close_pages']);
			set_pconfig(local_user(), 'vier', 'close_profiles', $_POST['vier_close_profiles']);
			set_pconfig(local_user(), 'vier', 'close_helpers', $_POST['vier_close_helpers']);
			set_pconfig(local_user(), 'vier', 'close_services', $_POST['vier_close_services']);
			set_pconfig(local_user(), 'vier', 'close_friends', $_POST['vier_close_friends']);
			set_pconfig(local_user(), 'vier', 'close_lastusers', $_POST['vier_close_lastusers']);
			set_pconfig(local_user(), 'vier', 'close_lastphotos', $_POST['vier_close_lastphotos']);
			set_pconfig(local_user(), 'vier', 'close_lastlikes', $_POST['vier_close_lastlikes']);
		}
	}
	$close = t('Settings');
	$aside['$close'] = $close;

	//get_baseurl
	$url = $a->get_baseurl($ssl_state);
	$aside['$url'] = $url;

	//print right_aside
	$tpl = get_markup_template('communityhome.tpl');
	$a->page['right_aside'] = replace_macros($tpl, $aside);
}
