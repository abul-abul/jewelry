    $(document).ready(function(){
            $("[name='approved']").bootstrapSwitch();
            $('.button-approved').click(function(){
                var id = $(this).find(':first-child').attr('alt');
                $(this).removeClass('default');
                $(this).addClass('green-jungle');
                $(this).next().removeClass('red-thunderbird');
                $(this).next().addClass('default');
                $.ajax({
                    method: "GET",
                    url: "/admin/edit-review/"+id+"/approved",
                    success:function(data){      
                    }
                })
            })

            $('.button-unapproved').click(function(){
                var id = $(this).find(':first-child').attr('alt');
                $(this).removeClass('default');
                $(this).addClass('red-thunderbird');
                $(this).prev().removeClass('green-jungle');
                $(this).prev().addClass('default');
                $.ajax({
                    method: "GET",
                    url: "/admin/edit-review/"+id+"/unapproved",
                    success:function(data){      
                    }
                })
            })
    });