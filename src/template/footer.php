  <!-- fixed tabbed footer -->
  <div class="navbar navbar-default navbar-fixed-bottom">

    <div class="container">

      <div class="bootcards-desktop-footer clearfix">

      <div class="btn-group">
        <a href="stacker.php" class="btn btn-default <?php if ($_SERVER['REQUEST_URI'] === "/stacker.php") { echo 'active'; } ?>">
          <i class="fa fa-2x fa-font"></i>Member Picker
        </a>
        <a href="qs.php" class="btn btn-default <?php if ($_SERVER['REQUEST_URI'] === "/qs.php") { echo 'active'; } ?>">
          <i class="fa fa-2x fa-users"></i>Questions
        </a>
        <a href="who.php" class="btn btn-default <?php if ($_SERVER['REQUEST_URI'] === "/who.php") { echo 'active'; } ?> ">
          <i class="fa fa-2x fa-dashboard"></i>Guess Who!
        </a>
      </div>
    </div>
   </div>

  </div><!--footer-->