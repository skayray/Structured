<?php 
//aggiungo social_sharer
    function Sharer() { 
        $post_url = urlencode(get_permalink());
		$post_title = str_replace( ' ', '%20', get_the_title());
		$bg_color="#343a40";
		$for_color="#fff";
		$social_media=Array(
			Array(
			'name'=>'Facebook',
			'share_url'=>"https://www.facebook.com/sharer/sharer.php?u=$post_url",
			'icon'=>'<i class="fab fa-facebook-f"></i>',
			'extra'=>'rel="nofollow noopener" target="_blank"',
			),
			Array(
			'name'=>'Twitter',
			'share_url'=>"https://twitter.com/intent/tweet?text=$post_title&amp;url=$post_url",
			'icon'=>'<i class="fab fa-twitter"></i>',
			'extra'=>'rel="nofollow noopener" target="_blank"',
			),
			Array(
			'name'=>'Linkedin',
			'share_url'=>"https://www.linkedin.com/shareArticle?mini=true&amp;url=$post_url&amp;title=$post_title",
			'icon'=>'<i class="fab fa-linkedin"></i>',
			'extra'=>'rel="nofollow noopener" target="_blank"',
			),
			Array(
			'name'=>'Whatsapp',
			'share_url'=>"https://api.whatsapp.com/send?text=$post_title $post_url",
			'icon'=>'<i class="fab fa-whatsapp"></i>',
			'extra'=>'rel="nofollow noopener" target="_blank"',
			),
			Array(
			'name'=>'Telegram',
			'share_url'=>"https://telegram.me/share/url?url=$post_url&amp;text=$post_title",
			'icon'=>'<i class="fab fa-telegram-plane" ></i>',
			'extra'=>'rel="nofollow noopener" target="_blank"',
			),
			Array(
			'name'=>'Email',
			'share_url'=>"mailto:?to=&amp;body=$post_title%20$post_url&amp;subject=$post_title",
			'icon'=>'<i class="fas fa-envelope" ></i>',
			'extra'=>'rel="nofollow noopener" target="_blank"',
			),
			Array(
			'name'=>'Copy Link',
			'share_url'=>"Javascript:copylink()",
			'icon'=>'<i class="fas fa-copy" ></i>',
			'extra'=>'',
			),
			);

		$style= "<style>.sharer a{background:$bg_color; padding:1px; color:$for_color;    display: inline-block;    text-align: center;    width: 22px;   height: 22px;    font-size: 14px;    line-height: 1.5;}.sharer a:hover{filter: brightness(0.9);}</style>";
		$script = "<script>function copylink() { navigator.clipboard.writeText('".get_permalink()."');  alert(\"Link copied!\");}</script>";
		$html=$style.$script;
		foreach($social_media as $arr_value){
			$html.='<a href="'.$arr_value["share_url"].'" title="Share: '. $arr_value["name"].'" '.$arr_value['extra'].'>'. $arr_value["icon"].'</a> ';
		}
		return '<div class="sharer">'.$html.'</div>';  

		
    }  
    add_shortcode("Social_Share", "Sharer");  
