// for Add More monthly-rollups
$('body').on('click', '.add-more-monthly-rollups', function(event) {
    m++;
    var cloned_div= $('.monthly-rollup-clone').clone();
    cloned_div.removeClass('monthly-rollup-clone');
    cloned_div.addClass('new-monthly-rollup-cloned-div');
    cloned_div.find('.btn-remove-monthly-rollups').removeClass('hide');
    cloned_div.find("input").val("");
    cloned_div.find(".control-label").html("");
    cloned_div.find('.file_name').attr('name','file_name['+m+']').val('');
    cloned_div.find('.add-more-monthly-rollups').addClass('hide');
    $('.monthly-rollup-new-div').prepend(cloned_div);
});

// For remove the  monthly rollup section
$('body').on('click','.btn-remove-monthly-rollups',function(){
    $this = $(this);
    $this.parent().parent().parent().remove();
    $('.add-more').prop('disabled', false);
});

//Remove the rollup documents
$('body').on('click','.remove-monthly-rollup',function(){
    var monthly_rollup_id = $(this).data('monthly-rollup');
    $this = $(this);
    swal({   
        title: "Warning",   
        text: "Are you sure you want to remove the monthly rollup",
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes",   
        closeOnConfirm: true,
        cancelButtonText : 'No' 
    }, function(){
        $.ajax({
            type : "get",
            url  : projectUrl+"/company-monthly-rollup/"+monthly_rollup_id+"/delete",
            success: function(response) {
                if(response == '1') {
                    $this.parent().parent().remove();
                    swal("", "Monthly rollup removed successfully!!", "success"); 
                } else {
                    swal("Something went wrong!", "", "warning");
                }
            }
        });
    });
}); 