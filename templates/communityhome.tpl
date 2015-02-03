<div id="boxsettings" style="display:none">
<form id="boxsettingsform" action="network" method="post" >
<fieldset><legend>{{$boxsettings.title.1}}</legend>
{{include file="field_select.tpl" field=$close_pages}}
{{include file="field_select.tpl" field=$close_profiles}}
{{include file="field_select.tpl" field=$close_helpers}}
{{include file="field_select.tpl" field=$close_services}}
{{include file="field_select.tpl" field=$close_friends}}
{{include file="field_select.tpl" field=$close_lastusers}}
{{include file="field_select.tpl" field=$close_lastphotos}}
{{include file="field_select.tpl" field=$close_lastlikes}}
<div class="settings-submit-wrapper">
<input id="boxsub" type="submit" value="{{$sub}}" class="settings-submit" name="diabook-settings-box-sub"></input>
</div>
</fieldset>
</form>
</div>

<div id="pos_null" style="margin-bottom:-30px;">
</div>

<div id="sortable_boxes">

<div id="close_pages" style="margin-top:30px;">
{{if $page}}
<div>{{$page}}</div>
{{/if}}
</div>

<div id="close_profiles">
{{if $comunity_profiles_title}}
<h3>{{$comunity_profiles_title}}<a id="closeicon" href="#boxsettings" onClick="open_boxsettings(); return false;" style="text-decoration:none;" class="icon close_box" title="{{$close}}"></a></h3>
<div id='lastusers-wrapper' class='items-wrapper'>
{{foreach $comunity_profiles_items as $i}}
	{{$i}}
{{/foreach}}
</div>
{{/if}}
</div>

<div id="close_helpers">
{{if $helpers}}
<h3>{{$helpers.title.1}}<a id="closeicon" href="#boxsettings" onClick="open_boxsettings(); return false;" style="text-decoration:none;" class="icon close_box" title="{{$close}}"></a></h3>
<a href="http://friendica.com/resources" title="How-to's" style="margin-left: 10px; " target="blank">How-To Guides</a><br>
<a href="http://kakste.com/profile/newhere" title="@NewHere" style="margin-left: 10px; " target="blank">NewHere</a><br>
<a href="https://helpers.pyxis.uberspace.de/profile/helpers" style="margin-left: 10px; " title="Friendica Support" target="blank">Friendica Support</a><br>
{{/if}}
</div>

<div id="close_services">
{{if $con_services}}
<h3>{{$con_services.title.1}}<a id="closeicon" href="#boxsettings" onClick="open_boxsettings(); return false;" style="text-decoration:none;" class="icon close_box" title="{{$close}}"></a></h3>
<div id="right_service_icons" style="margin-left: 16px; margin-top: 5px;">
<a href="{{$url}}/facebook"><img alt="Facebook" src="view/theme/diabook/icons/facebook.png" title="Facebook"></a>
<a href="{{$url}}/settings/connectors"><img alt="StatusNet" src="view/theme/diabook/icons/StatusNet.png?" title="StatusNet"></a>
<a href="{{$url}}/settings/connectors"><img alt="LiveJournal" src="view/theme/diabook/icons/livejournal.png?" title="LiveJournal"></a>
<a href="{{$url}}/settings/connectors"><img alt="Posterous" src="view/theme/diabook/icons/posterous.png?" title="Posterous"></a>
<a href="{{$url}}/settings/connectors"><img alt="Tumblr" src="view/theme/diabook/icons/tumblr.png?" title="Tumblr"></a>
<a href="{{$url}}/settings/connectors"><img alt="Twitter" src="view/theme/diabook/icons/twitter.png?" title="Twitter"></a>
<a href="{{$url}}/settings/connectors"><img alt="WordPress" src="view/theme/diabook/icons/wordpress.png?" title="WordPress"></a>
<a href="{{$url}}/settings/connectors"><img alt="E-Mail" src="view/theme/diabook/icons/email.png?" title="E-Mail"></a>
</div>
{{/if}}
</div>

<div id="close_friends" style="margin-bottom:53px;">
{{if $nv}}
<h3>{{$nv.title.1}}<a id="closeicon" href="#boxsettings" onClick="open_boxsettings(); return false;" style="text-decoration:none;" class="icon close_box" title="{{$close}}"></a></h3>
<a class="{{$nv.directory.2}}" href="{{$nv.directory.0}}" style="margin-left: 10px; " title="{{$nv.directory.3}}" >{{$nv.directory.1}}</a><br>
<a class="{{$nv.global_directory.2}}" href="{{$nv.global_directory.0}}" target="blank" style="margin-left: 10px; " title="{{$nv.global_directory.3}}" >{{$nv.global_directory.1}}</a><br>
<a class="{{$nv.match.2}}" href="{{$nv.match.0}}" style="margin-left: 10px; " title="{{$nv.match.3}}" >{{$nv.match.1}}</a><br>
<a class="{{$nv.suggest.2}}" href="{{$nv.suggest.0}}" style="margin-left: 10px; " title="{{$nv.suggest.3}}" >{{$nv.suggest.1}}</a><br>
<a class="{{$nv.invite.2}}" href="{{$nv.invite.0}}" style="margin-left: 10px; " title="{{$nv.invite.3}}" >{{$nv.invite.1}}</a>
{{$nv.search}}
{{/if}}
</div>

<div id="close_lastusers">
{{if $lastusers_title}}
<h3>{{$lastusers_title}}<a id="closeicon" href="#boxsettings" onClick="open_boxsettings(); return false;" style="text-decoration:none;" class="icon close_box" title="{{$close}}"></a></h3>
<div id='lastusers-wrapper' class='items-wrapper'>
{{foreach $lastusers_items as $i}}
	{{$i}}
{{/foreach}}
</div>
{{/if}}
</div>

{{if $activeusers_title}}
<h3>{{$activeusers_title}}</h3>
<div class='items-wrapper'>
{{foreach $activeusers_items as $i}}
	{{$i}}
{{/foreach}}
</div>
{{/if}}

<div id="close_lastphotos">
{{if $photos_title}}
<h3>{{$photos_title}}<a id="closeicon" href="#boxsettings" onClick="open_boxsettings(); return false;" style="text-decoration:none;" class="icon close_box" title="{{$close}}"></a></h3>
<div id='ra-photos-wrapper' class='items-wrapper'>
{{foreach $photos_items as $i}}
	{{$i}}
{{/foreach}}
</div>
{{/if}}
</div>

<div id="close_lastlikes">
{{if $like_title}}
<h3>{{$like_title}}<a id="closeicon" href="#boxsettings" onClick="open_boxsettings(); return false;" style="text-decoration:none;" class="icon close_box" title="{{$close}}"></a></h3>
<ul id='likes'>
{{foreach $like_items as $i}}
	<li id='ra-photos-wrapper'>{{$i}}</li>
{{/foreach}}
</ul>
{{/if}}
</div>

</div>
