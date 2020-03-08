// For Add More Project links

$('body').on('click', '.add-more-project-link', function(event) {
    j++;
    var cloned_div = $('.project-link-clone').clone();
    cloned_div.removeClass('project-link-clone');
    cloned_div.addClass('new-project-link-cloned-div');
    cloned_div.find('.btn-remove-project-link').removeClass('hide');
    //cloned_div.find('.col-md-12').addClass('list-group-item');
    cloned_div.find("input").val("");
    cloned_div.find(".control-label").html("");
    cloned_div.find('.project_name').attr('name','project_name['+j+']').val('');
    cloned_div.find('.project_url_link').attr('name','project_url_link['+j+']').val('');
    cloned_div.find('.project_link_order_id').attr('name','project_link_order['+j+']').val('');
    cloned_div.find('.add-more-project-link').addClass('hide');
    $('.project-link-new-div').prepend(cloned_div);
    
});

// For remove the  project links
$('body').on('click','.btn-remove-project-link',function(){
    var project_link_id = $(this).data('project-link-remove');

    if(project_link_id == null || project_link_id == '')
    { 
        $this = $(this);
        $this.parent().parent().parent().remove();
        $('.add-more').prop('disabled', false);   
        return false;
    }
    $this = $(this);
    swal({   
        title: "Warning",   
        text: "Are you sure you want to remove the project link",
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes",   
        closeOnConfirm: true,
        cancelButtonText : 'No' 
    }, function(){
        $.ajax({
            type : "get",
            url  : projectUrl+"/company-project-link/"+project_link_id+"/delete",
            success: function(response) {
                if(response == '1') {
                    $this.parent().parent().parent().remove();
                    $('.add-more').prop('disabled', false);
                    swal("", "Project link removed successfully!!", "success"); 
                } else {
                    swal("Something went wrong!", "", "warning");
                }
            }
        });
    });
});  