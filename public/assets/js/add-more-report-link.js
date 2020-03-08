// For Add More report links

$('body').on('click', '.add-more-report-link', function(event) {
    k++;
    var cloned_div= $('.report-link-clone').clone();
    cloned_div.removeClass('report-link-clone');
    cloned_div.addClass('new-report-link-cloned-div');
    cloned_div.find('.btn-remove-report-link').removeClass('hide');
    cloned_div.find("input").val("");
    cloned_div.find(".control-label").html("");
    cloned_div.find('.report_name').attr('name','report_name['+k+']').val('');
    cloned_div.find('.report_url_link').attr('name','report_url_link['+k+']').val('');
    cloned_div.find('.add-more-report-link').addClass('hide');
    $('.report-link-new-div').prepend(cloned_div);
    
});

// For remove the  report links
$('body').on('click','.btn-remove-report-link',function(){
    var report_link_id = $(this).data('report-link-remove');
    if(report_link_id == null || report_link_id == '')
    { 
        $this = $(this);
        $this.parent().parent().parent().remove();
        $('.add-more').prop('disabled', false);   
        return false;
    }
    $this = $(this);
    swal({   
        title: "Warning",   
        text: "Are you sure you want to remove the report link",
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes",   
        closeOnConfirm: true,
        cancelButtonText : 'No' 
    }, function(){
        $.ajax({
            type : "get",
            url  : projectUrl+"/company-report-link/"+report_link_id+"/delete",
            success: function(response) {
                if(response == '1') {
                    $this.parent().parent().parent().remove();
                    $('.add-more').prop('disabled', false);
                    swal("", "Report link removed successfully!!", "success"); 
                } else {
                    swal("Something went wrong!", "", "warning");
                }
            }
        });
    });
});  