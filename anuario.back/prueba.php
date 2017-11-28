<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<div class="main">
<div class="slides">
  <img src="caratula1.jpg" alt="" width="100" height="170">
  <img src="caratula2.jpg" alt="" width="100" height="170">
  <img src="caratula3.jpg" alt="" width="100" height="170">
  <img src="caratula4.jpg" alt="" width="100" height="170">
  <img src="caratula5.jpg" alt="" width="100" height="170">
  <img src="caratula6.jpg" alt="" width="100" height="170">
</div>
</div>
	<script>
 
	$(function(){
  $(".slides").slidesjs({
    play: {
      active: true,
        // [boolean] Generate the play and stop buttons.
        // You cannot use your own buttons. Sorry.
      effect: "slide",
        // [string] Can be either "slide" or "fade".
      interval: 3000,
        // [number] Time spent on each slide in milliseconds.
      auto: true,
        // [boolean] Start playing the slideshow on load.
      swap: true,
        // [boolean] show/hide stop and play buttons
      pauseOnHover: false,
        // [boolean] pause a playing slideshow on hover
      restartDelay: 2500
        // [number] restart delay on inactive slideshow
    }
  });
});
 
	</script>
</body>
</html>