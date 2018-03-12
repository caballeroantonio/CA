   <!--tab for reviews-->
    <div id="country4" class="tabcontent">
<?php
//show the reviews
    if ($reviews = $this->item->getReviews()) {
        ?>
        <br />
        <div class="componentheading<?php echo $this->params->get('pageclass_sfx'); ?>">
            <?php echo JText::_('_REALESTATE_MANAGER_LABEL_REVIEWS'); ?> 
        </div>

        <div class="reviews_table table_06">
            <?php
            if ($reviews != null && count($reviews) > 0) {
                for ($m = 0, $n = count($reviews); $m < $n; $m++) {
                    $review = $reviews[$m];
                    if ($review->state != 0) {
                        ?>
                        <div class="box_comment">
                            <div class="user_name"><?php echo $review->user_name; ?></div>
                            <span class="arrow_up_comment"></span>
                            <div class="head_comment">
                                <div class="title_rating">
                                    <h4 class="col_title_rev"><?php echo $review->title; ?></h4>
                                    <span class="col_rating_rev">
                                        <img src="./components/com_realestatemanager/images/rating-<?php
                                             echo $review->rating; ?>.png" 
                                             alt="<?php echo ($review->rating) / 2; ?>" border="0" align="right"/>
                                    </span>
                                </div>
                                <div class="row_comment">
                                    <?php echo $review->comment; ?>
                                </div>
                                <div class="date">
                                    <span class="date_format">
                                        <?php echo data_transform_rem($review->date); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
            }
            ?>
        </div>

        <?php
    } else{
      echo "<p>No reviews for house</p>";
    }

if ($this->params->get('show_reviews')) {
    $reviews = $this->item->getReviews();
    ?><?php
    if ($this->params->get('show_inputreviews')) {
        ?><?php positions_rem($this->params->get('view07')); ?><div id="hidden_review">
            <form action="<?php echo sefRelToAbs("index.php?option="
                 . $option . "&amp;task=review_house&amp;Itemid=" .
                   $Itemid); ?>" method="post" name="review_house"> 
                <input type="hidden" name="user_name" value="<?php echo $my->username ?>">
                <input type="hidden" name="fk_userid" value="<?php echo $my->id ?>">
                <input type="hidden" name="user_email" value="<?php echo $my->email ?>">
                <div class="componentheading<?php echo $this->params->get('pageclass_sfx'); ?>">
                    <hr />
                    <?php echo JText::_('_REALESTATE_MANAGER_LABEL_ADDREVIEW'); ?>
                </div>

                <div class="add_table_review table_09">
                    <div class="row_01"><?php echo JText::_('_REALESTATE_MANAGER_LABEL_REVIEW_TITLE'); ?></div>
                    <div class="row_02">
                        <input class="inputbox" type="text" name="title" size="80" 
                        value="<?php if (isset($_REQUEST["title"])) {
                        echo $_REQUEST["title"]; } ?>" /> 
                    </div>
                    <div class="row_03"><?php echo JText::_('_REALESTATE_MANAGER_LABEL_REVIEW_COMMENT'); ?></div>
                    <div class="row_04">
                            <?php
                            $comm_val = "";
                            if (isset($_REQUEST["comment"])) {
                                $comm_val = protectInjectionWithoutQuote("comment",'','STRING');
                            }
                            //editorArea( 'editor1',  $comm_val, 'comment', '410', '200', '60', '10' );
                            ?>
                        <textarea name="comment" cols="50" rows="8" ><?php echo $comm_val; ?></textarea>
                    </div>

                    <!-- #### RATING #### -->
                    <?php if (version_compare(JVERSION, "3.0", "ge")): ?>
                    <script type="text/javascript">
                        os_img_path = '<?php echo $mosConfig_live_site . '/components/com_realestatemanager/images/'; ?>' ;
                        jQuerREL(document).ready(function(){
                            jQuerREL('#star').raty({
                                starHalf: os_img_path+'star-half.png',
                                starOff: os_img_path+'star-off.png',
                                starOn: os_img_path+'star-on.png' 
                            });
                        });
                    </script>

                        <div class="row_rating_j3">
                            <span class="lable_rating"><?php echo JText::_('_REALESTATE_MANAGER_LABEL_REVIEW_RATING'); ?></span>
                            <span id="star"></span>
                        </div>

                            <?php else:
                            ?>
                        <div class="row_rating_j2">
                            <span class="col_01"><?php echo JText::_('_REALESTATE_MANAGER_LABEL_REVIEW_RATING'); ?></span>
                            <br />
                            <span>  
                            <?php
                            $k = 0;
                            while ($k < 11) {
                                ?>
                            <input type="radio" name="rating" value="<?php echo $k; ?>" <?php
                            if (isset($_REQUEST["rating"]) && $_REQUEST["rating"] == $k) {
                                echo "CHECKED";
                            }
                            ?> alt="Rating" />
                            <img src="./components/com_realestatemanager/images/rating-<?php echo $k; ?>.png" 
                              alt="<?php echo ($k) / 2; ?>" border="0" /><br />
                                <?php
                                $k++;
                            }
                            ?>
                            </span>
                        </div>

                        <?php endif; ?>

            <div  class="row_button_review">
                <span class="button_save"> 
                    <!-- save review button-->
                    <input class="button" type="button" value="<?php 
                      echo JText::_('_REALESTATE_MANAGER_LABEL_BUTTON_SAVE'); ?>" onclick="review_submitbutton()"/>
                </span>
            </div>

        </div>

        <input type="hidden" name="fk_houseid" value="<?php echo $this->item->id; ?>" />
        <input type="hidden" name="catid" value="<?php $temp = $this->item->catid;
        echo $temp[0]; ?>" />
            </form>
        </div> 
        <!-- end <div id="hidden_review"> -->
        <?php
    } //end if($this->params->get('show_inputreviews'))
} // end if( $this->params->get('show_reviews'))
?>
    </div>