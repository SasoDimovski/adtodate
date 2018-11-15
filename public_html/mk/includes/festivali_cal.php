<!-- jQuery -->
    
    <script src="../js/jquery.js"></script>
<!-- Core CSS File. The CSS code needed to make eventCalendar works -->
	<link rel="stylesheet" href="../js/jQueryEventCalendar-master/css/eventCalendar.css">
    <!-- Theme CSS file: it makes eventCalendar nicer -->
	<link rel="stylesheet" href="../js/jQueryEventCalendar-master/css/eventCalendar_theme_responsive.css">
    <div class="g4">
				<div id="eventCalendarDefault"></div>
				<script>
					$(document).ready(function() {
						$("#eventCalendarDefault").eventCalendar({
							eventsjson:'../js/jQueryEventCalendar-master/json/events.json1.php', // link to events json
							locales: '../js/jQueryEventCalendar-master/json/locale.mk.json',
							jsonDateFormat: 'human'
						});
					});
				</script>
			</div>
            <!-- plugin has dependency of moment.js to show dates -->
   <script src="../js/jQueryEventCalendar-master/js/moment.js" type="text/javascript"></script>
<!--
	development version
	<script src="js/jquery.eventCalendar.js" type="text/javascript"></script>
-->
<!--
	minify version
-->
	<script src="../js/jQueryEventCalendar-master/js/jquery.eventCalendar.js" type="text/javascript"></script>