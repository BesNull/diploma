<html>
    <head>
       <title>{$pageName}</title> 
        <link rel="stylesheet" href="{$templWebPth}css/main.css" type="text/css" /> 
        <link rel="stylesheet" href="{$templWebPth}css/animate.css" type="text/css" /> 
        <script type="text/javascript" src="/JavaScr/jquery-3.6.0.min.js" ></script>
        <script type="text/javascript" src="/JavaScr/m.js"></script>
        
        <link rel="stylesheet" href="/MDB5/css/mdb.min.css" />
        <!--MDB5 -->
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <title>Material Design for Bootstrap</title>
        <!-- MDB icon -->
        <link rel="icon" href="/MDB5/img/mdb-favicon.ico" type="image/x-icon" />
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
             <!-- Google Fonts Roboto -->
        <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap"
        />
             
      
         
        
        
    </head>
    
    <body style="background: url(https://cdn.oboi7.com/b3aa341633c35906c7dd4c33c1465232f9078e5b/sinij-minimalistichnyj-fony.jpg);">
        <!-- MDB js-->
        <script type="text/javascript" src="/MDB5/js/mdb.min.js"></script>
        <!-- MDB js-->
        
        
    <div id = "header">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <!-- Container wrapper -->
  <div class="container-fluid">
    <!-- Toggle button -->
    <button
      class="navbar-toggler"
      type="button"
      data-mdb-toggle="collapse"
      data-mdb-target="#navbarLeftAlignExample"
      aria-controls="navbarLeftAlignExample"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class="fas fa-bars"></i>
    </button>

    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarLeftAlignExample">
      <!-- Left links -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item mt-1">
        <a class="nav-link active" href="/">
            <i class="fa fa-home"> </i>
          
        </a>
      </li>
    
        
       <!-- 
         {foreach $dsCats as $item}
                <a class="btn btn-black btn-sm" href="/?controller=cat&id={$item.id}">{$item.name}</a><br />
                
                
                {if isset($item.child)}
                    {foreach $item.child as $itemchild}
                        --<a class="btn btn-white btn-sm" href="/?controller=cat&id={$itemchild.id}">{$itemchild.name}</a><br />
                    {/foreach}
                {/if}
            {/foreach}
       -->
        <!-- Navbar dropdown -->
       
        {foreach $dsCats as $item}
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="/?controller=cat&id={$item.id}"
                id="navbarDropdown"
                role="button"
                data-mdb-toggle="dropdown"
                aria-expanded="false"
              >
                {$item.name}
              </a>
              <!-- Dropdown menu -->
                <ul class="dropdown-menu " aria-labelledby="navbarDropdown">
                    {if isset($item.child)}
                    {foreach $item.child as $itemchild}
                      <li>
                        <a class="dropdown-item" href="/?controller=cat&id={$itemchild.id}">{$itemchild.name}</a>
                      </li>
                    {/foreach}
                    {/if}
                </ul>
              
            </li>
        {/foreach}
        
    
      
      </ul>
      <!-- Left links -->
    </div>
    <!-- Collapsible wrapper -->
  </div>
  <!-- Container wrapper -->
</nav>
        
        
       
    </div>
        
        {include file='LCol.tpl'}
        
        
    <div id="CCol">
        
       
