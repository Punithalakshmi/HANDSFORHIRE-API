<?php if($btn){?>
<div class="col-md-3 pull-right">
  <div class="row">
    <div class="col-md-12">
      <div class="btn-group pull-right">
        <?=$btn;?>  
      </div>
    </div>
  </div>
</div>
<?php }?>
<div class="col-md-9 table-sub-header text-right search-bar pull-left">
  <div class="row">
    <div class="div top-lisiting-search">
      <form method="post" id="simple_search_form">
        <div class="col-md-3">
          <?php echo form_dropdown('search_type', $simple_search_fields, $search_conditions['search_type'], 'class="form-control"');?>      
        </div>
        <div class="col-md-5">
          <div class="input-group">
            <input type="text" class="form-control" name="search_text" value="<?php echo $search_conditions['search_text'];?>" placeholder="Search some stuff.">
            <span class="input-group-btn">
            <button class="btn blue" type="button"  id="simple_search_button" data-placement="top" data-toggle="tooltip" data-original-title="search"><span class="md-click-circle md-click-animate" style="height: 49px; width: 49px; top: -4.5px; left: 11px;"></span><i class="fa fa-search"></i></button>
            </span>
            <a class="clear-text pull-right text-right clear-fil" href="javascript:void(0);" onclick="$.fn.clear_simple_search();" data-placement="top" data-toggle="tooltip" data-original-title="clear simple search">Clear Filter</a>
          </div>
        </div>
      </form>
      <div class="right-section">
        <div class="col-sm-4 entry-text pull-left text-left">
          <span class="col-sm-6 show-entry">Show entries:</span>
          <span class="col-sm-6">
            <?php echo form_dropdown('per_page_options', $per_page_options, $per_page, 'class="form-control input-sm"');?>
          </span>
        </div>
      </div>
    </div>
  </div>
</div>