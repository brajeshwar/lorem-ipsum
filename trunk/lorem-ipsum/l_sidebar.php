<!-- START: l_sidebar -->
<div id="l_sidebar">
<ul id="l_sidebarwidgeted">
<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(1) ) : else : ?>

<li id="Categories">
<h2>Categories</h2>
<ul><?php wp_list_categories('orderby=name&show_count=1&hide_empty=1&title_li'); ?></ul>

<!-- why not try a calendar here, something like the k10k.net style -->

<li id="ads-adsense">
<h2>Sponsors</h2>
<script type="text/javascript"><!--
google_ad_client = "pub-4468481779445136"; //change this to your Publisher ID
google_ad_width = 160;
google_ad_height = 600;
google_ad_format = "160x600_as";
google_ad_type = "text";
//2007-04-01: wp-theme-lorem-ipsum
google_ad_channel = "2784874737"; //change this to your appropriate channel
google_color_border = "FFFFFF";
google_color_bg = "FFFFFF";
google_color_link = "333333";
google_color_text = "666666";
google_color_url = "000000";
//-->
</script>
<script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>

<?php endif; ?>
</ul>
			
</div>
<!-- END: l_sidebar -->