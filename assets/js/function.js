
$(document).ready(function(){
   $('.date-picker').datepicker({
        rtl: Metronic.isRTL(),
        orientation: "left",
        autoclose: true,
        todayHighlight:true,
        format:"yyyy-mm-dd"
    });
    $('.timepicker').timepicker({
          autoclose: true,
          minuteStep: 1,
      });

    $('.select2_sample1').select2({
            placeholder: "Select an option",
            allowClear: true
        });
});


//to delete selected record from list.
function delete_record(del_url,elm)
{
	$("#div_service_message").remove();
  retVal = confirm("Are you sure to remove?");
  if( retVal == true )
  {
    $.post(base_url+del_url,{},function(data){
      if(data.status == "success"){
        //success message set.
        service_message(data.status,data.message);
        //grid refresh
        refresh_grid();
      }
      else if(data.status == "error")
      {
        //error message set.
        service_message(data.status,data.message);
      }
    },"json");
  } 
}

function refresh_grid(data_tbl)
{
  data_tbl     =  (data_tbl)?data_tbl:"data_table";
  var cur_page = $("#base_url").val()+$("#cur_page").val();
  $.fn.init_progress_bar();
  $.fn.display_grid(cur_page,data_tbl);
}

function service_message(err_type,message,div_id)
{
    
    div_id = (div_id)?div_id:false;   

    $("#div_service_message").remove();
    
    var str  ='<div id="div_service_message" class="alert alert-'+err_type+' alert-dismissible">';
        str +='<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>';
      str +='<strong>'+capitaliseFirstLetter(err_type)+':&nbsp;</strong>';
      str += message;
        str +='</div>';
        
        if(div_id){
             $("#"+div_id).html(str);
        }
        else
        {
          $(".blue-mat").after(str);
          // scroll_to("div_service_message");
        }
            
}
function capitaliseFirstLetter(string)
{
  return string.charAt(0).toUpperCase() + string.slice(1);
}

function make_card_default(card_url,elm)
{
  $("#div_service_message").remove();
    $.post(base_url+card_url,{},function(data){
      console.log(data);
      if(data.status == "success"){
        //success message set.
        service_message(data.status,data.message);
        //grid refresh
        refresh_grid();
      }
      else if(data.status == "error")
      {
        //error message set.
        service_message(data.status,data.message);
      }
    },"json");
}

