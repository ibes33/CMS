ClassicEditor
    .create( document.querySelector( '#body' ) )
    .catch( error => {
        console.error( error );
    } );

$(document).ready(function(){
	$('#selectAllBoxes').click(function(event){
		if (this.checked) {
			$('.checkBoxes').each(function(){
				this.checked = true;
			});
		}else{

			$('.checkBoxes').each(function(){
				this.checked = false;
			});
		}
	});
});

/*
// nu merge :(
// pagina de LOADING
var div_box = "<div id='load-screen'><div id='loading'></div></div>";

$("body").prepend(div_box);

$('#load-screen').delay(700).fadeOut(600, function(){
	$(this).remove();
});
*/

/*
//////////////////////refresh automat la user online
function loadUsersOnline(){
	$.get("functions.php?onlineusers=result", function(data){
		$(".usersonline".text(data);
	});
}
//trebuie sa chem functia dupa ce am creat-o
setInterval(function(){
	loadUsersOnline();
},500);
*/
