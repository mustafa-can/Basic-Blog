
    <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid" style="background:#ddd;">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="http://localhost/blog/index.php">[XBlog]</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="#" id="sign-in-out"><?php global $signin; echo ($signin == true) ? 'Sign out' : 'Sign in'; ?></a></li>
        <?php echo ($signin == true) ?
        '<li><a href="manage.php">Manage Posts</a></li>
         <li><a href="passwd.php">Change Password</a></li>' : ''; ?>
      </ul>
      <form class="navbar-form navbar-left" id="searchForm" method="post" action="search.php">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="search key" id="searchText" name="searchText">
        </div>
        <button type="submit" class="btn btn-default" id="doSearch">Search</button>
      </form>
    </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
    </nav>
