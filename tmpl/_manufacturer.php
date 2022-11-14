<?php defined('_JEXEC') or die('Restricted access');?>
<input type="hidden" name="manufacturers[]" value="0" />
<div class="manufacturer-filter filter-block-wrap">
    <div class="filter-head">
        <?php print JText::_('MANUFACTURER').":"?>
    </div>
    <?php 
        if($show_manufacturers=='1') { ?>
            <?php foreach($filter_manufactures as $v){ ?>
            <div class="filter-item">
                <input type="checkbox" name="manufacturers[]" id="filter-manufacturer-<?php print $v->id;?>" value="<?php print $v->id;?>" <?php if (in_array($v->id, $manufacturers)) print "checked";?> > <label for="filter-manufacturer-<?php print $v->id;?>"><?php print $v->name;?></label>
            </div>
            <?php }
        } elseif ($show_manufacturers=='2') {?>
            <div class="filter-item">
            <?php $filter = array_merge($filter_all, $filter_manufactures);
            echo JHTML::_('select.genericlist', $filter, 'manufacturers[]', 'size = "1"','id', 'name', $manufacturers); ?>
            </div>
    <?php }?>
</div>
<div class="after-filter-item"></div>