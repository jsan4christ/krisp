
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
            $('#tool-details').hide();
            $('#tool-details').show();
            $('#tool-details').modal('toggle');
            $('#sw_id').html(obj[0].sw_id);
            $('#sw_name').html(obj[0].sw_name);
            $link = 'Url: <a href='+obj[0].sw_url+' targe="_blank">'+obj[0].sw_url+'</a>';
            $('#sw_url').html($link);
            $('#sw_cat').html(obj[0].cat_name+'/'+obj[0].subcat_name);
            $('#date_of_instn').html("Installed on: "+obj[0].install_date);
            $('#install_locn').html("Location: " + obj[0].install_locn);
            $('#access_info').html(obj[0].instns_to_req_acc);
            $('#server').html("Server: "+ obj[0].svr_name + "("+ obj[0].svr_addr +")" );
            $('#sw_desc').html(obj[0].sw_desc);
            $('#tool_data-loader').hide();
        })
        .fail(function(){
            
            $('#tool-detail').html('Error, Please try again...');
            $('#tool_data-loader').hide();
        });
    });
});
/**/