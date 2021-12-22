<script type="text/javascript">
    function getCalendar(target_div,year,month){
        $.ajax({
            type:'POST',
            url:'calendarschedule.php',
            data:'year='+year+'&month='+month,
            success:function(html){
                $('#'+target_div).html(html);
            }
        });
    }
    $(document).ready(function(){
        $('.date_cell').mouseenter(function(){
            date = $(this).attr('date');
            $(".date_popup_wrap").fadeOut();
            $("#date_popup_"+date).fadeIn();    
        });
        $('.date_cell').mouseleave(function(){
            $(".date_popup_wrap").fadeOut();        
        });
        $('.month_dropdown').on('change',function(){
            getCalendar('calendar_div',$('.year_dropdown').val(),$('.month_dropdown').val());
        });
        $('.year_dropdown').on('change',function(){
            getCalendar('calendar_div',$('.year_dropdown').val(),$('.month_dropdown').val());
        });
        $(document).click(function(){
            $('#event_list').slideUp('slow');
        });
    });
</script>

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
<?php
$dateYear = ($year != '')?$year:date("Y");
$dateMonth = ($month != '')?$month:date("m");
$date = $dateYear.'-'.$dateMonth.'-01';
$currentMonthFirstDay = date("N",strtotime($date));
$totalDaysOfMonth = cal_days_in_month(CAL_GREGORIAN,$dateMonth,$dateYear);
$totalDaysOfMonthDisplay = ($currentMonthFirstDay == 7)?($totalDaysOfMonth):($totalDaysOfMonth + $currentMonthFirstDay);
$boxDisplay = ($totalDaysOfMonthDisplay <= 35)?35:42;
?>
<h1 class="page-title">
	Form Detail Employee Schedule
</h1>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light portlet-fit bordered calendar">
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-6">
                        <div id="calendar_div" class="container">
                            <div id="calender_section">
                                <h2>
                                    <select name="month_dropdown" class="month_dropdown dropdown">
                                        <?php 
                                        for($i=1;$i<=12;$i++){
                                            $value = ($i < 01)?'0'.$i:$i;
                                            $selectedOpt = ($i == $selected)?'selected':'';
                                            echo "
                                            <option value='".$value."".$selectedOpt."'>".date("F", mktime(0, 0, 0, $i+1, 0, 0))."</option>
                                            ";
                                        }
                                        ?>
                                     </select>
                                    <select name="year_dropdown" class="year_dropdown dropdown1">
                                        <?php 
                                            for($i=2015;$i<=2025;$i++){
                                                $selectedOpt = ($i == $selected)?'selected':'';
                                                echo "
                                                    <option value='".$i."".$selectedOpt."' >".$i."</option>
                                                ";
                                            }
                                        ?> 
                                    </select>
                                </h2>
                                <div id="calender_section_top">
                                    <ul>
                                        <li>Sun</li>
                                        <li>Mon</li>
                                        <li>Tue</li>
                                        <li>Wed</li>
                                        <li>Thu</li>
                                        <li>Fri</li>
                                        <li>Sat</li>
                                    </ul>
                                </div>
                                <div id="calender_section_bot">
                                    <ul>
                                    <?php 
                                        $dayCount = 1;
                                        $eventListHTML = '';                
                                        for($cb=1;$cb<=$boxDisplay;$cb++){
                                            if(($cb >= $currentMonthFirstDay+1 || $currentMonthFirstDay == 7) && $cb <= ($totalDaysOfMonthDisplay)){
                                                $currentDate = $dateYear.'-'.$dateMonth.'-'.$dayCount;
                                                // print_r($currentDate);
                                                $eventNum = 0;
                                                $result = $this->scheduleemployeeschedule_model->getDate($currentDate);
                                                // print_r($result);
                                                $eventNum = $this->scheduleemployeeschedule_model->getCOUNT($currentDate);
                                                if(strtotime($currentDate) == strtotime(date("Y-m-d"))){
                                                    echo '<li date="'.$currentDate.'" class="grey date_cell">';
                                                }elseif($eventNum > 0){
                                                    echo '<li date="'.$currentDate.'" class="light_sky date_cell">';
                                                }else{
                                                    echo '<li date="'.$currentDate.'" class="date_cell">';
                                                }
                                                echo '<span>';
                                                echo $dayCount;
                                                echo '</span>';
                                                // echo '<span>';
                                                // echo 'A';
                                                // echo '</span>';
                                                echo '<div id="date_popup_'.$currentDate.'" class="date_popup_wrap none">';
                                                echo '<div class="date_window">';
                                                echo '<div class="popup_event">EVENTS ('.$eventNum.')</div>';
                                                if($eventNum > 0){
                                                    // print_r($result);
                                                    foreach ($result as $key => $val){ 
                                                        echo" <a href='".$this->config->item('base_url').'scheduleemployeeschedule/showdetail/'.$val[employee_schedule_id]."'>".$val['shift_pattern_code']."</a><br>";
                                                    }
                                                    
                                                }
                                                
                                                echo '</div></div>';
                                                echo '</li>';
                                                $dayCount++;
                                    ?>
                                    <?php }else{ ?>
                                        <li><span>&nbsp;</span></li>
                                    <?php } } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                
    <!-- END CONTENT BODY -->