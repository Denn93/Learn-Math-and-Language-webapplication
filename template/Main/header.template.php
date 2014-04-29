<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
  <head>
    <title>Homepage Dennis</title>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="author" content="Dennis" />
      <link rel="stylesheet" type="text/css" href="Style/css.css" media="screen" />
      <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
      <script type="text/javascript" src="prototype.js"></script>
  </head>

  <body>
     <div id="container">
       <!--Header-->
       <div id="header">
          <div class="headtitle">Homepage door Dennis
          </div>
        </div>

       <!--Menu-->
	   <div id="menu">
	     <ul>
			<li><a href="index.php?Page=Home" title="">HOME</a></li>
			<li><a href="index.php?Page=Games" title="">GAMES</a></li>
                        <?php if (User::isLoggedIn()){?>
                        <li><a href="index.php?Page=Test" title="">eerste applicatie TEMP</a></li>
                        <?php } ?>
             </ul>
	   </div>
       
       <div id="roundedheader">&nbsp;</div>

       <!--Content-->
       <div id="content">