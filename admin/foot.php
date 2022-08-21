   
<script src="js/datatables.js"></script>   
<script src="js/bootstrap.js"></script>
<script src="js/app.js"></script> 
<script src="js/slimscroll/jquery.slimscroll.min.js"></script>
<script src="js/charts/easypiechart/jquery.easy-pie-chart.js"></script>
<script src="js/charts/sparkline/jquery.sparkline.min.js"></script>
<script src="js/charts/flot/jquery.flot.min.js"></script>
<script src="js/charts/flot/jquery.flot.tooltip.min.js"></script>
<script src="js/charts/flot/jquery.flot.resize.js"></script>
<script src="js/charts/flot/jquery.flot.grow.js"></script>
<script src="js/charts/flot/demo.js"></script>

<script src="js/calendar/bootstrap_calendar.js"></script>
<script src="js/calendar/demo.js"></script>

<script src="js/sortable/jquery.sortable.js"></script>
<script src="js/app.plugin.js"></script>
<script src="js/jquery.pjax.js"></script>

<script>
    $.pjax.defaults.timeout = 50000;
//    $(document).on('pjax:start', function() {    
//       alert('here');
//    });
//    $(document).on('pjax:end',   function(xhr, options) {
//       try {
//            var page_url = xhr.target.baseURI;
//            build_inpage_help(page_url);
//        }
//        catch (e) {
//        }
////        update_version();
//        
//        var url = window.location.href;
//
//    });
//    $(document).on('pjax:success',   function(xhr, options) {
//       
//       alert('success');
//    });
//    $(document).on('pjax:complete',   function(xhr, options) {
//       
//       alert('complete');
//
//    });
    $(document).pjax('#main_menu_nav a.pjax-link, #user_menu_nav a.pjax-link', '#content');
    $(document).pjax('a.pjax-content-link', '#content');
    /*
     The function build_inpage_help() will be called every time a PJAX request is completed.
     We also have to call it manually when the page is first loaded via the browser
     */

    if (typeof build_inpage_help == 'function') {
        var current_page_url = window.location.href;
        build_inpage_help(current_page_url);
    }
</script>
</body>
</html>