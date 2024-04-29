$('#alert').hide();
var d= new Date();
var days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
var months = ["Jan","Feb","Mar","Apr","May","June","July","Aug","Sep","Oct","Nov","Dec"];
$(".date").text(days[d.getDay()] +", "+d.getDate() + " "+ months[d.getMonth()]);
if(d.getHours()<12){
	$('.greeting').text("Good Morning");
}else if(d.getHours()<17){
	$('.greeting').text("Good Afternoon");
}else{
	$('.greeting').text("Good Evening");
}
  $(window).on('load', function () {
    $('#loading').hide();
  }) 

var a=localStorage.getItem('darkmode');
if(a=='ture'){
	document.body.classList.toggle("dark_theme");
	var dm = document.getElementById("darkmode");
	if (dm.classList.contains('fa-moon')){
	localStorage.setItem('darkmode','ture');
	dm.classList.remove("fa-moon");
	dm.classList.add("fa-adjust");
	}else{
		dm.classList.remove("fa-adjust");
		dm.classList.add("fa-moon");
		localStorage.removeItem('darkmode');
	}
}

function darkmode(x){
	document.body.classList.toggle("dark_theme");
	var dm = document.getElementById("darkmode");
	if (dm.classList.contains('fa-moon')){
	localStorage.setItem('darkmode','ture');
	dm.classList.remove("fa-moon");
	dm.classList.add("fa-adjust");
	}else{
		dm.classList.remove("fa-adjust");
		dm.classList.add("fa-moon");
		localStorage.removeItem('darkmode');
	}
}
function triggerClick(e) {
  document.querySelector('#imgfile').click();
}
function displayImage(e) {
  if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
}
function triggerClickEdit(e) {
  document.querySelector('#edit_imgfile').click();
}
function displayImageEdit(e) {
  if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('#edit_profileDisplay').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
}
function triggerClickArtist(ea) {
  document.querySelector('#artist_imgfile').click();
}
function displayImageArtist(ea) {
  if (ea.files[0]) {
    var reader = new FileReader();
    reader.onload = function(ea){
      document.querySelector('#artistProfileDisplay').setAttribute('src', ea.target.result);
    }
    reader.readAsDataURL(ea.files[0]);
  }
}

function triggerClickEditArtist(ea) {
  document.querySelector('#edit_artist_imgfile').click();
}
function displayImageArtistEdit(ea) {
  if (ea.files[0]) {
    var reader = new FileReader();
    reader.onload = function(ea){
      document.querySelector('#editartist_profileDisplay').setAttribute('src', ea.target.result);
    }
    reader.readAsDataURL(ea.files[0]);
  }
}
function previewSong(e) {
	var audio = document.getElementById('edit_previewSong');
  if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('#edit_previewSong').setAttribute('src', e.target.result);
	  audio.load();
	  audio.play();
    }
    reader.readAsDataURL(e.files[0]);
  }
}
$(document).on("click",function(){
	var ifConnected = window.navigator.onLine;
	if (!ifConnected) {
		$('#alert').show();
		$('#message').text("Connection Error!");
		$('#message-icon').text("perm_scan_wifi");
	} 
});
$(document).ready(function(){
	var songCount=5;
	$("#load-songs").click(function(){
		songCount=songCount + 5;
		$("#songs-list").load("oopdb.php", {
			songNewCount:songCount,
		});
	});
/*	$("#addsong").click(function(){
		$('#songs-list').load(" #songs-list > *");
	});*/
	$("#addartistbtn").click(function(){
			$("#artists-list").load(" #artists-list > *");
	});
	$("#search_song").keyup(function(){
		var search_song = $("#search_song").val(),
	    trim_search_song = $.trim(search_song.replace( /\s\s+/g, ' ' ));
		$.ajax({
			type:'POST',
			url:'oopdb.php',
			data:{
				search_song:trim_search_song,
			},
			success:function(data){
				$("#songs-list").html(data);
			}
		})
	});
$(document).on('keyup','#search_song_user', function() {
		var search_song_user = $("#search_song_user").val(),
	    trim_search_song = $.trim(search_song_user.replace( /\s\s+/g, ' ' ));
		$.ajax({
			type:'POST',
			url:'userdb.php',
			data:{
				search_song_user:trim_search_song,
			},
			success:function(data){
				var data = data.split("split");
				$("#song-cards").html(data[0]);
				$('body').append("<script>"+data[1]+"</script>");
				$('.musics-ul').html(data[2]);
			}
		})
	});
	
	$(document).on('keyup','#search_artist_user', function() {
		var search_artist_user = $("#search_artist_user").val(),
	    trim_search_song = $.trim(search_artist_user.replace( /\s\s+/g, ' ' ));
		$.ajax({
			type:'POST',
			url:'userdb.php',
			data:{
				search_artist_user:trim_search_song,
			},
			success:function(data){
				$(".artist-cards").html(data);
			}
		})
	});

	$("#search_artist").keyup(function(){
		var search_artist = $("#search_artist").val(),
	    trim_search_artist = $.trim(search_artist.replace( /\s\s+/g, ' ' ));
		$.ajax({
			type:'POST',
			url:'oopdb.php',
			data:{
				search_artist:trim_search_artist,
			},
			success:function(data){
				$("#artists-list").html(data);
			}
		})
	});
	$("#search_user").keyup(function(){
		var search_user = $("#search_user").val(),
	    trim_search_user = $.trim(search_user.replace( /\s\s+/g, ' ' ));
		$.ajax({
			type:'POST',
			url:'oopdb.php',
			data:{
				search_user:trim_search_user,
			},
			success:function(data){
				$("#users-list").html(data);
			}
		})
	});
	$("#search_genre").keyup(function(){
		var search_genre = $("#search_genre").val(),
	    trim_search_genre = $.trim(search_genre.replace( /\s\s+/g, ' ' ));
		$.ajax({
			type:'POST',
			url:'db.php',
			data:{
				search_genre:trim_search_genre,
			},
			success:function(data){
				$(".genre-cards").html(data);
			}
		})
	});
	$('form#data').submit(function(a){
	    a.preventDefault();    
	    var formData = new FormData(this);
	    var num=parseInt(document.getElementById('total-songs').innerHTML);
	    $.ajax({
	        url: "oopdb.php",
	        type: 'POST',
	        data: formData,
	        success: function (data) {
	        	$('#addSongModal').modal('hide');
	        	alert(data);
	        	alert(parseInt(num));
	        	$('.total-songs').text(num+1);
	        	$('#songs-list').load(" #songs-list > *");
	        },
	        cache: false,
	        contentType: false,
	        processData: false
	    });
	});
	$('form#addartistdata').submit(function(aad){
		aad.preventDefault();
		var formData = new FormData(this);
	    var num=parseInt(document.getElementById('total-artists').innerHTML);
		$.ajax({
	        url: "oopdb.php",
	        type: 'POST',
			data: formData,
	        success: function (data) {
	        	alert(data);
	        	$('.total-artists').text(num+1);
	        	$('#addArtistModal').modal('hide');
	        },
	        cache: false,
	        contentType: false,
	        processData: false

		});
	});
	$('form#adduserdata').submit(function(aad){
		aad.preventDefault();
		var formData = new FormData(this);
	    var num=parseInt(document.getElementById('total-users').innerHTML);
		$.ajax({
	        url: "oopdb.php",
	        type: 'POST',
			data: formData,
	        success: function (data) {
	        	alert(data);
	        	$('.total-users').text(num+1);
	        	$('#addUserModal').modal('hide');
	        	$('#users-list').load(" #users-list > *");
	        },
	        cache: false,
	        contentType: false,
	        processData: false

		});
	});
	$(document).on('click','button[data-role=update]',function(){
		/*alert($(this).data('id'));*/
		var id =$(this).data('id');
		var name =$('#'+id).children('td[data-target=name]').text();
		var artist =$('#'+id).children('td[data-target=artist_id]').text();
		var cover =$('#'+id).children('td[data-src=cover]').text();
		var audio =$('#'+id).children('td[data-src=audio]').text();

		$('#edit_song_id').val(id);
		$('#edit_song_name').val(name);
		$('#edit_artist_id').val(artist);
		document.getElementById('edit_profileDisplay').src = "../images/song-image/"+cover;
		document.getElementById('edit_previewSong').src = "../music/"+audio;
	});
	$(".playbtn").click(function(){
		var count_id =$(this).data('count');
			$.ajax({
				url:"userdb.php",
				type:"POST",
				data:{count_id:count_id},
				success:function(data){
				}
			});
	 });

	$(document).on('click','button[data-role=artistupdate]',function(){
		var id=$(this).data('id');
		var artistname=$('#artist'+id).children('td[data-target=name]').text();
		var cover =$('#artist'+id).children('td[data-src=cover]').text();
		$('.edit_artist_id').val(id);
		$('#edit_artist_name').val(artistname);
		document.getElementById('editartist_profileDisplay').src = "../images/song-image/"+cover;
	});

	$(document).on('click','button[data-role=userupdate]',function(){
		var id=$(this).data('id');
		var username=$('#editUser'+id).children('td[data-target=email]').text();
		var uname=$('#editUser'+id).children('td[data-target=uname]').text();

		var cover =$('#editUser'+id).children('td[data-src=cover]').text();
		$('.edit_user_id').val(id);
		$('#edit_user_name').val(username);
		$('#edit_user_uname').val(uname);

		document.getElementById('edituser_profileDisplay').src = "../images/song-image/"+cover;
	});

	$(document).on('click','button[data-role=deletegenre]',function(){
	    var num=parseInt(document.getElementById('total-genres').innerHTML);
		var genre_id=$(this).data('id');
		if(confirm('are you sure to delete?')){
			$.ajax({
				url:"db.php",
				type:"POST",
				data:{genre_id:genre_id},
				success:function(data){
					$('#genre'+genre_id).hide();
		        	$('.total-genres').text(num-1);
		        	$('#message').text("Genre Deleted Successfully!");
		        	$('#alert').show();
				}
			});
		}
	});
	$(document).on('click','button[data-role=editgenre]',function(){
		var genre_id=$(this).data('id');
		var genrename=$('#genrename'+genre_id).text();
		$('#edit_song_genre').val(genrename);
		$('#getgenreid').val(genre_id);
	});
	$('form#editdata').submit(function(b){
	    b.preventDefault();    
	    var formData = new FormData(this);
	    var id=$("#edit_song_id").val();
	    var name = $("#edit_song_name").val();
	    var artist = $('#edit_artist_id').val();
	    var cover=$('.editprofilePhoto img').attr('src');

	    $.ajax({
	        url: "oopdb.php",
	        type: 'POST',
	        data: formData,
	        success: function (editdata) {
	            alert(editdata);
	            $('#editSongModal').modal('hide');
	        	  $('#songs-list').load(" #songs-list > *");
	        },
	        cache: false,
	        contentType: false,
	        processData: false
	    });
	});
	$('form#editartist').submit(function(ea){
	    ea.preventDefault();    
	    var formData = new FormData(this);
	    var id= $("#edit_artist_id").val();
	    var name = $("#edit_artist_name").val();
	    var cover=$('.editprofilePhoto img').attr('src');

	    $.ajax({
	        url: "oopdb.php",
	        type: 'POST',
	        data: formData,
	        success: function (editartist) {
	            $('#editArtistModal').modal('hide');
	            alert(editartist);
	        	  $('#artists-list').load(" #artists-list > *");
	        },
	        cache: false,
	        contentType: false,
	        processData: false
	    });
	});
	
	$('form#edituser').submit(function(ea){
	    ea.preventDefault();    
	    var formData = new FormData(this);
	    var id= $("#edit_user_id").val();
	    var name = $("#edit_user_name").val();
	    var cover=$('.editprofilePhoto img').attr('src');

	    $.ajax({
	        url: "oopdb.php",
	        type: 'POST',
	        data: formData,
	        success: function (edituser) {
	            $('#editUserModal').modal('hide');
	            alert(edituser);
	        	  $('#users-list').load(" #users-list > *");
	        },
	        cache: false,
	        contentType: false,
	        processData: false
	    });
	});
	$('form#genredata').submit(function(g){
		g.preventDefault();
		var genre = $('#song_genre').val();
		var id=parseInt($('#putgenreid').val())+1;
		$.ajax({
			type:'POST',
			url:'db.php',
			data:{genre:genre},
			success:function(data){
				$('#addGenreModal').modal('hide');
	        	$genre="<a class='genre-card' href='#' id='genre"+id+"'><div class='card'><input type='hidden' id='putgenreid' value='"+id+"'><h3 id='genrename"+id+"'>"+genre+"</h3><button data-id='"+id+"' data-role='editgenre' data-target='#editGenreModal' data-toggle='modal' class='btn edit'>Edit  <i class='fas fa-pen' alt='edit'></i></button><button data-id='"+id+"' data-role='deletegenre' class='btn delete'><i class='fas fa-times'></i></button></div></a>";
	        	$(".genre-cards .genre-card:first-child").after($genre);
			}
		});
	});
	$('form#editgenredata').submit(function(egd){
		egd.preventDefault();
		var editgenre = $('#edit_song_genre').val();
		var id=$('#getgenreid').val();
		$.ajax({
			type:'POST',
			url:'db.php',
			data:{editgenreid:id,editgenre:editgenre},
			success:function(data){
				$('#editGenreModal').modal('hide');
				$('#genrename'+id).text(editgenre);
			}
		});
	});

	$('form#editusermodaldata').submit(function(editusermodaldata){
	    editusermodaldata.preventDefault();    
	    var formData = new FormData(this);
	    $.ajax({
	        url: "userdb.php",
	        type: 'POST',
	        data: formData,
	        success: function (userdata) {
	        	$('#editusermodal').modal('hide');
	        	alert(userdata);
		        	$('#message').text("Please Refresh to see changes. ");
							$('#message-icon').text("how_to_reg");	
		        	$('#alert').css('display', 'flex');
	        },
	        cache: false,
	        contentType: false,
	        processData: false
	    });
	});

	$(document).on('click','#artistsonglistbtn',function(){
		var id =$(this).data('id');
			$.ajax({
				url:"userdb.php",
				type:"POST",
				data:{artistsonglistid:id},
				success:function(data){
					$('#artist-cards').html(data);
				}
			});	
	});
	

	$(document).on('click','#artistsonglistbtn',function(){
		$('#artistqueue').show();
		$('#queue').hide();
		//var id =$(this).data('id');
		var artist_id=$(this).data('id');
		$.ajax({
			url:"userdb.php",
			type:"POST",
			data:{artist_id:artist_id},
			success:function(data){
				var data = data.split("split");
					$('#artist-ul').html(data[0]);
					$('body').append("<script>"+data[1]+"</script>");
			}
		});
	});
	$(document).on('click','#artistqueue',function(){
		$('#queueModal').modal('show');
	});
	$(document).on('click','.btn.back,.homebtn',function(){
				$("#artist").load(" #artist > *");
				var search="";
				$.ajax({
					url:"userdb.php",
					type:"POST",
					data:{artist_id_back:search},
					success:function(data){
						var data = data.split("split");
							$('#artist-ul').html(data[0]);
							$('body').append("<script>"+data[1]+"</script>");
					}
				});
	});
	$(document).on('click','#backtoartist',function(){
				$("#artist").load(" #artist > *");
	});
	
	$(document).on('click','#queue',function(){
		var search_song_user = $("#search_song_user").val();
			$('#queueModal').modal('show');
/*			$.ajax({
				url:"userdb.php",
				type:"POST",
				data:{queuesearch:search_song_user},
				success:function(data){
					$('.musics-ul').html(data);
				}
			});	*/
	});


});
function delete_song(id){
	var num=parseInt(document.getElementById('total-songs').innerHTML);
	if(confirm('After Deletion this action can not be undone. Are you sure to continue? ')){	
		$.ajax({
			type:'post',
			url:'db.php',
			data:{delete_song:id},
			success:function(data){
				alert(data);
				$('#'+id).hide();
	        	$('.total-songs').text(num-1);
			}
		});
	}
}
function delete_artist(id){
	var num=parseInt(document.getElementById('total-artists').innerHTML);
	if(confirm('After Deletion this action can not be undone. Are you sure to continue? ')){	
		$.ajax({
			type:'post',
			url:'oopdb.php',
			data:{delete_artist:id},
			success:function(data){
				alert(data);
				$('#artist'+id).hide();
	        	$('.total-artists').text(num-1);
			}
		});
	}
}
function delete_user(id){
	var num=parseInt(document.getElementById('total-users').innerHTML);
	if(confirm('After Deletion this action can not be undone. Are you sure to continue? ')){	
		$.ajax({
			type:'post',
			url:'oopdb.php',
			data:{delete_user:id},
			success:function(data){
				alert(data);
				$('#editUser'+id).hide();
	        	$('.total-users').text(num-1);
			}
		});
	}
}