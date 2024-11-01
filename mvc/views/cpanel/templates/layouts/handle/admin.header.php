<?php require_once("admin.action.php"); ?>
<body>
<section id="sidebar">
    <ul class="side-menu top">
        <?php foreach ($sidebarMenu as $menuItem): 
            $itemHrefParts = explode('/', $menuItem['href']);
            $lastSegment = end($itemHrefParts);
            $isActive = ($lastSegment === $actionUrlPath) ? 'active' : '';
        ?>
            <li class="<?= $isActive ?>">
                <a href="<?= htmlspecialchars($menuItem['href']) ?>">
                    <i class="<?= htmlspecialchars($menuItem['icon']) ?>"></i>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
    
    <ul class="side-menu">
        <li><a href="#"><i class='bx bxs-cog'></i></a></li>
        <li><a href="?module=auth&action=logout" class="logout"><i class='bx bx-log-out-circle'></i></a></li>
    </ul>
</section>

<section id="content">
    <nav>
        <a href="?module=auth&action=adminData&page=1" class="nav-link">Trang quản trị</a>
        
        <form role="search" method="GET" id="searchAdmin">
            <div class="form-input">
                <input type="search" placeholder="Search..." name="search_query" />
                <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
            </div>
        </form>

        <div class="text-center"><span>Bạn đang ở chế độ tạo bài viết</span></div>
        
        <a href="#" class="notification">
            <i class='bx bxs-bell'></i>
            <span class="num">8</span>
        </a>
        
        <a href="#" class="profile">
            <img class="crown" src="<?= htmlspecialchars(_TEMPLATE . 'images/icons/crown.png') ?>" width="30">
            <img class="circle-avt" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQZDCFinmDP3w1m-8XlHnkugisfqtNJ2VTQAbFLWco4YTl2cOPWHc4qc5QAiaJ6N-cFG4g&usqp=CAU" width="40">
        </a>
    </nav>
    
    <div class="block"></div>
    <main>
