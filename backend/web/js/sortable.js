    $(document).ready(function() { 
        $( "#sortable" ).sortable({   
            revert: true,
            update: function(event, ui) {
                var order = $(this).sortable("toArray");
                $.ajax({
                    type: "POST",
                    url: $("#sortable").attr('data-url'),
                    data: {order: order},
                    beforeSend: function() {
                        // console.log('beforesend');
                    },
                    error: function(data) {
                        // console.log('error');
                    },
                    success: function(data) {
                        // console.log('success');
                    }
                });
            }
        });
    });