<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-58de70416f2cd9c8"></script> 
<script>
    @if(!empty(Config::get('settings')->analytics_id))
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', '{{ Config::get('settings')->analytics_id }}', 'auto');
    ga('send', 'pageview');
    @endif
</script>