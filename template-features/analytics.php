<?php 
$options = get_option('structured-options');


// function that runs when shortcode is called
function echo_cookie_settings() { 

	if(!isset($_COOKIE["allow_analytics_cookies"]) OR $_COOKIE["allow_analytics_cookies"]!=='true' ){
		$analytics_status='';
	}
	else{
		$analytics_status='checked';
	}
$html='	
<div id="cookie_box" class="m-4">
  <div class="form-check form-switch">
	<input class="form-check-input " type="checkbox" role="switch" id="cookie_box_analytical_cookies" '.$analytics_status.'>
	<label class="form-check-label" for="cookie_box_analytical_cookies">Analytical cookies</label>
  </div>
  <div class="form-check form-switch">
	<input class="form-check-input " type="checkbox" role="switch" id="cookie_box_technical_cookies" checked disabled>
	<label class="form-check-label" for="cookie_box_technical_cookies">Essential cookies</label>
  </div></div>
	<div id="cookie_box_save" class="text-center">
  <button  id="cookie_box-accept" class="rounded-0 ps-4 pe-4 d- btn btn-outline-dark" type="button">Save</button>
	</div>
';
$script='
<script>
document.addEventListener("DOMContentLoaded", function(){
if (document.contains(document.getElementById("cookie_banner"))) {
document.getElementById("cookie_banner").remove();}
});
document.getElementById("cookie_box-accept").onclick = function(e) {
  days = 200; //number of days to keep the cookie
  myDate = new Date();
  myDate.setTime(myDate.getTime()+(days*24*60*60*1000));
  is_accepted=document.getElementById("cookie_box_analytical_cookies").checked;
  document.cookie = "allow_analytics_cookies = "+is_accepted+"; expires = " + myDate.toGMTString()+"; path=/"; //creates the cookie: name|value|expiry
location.reload();
}
</script>
';
	
return $html.$script;
}
// register shortcode
add_shortcode('cookie_box', 'echo_cookie_settings');

//add cookie banner
if (isset($options['cookie_activate_input']) AND $options['cookie_activate_input']==1){
add_action( 'wp_footer', 'insert_analytics_footer');
}
function insert_analytics_footer() {
$options = get_option('structured-options');
	$cookie_slug=$options['cookie_page_slug_input'];
if(!isset($_COOKIE["allow_analytics_cookies"])) { ?>
	<style>
		#cookie_banner{    display: block; 
    position: fixed;
    bottom: 0;
    width: 100%;
    background: #110b1add;
    padding: 1rem;
    color: #fff;
    font-size: .9rem;
    font-family: arial;z-index:1000;
		}	
		#cookie_info a{color:#fff; text-decoration: underline;}
		#cookies_body{max-width:960px; width:90%; margin:auto; align-items: center;display: flex;
    justify-content: space-between; }	
		#cookie_save{    display: flex;    gap: 0.5rem;       justify-content: end;  }
		#cookie_save .btn{font-size:.9rem}
		@media(max-width:575px){ #cookies_body{display:grid;  gap:1rem;} 	#cookie_save{justify-content:center;    display: flex;
    gap: .5rem;}}
	</style> 
<div id="cookie_banner">
<div id="cookies_body"><div id="cookie_info"><p class="m-0 p-0 ">This site uses cookies to offer you a better browsing experience.<br>Find out more on <a href="<?php echo site_url();echo '/'.$cookie_slug;?>">how we use cookies.</a></p> 
</div>
	<div id="cookie_save">
  <button  id="cookie-essential" class="border-0  btn text-white" type="button">Essential cookies only</button>
  <button  id="cookie-accept" class="rounded-0 btn btn-light" type="button">Accept all cookies</button>
	</div>
  </div></div>

<script>
document.getElementById("cookie-essential").onclick = function(e) {
  days = 1; //number of days to keep the cookie
  myDate = new Date();
  myDate.setTime(myDate.getTime()+(days*24*60*60*1000));
  is_accepted='false';
  document.cookie = "allow_analytics_cookies = "+is_accepted+"; expires = " + myDate.toGMTString()+"; path=/"; //creates the cookie: name|value|expiry
location.reload();
}
document.getElementById("cookie-accept").onclick = function(e) {
  days = 100; //number of days to keep the cookie
  myDate = new Date();
  myDate.setTime(myDate.getTime()+(days*24*60*60*1000));
  is_accepted='true';
  document.cookie = "allow_analytics_cookies = "+is_accepted+"; expires = " + myDate.toGMTString()+"; path=/"; //creates the cookie: name|value|expiry
location.reload();
}
</script>
<?php } 
	

//fine cookies;	
?>


<?php 
$options = get_option('structured-options');
if (isset($options['ga_id_input']) AND $options['ga_activate_input']==1):?>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php _e($options['ga_id_input']); ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
	<?php if  ($_COOKIE['allow_analytics_cookies']=='true'):?>		
	gtag('consent', 'default', {  'ad_storage': 'denied',analytics_storage:'granted'});	
	<?php else: ?>
	gtag('consent', 'default', {  'ad_storage': 'denied',analytics_storage:'denied'});		
	<?php endif; ?>		
  gtag('js', new Date());
  gtag('config', '<?php _e($options['ga_id_input']); ?>',{ 'anonymize_ip': true });
</script>
<!-- End Google Analytics -->

<?php endif; ?>




<?php if  ($_COOKIE['allow_analytics_cookies']=='true'):?>	

<?php if (isset($options['metricool_id_input']) AND $options['metricool_activate_input']==1):?>
<!-- metricool_id_input Code -->
<script>
function loadScript(a){var b=document.getElementsByTagName("head")[0],c=document.createElement("script");c.type="text/javascript",c.src="https://tracker.metricool.com/resources/be.js",c.onreadystatechange=a,c.onload=a,b.appendChild(c)}loadScript(function(){beTracker.t({hash:"<?php _e($options['metricool_id_input']); ?>"})});
</script>
<!-- metricool_id_input Code -->

<?php endif; ?>

<?php 
if (isset($options['fbpixel_id_input']) AND $options['fbpixel_activate_input']==1):
?>

<!-- Meta Pixel Code -->
<script>

!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '<?php _e($options['fbpixel_id_input']); ?>');
fbq('track', 'PageView');

</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=<?php _e($options['fbpixel_id_input']); ?>&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->

<?php endif; ?>


<?php 
if (isset($options['matomo_id_input']) AND $options['matomo_activate_input']==1):
?>
<!-- Matomo -->
<script>
  var _paq = window._paq = window._paq || [];
  /* tracker methods like "setCustomDimension" should be called before "trackPageView" */

//DISABILITO I COOKIE
if (document.cookie.match('(^|;)\\s*' + 'allow_analytics_cookies' + '\\s*=\\s*([^;]+)')?.pop() !='allow'){ _paq.push(['disableCookies']);
}
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//analytics.btcongress.com/";
    _paq.push(['setTrackerUrl', u+'matomo.php']);
    _paq.push(['setSiteId', '<?php _e($options['matomo_id_input']); ?>']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- End Matomo Code -->
<?php endif; ?>
<?php endif; ?>

<?php if  ($_COOKIE['allow_analytics_cookies']!='true'):
$allowedcookies = array("PHPSESSID", "cookieconsent_status", "allow_analytics_cookies");
foreach ($_COOKIE as  $key => $value){
	if (!in_array($key,$allowedcookies)){
	 unset($_COOKIE[$key]); 
		echo  $_COOKIE[$key];
    setcookie($key, 'deleted', 1, '/'); 
	}
}
?>	
<script>
  /*Split Cookies into a two-dimensional array:*/
  var c_a = document.cookie.split (';').map(cookie => cookie.split('='));
  var c = 0;
//protected cookies
	const allowedcookies = ["PHPSESSID", "allow_analytics_cookies","wp_"];
	function hastring (cookie,array){
		return array.some(item => cookie.includes(item));
	}

  while (c < c_a.length) {
    var c_a_name = c_a[c][0];
	  cookiename=c_a_name.trim();
	   if (!hastring(cookiename,allowedcookies)){		   
	   document.cookie = c_a_name+'=; expires=Thu, 01 Jan 1970 00:00:00 UTC;  path=/0/; ';
	   document.cookie = c_a_name+'=; expires=Thu, 01 Jan 1970 00:00:00 UTC;  path=/0/; domain=www.' + window.location.hostname + ';';
  		//console.log('removing cookie -> '+c_a_name+'=; expires='+new Date(0).toUTCString() +'; path=/0/; Domain=.ginendo.org;')  
	  }
    c++;
  }
</script>
<?php 
	endif; 
}//chiudo function insert_analytics_footer
?>
