<!--       *******************************************************************         -->
<?php if($this->params->get('manager_feature_category') == 1) { ?>
<div class="table_country3 ">
  <?php 
    if (count($house_feature)) {
  ?>
    <div class="row_text">
        <div class="rem_features_title">
        <?php echo JText::_('_REALESTATE_MANAGER_LABEL_FEATURED_MANAGER_FEATURE'); ?>:
        </div>
        <span class="col_text_2">
        <?php 
        for ($i = 0; $i < count($house_feature); $i++) {
          if ($i != 0) {
            if ($house_feature[$i]->categories !== $house_feature[$i - 1]->categories)
              echo "<div class='rem_features_category'>" . $house_feature[$i]->categories . "</div>";
          }
          else {
            echo "<div class='rem_features_category'>" . $house_feature[$i]->categories . "</div>";
          }
          echo "<span class='rem_features_name'><i class='fa  fa-check rem_fa'></i>"
             . $house_feature[$i]->name . "</span>";
          if ($i != count($house_feature)-1) {
            if ($house_feature[$i]->categories == $house_feature[$i + 1]->categories);            
          }
        }
        ?>
        </span>
    </div>

        <?php }
    ?>
</div>
<?php } ?>