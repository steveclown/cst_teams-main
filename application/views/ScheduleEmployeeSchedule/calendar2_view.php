 <?php

function tanggal_sekarang($time=FALSE)

{

 date_default_timezone_set('Asia/Jakarta');

 $str_format='';

 if($time==FALSE)
 {
  $str_format= date("Y-m-d");
 }else{
  $str_format= date("Y-m-d H:i:s");
 }

 return $str_format;

}

?>
<script>
    $(document).ready(function()
    {
        $('#calendar').fullCalendar(
        {
            theme: true,
            header:
            {
                left: 'prev,next today',
                center: 'title',
                right: 'month'
            },
            defaultDate: '<?=tanggal_sekarang();?>',
            editable: false,
            eventLimit: true, // allow "more" link when too many events
            events: '<?php echo base_url(); ?>scheduleemployeeschedule/getEvents',

            
            eventMouseover: function(calEvent, jsEvent, view){

            var tooltip = '<div class="event-tooltip">' + calEvent.description + '</div>';
            $("body").append(tooltip);

            $(this).mouseover(function(e) {
                $(this).css('z-index', 10000);
                $('.event-tooltip').fadeIn('500');
                $('.event-tooltip').fadeTo('10', 1.9);
            }).mousemove(function(e) {
                $('.event-tooltip').css('top', e.pageY + 10);
                $('.event-tooltip').css('left', e.pageX + 20);
            });
	        },
	        eventMouseout: function(calEvent, jsEvent) {
	            $(this).css('z-index', 8);
	            $('.event-tooltip').remove();
	        },
        });
    });
</script>
<style>    
    #calendar {
        max-width: 900px;
        margin: 0 auto;
    }
</style>
<!-- BEGIN PAGE TITLE & BREADCRUMB-->
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<a href="<?php echo base_url();?>">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>scheduleemployeeschedule">Employe Schedule</a>
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
</div>
<h1 class="page-title">
	Form Detail Employee Schedule
</h1>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light portlet-fit bordered calendar">
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-6">
				        <div id="calendar"> </div>
				    </div>