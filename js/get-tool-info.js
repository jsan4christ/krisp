
/*Get tool details from the database*/
$(document).ready(function(){
    $(document).on('click','#tool',function(e){
        e.preventDefault();
        var sw_id = $(this).data('id');
        $('#tool-details').hide();
        $('#tool_data-loader').show();
        
        $.ajax({
            url: 'db_scripts/get-tool-info.php',
            type: 'post',
            data: 'sw_id='+sw_id,
            datatype: 'json',
            cache: false 
        }).done(function(data){
            
            obj = JSON.parse(data);
            console.log(data);
            /** **/
            $('#tool-details').hide();
            $('#tool-details').show();
            $('#tool-details').modal('toggle');
            $('#sw_id').html(obj.sw_id);
            $('#sw_name').html(obj.sw_name);
            $link = 'Url: <a href='+obj.sw_url+' targe="_blank">'+obj.sw_url+'</a>';
            $('#sw_url').html($link);
            $('#sw_cat').html(obj.cat_name +'/'+ obj.subcat_name);
            $('#date_of_instn').html("Installed on: "+obj.install_date);
            /*$('#install_locn').html("Location: " + obj.install_locn);*/
            $('#access_info').html(obj.instns_to_req_acc);
            $('#server').html(obj.svr_name);
            $('#sw_desc').html(obj.sw_desc);
            $('#sw_expert').html(obj.name);
            $('#cmds_names').html(obj.cmd_name);
            $('#tool_data-loader').hide();
            /**/
        })
        .fail(function(){
            
            $('#tool-detail').html('Error, Please try again...');
            $('#tool_data-loader').hide();
        });
    });
});
/**/