<?php
echo $this->Html->css(array('/bootstrap/css/bootstrap.min', 'popup',
    'font-awesome/css/font-awesome.min',
    '/js/lib/datepicker/css/datepicker',
    '/js/lib/timepicker/css/bootstrap-timepicker.min'
        )
);
echo $this->Html->script(array('jquery.min',
    '/bootstrap/js/bootstrap.min'
    , 'lib/chained/jquery.chained.remote.min', 'lib/jquery.inputmask/jquery.inputmask.bundle.min', 'lib/parsley/parsley.min', 'pages/ebro_form_validate', 'lib/datepicker/js/bootstrap-datepicker', 'lib/timepicker/js/bootstrap-timepicker.min', 'pages/ebro_form_extended'
        )
);
echo $this->fetch('script');
/* End */
?>
<script type="text/javascript">
    $(document).ready(function(e) {
        $('.next_tab').click(function(e) {
            $('.nav-tabs li#tab1').removeClass('active');
            $('.nav-tabs li#tab2').addClass('active');
        });
        $('.next_tab2').click(function(e) {
            $('.nav-tabs li#tab2').removeClass('active');
            $('.nav-tabs li#tab3').addClass('active');
        });
    });
</script>	
<!----------------------------start add project block------------------------------>
<div class="content">
    <div class="pop-up-hdng">Add Activity</div>


<?php
//echo $this->Form->create('Remark', array('enctype' => 'multipart/form-data'));
echo $this->Form->create('Event', array('action' => 'add', 'method' => 'post', 'id' => 'parsley_reg', 'novalidate' => true,
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    )
));

$cur_date = date('d-m-Y');

$curdate = strtotime($cur_date);
$mydate = strtotime($event_date);

$date = '';
if ($curdate > $mydate) {
    $selected = 'Yes';
    $date = $event_date;
    $past_div = 'style="display:inline-table"';
    $present_div = 'style="display:none"';
} else {
    $selected = 'No';
    $date = $event_date;
    $present_div = 'style="display:inline-table"';
    $past_div = 'style="display:none"';
}
?>
    <input type="hidden" id="hidden_site_baseurl" value="<?php echo $this->request->base . ((!is_null($this->params['language'])) ? '/' . $this->params['language'] : ''); ?>"  />
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Add Event</h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12 nopdng">
                            <ul class="nav nav-tabs">
                                <li id="tab1" class="active"><a data-toggle="tab" href="#tbb_a">Primary Information</a></li>
                                <li id="tab2"><a data-toggle="tab" href="#tbb_b">Reimbursement Details</a></li>
                                <li id="tab3"><a data-toggle="tab" href="#tbb_c">Followup Details</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="tbb_a" class="tab-pane active">

                                    <p>
                                    <div class="col-sm-12 fullrow evt">
                                        <div class="form-group">
                                            <label for="reg_input_name" class="req">Past Event?</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"> <?php
    echo $this->Form->input('activity_past', array('id' => 'activity_past', 'options' => array('Yes' => 'Yes', 'No' => 'No'), 'default' => 'No', 'selected' => $selected, 'data-required' => 'true', 'onclick' => 'reimbursement_active()'));
?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6" >      
                                        <div class="form-group" >
                                            <label for="reg_input_name" class="req">Start Date</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">
                                                <div class="input-group date ebro_datepicker event_date_present_div" data-date-format="dd-mm-yyyy" data-date-autoclose="true" <?php echo $present_div; ?> >
<?php
echo $this->Form->input('start_date_present', array('id' => 'dpd1', 'type' => 'text', 'data-date-format' => 'dd-mm-yyyy', 'data-date-autoclose' => 'true', 'value' => $date));
?>
                                                    <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                                </div>
                                                <div class="input-group date ebro_datepicker event_date_past_div" data-date-format="dd-mm-yyyy" data-date-autoclose="true" <?php echo $past_div; ?> >
<?php
echo $this->Form->input('start_date_past', array('id' => 'start_date_past', 'type' => 'text', 'data-date-format' => 'dd-mm-yyyy', 'data-date-autoclose' => 'true', 'value' => $date));
?>
                                                    <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                                </div>                            

                                            </div>
                                        </div>
                                        <div class="form-group imp">
                                            <label for="input_name" class="req">From</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">
                                                <div class="input-group bootstrap-timepicker">
<?php
echo $this->Form->input('start_time', array('type' => 'text', 'id' => 'start_time'));
?>
                                                    <span class="input-group-addon"><i class="icon-time"></i></span>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input_name" class="req">Activity Level</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">
<?php
echo $this->Form->input('activity_level', array('id' => 'activity_level', 'options' => $activity_levels, 'empty' => '--Select--', 'data-required' => 'true'));
?>
                                            </div>

                                        </div>
                                        <div class="form-group activity_type" style="display:none;">
                                            <label for="input_name" class="req">Activity Type</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">
<?php
echo $this->Form->input('client_types', array('options' => $client_types, 'class' => 'form-control client EventActivityType', 'empty' => '--Select--', 'style' => 'display:none;', 'onchange' => 'totalCalculate()'));
echo $this->Form->input('proj_builder_types', array('options' => $proj_builder_types, 'class' => 'form-control builder_project EventActivityType', 'empty' => '--Select--', 'style' => 'display:none;', 'onchange' => 'totalCalculate()'));

echo $this->Form->input('city_sub_area_types', array('options' => $city_sub_area_types, 'class' => 'form-control city_sub_area EventActivityType', 'empty' => '--Select--', 'style' => 'display:none;', 'onchange' => 'totalCalculate()'));

echo $this->Form->input('company_types', array('options' => $company_types, 'class' => 'form-control company EventActivityType', 'empty' => '--Select--', 'style' => 'display:none;', 'onchange' => 'totalCalculate()'));

echo $this->Form->input('other_types', array('options' => $other_types, 'class' => 'form-control other EventActivityType', 'empty' => '--Select--', 'style' => 'display:none;', 'onchange' => 'totalCalculate()'));
?>
                                            </div>

                                        </div>
                                        <div class="form-group attended1" style="display:none">
                                            <label>Attended By 1</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">
                                                <?php
                                                echo $this->Form->input('event_attended_by_1', array('options' => $attendes, 'empty' => '--Select--'));
                                                ?>
                                            </div>
                                        </div>
                                        <div class="form-group attended23" style="display:none">
                                            <label>Attended By 2</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">
<?php
echo $this->Form->input('event_attended_by_2', array('options' => $attendes, 'empty' => '--Select--'));
?>
                                            </div>
                                        </div>   
                                    </div>
                                    <div class="col-sm-6">      
                                        <div class="form-group" >
                                            <label for="input_name" class="req">End Date</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">
                                                <div class="input-group date ebro_datepicker event_date_present_div" data-date-format="dd-mm-yyyy" data-date-autoclose="true" <?php echo $present_div; ?> >
<?php
echo $this->Form->input('end_date_present', array('id' => 'dpd2', 'type' => 'text', 'data-date-format' => 'dd-mm-yyyy', 'data-date-autoclose' => 'true', 'value' => $date, 'onchange' => 'fllowupdate(this.value)'));
?>
                                                    <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                                </div>
                                                <div class="input-group date ebro_datepicker event_date_past_div" data-date-format="dd-mm-yyyy" data-date-autoclose="true" <?php echo $past_div; ?> >
                                                <?php
                                                echo $this->Form->input('end_date_past', array('id' => 'end_date_past', 'type' => 'text', 'data-date-format' => 'dd-mm-yyyy', 'data-date-autoclose' => 'true', 'value' => $date, 'onchange' => 'fllowupdate(this.value)'));
                                                ?>
                                                    <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                                </div>                                

                                            </div>
                                        </div>
                                        <div class="form-group imp">
                                            <label for="input_name" class="req">To</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">
                                                <div class="input-group bootstrap-timepicker">
                                                    <?php
                                                    echo $this->Form->input('end_time', array('type' => 'text', 'id' => 'end_time'));
                                                    ?>
                                                    <span class="input-group-addon"><i class="icon-time"></i></span>
                                                </div>

                                            </div>
                                        </div>  
                                        <div class="form-group activity_with" style="display:none;">
                                            <label for="input_name" class="req">Activity With</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">

<?php
echo $this->Form->input('project_id', array('id' => 'project_id', 'class' => 'activity_with_class', 'options' => $projects, 'div' => array('class' => 'project_id with', 'style' => 'display:none;'), 'empty' => '--Select--'));

echo $this->Form->input('builder_id', array('id' => 'builder_id', 'class' => 'activity_with_class', 'options' => $builders, 'div' => array('class' => 'builder_id with', 'style' => 'display:none;'), 'empty' => '--Select--'));

echo $this->Form->input('lead_id', array('id' => 'lead_id', 'class' => 'activity_with_class', 'options' => $clients, 'div' => array('class' => 'lead_id_div with', 'style' => 'display:none;'), 'empty' => '--Select--'));

echo $this->Form->input('city_id', array('id' => 'city_id', 'class' => 'activity_with_class', 'options' => $cities, 'div' => array('class' => 'city_id_div with', 'style' => 'display:none;'), 'empty' => '--Select--'));

echo $this->Form->input('suburb_id', array('id' => 'suburb_id', 'class' => 'activity_with_class', 'options' => $suburbs, 'div' => array('class' => 'suburbs_id_div with', 'style' => 'display:none;'), 'empty' => '--Select--'));

echo $this->Form->input('area_id', array('id' => 'area_id', 'class' => 'activity_with_class', 'options' => $areas, 'div' => array('class' => 'area_id_div with', 'style' => 'display:none;'), 'empty' => '--Select--'));

echo $this->Form->input('company_id', array('id' => 'company_id', 'class' => 'activity_with_class', 'options' => $companies, 'div' => array('class' => 'company_id_div with', 'style' => 'display:none;'), 'empty' => '--Select--'));
?>


                                            </div>
                                        </div>

                                        <div class="form-group imp activity_type" style="display:none">
                                            <label for="input_name" class="req">Details</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">
                                                <?php
                                                echo $this->Form->input('event_type_desc', array('options' => array(), 'empty' => '--Select--', 'data-required' => true));
                                                ?>


                                            </div>
                                        </div> 
                                        <div class="form-group site_project_id" style="display:none">
                                            <label>Project Site</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">
<?php
echo $this->Form->input('site_visit_project_id', array('options' => $projects, 'empty' => '--Select--'));
?>
                                            </div>
                                        </div>
                                        <div class="form-group attended23" style="display:none">
                                            <label>Attended By 3</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">
                                                <?php
                                                echo $this->Form->input('event_attended_by_3', array('options' => $attendes, 'empty' => '--Select--'));
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group activity_completed">
                                            <label>Completed?</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10 checkbox-cont"><?php
                                                $options = array('1' => 'Yes', '2' => 'No');
                                                if ($selected == 'Yes')
                                                    $attributes = array('legend' => false, 'escape' => false, 'hiddenField' => false, 'default' => '1', 'class' => 'completed', 'onclick' => 'reimbursement_active()');
                                                else
                                                    $attributes = array('legend' => false, 'escape' => false, 'hiddenField' => false, 'default' => '2', 'disabled' => true, 'class' => 'completed', 'onclick' => 'reimbursement_active()');
                                                echo $this->Form->radio('activity_completed', $options, $attributes);
                                                ?>

                                            </div>

                                        </div>
                                        <!--<div class="form-group activity_completed completed_present" <?php echo $present_div; ?>>
                                            <label>Completed?</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10 checkbox-cont"><?php
                                                $options_present = array('1' => 'Yes', '2' => 'No');
                                                $attributes_present = array('legend' => false, 'escape' => false, 'hiddenField' => false, 'default' => '2', 'disabled' => true, 'class' => 'completed');
                                                echo $this->Form->radio('activity_completed_present', $options_present, $attributes_present);
                                                ?>
                                    
                                            </div>
                                            
                                        </div>-->
                                    </div>  
                                    <div id="client_ph_email" class="col-sm-12"> </div>   
                                    <div class="col-sm-12 fullrow evt">
                                        <div class="form-group">
                                            <label for="input_name" class="req">Describe</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">
<?php echo $this->Form->input('event_level_desc', array('type' => 'textarea', 'data-required' => true)); ?>
                                            </div>
                                        </div>
                                    </div>





                                        <?php echo $this->Html->link('Next', '#tbb_b', array('data-toggle' => 'tab', 'escape' => false, 'class' => 'success btn next_tab')); ?>
                                    </p>
                                </div>
                                <div id="tbb_b" class="tab-pane">
                                    <div class="cont-det">
                                        <p>Do you have expense details?</p>
<?php echo $this->Form->checkbox('Reimbursement.is_expense', array('id' => 'is_expense', 'disabled' => true)); ?>
                                        <label>Yes</label> 
                                    </div>
                                    <p>

                                    <div class="tab2-form-cont">
                                        <div class="inactive-form" id="inactive_div"></div>
                                        <div class="col-sm-6" >  
                                            <div class="form-group evtsp">
                                                <label>Expense Level</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
<?php
echo $this->Form->input('Reimbursement.rem_level', array('readonly' => true));
?>
                                                </div>

                                            </div>    
                                            <div class="form-group evtsp">
                                                <label>Expense Type</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
                                        <?php
                                        echo $this->Form->input('Reimbursement.rem_type', array('readonly' => true));
                                        ?>
                                                </div>

                                            </div>

                                            <div class="form-group evtsp">
                                                <label>Travel Distance (KM)</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
                                                    <?php
                                                    echo $this->Form->input('Reimbursement.reimbursement_factor_1', array('onchange' => 'totalCalculate()'));
                                                    ?>
                                                </div>

                                            </div>



                                        </div>
                                        <div class="col-sm-6"> 	 
                                            <div class="form-group evtsp">
                                                <label>Expense With</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
<?php
echo $this->Form->input('Reimbursement.reimbursement_with', array('readonly' => true));
?>
                                                </div>

                                            </div>
                                            <div class="form-group evtsp">
                                                <label>Expense For</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
<?php
echo $this->Form->input('Reimbursement.reimbursement_type_2', array('options' => array(), 'empty' => '--Select--', 'onchange' => 'totalCalculate()'));
?>
                                                </div>

                                            </div>    




                                            <div class="form-group evtsp">
                                                <label>Incurred Expense / KM</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
                                                    <?php
                                                    echo $this->Form->input('Reimbursement.reimbursement_factor_2', array('onchange' => 'totalCalculate()'));
                                                    ?>
                                                </div>
                                            </div>

                                        </div>     	
                                        <div class="col-sm-12 fullrow">
                                            <div class="form-group evtsp">
                                                <label>Total Expense Amount</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
<?php echo $this->Form->input('Reimbursement.reimbursement_amount', array('type' => 'text', 'readonly' => true)); ?>
                                                </div>
                                            </div>
                                            <div class="form-group evtsp">
                                                <label>Expense Description</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
<?php echo $this->Form->input('Reimbursement.reimbursement_desc', array('type' => 'textarea')); ?>
                                                </div>
                                            </div>
                                        </div>	
                                        <!--<div class="col-sm-6">   
                                        <div class="form-group evtsp">
                                        <label>Bill Status</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
<?php
echo $this->Form->input('Reimbursement.reimbursement_bill_type', array('options' => $bill_type, 'empty' => '--Select--'));
?>
                                        </div>
                                        </div>   
                                        <div class="form-group evtsp">
                                        <label>Submission Date</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
<?php
echo $this->Form->input('Reimbursement.reimbursement_bill_submission_date', array('type' => 'text', 'readonly' => true, 'value' => date('Y-m-d')));
?>
                                        </div>
                                        
                                        </div>
                                        
                                        
                                        
                                        </div>-->
                                        <!--<div class="col-sm-6" >      
                                        <div class="form-group evtsp">
                                        <label>Bill Type</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                        <?php
                                        echo $this->Form->input('Reimbursement.reimbursement_bill_status', array('options' => $bill_status, 'empty' => '--Select--'));
                                        ?>
                                        </div>
                                        
                                        </div>
                                        <div class="form-group evtsp">
                                        <label>Submitted To</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
<?php
echo $this->Form->input('Reimbursement.reimbursement_bill_submitted_to', array('options' => $submitted_to, 'disabled' => 'disabled'));
?>
                                        </div>
                                        
                                        </div>
                                        
                                        
                                        
                                        
                                        
                                        </div>-->
                                    </div>
                                        <?php echo $this->Html->link('Next', '#tbb_c', array('data-toggle' => 'tab', 'escape' => false, 'class' => 'success btn next_tab2')); ?>
                                    </p>
                                </div>
                                <div id="tbb_c" class="tab-pane">
                                    <div class="cont-det">
                                        <p>Want to plan a followup activity?</p>
<?php echo $this->Form->checkbox('is_follow', array('id' => 'is_follow')); ?>
                                        <label>Yes</label> 
                                    </div>
                                    <p> 
                                    <div class="tab2-form-cont">
                                        <div class="inactive-form" id="fllow_inactive_div"></div>
                                        <div class="col-sm-6" >      
                                            <div class="form-group" >
                                                <label>Start Date</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
                                                    <div class="input-group date ebro_datepicker" data-date-format="dd-mm-yyyy" data-date-autoclose="true">
<?php
echo $this->Form->input('fllow_start_date', array('id' => 'start_date', 'type' => 'text', 'data-date-format' => 'dd-mm-yyyy', 'data-date-autoclose' => 'true'));
?>
                                                        <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                                    </div>


                                                </div>
                                            </div>
                                            <div class="form-group imp">
                                                <label>From</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
                                                    <div class="input-group bootstrap-timepicker">
<?php
echo $this->Form->input('fllow_start_time', array('type' => 'text', 'class' => 'time_picker'));
?>
                                                        <span class="input-group-addon"><i class="icon-time"></i></span>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Activity Level</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
                                                        <?php
                                                        echo $this->Form->input('fllow_activity_level', array('disabled' => true));
                                                        ?>
                                                </div>

                                            </div>
                                            <div class="form-group activity_type" style="display:none;">
                                                <label>Activity Type</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
<?php
echo $this->Form->input('fllow_client_types', array('options' => $client_types, 'class' => 'form-control client EventActivityType', 'empty' => '--Select--', 'style' => 'display:none;'));
echo $this->Form->input('fllow_proj_builder_types', array('options' => $proj_builder_types, 'class' => 'form-control builder_project EventActivityType', 'empty' => '--Select--', 'style' => 'display:none;'));

echo $this->Form->input('fllow_city_sub_area_types', array('options' => $city_sub_area_types, 'class' => 'form-control city_sub_area EventActivityType', 'empty' => '--Select--', 'style' => 'display:none;'));

echo $this->Form->input('fllow_company_types', array('options' => $company_types, 'class' => 'form-control company EventActivityType', 'empty' => '--Select--', 'style' => 'display:none;'));

echo $this->Form->input('fllow_other_types', array('options' => $other_types, 'class' => 'form-control other EventActivityType', 'empty' => '--Select--', 'style' => 'display:none;'));
?>
                                                </div>

                                            </div>
                                            <div class="form-group attended1" style="display:none">
                                                <label>Attended By 1</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
<?php
echo $this->Form->input('fllow_event_attended_by_1', array('options' => $attendes, 'empty' => '--Select--'));
?>
                                                </div>
                                            </div>
                                            <div class="form-group attended23" style="display:none">
                                                <label>Attended By 2</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
                                                    <?php
                                                    echo $this->Form->input('fllow_event_attended_by_2', array('options' => $attendes, 'empty' => '--Select--'));
                                                    ?>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-sm-6">      
                                            <div class="form-group" >
                                                <label>End Date</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
                                                    <div class="input-group date ebro_datepicker" data-date-format="dd-mm-yyyy" data-date-autoclose="true">
<?php
echo $this->Form->input('fllow_end_date', array('id' => 'end_date', 'type' => 'text', 'data-date-format' => 'dd-mm-yyyy', 'data-date-autoclose' => 'true'));
?>
                                                        <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                                    </div>


                                                </div>
                                            </div>
                                            <div class="form-group imp">
                                                <label>To</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
                                                    <div class="input-group bootstrap-timepicker">
<?php
echo $this->Form->input('fllow_end_time', array('type' => 'text', 'class' => 'time_picker'));
?>
                                                        <span class="input-group-addon"><i class="icon-time"></i></span>
                                                    </div>

                                                </div>
                                            </div>  
                                            <div class="form-group">
                                                <label>Activity With</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">

                                                        <?php
                                                        echo $this->Form->input('fllow_activity_with', array('disabled' => true));
                                                        ?>


                                                </div>
                                            </div>
                                            <div class="form-group imp activity_type" style="display:none">
                                                <label>Details</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
<?php
echo $this->Form->input('fllow_event_type_desc', array('options' => array(), 'empty' => '--Select--'));
?>


                                                </div>
                                            </div> 
                                            <div class="form-group site_project_id" style="display:none">
                                                <label>Project Site</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
<?php
echo $this->Form->input('fllow_site_visit_project_id', array('options' => $projects, 'empty' => '--Select--'));
?>
                                                </div>
                                            </div>
                                            <div class="form-group attended23" style="display:none">
                                                <label>Attended By 3</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
<?php
echo $this->Form->input('fllow_event_attended_by_3', array('options' => $attendes, 'empty' => '--Select--'));
?>
                                                </div>
                                            </div>
                                            <div class="form-group activity_completed">
                                                <label>Completed?</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10 checkbox-cont"><?php
                                                    $options = array('1' => 'Yes', '2' => 'No');
                                                    $attributes = array('legend' => false, 'escape' => false, 'hiddenField' => false, 'default' => '2');
                                                    echo $this->Form->radio('fllow_activity_completed', $options, $attributes);
                                                    ?>

                                                </div>

                                            </div>
                                        </div>     
                                        <div class="col-sm-12 fullrow evt">
                                            <div class="form-group">
                                                <label>Remark</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
<?php echo $this->Form->input('fllow_event_level_desc', array('type' => 'textarea')); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                                    <?php echo $this->Form->submit('Add Event', array('class' => 'success btn')); ?>

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>


<?php echo $this->Form->end();
?>
</div>	


<script type="text/javascript">

    function totalCalculate(case_type)
    {
        var factor1 = $('#ReimbursementReimbursementFactor1').val();
        var factor2 = $('#ReimbursementReimbursementFactor2').val();
        var expense_for = $('#ReimbursementReimbursementType2').val();
        var level = $('#activity_level').val();
        var expense_type = '';
        if (level == '1')
            expense_type = $('#EventClientTypes').val();
        else if (level == '2' || level == '3')
            expense_type = $('#EventProjBuilderTypes').val();


        if (expense_type == 1 || expense_type == 4 || expense_type == 6) { //case 1
            $('#ReimbursementReimbursementAmount').attr('readonly', true);

            if (expense_for == 44 || expense_for == 60) {
                $('#ReimbursementReimbursementFactor2').attr('readonly', true);
                $('#ReimbursementReimbursementFactor1').attr('readonly', false);
                $('#ReimbursementReimbursementFactor2').val('2');
                var total = parseFloat(factor1 * factor2);
                $('#ReimbursementReimbursementAmount').val(total);


            }
            else if (expense_for == 45 || expense_for == 61) {
                $('#ReimbursementReimbursementFactor2').attr('readonly', true);
                $('#ReimbursementReimbursementFactor1').attr('readonly', false);
                $('#ReimbursementReimbursementFactor2').val('6');
                var total = parseFloat(factor1 * factor2);
                $('#ReimbursementReimbursementAmount').val(total);
            }
            else {
                //$('#ReimbursementReimbursementFactor1').val(0);
                $('#ReimbursementReimbursementFactor2').val('');
                //$('#ReimbursementReimbursementAmount').val(0);
                $('#ReimbursementReimbursementFactor1').attr('readonly', false);
                $('#ReimbursementReimbursementFactor2').attr('readonly', false);
                $('#ReimbursementReimbursementAmount').attr('readonly', false);

            }




        }

        else if (expense_type == 1)
        {

            $('#ReimbursementReimbursementFactor2').attr('readonly', true);
            $('#ReimbursementReimbursementFactor1').attr('readonly', true);
            $('#ReimbursementReimbursementAmount').attr('readonly', false);
            //$('#ReimbursementReimbursementAmount').val(factor2);
        }
        else
            $('#ReimbursementReimbursementAmount').val(0);




        /*	
         if(factor1 == null && factor1 == '')
         $('#ReimbursementReimbursementAmount').val(factor2);
         else
         {	
         
         var total = parseFloat(factor1 * factor2);
         $('#ReimbursementReimbursementAmount').val(total);
         }
         */
    }

    function reimbursement_active() {

        var type_id = $('.EventActivityType').val();
        var completed = $("input:checked").val();
        var level = $('#activity_level').val();

        if (level == '1')
            type_id = $('#EventClientTypes').val();
        else if (level == '2' || level == '3')
            type_id = $('#EventProjBuilderTypes').val();

        if ((type_id == 1 || type_id == 4 || type_id == 6 || type_id == 7 || type_id == 9 || type_id == 10) && completed == 1)
            $("#is_expense").attr('disabled', false);
        else
            $("#is_expense").attr('disabled', true);
    }

    function fllowupdate($date) {
        //alert($date);
        var start_date_fllowup = $('#start_date').datepicker({
            startDate: $date,
            onRender: function(date) {

                //return date.valueOf() <= start_date_past.date.valueOf() ? 'disabled' : '';
            }
        }).on('changeDate', function(ev) {

            start_date_fllowup.hide();
        }).data('datepicker');

        var end_date_fllowup = $('#end_date').datepicker({
            startDate: $date,
            onRender: function(date) {

                //return date.valueOf() <= start_date_past.date.valueOf() ? 'disabled' : '';
            }
        }).on('changeDate', function(ev) {

            end_date_fllowup.hide();
        }).data('datepicker');
    }



    $(document).ready(function(e) {

        var FULL_BASE_URL = $('#hidden_site_baseurl').val(); // For base path of value;

        //alert($('#dpd2').val());
        //$('#ReimbursementReimbursementBillSubmissionDate').val($('#dpd2').val());

        $('#ReimbursementReimbursementType2').change(function() {
            $('#ReimbursementReimbursementFactor1').val('');
            $('#ReimbursementReimbursementAmount').val('');
        });

        $("#is_expense").bind('click', function() {
            if ($(this).is(":checked")) {
                $("#inactive_div").hide();
            }
            else {
                $("#inactive_div").show();
            }
        });
        $("#is_follow").bind('click', function() {
            if ($(this).is(":checked")) {
                $("#fllow_inactive_div").hide();
            }
            else {
                $("#fllow_inactive_div").show();
            }
        });


        $('#lead_id').change(function() {
            var level = $('#activity_level option:selected').text();
            var lead_id = $(this).val();

            $('#EventFllowActivityWith').val($('#lead_id option:selected').text());

            var dataString = 'lead_id=' + lead_id;
            $.ajax({
                type: "POST",
                data: dataString,
                url: FULL_BASE_URL + '/all_functions/get_client_phone_email',
                beforeSend: function() {
                    // $('#ReimbursementReimbursementType2').attr('disabled', 'disabled');
                    //return false;
                },
                success: function(return_data) {
                    // $('#ReimbursementReimbursementType2').removeAttr('disabled');
                    $('#client_ph_email').html(return_data);
                }
            });

            /*
             if(level == 'Client')
             $('#ReimbursementRemType').val($('#EventClientTypes option:selected' ).text());
             else if(level == 'Builder' || level == 'Project')	
             $('#ReimbursementRemType').val($('#EventProjBuilderTypes option:selected' ).text());
             else if(level == 'City' || level == 'Suburb' || level == 'Area')	
             $('#ReimbursementRemType').val($('#EventCitySubAreaTypes option:selected' ).text());	
             */
        });

        $('#activity_level').change(function() {
            $('#ReimbursementReimbursementWith').val('');
            var type_id = $(this).val();
            $('#ReimbursementRemLevel').val($('#activity_level option:selected').text());
            var model = 'Event';
            $('#EventFllowActivityLevel').val($('#activity_level option:selected').text());
            var dataString = 'type_id=' + type_id;
            $('#EventEventTypeDesc').attr('disabled', 'disabled');
            $.ajax({
                type: "POST",
                data: dataString,
                url: FULL_BASE_URL + '/all_functions/get_activity_desc_by_typeId',
                beforeSend: function() {
                    $('#EventEventTypeDesc').attr('disabled', 'disabled');
                    //return false;
                },
                success: function(return_data) {
                    $('#EventEventTypeDesc').removeAttr('disabled');
                    $('#EventEventTypeDesc').html(return_data);
                    $('#EventFllowEventTypeDesc').html(return_data);
                }
            });

        });

        $('#EventFllowClientTypes').change(function() {
            var type_id = $(this).val();
            if (type_id == '6')
                $('.site_project_id').css('display', 'block');
            else
                $('.site_project_id').css('display', 'none');
        });
        /*
         $('#EventClientTypes').change(function(){
         var type_id = $(this).val();
         //var completed = $('.completed :checked').val();
         
         //var completed = $('.completed').prop('checked');
         if(type_id == '6')
         $('.site_project_id').css('display','block');
         else
         $('.site_project_id').css('display','none');	
         var model = 'Event';
         
         
         
         
         var dataString = 'type_id=' + type_id + '&model='+model;
         $('#ReimbursementReimbursementType2').attr('disabled', 'disabled');
         $.ajax({
         type: "POST",
         data: dataString,
         url: FULL_BASE_URL + '/all_functions/get_type_2_by_type1_id',
         beforeSend: function() {
         $('#ReimbursementReimbursementType2').attr('disabled', 'disabled');
         //return false;
         },
         success: function(return_data) {
         $('#ReimbursementReimbursementType2').removeAttr('disabled');
         $('#ReimbursementReimbursementType2').html(return_data);
         }
         });  
         
         });
         */

        $('.next_tab').click(function(event) {
            //alert('asd');
            $('.nav li:first').removeClass('active');
            href_id = $(this).attr('href');
            //alert($(this).attr('href').nav li > a);
            //$( "li.item-a" ).closest( "li" ).addClass('active');
            $('a').attr('href,#tbb_b').closest("li").addClass('active');
            //$('.nav > a:#tbb_b').closest( "li" ).addClass('active');
            //$(this).addClass('active');
            //alert(class);
        });

        /************************Total Amount ************************/



        var nowTemp = new Date();
        var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

        //newDate.setDate(newDate.getDate() + 1);
        // alert(setDate(now + 1));
        /************************Present event ***************************/

        var checkin = $('#dpd1').datepicker({
            startDate: '-0m',
            onRender: function(date) {
                return date.valueOf() < now.valueOf() ? 'disabled' : '';
            }
        }).on('changeDate', function(ev) {


            $('#dpd2').val($('#dpd1').val());
            $('#start_date').val($('#dpd1').val());
            $('#endt_date').val($('#dpd1').val());

            /*
             if (ev.date.valueOf() > checkout.date.valueOf()) {
             var newDate = new Date(ev.date);
             newDate.setDate(newDate.getDate() + 1);
             checkout.setValue(newDate);
             }
             */
            checkin.hide();
            //$('#dpd2')[0].focus();
        }).data('datepicker');
        var checkout = $('#dpd2').datepicker({
            startDate: '-0m',
            onRender: function(date) {
                return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
            }
        }).on('changeDate', function(ev) {
            $('#start_date').val($('#dpd2').val());
            $('#end_date').val($('#dpd2').val());

            //$('#ReimbursementReimbursementBillSubmissionDate').val($('#dpd2').val());
            checkout.hide();
        }).data('datepicker');




        /************************past event ***************************/


        var start_date_past = $('#start_date_past').datepicker({
            endDate: '-0m',
            onRender: function(date) {
                return date.valueOf() < now.valueOf() ? 'disabled' : '';
            }
        }).on('changeDate', function(ev) {
            $('#end_date_past').val($('#start_date_past').val());
            $('#start_date').val($('#start_date_past').val());
            $('#end_date').val($('#start_date_past').val());
            start_date_past.hide();
            //$('#end_date_past')[0].focus();
        }).data('datepicker');

        var end_date_past = $('#end_date_past').datepicker({
            endDate: '-0m',
            onRender: function(date) {

                return date.valueOf() <= start_date_past.date.valueOf() ? 'disabled' : '';
            }
        }).on('changeDate', function(ev) {
            $('#start_date').val($('#end_date_past').val());
            $('#end_date').val($('#end_date_past').val());

            //$('#ReimbursementReimbursementBillSubmissionDate').val($('#end_date_past').val());
            //$('#ReimbursementReimbursementBillSubmissionDate').val($('#end_date_past').val());
            end_date_past.hide();
        }).data('datepicker');





        /*
         $('#start_date').datepicker({
         
         startDate: $('#last_date').val(),
         onRender: function(date) {
         return date.valueOf() < now.valueOf() ? 'disabled' : '';
         }
         }).on('changeDate', function(ev) {
         //alert($('#end_date_past').val());
         checkin.hide();
         //$('#dpd2')[0].focus();
         }).data('datepicker');
         */
        /****************************Click on past event **************************/

        $('#activity_past').change(function() {
            var value = $(this).val();
            if (value == 'Yes')
            {
                $('#event_id').css('display', 'block');
                $('.event_date_present_div').css('display', 'none');
                $('.event_date_past_div').css('display', 'inline-table');
                //alert('sdf');
                //$('#EventActivityCompleted2').removeAttr('checked');
                //$('#EventActivityCompleted2').removeAttr('checked');	
                $("#EventActivityCompleted1").prop("checked", true);
                $('#EventActivityCompleted2').attr('disabled', false);
                $('#EventActivityCompleted1').attr('disabled', false);
                $('#start_date_past').val('');
                $('#end_date_past').val('');

            }
            else {
                $('#event_id').css('display', 'block');
                $('.event_date_past_div').css('display', 'none');
                $('.event_date_present_div').css('display', 'inline-table');
                //$('#EventActivityCompleted1').attr('checked','');
                $("#EventActivityCompleted2").prop("checked", true);
                $('#EventActivityCompleted2').attr('disabled', true);
                $('#EventActivityCompleted1').attr('disabled', true);
                //$('#EventActivityCompleted2').attr('checked','checked');
                //$('#EventActivityCompleted1').removeAttr('checked');
                $('#dpd1').val('');
                $('#dpd2').val('');

            }
        });
        $('#end_time').change(function() {
            $('#EventFllowStartTime').val($(this).val());
            $('#EventFllowEndTime').val($(this).val());
        });

        $('#activity_level').change(function() {
            var activity_id = $(this).val();

            if (activity_id == 1) {

                $('.activity_type').css('display', 'block');
                $('.activity_with').css('display', 'block');
                $('.lead_id_div').css('display', 'block');
                $('.builder_id').css('display', 'none');
                $('.project_id').css('display', 'none');
                $('.city_id_div').css('display', 'none');
                $('.suburbs_id_div').css('display', 'none');
                $('.area_id_div').css('display', 'none');
                $('.company_div').css('display', 'none');
                $('.activity_type_div').css('display', 'block');
                $('.client').css('display', 'block');
                $('.builder_project').css('display', 'none');
                $('.city_sub_area').css('display', 'none');
                $('.other').css('display', 'none');
                $('.company').css('display', 'none');
            }

            else if (activity_id == 2) {
                $('.activity_type').css('display', 'block');
                $('.activity_with').css('display', 'block');
                $('.project_id').css('display', 'none');
                $('.lead_id_div').css('display', 'none');
                $('.builder_id').css('display', 'block');
                $('.city_id_div').css('display', 'none');
                $('.suburbs_id_div').css('display', 'none');
                $('.area_id_div').css('display', 'none');
                $('.company_div').css('display', 'none');
                $('.activity_type_div').css('display', 'block');
                $('.builder_project').css('display', 'block');
                $('.client').css('display', 'none');
                $('.city_sub_area').css('display', 'none');
                $('.other').css('display', 'none');
                $('.company').css('display', 'none');
            }
            else if (activity_id == 3) {
                $('.activity_with').css('display', 'block');
                $('.activity_type').css('display', 'block');
                $('.project_id').css('display', 'block');
                $('.lead_id_div').css('display', 'none');
                $('.builder_id').css('display', 'none');
                $('.city_id_div').css('display', 'none');
                $('.suburbs_id_div').css('display', 'none');
                $('.area_id_div').css('display', 'none');
                $('.company_div').css('display', 'none');
                $('.activity_type_div').css('display', 'block');
                $('.builder_project').css('display', 'block');
                $('.client').css('display', 'none');
                $('.city_sub_area').css('display', 'none');
                $('.other').css('display', 'none');
                $('.company').css('display', 'none');

            }
            else if (activity_id == 4) {
                $('.activity_with').css('display', 'block');
                $('.activity_type').css('display', 'block');
                $('.project_id').css('display', 'none');
                $('.city_id_div').css('display', 'block');
                $('.builder_id').css('display', 'none');
                $('.lead_id_div').css('display', 'none');
                $('.suburbs_id_div').css('display', 'none');
                $('.area_id_div').css('display', 'none');
                $('.company_div').css('display', 'none');
                $('.activity_type_div').css('display', 'block');
                $('.city_sub_area').css('display', 'block');
                $('.client').css('display', 'none');
                $('.builder_project').css('display', 'none');
                $('.other').css('display', 'none');
                $('.company').css('display', 'none');
            }
            else if (activity_id == 5) {
                $('.activity_with').css('display', 'block');
                $('.activity_type').css('display', 'block');
                $('.project_id').css('display', 'none');
                $('.suburbs_id_div').css('display', 'block');
                $('.lead_id_div').css('display', 'none');
                $('.builder_id').css('display', 'none');
                $('.lead_id_div').css('display', 'none');
                $('.area_id_div').css('display', 'none');
                $('.company_div').css('display', 'none');
                $('.activity_type_div').css('display', 'block');
                $('.city_sub_area').css('display', 'block');
                $('.client').css('display', 'none');
                $('.builder_project').css('display', 'none');
                $('.other').css('display', 'none');
                $('.company').css('display', 'none');
            }
            else if (activity_id == 6) {
                $('.activity_with').css('display', 'block');
                $('.activity_type').css('display', 'block');
                $('.project_id').css('display', 'none');
                $('.suburbs_id_div').css('display', 'none');
                $('.area_id_div').css('display', 'block');
                $('.lead_id_div').css('display', 'none');
                $('.builder_id').css('display', 'none');
                $('.lead_id_div').css('display', 'none');
                $('.company_div').css('display', 'none');
                $('.activity_type_div').css('display', 'block');
                $('.city_sub_area').css('display', 'block');
                $('.client').css('display', 'none');
                $('.builder_project').css('display', 'none');
                $('.other').css('display', 'none');

                $('.company').css('display', 'none');
            }
            else if (activity_id == 7) {
                $('.activity_with').css('display', 'block');
                $('.activity_type').css('display', 'block');
                $('.company_id_div').css('display', 'block');
                $('.company').css('display', 'block');
                $('.project_id').css('display', 'none');
                $('.suburbs_id_div').css('display', 'none');
                $('.area_id_div').css('display', 'none');
                $('.company_div').css('display', 'block');
                $('.lead_id_div').css('display', 'none');
                $('.builder_id').css('display', 'none');
                $('.lead_id_div').css('display', 'none');
                $('.activity_type_div').css('display', 'block');
                $('.city_sub_area').css('display', 'none');
                $('.client').css('display', 'none');
                $('.builder_project').css('display', 'none');
                $('.other').css('display', 'none');

            }
            else
            {
                $('.activity_with').css('display', 'none');
                $('.activity_type').css('display', 'none');
                $('.lead_id_div').css('display', 'none');
                $('.city_id_div').css('display', 'none');
                $('.project_id').css('display', 'none');
                $('.builder_id').css('display', 'none');
                $('.suburbs_id_div').css('display', 'none');
                $('.area_id_div').css('display', 'none');
                $('.company_div').css('display', 'none');
                $('.activity_type_div').css('display', 'block');
                $('.other').css('display', 'block');
                $('.company').css('display', 'none');

                $('.city_sub_area').css('display', 'none');
                $('.client').css('display', 'none');
                $('.builder_project').css('display', 'none');
            }
        });

        $('.EventActivityType').change(function() {
            var type = $(this).val();

            var level = $('#activity_level').val();

            var event_type = $('#activity_past').val();
            var completed = $("input:checked").val();

            if (level == '1') {
                type = $('#EventClientTypes').val();
                $('#ReimbursementRemType').val($('#EventClientTypes option:selected').text());

            }
            else if (level == '2' || level == '3') {
                type = $('#EventProjBuilderTypes').val();
                $('#ReimbursementRemType').val($('#EventProjBuilderTypes option:selected').text());

            }
            if ((type == 1 || type == 4 || type == 6 || type == 7 || type == 9 || type == 10) && completed == 1)
                $("#is_expense").attr('disabled', false);
            else
                $("#is_expense").attr('disabled', true);


            if (type == '1' || type == '2' || type == '3') {
                $('.attended1').css('display', 'block');
                $('.attended23').css('display', 'none');

            }
            else if (type == '4' || type == '6' || type == '10') {
                $('.attended1').css('display', 'block');
                //$('.activity_completed').css('display','block');
                $('.attended23').css('display', 'block');
            }
            else {
                $('.attended1').css('display', 'none');
                //$('.activity_completed').css('display','none');
                $('.attended23').css('display', 'none');
            }


            if (type == '6')
                $('.site_project_id').css('display', 'block');
            else
                $('.site_project_id').css('display', 'none');
            var model = 'Event';




            var dataString = 'type_id=' + type + '&model=' + model;
            $('#ReimbursementReimbursementType2').attr('disabled', 'disabled');
            $.ajax({
                type: "POST",
                data: dataString,
                url: FULL_BASE_URL + '/all_functions/get_type_2_by_type1_id',
                beforeSend: function() {
                    $('#ReimbursementReimbursementType2').attr('disabled', 'disabled');
                    //return false;
                },
                success: function(return_data) {
                    $('#ReimbursementReimbursementType2').removeAttr('disabled');
                    $('#ReimbursementReimbursementType2').html(return_data);
                }
            });
        });




        $('#activity_type').change(function() {

            var activity_type = $(this).val();
            // alert(activity_type);
            if (activity_type == 1) {
                $('.call_div').css('display', 'block');
                $('.channel_div').css('display', 'none');
                $('.from_city_div').css('display', 'none');
                $('.to_city_div').css('display', 'none');
                $('.other_div').css('display', 'none');
            }
            else if (activity_type == 2) {
                $('.call_div').css('display', 'block');
                $('.channel_div').css('display', 'none');
                $('.from_city_div').css('display', 'none');
                $('.to_city_div').css('display', 'none');
                $('.other_div').css('display', 'none');
            }
            else if (activity_type == 3) {
                $('.call_div').css('display', 'block');
                $('.channel_div').css('display', 'none');
                $('.to_city_div').css('display', 'none');
                $('.from_city_div').css('display', 'none');
                $('.other_div').css('display', 'none');
            }
            else if (activity_type == 4) {
                $('.channel_div').css('display', 'block');
                $('.call_div').css('display', 'none');
                $('.from_city_div').css('display', 'none');
                $('.to_city_div').css('display', 'none');
                $('.other_div').css('display', 'none');
            }
            else if (activity_type == 5) {
                $('.channel_div').css('display', 'block');
                $('.call_div').css('display', 'none');
                $('.from_city_div').css('display', 'none');
                $('.to_city_div').css('display', 'none');
                $('.other_div').css('display', 'none');
            }
            else if (activity_type == 6) {
                $('.channel_div').css('display', 'block');
                $('.call_div').css('display', 'none');
                $('.from_city_div').css('display', 'none');
                $('.to_city_div').css('display', 'none');
                $('.other_div').css('display', 'none');
            }
            else if (activity_type == 7) {
                $('.channel_div').css('display', 'block');
                $('.call_div').css('display', 'none');
                $('.from_city_div').css('display', 'none');
                $('.to_city_div').css('display', 'none');
                $('.other_div').css('display', 'none');
            }
            else if (activity_type == 8) {
                $('.channel_div').css('display', 'block');
                $('.call_div').css('display', 'none');
                $('.from_city_div').css('display', 'none');
                $('.to_city_div').css('display', 'none');
                $('.other_div').css('display', 'none');
            }
            else if (activity_type == 9) {
                $('.from_city_div').css('display', 'block');
                $('.to_city_div').css('display', 'block');
                $('.channel_div').css('display', 'none');
                $('.call_div').css('display', 'none');
                $('.other_div').css('display', 'none');
            }
            else if (activity_type == 10) {
                $('.other_div').css('display', 'block');
                $('.from_city_div').css('display', 'none');
                $('.to_city_div').css('display', 'none');
                $('.channel_div').css('display', 'none');
                $('.call_div').css('display', 'none');
            }
            else {
                $('.call_div').css('display', 'none');
                $('.channel_div').css('display', 'none');
                $('.from_city_div').css('display', 'none');
                $('.to_city_div').css('display', 'none');
                $('.other_div').css('display', 'none');
            }
        });

        $('#EventEventAttendedBy2').click(function(e) {
            var atten1 = $('#EventEventAttendedBy1').val();
            if (atten1 == '')
                alert('Please select Attended By 1');
        });
        $('#EventEventAttendedBy3').click(function(e) {
            var atten2 = $('#EventEventAttendedBy2').val();
            if (atten2 == '')
                alert('Please select Attended By 2');
        });

        $('.activity_with_class').change(function() {
            $('#ReimbursementReimbursementWith').val($('option:selected', $(this)).text());
            $('#EventFllowActivityWith').val($('option:selected', $(this)).text());
        });

    });

</script>	


<!----------------------------end add project block------------------------------>
