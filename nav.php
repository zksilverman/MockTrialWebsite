<nav>
    <a class="<?php 
       if ($path_parts['filename'] == "index") 
       {
           print 'activePage';
       }?>"
       href="index.php">Home
    </a>
    <a class="<?php 
       if ($path_parts['filename'] == "about") 
       {
           print 'activePage';
       }?>"
       href="about.php">About Mock Trial
    </a>
    <a class="<?php 
       if ($path_parts['filename'] == "case") 
       {
           print 'activePage';
       }?>"
       href="case.php">Case Materials
    </a>
    <a class="<?php 
       if ($path_parts['filename'] == "involved") 
       {
           print 'activePage';
       }?>"
       href="involved.php">Want to get Involved?
    </a>
    <a class="<?php 
       if ($path_parts['filename'] == "contact") 
       {
           print 'activePage';
       }?>"
       href="contact.php">Executive Board
    </a>
</nav>  