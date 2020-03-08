// For Add More Additional Address
$('body').on('click', '.add-more', function(event) {
    $('.additional-location-clone').show();
    i++
    var cloned_div= $('.additional-location-clone').clone();
    cloned_div.removeClass('additional-location-clone');
    cloned_div.addClass('new-cloned-div');
    cloned_div.find('.btn-remove').removeClass('hide');
    cloned_div.find("input").val("");
    cloned_div.find('.location_name').attr('name','location_name['+i+']').val('');
    cloned_div.find('.address').attr('name','address['+i+']').val('');
    cloned_div.find('.city').attr('name','city['+i+']').val('');
    cloned_div.find('.state').attr('name','state['+i+']').val('');
    cloned_div.find('.zip').attr('name','zip['+i+']').val('');
    cloned_div.find('.phone').attr('name','phone['+i+']').val('');
    $('.new-div').prepend(cloned_div);
    $('.additional-location-clone').hide();
});  
// For remove the  Additional Address
$('body').on('click','.btn-remove',function(){
    var additional_address_id = $(this).data('remove-additional-address');
    
    if(additional_address_id == null || additional_address_id == '')
    { 
        $this = $(this);
        $this.parent().parent().parent().remove();
        $('.add-more').prop('disabled', false);   
        return false;
    }
    $this = $(this);
    swal({   
        title: "Warning",   
        text: "Are you sure you want to remove the additional address",
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes",   
        closeOnConfirm: true,
        cancelButtonText : 'No' 
    }, function(){
        $.ajax({
            type : "get",
            url  : projectUrl+"/company-additional-address/"+additional_address_id+"/delete",
            success: function(response) {
                if(response == '1') {
                    $this.parent().parent().parent().remove();
                    $('.add-more').prop('disabled', false);
                    swal("", "Additional address removed successfully!!", "success"); 
                } else {
                    swal("Something went wrong!", "", "warning");
                }
            }
        });
    });
}); 