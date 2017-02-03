$(document).ready(function(){
	$('.confirm_modal').click(function(){
		var count = $(this).data('count');	
		var categoryArr = new Array();
		var selectedCat = new Array();
		var categories = new Array();
		var mainCategories = new Array('Rings', 'Earrings', 'Bracelets', 'Chains', 'Crosses & Rosaries', 'Necklaces');
		for(var i=1; i<=count; i++)
		{
			var checked = $('.category_check'+i).parent().attr('class');
			if(checked == 'checked')
			{	var category = $('.category_check'+i).val();
				selectedCat.push(category);		
				var name = 	$('.category_check'+i).data('category');	
				if($.inArray(name, mainCategories) == -1)
				{
					categoryArr.push(category);
				}else{
					$('.category_check'+i).parent().attr('class',"");
				}
			}
		}
		$('#delete_categories').data('array', categoryArr);
		for(var m=0; m<=selectedCat.length; m++)
		{
			var cat = $('.category_check'+selectedCat[m]).data('category');
			if($.inArray(cat, mainCategories) != -1)
			{
				categories.push(cat);
			}
		}
		if(categories != "")
		{
			$('.modal-title').text('You can not delete '+categories+' categories! Delete the other categories?');
			$('.modal').modal('show');
		}else{
			$('.modal-title').text('Delete selected categories?');
			$('.modal').modal('show');
		}
	})
	$('#delete_categories').click(function(){
		var catArr = $(this).data('array');

		$.ajax({
			url:"/admin/category/delete-categories",
			method:"GET",
			data:{catArr:catArr},
			success:function(data){
				for(var n=0; n<= catArr.length; n++)
				{
					$('.category_check'+catArr[n]).closest("tr").remove();
				}
				// for(var m=0; m<=selectedCat.length; m++)
				// {
				// 	var cat = $('.category_check'+selectedCat[m]).data('category');
				// 	if($.inArray(cat, mainCategories) != -1)
				// 	{
				// 		categories.push(cat);
				// 	}
				// }
				// if(categories != "")
				// {
				// 	$('.modal-title').text('You can not delete '+categories+' categories! ');
				// 	$('#delete_collection').attr('style','display: none;');
				// 	$('.modal').modal('show');
				// }
				$('#check_all').parent().attr('class', "");
			}
		})
	})
})