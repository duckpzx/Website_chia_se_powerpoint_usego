<?php require_once ("handle/header.active.php") ?>
<?php require_once ("handle/header.getData.php") ?>
<?php 
    $dataInfoUser = $statusLogin->checkStatusLogin();

    // Get Data Top Keywords
    $showInfo = new showInfo(); 
    if(!empty( $showInfo->getTopKeywords() )) :
    $dataKeywords = $showInfo->getTopKeywords();
    endif;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta http-equiv="X-UA-Compatible" content= "IE=edge,chrome=1">
	<meta name= "viewport" content= "width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta http-equiv="Expires" content="-1">
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="Cache-control" content="no-cache">
	<meta http-equiv="Cache" content="no-cache">
	<meta name="renderer" content="webkit">
	<meta name="format-detection" content="telephone=no">
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="stylesheet" href="<?= _TEMPLATE . 'libary/cute-alert/style.css' ?>" type="text/css" media="all" />
    <link rel="stylesheet" href="<?= _TEMPLATE . 'libary/xdialog/xdialog.css' ?>" type="text/css" media="all" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= _TEMPLATE . 'css/root.css' ?>" type="text/css" media="all" />
    <link rel="stylesheet" href="<?= _TEMPLATE . 'css/style.css' ?>" type="text/css" media="all" />
    <link rel="stylesheet" href="<?= _TEMPLATE . 'css/layouts/header.css' ?>" type="text/css" media="all" />
    <?php if(!empty( $dataUsego['css'] )) : ?>
    <link rel="stylesheet" href="<?= _TEMPLATE . 'css/views/'. $dataUsego['css'] .'.css' ?>" type="text/css" media="all" />
    <?php endif; ?>
    <?php if(!empty( $dataUsego['_lite']['_css'] )) : ?>
    <link rel="stylesheet" href="<?= _TEMPLATE . 'css/views/'. $dataUsego['_lite']['_css'] .'.css' ?>" type="text/css" media="all" />
    <?php endif; ?>
    <link rel="stylesheet" href="<?= _TEMPLATE . 'css/layouts/footer.css' ?>" type="text/css" media="all" />
    <link rel="shortcut icon" href="<?= _TEMPLATE . 'images/icons/website_logo_usego.png' ?>" type="image/x-icon" />
    <title><?php if(!empty( $dataUsego['title'] )) echo $dataUsego['title']; else echo '404 - Page Not Found' ?></title>
    <script src="<?= _TEMPLATE ?>libary/dompurify-js/dompurify/dist/purify.js"></script>
    <?php if(!empty( $dataUsego['swiper'] ) ) : ?>
    <link rel="stylesheet" href="<?= _TEMPLATE . 'libary/swiper/node_modules/swiper/' . $dataUsego['swiper'] . '.css' ?>">
    <?php endif; ?>
    <?php if( !empty( $dataUsego['editor'] ) ) : ?>
    <link href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js"></script>
    <?php endif; ?>
</head>
<body>
<header>
    <div class="loadding_website">
        <span class="loader"></span>
    </div> 
    <div class="wrapper-header">        
        <div class="header-left flex flex-alicenter">
            <section>
                <a href="/usego/home">
                <p>SD</p>
                <small>usego.com</small>
                </a>
            </section>
            <div class="MobileMenu_wrapper">
                <em>
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-menu-2" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="4" y1="6" x2="20" y2="6"></line><line x1="4" y1="12" x2="20" y2="12"></line><line x1="4" y1="18" x2="20" y2="18"></line></svg>
                </em>
            </div>
        </div>
        <div class="header_center" id="header_center">
            <ul id="directional">
                <li>
                    <a href="/usego" class="<?php if( $active->setActive() == HD_Home ) echo ' activer' ?>">
                    Trang chủ</a>
                    <hr class="line <?php if( $active->setActive() == HD_Home ) echo ' active' ?>">
                </li>
                <div class="br-line"></div>
                <li class="item-topic">
                    <a href="#" class="topic-system <?php if( $active->setActive() == HD_Topic ) echo ' activer' ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-layout item-img" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="4" y="4" width="6" height="5" rx="2"></rect><rect x="4" y="13" width="6" height="7" rx="2"></rect><rect x="14" y="4" width="6" height="16" rx="2"></rect></svg>
                    <span>Chủ đề <i class="fa-solid fa-angle-right"></i></span></a>
                    <hr class="line <?php if( $active->setActive() == HD_Topic ) echo ' active' ?>">
                    <div id="part-dropdown">
                        <ul class="dropdown-content">
                            <li>
                                <a href="/usego/powerpoint/?page=1">
                                    <i class="fa-regular fa-newspaper"></i>
                                    <span>Tất cả bài viết</span>
                                    <small>1924 bài viết</small>
                                </a>
                            </li>
                            <li>
                                <a href="/usego/powerpoint/xa-hoi/?page=1">
                                    <i class="fa-regular fa-message"></i>
                                    <span>Xã hội</span>
                                    <small>192 bài viết</small>
                                </a>
                            </li>
                            <li>
                                <a href="/usego/powerpoint/sang-trong/?page=1">
                                    <i class="fa-regular fa-gem"></i>
                                    <span>Sang trọng</span>
                                    <small>443 bài viết</small>
                                </a>
                            </li>
                            <li>
                                <a href="/usego/powerpoint/tinh-yeu/?page=1">
                                    <i class="fa-regular fa-heart"></i>
                                    <span>Tình yêu</span>
                                    <small>1924 bài viết</small>
                                </a>
                            </li>
                            <li>
                                <a href="/usego/powerpoint/thuong-mai/?page=1">
                                    <i class="fa-solid fa-store"></i>
                                    <span>Thương mại</span>
                                    <small>524 bài viết</small>
                                </a>
                            </li>
                            <li>
                                <a href="/usego/powerpoint/kinh-doanh/?page=1">
                                    <i class="fa-regular fa-credit-card"></i>
                                    <span>Kinh doanh </span>
                                    <small>524 bài viết</small>
                                </a>
                            </li>
                            <li>
                                <a href="/usego/powerpoint/robot/?page=1">
                                    <i class="fa-brands fa-bilibili"></i>
                                    <span>Robot</span>
                                    <small>52 bài viết</small>
                                </a>
                            </li>
                            <li>
                                <a href="/usego/powerpoint/cong-nghe/?page=1">
                                    <i class="fa-solid fa-laptop-code"></i>
                                    <span>Công nghệ</span>
                                    <small>224 bài viết</small>
                                </a>
                            </li>
                            <li>
                                <a href="/usego/powerpoint/nghe-thuat/?page=1">
                                <i class="fa-solid fa-palette"></i>
                                    <span>Nghệ thuật</span>
                                    <small>224 bài viết</small>
                                </a>
                            </li>
                            <li>
                                <a href="/usego/powerpoint/the-gioi/?page=1">
                                    <i class="fa-solid fa-earth-europe"></i>
                                    <span>Thế giới</span>
                                    <small>224 bài viết</small>
                                </a>
                            </li>
                            <li>
                                <a href="/usego/powerpoint/hoat-hinh/?page=1">
                                    <i class="fa-solid fa-film"></i>
                                    <span>Hoạt hình</span>
                                    <small>624 bài viết</small>
                                </a>
                            </li>
                            <li>
                                <a href="/usego/powerpoint/du-lich/?page=1">
                                    <i class="fa-regular fa-paper-plane"></i>
                                    <span>Du lịch</span>
                                    <small>624 bài viết</small>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="item-new-feed">
                    <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-star item-img" width="21" height="21" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path></svg>
                    Thông báo
                    <img src="<?= _TEMPLATE . 'images/icons/usego_hot.png' ?>" width="13">
                    </a>
                    <hr class="line">
                </li>
                <li>
                    <a href="/usego/instruct" class="<?php if( $active->setActive() == HD_Instruct ) echo ' activer' ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chart-donut-3 item-img" width="21" height="21" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 3v5m4 4h5"></path><path d="M8.929 14.582l-3.429 2.918"></path><circle cx="12" cy="12" r="4"></circle><circle cx="12" cy="12" r="9"></circle></svg>
                    Cộng đồng </a>
                    <hr class="line <?php if( $active->setActive() == HD_Instruct ) echo ' active' ?>">
                </li>
                <?php if ( !empty($dataInfoUser[0]['ug_type']) && $dataInfoUser[0]['ug_type'] === 1 ) : ?>
                <li>
                    <a href="/usego/admin" class="<?php if( $active->setActive() == HD_Admin ) echo ' activer' ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chart-line item-img" width="21" height="21" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="4" y1="19" x2="20" y2="19"></line><polyline points="4 15 8 9 12 11 16 6 20 10"></polyline></svg>
                    Quản lý</a>
                    <hr class="line <?php if( $active->setActive() == HD_Admin ) echo ' active' ?>">
                </li>
                <?php endif; ?>
                <li>
                    <a href="/usego/contact" class="<?php if( $active->setActive() == HD_Contact ) echo ' activer' ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-circle item-img" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="9"></circle><circle cx="12" cy="10" r="3"></circle><path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855"></path></svg>
                    Chúng tôi</a>
                    <hr class="line <?php if( $active->setActive() == HD_Contact ) echo ' active' ?>">
                </li>
            </ul>
        </div>
        <div class="header-right">
            <div class="search">
                <button class="search-click">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="10" cy="10" r="7"></circle><line x1="21" y1="21" x2="15" y2="15"></line></svg>
                    <span>Tìm kiếm</span>
                </button>
                <div class="content-search">
                    <div class="container-search">
                        <button id="remove-pattern">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                        <div class="part-search">
                            <article>
                                <h2>Tìm kiếm</h2>
                            </article>
                            <form id="search-form" action="/usego/search" method="GET">
                                <div class="form-group">
                                    <input type="text" 
                                    name="q" 
                                    class="search-input" 
                                    placeholder="Tìm kiếm usego">
                                    <div class="warpper-box">
                                        <button type="submit" class="btn-form btn-search flex flex-center" id="btn-header-search">
                                            <p>Tìm Kiếm</p>
                                        </button>
                                    </div>
                                </div>
                                <div class="tippy-module-wrapper">
                                    <div class="search-heading">
                                        <div class="content">
                                            <span>BÀI VIẾT</span>
                                            <button class="tippy-seemore">
                                                <span title="Xem tất cả kết quả">Xem thêm</span>
                                            </button>
                                        </div>
                                        <div class="search-wrapper">
                                            <ul class="lists" data-path-upload="<?= _TEMPLATE . 'images/uploads/powerpoint-images/' ?>"></ul>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="wrapper-tag">
                                <ul class="list-tags">
                                <?php $count = 0; foreach ( $dataKeywords as $tags ) : ?>
                                    <li>
                                        <a href="/usego/search?q=<?= str_ireplace(',', '', $tags); ?>">
                                            <?php if( $count < 4 ) : ?>
                                                <img 
                                                src="<?= _TEMPLATE . 'images/icons/icon_hots.png' ?>" 
                                                width="15">
                                            <?php endif; $count++; ?>
                                            <?= str_ireplace(',', '', $tags); ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                                </ul>
                            </div>
                            <div class="home-list-btns outstanding-articles">
                                <h2>Bạn có thể thích</h2>
                                <div class="wrapper-tag">
                                    <ul class="list-tags">
                                    <?php $count = 0; foreach ( $dataKeywords as $tags ) : ?>
                                        <li>
                                            <a href="search?q=<?= str_ireplace(',', '', $tags); ?>">
                                                <?php if( $count < 6 ) : ?>
                                                    <i class="fa-solid fa-arrow-trend-up"></i>
                                                <?php endif; $count++; ?>
                                                <?= str_ireplace(',', '', $tags); ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="infomation">
                <div class="user" id="detailUserHeader"
                data-id="<?php if (!empty( $dataInfoUser[0]['id'] )) echo $dataInfoUser[0]['id']; ?>">
                <?php if ( $statusLogin->getStatus() ) : ?>
                    <img class="avt-zoom" 
                        src="<?= _TEMPLATE . 'images/uploads/avatar/' . showInfo::setAvatar($dataInfoUser, 0); ?>" 
                        onerror="this.src='<?php echo _TEMPLATE . 'images/icons/not-images.png'; ?>'"
                        width="40">
                <?php else : ?>
                    <img 
                        src="<?= _TEMPLATE . 'images/uploads/avatar/avarta_default.png' ?>" width="40">
                <?php endif; ?>
                </div>
                <div class="content">
                    <div class="content-top">
                        <img class="bg-content" 
                        src="<?= _TEMPLATE . 'images/background/usego-vip-bg.jpg' ?>" 
                        width="100">
                        <?php 
                            if( $statusLogin->getStatus() ) { ?>
                            <a href="/usego/profile/?id=<?= showInfo::setIdUser($dataInfoUser); ?>">
                                <img class="avt-zoom" 
                                src="<?= _TEMPLATE . 'images/uploads/avatar/' . showInfo::setAvatar($dataInfoUser, 0); ?>" 
                                onerror="this.src='<?php echo _TEMPLATE . 'images/icons/not-images.png'; ?>'"
                                width="40">
                            </a>
                        <?php } else { ?>
                            <img class="avt-zoom" 
                            src="<?= _TEMPLATE . 'images/uploads/avatar/avarta_default.png' ?>" 
                            width="40">
                            <?php } ?>
                        <div class="info">
                        <?php 
                            if( $statusLogin->getStatus() ) { ?>
                            <b>
                                <?= showInfo::setFullName($dataInfoUser, 0); ?>
                                <?php if ( !empty($dataInfoUser[0]['ug_type']) && $dataInfoUser[0]['ug_type'] === 1 ) : ?>
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle-check" class="svg-inline--fa fa-circle-check UserName_icon__zT+rB" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="font-size: 1.2rem;"><path fill="currentColor" d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM371.8 211.8C382.7 200.9 382.7 183.1 371.8 172.2C360.9 161.3 343.1 161.3 332.2 172.2L224 280.4L179.8 236.2C168.9 225.3 151.1 225.3 140.2 236.2C129.3 247.1 129.3 264.9 140.2 275.8L204.2 339.8C215.1 350.7 232.9 350.7 243.8 339.8L371.8 211.8z"></path></svg>
                                <?php endif; ?>
                            </b>
                            <span 
                                title="<?= showInfo::setEmail($dataInfoUser); ?>">
                                <?= showInfo::setEmail($dataInfoUser); ?>
                            </span>
                        <?php } else { ?>
                            <b>Bạn chưa đăng nhập ?</b>
                            <a href="/usego/account/register">
                                <span>Đăng ký tài khoản.</span>
                            </a>
                            <?php } ?>
                        </div>
                        <?php 
                            if( $statusLogin->getStatus() ) { ?>
                            <button class="link logout-usego">Đăng xuất</button>      
                        <?php } else { ?>
                            <a class="link" href="/usego/account/logind">Đăng nhập</a>  
                            <?php } ?>
                    </div>
                    <ul class="quick-task">
                        <li>
                            <a href="/usego/profile/?id=<?= showInfo::setIdUser($dataInfoUser); ?>&tab=c">
                                <img src="<?= _TEMPLATE . 'images/icons/favorite.png' ?>" width="22">
                                <span>Yêu thích</span>
                            </a>
                        </li>
                        <li>
                            <a <?php echo ($statusLogin->getStatus()) ? "href='/usego/profile/archive'" : "href='/usego/account/logind'" ?> >
                                <img src="<?= _TEMPLATE . 'images/icons/download.png' ?>" width="22">
                                <span>Tải xuống</span>
                            </a>
                        </li>
                        <li>
                            <a <?php echo ($statusLogin->getStatus()) ? "href='/usego/instruct/newpost'" : "href='/usego/account/logind'" ?> >
                                <img src="<?= _TEMPLATE . 'images/icons/createpost.png' ?>" width="22">
                                <span>Viết bài</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="<?= _TEMPLATE . 'images/icons/email.png' ?>" width="22">
                                <span>Đóng góp</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="header-block">
    </div>  
</header>
<div class="push-mobile"></div>