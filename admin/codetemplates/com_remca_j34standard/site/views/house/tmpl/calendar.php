<?php
/////////////////////////////////////////////START CALENDAR\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
if ($this->item->listing_type == 1) {
  if ($this->params->get('show_rentrequest') && $this->params->get('show_rentstatus') && $this->params->get('calendar_show')) {
?>
    <div id="country5" class="tabcontent">
      <div style="text-align: center;" >
        <h4><?php echo JText::_('_REALESTATE_MANAGER_LABEL_CALENDAR_TITLE'); ?></h4>
        <form action="" method="post" id="calendar" name="calendar" >    
        <!-- year select list on display -->
        <?php
        echo $this->params->get('months_list');
        echo $this->params->get('years_list');
        $calendar = $this->params->get('calendar');
        ?>
        <!-- year select list on display -->
        </form>
        <div class="rem_tableC basictable">
          <div class="row_01">
              <span class="col_01"><?php echo $calendar->tab1; ?></span>
              <span class="col_02"><?php echo $calendar->tab2; ?></span>
              <span class="col_03"><?php echo $calendar->tab3; ?></span>
              <span class="col_03"><?php echo $calendar->tab4; ?></span>
          </div>
          <div class="row_02">
              <span class="col_01"><?php echo $calendar->tab21; ?></span>
              <span class="col_02"><?php echo $calendar->tab22; ?></span>
              <span class="col_02"><?php echo $calendar->tab23; ?></span>
              <span class="col_03"><?php echo $calendar->tab24; ?><br /></span>
          </div>
          <div class="calendar_notation row_03">
            <div class="row_calendar">
              <span class="label_calendar_available">
              <?php echo JText::_('_REALESTATE_MANAGER_LABEL_CALENDAR_AVAILABLE'); ?></span>
              <div class="calendar_available_notation"></div>
            </div>
            <div class="row_calendar">
              <span class="label_calendar_available">
                <?php echo JText::_('_REALESTATE_MANAGER_LABEL_CALENDAR_NOT_AVAILABLE'); ?></span>
              <div class="calendar_not_available_notation"></div>
            </div>
          </div>
        </div>
      </div>
    </div>   
    <?php
  }
} 
/////////////////////////////////////////////END CALENDAR\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\   
?>