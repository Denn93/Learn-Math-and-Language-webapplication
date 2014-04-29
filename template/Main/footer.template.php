            <div id="sidebar">	
                <?php if (!User::isLoggedIn())
                          require_once 'template/Content/Login.template.php';
                      else
                          require_once 'template/Content/Account.template.php';                      
                ?>                
            </div>		

            <div style="clear: both;"></div>
	   </div>

	   <div id="roundedfooter">&nbsp;</div>

       <!--Footer-->
	   <div id="footer">
             <span>Dennis &copy; 2011-2011 <a href="http://www.ictacademie.info">Ict Academie</a> Revision: 10</span>
	   </div>
    </div>
  </body>
</html>