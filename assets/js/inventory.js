function tabsection(){
    
    if(namespace == 'inventory_index'){
        
        $('#ProductTabs a').click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        });
    
      var product_id = $("#edit_id").val();
      if(product_id==''){
        if(namespace == 'inventory_index'){
            $('#ProductTabs a').not(":first").unbind("click");
            $('#ProductTabs li').not(":first").click(function(){
                bootbox.alert("Please Enter General Info");
            });
        } 
      }
      else
      {
        //$("#ProductTabs a:first").trigger("click");
        //$('#ProductTabs a').attr("data-toggle",'tab').trigger('click');
      }
        $("#ProductTabs a:first").trigger("click");
        
    }
    
    if(namespace=='upload_inventory_index'){
        $("#upload_variations li a:first").trigger('click'); 
    }
}


function open_tab(tab)
{
    $("#").trigger("click");
}

function inventory_sub(ty='',edit_id,title)
{    
    if(edit_id!=''){
         edit_id = edit_id;
    }
    else
    {
        edit_id = (ty=='create')?"":$("#inventory_sub_form #edit_id").val();
    }
      
      if($("#form_type"))  
         $("#form_type").val(ty);
        
     var fdata  = (ty=='create')?{type:ty}:$("#inventory_sub_form").serialize();
        
      $.ajax({
          url:base_url+"inventory/add/"+edit_id,
          type:"POST",
          data:fdata,
          dataType:'json',
          success:function(res)
          {
            var status = res.status;
            var output = res.output; 
            if(res.message){ 
                bootbox.alert(res.message);
            }
            $("#inventory_form .modal-body").html(output);
            $("#inventory_form").find("#myModalLabel").html(title);
            $("#inventory_form").modal({
                backdrop:"static"
            });
             $("#inventory_form").show(); 
             $("#ProductTabs a:first").trigger("click"); 
             tabsection(); 
             init_product_uploads();  
             refresh_grid();
          }
    });    
}

function add_vendor_price_lists(action,div_id,type)
{
    //alert(action);
    // var fdata   = $("#form_vendor_add").serialize();
    // var edit_id = '';
        // edit_id = $("#form_vendor_add #edit_id").val();
     var data = (type == 'add')?$("#form_vendor_add").serialize():"";
      $.ajax({
          url:base_url+action,
          type:"POST",
          data:data,
          dataType:'json',
          success:function(res)
          {
            var status = res.status;
            var output = res.output;
             bootbox.alert(res.message);
                             
            if(status == 'success'){
              get_vendor_price_lists(res.product_id,div_id);
            }
            else
            {
                $("#"+div_id).find("#myModalLabel").html('Add Vendor');
                $("#"+div_id).find(".modal-body").html(res.form_view);
               // init_modal();  
            }
          }
      });    
}


function get_vendor_price_lists(product_id,div_id)
{
     $.ajax({
          url:base_url+"inventory/get_vendor_price_lists/"+product_id,
          type:"POST",
          data:{},
          dataType:'json',
          success:function(res)
          {
            var status = res.status;
            var output = res.output;                
            if(status == 'success'){
              $("#"+div_id).fadeOut();  
              $("#inventory_vendor_lists").html(output);
            }
         }
    });
}

function check_product_id(event)
{
    var product_id = $("#edit_id").val();
    if(product_id==''){
        alert("Please Add Product first");
        return false;
    }
    else
    {
        $("#load_image_popup").attr({"data-toggle":"modal","data-target":"#myModal"}).trigger('click');
        return true;
    }
}

//product image delete
function product_image_delete(del_id,table_name,product_id = '')
{
      $.ajax({
          url:base_url+"inventory/product_image_delete/"+del_id+"/"+table_name,
          type:"POST",
          data:{},
          dataType:'json',
          success:function(res){
             bootbox.alert(res.message);
            if(table_name == 'vendor_price_list'){
               get_vendor_price_lists(product_id,'addVendorForm'); 
            }
          }
    });    
}

function load_product_image_popup(modal)
{
    $(modal).addClass("in").fadeIn();
    //init_modal();  
    product_image_upload_settings();  
}


function init_product_uploads()
{
//product certificate upload section

var upld_certificate_options = {}; 
    upld_certificate_options.uploadUrl              = base_url+'inventory/certificate_upload';
    upld_certificate_options.allowedFileExtensions  = ['doc','docx'];
    upld_certificate_options.maxFileSize            = 2000; //kb
    upld_certificate_options.showCaption            = false;
    upld_certificate_options.dropZoneEnabled        = false;
    upld_certificate_options.showRemove             = false;
    
    var up_folder,divid,field_name;
    
    if(prv_certificate != '')
        upld_certificate_options.initialPreview = [prv_certificate];
   
    upld_certificate_options.uploadExtraData = {'upload_folder':"certificate",'types':'doc|docx','field':"certificate_file_name"}, 

    upld_certificate_options.slugCallback = function(filename) {      
      return filename.replace('(', '_').replace(']', '_');
    };
    
    $("#success_msg").html('');
    
    $("#certificate_file_name").fileinput(upld_certificate_options);

    $(document).ready(function() {
        $('#certificate_file_name').on('fileuploaded', function(event, data, previewId, index) {
            var form = data.form, files = data.files, extra = data.extra,
            response = data.response, reader = data.reader;
            $("#certification_files").val(response.fileuploaded);       
        });
    });
}

function product_image_upload_settings()
{
    //product images upload section
var upld_options = {}; 
    upld_options.uploadUrl              = base_url+'inventory/do_upload';
    upld_options.allowedFileExtensions  = ['jpg','jpeg','png','gif'];
    upld_options.maxFileSize            = 2000; //kb
    upld_options.showCaption            = false;
    upld_options.dropZoneEnabled        = false;
    upld_options.showRemove             = false;
    
    var up_folder,divid,field_name;
    
    if(prv_img != '')
        upld_options.initialPreview = [prv_img];
        
    if(page == 'social'){
        up_folder  = 'social_icon';
        divid      = 'Images';
    }    
    else
    {   up_folder = 'product';
        divid     = 'file_name';  
    }
     
    upld_options.uploadExtraData = {'upload_folder':up_folder,'types':'gif|jpg|png|jpeg','field':"product_upload_image"}, 

    upld_options.slugCallback = function(filename) {      
      return filename.replace('(', '_').replace(']', '_');
    };
    
    $("#success_msg").html('');
    
    $("#product_upload_image").fileinput(upld_options);

    $(document).ready(function() {
         
        $('#product_upload_image').on('fileuploaded', function(event, data, previewId, index) {
            var form = data.form, files = data.files, extra = data.extra,
            response = data.response, reader = data.reader;
            var imgtitle    = $("#image_title").val(); 
            var productid   = $("#edit_id").val();
            var uploaded_id = response.image_id;
             $.ajax({
                      url:base_url+"inventory/update_image_title/",
                      type:"POST",
                      data:{"image_title":imgtitle,"product_id":productid,'uploaded_id':uploaded_id},
                      dataType:'json',
                      success:function(res){
                        $("#success_msg").html(res.message).fadeIn(400);
                        $("#success_msg").fadeOut(600);
                      }
                  });
                  
            $("#"+divid).val(response.fileuploaded);       
        });
    });

}