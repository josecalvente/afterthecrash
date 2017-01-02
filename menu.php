<html>
<!--MENYN HÄMTAS FRÅN DEN HÄR FILEN-->
<head>
</head>
   
<div id="topdiv">
        
           
    <nav>
      <center>
        <ul>
          <li><a href="menu.php?page=index">Home</a></li>
          <li><a href="menu.php?page=musicbrackets">Music</a></li>
          <!--<li><a href="menu.php?page=portfolio">Portfolio</a></li>-->
          <li><a href="menu.php?page=countdown">Countdown</a></li>
          <li><a href="menu.php?page=guestbook">Guest book</a></li>
          <li><a href="menu.php?page=contactform">Contact</a></li>
          <li><a href="menu.php?page=cv">CV</a></li>
        </ul>
      </center>
     <div class="handle">Burger</div>
    </nav>
    </div>
<!--PHP. HÄMTAR MENY MED _GET METODEN-->
      <?php
      //if (isset($_POST ["page"]))//tar bort: Notice: osv...
      $page = $_GET['page'];
      $pages = array('index', 'musicbrackets', 'portfolio', 'countdown', 'hangman', 'guestbook', 'contactform', 'cv');
      if (!empty($page)) {
          if(in_array($page,$pages)) {
              $page .= '.php';
              include($page);
          }
          else {
              echo 'Sidan hittades inte. Tillbaka till 
        <a href="index.php">Startsidan</a>';
          }
      }
    
      ?>
    <script>
 $(".handle").on("click", function(){
    $("nav ul").toggleClass("showing");
 });
</script>
   