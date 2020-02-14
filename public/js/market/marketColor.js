$(function(){

	if($(".market-select-account-list-text-box").length > 0)

	{
		$(".market-select-account-list-text-box").each(function(){

			var target_element = $(this).attr("data-target") || "li";

			var target_where   = "background-color";

			var rand_color = random_color();
            //console.log(rand_color);
			
			//광고주 계정 background color 부여
			$(this).css({backgroundColor:rand_color});

		});

	}

});

function random_color(){

	var color = '#';
    var letters = ['ee2560','283149','FDA403']; 
    var length = letters.length;
	for(var i = 0; i < length; i++ )	{
	color += letters[Math.floor(Math.random() * letters.length)];
	}

	return color;

}

