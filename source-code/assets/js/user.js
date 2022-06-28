//for get id to delete
$("body").on("click", "a.btn-delete-user", function() {
    var item = $(this).parents("tr");
    var id = $(this).data("id");
    var url = $(this).data("url");
 
    
     
    Swal.fire({
            title: __("Are you sure to delete this data?"),
            text: __("Warning! All data related to this item will be delete! It is not possible to get back removed data!"),
            icon: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: __("Yes, Delete"),
            cancelButtonText: __("Cancel")
    }).then(function(t) {
            if (t.value) {
                    $.ajax({
                            url: url + "/" + id,
                            data: {action: 'delete'},
                            type: 'DELETE',
                            dataType: 'JSON',
                            error: function() {
                                    Swal.fire(__('Oops...'), __("Oops! An error occured. Please try again later!"), 'error')
                            },

                            success: function(resp) {
                                    if (resp.result == 0) {
                                            Swal.fire(__('Oops...'), resp.msg, 'error')
                                    } else {
                                            Swal.fire(__("Success!"), resp.msg, "success");
                                            let myObject = $("tbody tr").find("a[data-id="+id+"]").parent().parent();
                                            let myTarget = myObject.find("td:nth-child(5)").html("<i style='color:red' class='fa fa-times-circle' aria-hidden='true'></i>");                                            
                                    }

                            }
                    });
            }
    })
});