$(document).ready(function(){
	window.onload = function() {
	    var URL = window.location.href;
	    if(URL.indexOf('edit') != -1 && location.hash == "#reload") 
	    {
	    	$("#info-tab").removeClass("active");
		    $("#info-tab").children('a').attr("aria-expanded", false);
		    $("#tab_information").attr("class","tab-pane");
		    $("#images-tab").attr("class", "active");
		    $("#images-tab").children('a').attr("aria-expanded", true);
		    $("#tab_images").attr("class", "tab-pane active");
		    location.hash = "";    
	    }else{
	    	$("#info-tab").addClass("active");
	    	$("#tab_information").addClass("active"); 
	    }
	    if($('.green-jungle').data('status')){
	    	$("#info-tab").removeClass("active");
		    $("#info-tab").children('a').attr("aria-expanded", false);
		    $("#tab_information").attr("class","tab-pane");
		    $("#video-tab").attr("class", "active");
		    $("#video-tab").children('a').attr("aria-expanded", true);
		    $("#tab_videos").attr("class", "tab-pane active");
		    location.hash = "";
	    }
	}
	    
})