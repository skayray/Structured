<?php if  ($_COOKIE['cookieconsent_status_analytics']=='allow'):?>	

<?php 
$options = get_option('structured-options');
if (isset($options['ga_id_input']) AND $options['ga_activate_input']==1):
?>
<!-- Google Analytics -->
<script>

(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

ga('create', '<?php _e($options['ga_id_input']); ?>', 'auto');
ga('set', 'anonymizeIp', true);
ga('send', 'pageview');

	
</script>
<!-- End Google Analytics -->

<?php endif; ?>
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
$options = get_option('structured-options');
if (isset($options['matomo_id_input']) AND $options['matomo_activate_input']==1):
?>
<!-- Matomo -->
<script>
  var _paq = window._paq = window._paq || [];
  /* tracker methods like "setCustomDimension" should be called before "trackPageView" */

//DISABILITO I COOKIE
if (document.cookie.match('(^|;)\\s*' + 'cookieconsent_status_analytics' + '\\s*=\\s*([^;]+)')?.pop() !='allow'){ _paq.push(['disableCookies']);
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

<?php if  ($_COOKIE['cookieconsent_status_analytics']!='allow'):?>	

<script>
  /*Split Cookies into a two-dimensional array:*/
  var c_a = document.cookie.split (';').map(cookie => cookie.split('='));
	//console.log(c_a);
  var c = 0;
  while (c < c_a.length) {
    var c_a_name = c_a[c][0];
	  if (c_a_name=='cookieconsent_status_analytics' && c_a_name=='cookieconsent_status') { continue; }
	  console.log(c_a_name);
    document.cookie = c_a_name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/";
    c++;
  }

</script>
<?php endif; ?>
