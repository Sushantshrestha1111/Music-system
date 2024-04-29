$(document).ready(function(){
    var footersongname = $(".footersongname");
    var footerartistname = $(".footerartistname");
    var prev = $("#prev");
    var play = $("#play");
    var next = $("#next");
    var audio = document.querySelector('audio');
    var img = document.getElementById('nowplayingimg');
    let nowPlaying = false;

    var songIndex=$('.play').attr('id');
    loadSong(songs[songIndex]);

    $(document).keyup(function(event) { 
      if(event.which == 39) {
        $("#next").click();
      }
      if(event.which == 37) {
        $("#prev").click();
      }
    });
    $(document).keypress(function(event) {    
      if(event.charCode == 32) {
        $('.play').click();
      }
    });
    $(document).on('click','.playartistlistbtn',function(){
        $('#0.artistplay').click();
        if(nowPlaying){
            $('.playartistlistbtn').text('pause');
        }else{
            $('.playartistlistbtn').text('play_arrow');

        }
    });
    $(document).on('click','.artistplay', function() {
        var nowplayingindex=$('.play').attr('id');
        console.log(nowplayingindex);
        console.log(this.id);
        if(nowplayingindex != this.id){
           $('.play').attr('id',this.id);
            loadSong(songs[this.id]);
            playMusic();
            $(".artistplay").text('play_arrow');
            $('span#'+this.id+'.artistplay').text('pause');
            $('#'+this.id+'.nav-item.ql.cp').addClass("active");
            $('.user-list').removeClass("active");
            $('#ul'+this.id).addClass("active");
        }else{
            $('.play').click();
        }   
    });

    $(document).on('click','.play', function() {
        var songIndex=$(this).attr("id");
        if (nowPlaying) {
            pauseMusic();
            $('span#'+this.id+".playbtn").text('play_arrow');
            $('#'+this.id+'.nav-item.ql.cp').addClass("active");

            $('.artistplay').text('play_arrow');

            $('.user-list').removeClass("active");
            $('#ul'+this.id).addClass("active");

        } else {
            playMusic();
            $(".playbtn").text('play_arrow');
            $('#'+songIndex+'.playbtn').text('pause');
            $("#"+songIndex+".nav-item.ql.cp").addClass("active"); 

             $('#'+songIndex+".artistplay").text('pause');

            $('.user-list').removeClass("active");
            $('#ul'+this.id).addClass("active");
        }
    });

    $(document).on('click','.playbtn', function() {
        var nowplayingindex=$('.play').attr('id');
        if(nowplayingindex != this.id){
           $('.play').attr('id', this.id);
            loadSong(songs[this.id]);
            playMusic();
            $(".playbtn").text('play_arrow');
            $('span#'+this.id+'.playbtn').text('pause');
            $('#'+this.id+'.nav-item.ql.cp').addClass("active");
        }else{
            $('.play').click();
        }
    });
    function playMusic() {
        nowPlaying = true;
        audio.play();
        $('.play').text('pause');
        if($(".nav-item.ql.cp").hasClass("active")){
            $("li.nav-item.ql.cp").removeClass("active");
        }
    }
    function pauseMusic() {
        nowPlaying = false;
        audio.pause();
        $('.play').text('play_arrow');
    }
    function loadSong(songs) {
        footersongname.text(songs.title);
        footerartistname.text(songs.artist);
        audio.src = "music/"+songs.name;
        img.src = "images/song-image/"+songs.clipArt;
    }
    $("#next").click(function() {
        songIndex = (songIndex + 1) % songs.length;
        loadSong(songs[songIndex]);
        playMusic();
        $('.play').attr('id', songIndex);
        $("li#"+songIndex+".nav-item.ql.cp").addClass("active");
        $(".playbtn").text('play_arrow');
        $('span#'+songIndex+".playbtn").text('pause');

        $('.artistplay').text('play_arrow');
        $('span#'+songIndex+".artistplay").text('pause');

            $('.user-list').removeClass("active");
            $('#ul'+songIndex).addClass("active");
    });
    $("#prev").click(function() {
        songIndex = (songIndex - 1 + songs.length) % songs.length;
        loadSong(songs[songIndex]);
        playMusic();
        $('.play').attr('id', songIndex);
        $("li#"+songIndex+".nav-item.ql.cp").addClass("active");
        $(".playbtn").text('play_arrow');
        $('span#'+songIndex+".playbtn").text('pause');

        $('.artistplay').text('play_arrow');
        $('span#'+songIndex+'.artistplay').text('pause');

            $('.user-list').removeClass("active");
            $('#ul'+songIndex).addClass("active");
    });
    $("#player").bind("ended", function(){
        songIndex = (songIndex + 1) % songs.length;
        loadSong(songs[songIndex]);
        playMusic(); 
        $('.play').attr('data-id', songIndex);
        $("li#"+songIndex+".nav-item.ql.cp").addClass("active");
        $(".playbtn").text('play_arrow');
        $('span#'+songIndex+".playbtn").text('pause');

        $('.artistplay').text('play_arrow');
        $('span#'+songIndex+".artistplay").text('pause');
    });
    $(document).on('click','.nav-item.ql.cp', function() {
            loadSong(songs[this.id]);
            playMusic();
            $('.playbtn').text('play_arrow');
            $('span#'+this.id+'.playbtn').text('pause');
            $('.nav-item.ql.cp').removeClass("active");
            $('#'+this.id+'.nav-item.ql.cp').addClass("active");
            $('.play').attr('id', this.id);

            $('.artistplay').text('play_arrow');
            $('span#'+this.id+'.artistplay').text('pause');

    });
    $(document).on('click','.playbtn,.artistplay', function() {
        $('.footer').show(500);
    });
});