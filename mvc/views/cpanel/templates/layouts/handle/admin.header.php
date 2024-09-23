<?php require_once ("admin.action.php") ?>
<body>
<section id="sidebar">
    <ul class="side-menu top">
        <?php foreach ($sidebarMenu as $menuItem):
            // browse value href  

            $itemHref = explode('/', $menuItem['href']);
            // separate href value

            $itemHrefPresent = end($itemHref);
            // get the last part of the value
            ?>
            <li class="<?php if($itemHrefPresent === $actionUrlPath) echo 'active' ?>">
            <!-- separate href value -->
            
                <a href="<?= $menuItem['href']; ?>">
                    <i class="<?=$menuItem['icon']?>"></i>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
    <ul class="side-menu">
        <li>
            <a href="#">
                <i class='bx bxs-cog' ></i>
            </a>
        </li>
        <li>
            <a href="?module=auth&action=logout" class="logout">
                <i class='bx bx-log-out-circle'></i>
            </a>
        </li>
	</ul>
</section>
<section id="content">
    <nav>
        <a href="?module=auth&action=adminData&page=1" class="nav-link">
        Trang quản trị </a>
        <form role="search" method="GET" id="searchAdmin">
            <div class="form-input">
                <input type="search" placeholder="Search..." name="search_query" ?>
                <div type="submit" class="search-btn"><i class='bx bx-search' ></i></div>
            </div>
        </form>
        <div class="text-center">
            <span>Bạn đang ở chế độ tạo bài viết</span>
        </div>
        <a href="#" class="notification">
            <i class='bx bxs-bell' ></i>
            <span class="num">8</span>
        </a>
        <a href="#" class="profile">
            <img class="crown" src="<?= _TEMPLATE . 'images/icons/crown.png' ?>" width="30">
            <img class="circle-avt" src="<?='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQZDCFinmDP3w1m-8XlHnkugisfqtNJ2VTQAbFLWco4YTl2cOPWHc4qc5QAiaJ6N-cFG4g&usqp=CAU' ?>" width="40">
        </a>
    </nav>
    <div class="block"></div>
<main>
