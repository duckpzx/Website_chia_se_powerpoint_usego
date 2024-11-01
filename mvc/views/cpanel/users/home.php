<?php
    if(Session::getSession('first_login_usego_userid')):
    require_once ('./mvc/core/content/FirstLogin.php');
    Session::removeSession('first_login_usego_userid');
    endif;

    $statusLogin = new showInfo();  

    $dataKeys = ['totalUsers', 'dataPowerpoint', 'dataTopPowerpoint', 'dataTopAuthor'];
    
    foreach ($dataKeys as $key) {
        if (!empty($dataSql[$key])) {
            ${$key} = Compact::compactData($dataSql, $key);
        }
    }

    $firstThreeItems = array_slice($dataPowerpoint, 0, 4);
    $dataPowerpoint = array_slice($dataPowerpoint, 3, 8);
?>
<main>
    <div class="container">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="slideshow_content slideshow_content_1">
                    <img class="banner-left" src="<?= _TEMPLATE . 'images/background/banner-left-3.png' ?>">
                    <div class="content_slide">
                        <small>Bạn cần tìm kiếm, bài thuyết trình ?</small>
                        <slide class="content_main">
                            <h2>POWER POINT</h2>
                            <button class="btn-cirlce-transparent">
                                Tìm hiểu thêm
                            </button>
                        </slide>
                    </div>
                    <img class="banner-right" src="<?= _TEMPLATE . 'images/background/banner-right-3.png' ?>">
                </div>
            </div>
            <div class="swiper-slide">
                <div class="slideshow_content slideshow_content_2">
                    <img class="banner-top" src="<?= _TEMPLATE . 'images/background/banner-top.png' ?>">
                         <div div class="content_slide">
                            <small>Bạn muốn chia sẻ các mẫu thiết kế, hãy đăng tải ?</small>
                            <slide class="content_main">
                                <h2>SHARE DESIGN</h2>
                                <h3>Hãy tạo ra niềm vui, bằng việc chia sẻ kiến thức.</h3>
                                <button class="btn-cirlce-transparent">
                                    Đăng tải lên
                                </button>
                            </slide>
                        </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="slideshow_content slideshow_content_3">
                    <img class="banner-top" src="<?= _TEMPLATE . 'images/background/banner-left-5.png' ?>">
                    <div div class="content_slide">
                        <small>Bạn là người muốn học hỏi cái mới, nâng cấp bản thân ?</small>
                        <slide class="content_main">
                            <h2>LEARN NEWS</h2>
                            <h3>Website là một lựa chọn tốt cho công việc, học tập.</h3>
                            <button class="btn-cirlce-transparent">
                                Trải nghiệm ngay
                            </button>
                        </slide>
                    </div>
                    <img class="banner-right" src="<?= _TEMPLATE . 'images/background/banner-right-5.png' ?>">
                </div>
            </div>
            <div class="swiper-slide">
                <div class="slideshow_content slideshow_content_4">
                    <div div class="content_slide">
                        <small>Tìm bạn bè để cùng nhau học tập ?</small>
                        <slide class="content_main">
                            <h2>SOCIAL MEDIA</h2>
                            <h3>Xây dựng cộng đồng, vững chắc lành mạnh</h3>
                            <button class="btn-cirlce-transparent">
                                Tìm hiểu thêm 
                            </button>
                        </slide>
                    </div>
                    <img class="banner-right" src="<?= _TEMPLATE . 'images/background/banner-right-6.png' ?>">
                </div>
            </div>
            <div class="swiper-slide">
                <div class="slideshow_content slideshow_content_5">
                    <img class="banner-left" src="<?= _TEMPLATE . 'images/background/banner-left-7.png' ?>">
                    <div div class="content_slide">
                        <small>Tạo các mẫu thiết kế theo yêu cầu với nhà phát triển ?</small>
                        <slide class="content_main">
                            <h2>SEVICE ON REQUEST</h2>
                            <h3>Tạo mới bản thiết kế, ngoài các bản chia sẻ có sẵn</h3>
                            <button class="btn-cirlce-transparent">
                                Liên hệ ngay 
                            </button>
                        </slide>
                    </div>
                </div>
            </div>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
            <!-- Fast home-header-fixed-cont -->
            <div class="home-header-fixed-cont">
                <ul id="home-header">
                    <li class="flex flex-alicenter">
                        <a href="#" class="item">
                            <div class="content flex flex-alicenter">
                                <i class="fa-solid fa-fire"></i>
                                <span>Nền tảng học tập</span>
                            </div>
                        </a>
                    </li>
                    <li class="flex flex-alicenter flex flex-alicenter">
                        <a href="#" class="item">
                            <div class="content">
                                <i class="fa-solid fa-trophy"></i>
                                <span>Top 10 yêu thích</span>
                            </div>
                        </a>
                    </li>
                    <li class="flex flex-alicenter">
                        <a href="#" class="item">
                            <div class="content flex flex-alicenter">
                                <i class="fa-solid fa-head-side-virus"></i>
                                <span>Toàn diện thiết thực</span>
                            </div>
                        </a>
                    </li>
                    <li class="flex flex-alicenter">
                        <a href="#" class="item">
                            <div class="content flex flex-alicenter">
                                <i class="fa-regular fa-thumbs-up"></i>
                                <span>Có thể bạn thích</span>
                            </div>
                        </a>
                    </li>
                    <div class="home-header-row flex flex-between">
                        <a href="#" class="item-topr item-11">
                            <i class="fa-solid fa-fire-flame-curved"></i>
                        </a> 
                        <a href="#" class="item-topr item-22">
                            <i class="fa-solid fa-user-ninja"></i>
                        </a> 
                        <a href="#" class="item-topr item-33">
                            <i class="fa-solid fa-book"></i>
                        </a> 
                        <a href="#" class="item-topr item-44">
                            <i class="fa-regular fa-lightbulb"></i>
                        </a> 
                    </div>
                    <div class="cont-icons">
                        <h3 class="flex-center">Truy cập nhanh 
                            <button class="hide-icons-taskbar">
                                <i class="fa-solid fa-eye-slash"></i>
                            </button>
                        </h3>
                        <div class="cont-wrap">
                            <div class="items-fast flex flex-column flex-alicenter">
                                <i class="fa-solid fa-fire-flame-curved items-fa-tv flex flex-center"></i>
                                <small>Thiết kế hot</small>
                            </div>
                            <div class="items-fast flex flex-column flex-alicenter">
                                <i class="fa-solid fa-user-ninja flex flex-center"></i>
                                <small>Con đường tự học</small>
                            </div>
                            <div class="items-fast flex flex-column flex-alicenter">
                                <i class="fa-solid fa-book items-user-shield flex flex-center"></i>
                                <small>Danh sách mục</small>
                            </div>
                            <div class="items-fast flex flex-column flex-alicenter">
                                <i class="fa-regular fa-lightbulb items-lightbuld flex flex-center"></i>
                                <small>Làm mới ý tưởng</small>
                            </div>
                        </div>
                    </div>
                </ul>
            </div>
        </div>    
        <div class="home-recommend">
            <ul id="lists-recomment">
                <li>
                    <a href="#">
                        <i class="fa-solid fa-vector-square square-back recomment-11 flex flex-center"></i>
                        <div class="recomment-text flex flex-between flex-column">
                            <span>Xu hướng<Small><i class="fa-solid fa-angle-right"></i></Small></span>
                            <p>Kiểm tra xu thế</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-solid fa-arrows-to-eye square-back recomment-22 flex flex-center"></i>
                        <div class="recomment-text flex flex-between flex-column">
                            <span>Nên xem<Small><i class="fa-solid fa-angle-right"></i></Small></span>
                            <p>Nội dung phổ biến</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/usego/instruct">
                        <i class="fa-solid fa-users-viewfinder square-back recomment-33 flex flex-center"></i>
                        <div class="recomment-text flex flex-between flex-column">
                            <span>Cộng đồng<Small><i class="fa-solid fa-angle-right"></i></Small></span>
                            <p>Tự học</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/usego/trademark">
                        <i class="fa-solid fa-chart-line square-back recomment-44 flex flex-center"></i>
                        <div class="recomment-text flex flex-between flex-column">
                            <span>Thương mại<Small><i class="fa-solid fa-angle-right"></i></Small></span>
                            <p>Sự phát triển</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/usego/profile/archive">
                        <i class="fa-solid fa-cloud-arrow-down square-back flex flex-center"></i>
                        <div class="recomment-text">
                            <span>Tài nguyên<Small><i class="fa-solid fa-angle-right"></i></Small></span>
                            <p>Nắm bắt tất cả</p>
                        </div>
                    </a>
                </li>
            </ul>
            <button class="show-icon-taskbar"><i class="fa-solid fa-eye"></i></button>
        </div>  
        <div class="path-list-title">
            <ul id="lists-title" class="list-image-posters">
                <li class="loading-image flex flex-alicenter">
                    <a href="#">
                        <div class="text-desc flex flex-center">    
                            <span class="text-cl-brown">Học Tập</span>
                        </div>
                        <img src="<?= _TEMPLATE . 'images/background/image-poster2.jpg' ?>">
                    </a>
                </li>
                <li class="loading-image flex flex-alicenter">
                    <a href="#">
                        <div class="text-desc flex flex-center">
                            <span class="text-cl-navy">Sáng Tạo</span>
                        </div>
                        <img src="<?= _TEMPLATE . 'images/background/image-poster3.jpg' ?>">
                    </a>
                </li>
                <li class="loading-image flex flex-alicenter">
                    <a href="#">
                        <div class="text-desc flex flex-center">
                            <span class="text-cl-pink">Yêu Thương</span>
                        </div>
                        <img src="<?= _TEMPLATE . 'images/background/image-poster4.jpg' ?>">
                    </a>
                </li>
                <li class="loading-image flex flex-alicenter">
                    <a href="#">
                        <div class="text-desc flex flex-center">
                            <span class="text-cl-purple">Công Nghệ</span>
                        </div>
                        <img src="<?= _TEMPLATE . 'images/background/image-poster5.jpg' ?>">
                    </a>
                </li>
            </ul>
        </div>
        <div class="path-list-title">
            <ul id="lists-title" class="title-texts">
                <li>
                    <a href="#" class="title-style">Cập nhật</a>
                </li>
                <li>
                    <a href="#">Phổ biến</a>
                </li>
                <li>
                    <a href="/usego/trademark">
                    <img src="<?= _TEMPLATE . 'images/icons/usego-yy-icon-1.gif' ?>">    
                    Dịch vụ trực tuyến</a>
                </li>
                <li>
                    <a href="#">Đơn thuần</a>
                </li>
                <li>
                    <a href="#">Vẽ tay</a>
                </li>
                <li>
                    <a href="#">Sự tương tác</a>
                </li>
                <li>
                    <a href="#">Sản phẩm</a>
                </li>
                <li>
                    <a href="#">Tải xuống</a>
                </li>
            </ul>
        </div>   
        <div class="path-list-title">
        <p class="scrollList_sub-heading">
            <strong><?php if (!empty( $totalUsers )) echo $totalUsers; ?>+ </strong> 
            người khác đã tham gia
        </p>
        </div>
        <div class="archive-lists flex flex-juscenter">
            <div class="list-item-product flex flex-juscenter">
            <?php $count = 0; 
            foreach ( $firstThreeItems as $key => $item ) : ?>
            <section>
                <div class="archive-poster <?php if($count == 3) echo 'poster-3-item' ?>">
                    <?php if ( $count != 3 ) : ?>
                        <a href="/usego/powerpoint/detail?id=<?php if (!empty( $item['id'] )) echo $item['id']; ?>">
                        <img class="poster-product lazyload" 
                        data-src="<?= _TEMPLATE . 'images/uploads/powerpoint-images/' . showInfo::analysis2Character( $item['images'] )[0] ?>" 
                        onerror="this.src='<?= _TEMPLATE . 'images/icons/not-image.png'; ?>'"
                        loading="lazy">
                        </a>
                    <?php endif; ?>
                </div>
                <div class="content">
                    <?php if ( $count == 3 ) { ?>
                        <div class="widget-wrap">
                            <img class="corner-paper" 
                            src="<?= _TEMPLATE ?>images/icons/corner-paper.jpg">
                            <div class="widget-title">
                                <a href="#" class="title-corner">
                                    <h4> Thông tin mới nhất </h4>
                                    <small><?= date('l') . ' năm ' . date('Y') . ' tháng ' . date('m') ?></small>
                                </a>
                                <ul class="lists-content">
                                    <li class="item-newpaper">
                                        <h3>01</h3>
                                        <a href="#">Trạm b sẽ trực tuyến tính năng "Truyên bố người sáng tạo"</a>
                                    </li>
                                    <li class="item-newpaper">
                                        <h3>02</h3>
                                        <a href="#">Ford đã cập nhật Logo lần đầu tiên trong 20 năm, tổng thể phẳng</a>
                                    </li>
                                    <li class="item-newpaper">
                                        <h3>03</h3>
                                        <a href="#">Baidu "Đám mây một bông hoa" trợ lý tập tin trực tuyến.</a>
                                    </li>
                                    <li class="item-newpaper">
                                        <h3>04</h3>
                                        <a href="#">Baidu "Đám mây một bông hoa" trợ lý tập tin trực tuyến.</a>
                                    </li>
                                </ul>
                            </div>
                            <a href="#" class="view-alls flex flex-center">Xem tất cả</a>
                        </div>
                    <?php } else { ?>
                        <p class="title" title="<?= $item['title'] ?>"> <?= $item['title'] ?? _no_data ?> </p>
                        <small class="description"> <?= str_replace(',', ', ', implode(' ', showInfo::analysis2Character( $item['tags'] ))) ?? _no_data ?> </small>
                        <article class="infomation">
                            <div class="item-info info-detail">
                                <a class="on-Pewview flex flex-alicenter" href="/usego/profile/?id=<?= $item['userId'] ?>">
                                    <img class="avarta" 
                                    src="<?= _TEMPLATE . 'images/uploads/avatar/' . $item['avatar'] ?>" width="30">
                                    <small class="name">
                                        <?= showInfo::setFullName( $firstThreeItems, $count ) ?? _no_data ?> 
                                    </small>
                                </a>    
                                <div class="preview_user">
                                    <div class="info">
                                        <a href="/usego/profile/?id=<?= $item['userId'] ?? null ?>">
                                            <img class="avarta" 
                                            src="<?= _TEMPLATE . 'images/uploads/avatar/' . $item['avatar'] ?>" width="30">
                                        </a>
                                        <div class="text">
                                            <small class="name">

                                                <?= showInfo::setFullName( $firstThreeItems, $count ) ?? _no_data ?>
                                                
                                                <?php if ( !empty ( $item['ug_type'] ) && $item['ug_type'] === 1 ) : ?>
                                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle-check" class="svg-inline--fa fa-circle-check UserName_icon__zT+rB" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="font-size: 1.2rem;"><path fill="currentColor" d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM371.8 211.8C382.7 200.9 382.7 183.1 371.8 172.2C360.9 161.3 343.1 161.3 332.2 172.2L224 280.4L179.8 236.2C168.9 225.3 151.1 225.3 140.2 236.2C129.3 247.1 129.3 264.9 140.2 275.8L204.2 339.8C215.1 350.7 232.9 350.7 243.8 339.8L371.8 211.8z"></path></svg>
                                                <?php endif; ?> 

                                            </small>
                                            <?php if( $statusLogin->getStatus() ) : ?>
                                                <?php if( ( $item['total_follow'] ) < 1 ) : ?>
                                                    <?php if(!showInfoYourSelf::checkYourSelf( $item['userId'] )) : ?>
                                                        <button class="btn-follower" data-id="<?= $item['userId'] ?>">
                                                        <span>+ Theo dõi</span>
                                                        </button>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <?php if(!showInfoYourSelf::checkYourSelf( $item['userId'] ) ) : ?>
                                                        <button class="btn-follower" data-id="<?= $item['userId'] ?>">
                                                            <i class="fa-regular fa-circle-check"></i>  
                                                            <span>Đã theo dõi</span>
                                                        </button>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item-info tag-form flex">
                                <img src="<?= _TEMPLATE . 'images/icons/hashtag.png' ?>" width="20">
                                <a href="/usego/search?q=<?= showInfo::handleKeyWord(showInfo::analysis2Character( $item['tags'] ), $item['title']) ?? _no_data ?>">
                                    <?= showInfo::handleKeyWord(showInfo::analysis2Character( $item['tags'] ), $item['title']) ?? _no_data ?>
                                </a>
                            </div>
                        </article>
                    <?php } ?>
                </div>
            </section>
            <?php $count++;  endforeach; ?>
            </div>
        </div>
        <div class="part-tags flex flex-juscenter">
            <div class="pt-items flex">
                <div class="f-item flex">
                    <i class="fa-solid fa-fire-flame-curved"></i>
                    <div class="content">
                        <h3>Thiết kế giao diện</h3>
                        <small>Nóng! 1091 bài viết đã được đăng tải</small>
                    </div>
                </div>
                <div class="f-item flex">
                    <i class="fa-solid fa-fire-flame-curved"></i>
                    <div class="content">
                        <h3>Thiết kế giao diện</h3>
                        <small>Nóng! 1091 bài viết đã được đăng tải</small>
                    </div>
                </div>
                <div class="f-item f-item-blue flex">
                    <i class="fa-solid fa-gem item-fa-gem"></i>
                    <div class="content">
                        <h3>Chi tiết giao diện</h3>
                        <small>160 bài viết đã xuất bản</small>
                    </div>
                </div>
                <div class="f-item flex">
                    <i class="fa-solid fa-fire-flame-curved"></i>
                    <div class="content">
                        <h3>AIGC</h3>
                        <small>Nóng! 1091 bài viết đã được đăng tải</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="archive-lists archive-list-twos flex flex-juscenter">
            <div class="list-item-product flex flex-juscenter">
            <?php $count = 0; foreach ( $dataPowerpoint as $item ) : ?>
            <section>
                <div class="archive-poster <?php if( $count == 3 ) echo 'poster-3-item' ?>">
                    <?php if ( $count != 3 ) : ?>
                        <a href="/usego/powerpoint/detail?id=<?php if (!empty( $item['id'] )) echo $item['id']; ?>">
                        <img class="poster-product lazyload" 
                        data-src="<?= _TEMPLATE . 'images/uploads/powerpoint-images/' . showInfo::analysis2Character($item['images'])[0] ?>" 
                        onerror="this.src='<?= _TEMPLATE . 'images/icons/not-image.png'; ?>'"
                        loading="lazy">
                        </a>
                    <?php endif; ?>
                </div>
                <div class="content">
                    <?php if ( $count == 3 ) : ?>
                        <div class="widget-wrap">
                            <img class="corner-paper" 
                            src="<?= _TEMPLATE ?>images/icons/corner-paper.jpg">
                            <div class="widget-title">
                                <a href="#" class="title-corner">
                                    <h4>Bài viết nổi bật</h4>
                                    <small><?= date('l') . ' năm ' . date('Y') . ' tháng ' . date('m') ?></small>
                                </a>
                                <ul class="lists-content">
                                    <li class="item-newpaper">
                                        <h3>01</h3>
                                        <a href="#">Trạm b sẽ trực tuyến tính năng "Truyên bố người sáng tạo"</a>
                                    </li>
                                    <li class="item-newpaper">
                                        <h3>02</h3>
                                        <a href="#">Ford đã cập nhật Logo lần đầu tiên trong 20 năm, tổng thể phẳng</a>
                                    </li>
                                    <li class="item-newpaper">
                                        <h3>03</h3>
                                        <a href="#">Baidu "Đám mây một bông hoa" trợ lý tập tin trực tuyến.</a>
                                    </li>
                                    <li class="item-newpaper">
                                        <h3>04</h3>
                                        <a href="#">Baidu "Đám mây một bông hoa" trợ lý tập tin trực tuyến.</a>
                                    </li>
                                </ul>
                            </div>
                            <a href="#" class="view-alls flex flex-center">Xem tất cả</a>
                        </div>
                    <?php else : ?>
                        <p class="title" title="<?= $item['title'] ?>">
                        <?= $item['title'] ?? _no_data ?>
                        </p>
                        <small class="description">
                        <?= str_replace(',', ', ', implode(' ', showInfo::analysis2Character($item['tags']))) ?? _no_data ?>
                        </small>
                        <article class="infomation">
                            <div class="item-info info-detail">
                                <a class="on-Pewview flex flex-alicenter" href="/usego/profile/?id=<?= $item['userId'] ?>">
                                    <img class="avarta" 
                                    src="<?= _TEMPLATE . 'images/uploads/avatar/' . $item['avatar'] ?>" width="30">
                                    <small class="name">
                                        <?= showInfo::setFullName($dataPowerpoint, $count); ?>
                                    </small>
                                </a>
                                <div class="preview_user">
                                    <div class="info">
                                        <a href="/usego/profile/?id=<?= $item['userId'] ?>">
                                            <img class="avarta" 
                                            src="<?= _TEMPLATE . 'images/uploads/avatar/' . $item['avatar'] ?>" width="30">
                                        </a>
                                        <div class="text">
                                            <small class="name">
                                                <?= showInfo::setFullName($dataPowerpoint, $count); ?> 
                                                <?php if ( !empty($item['ug_type']) && $item['ug_type'] === 1 ) : ?>
                                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle-check" class="svg-inline--fa fa-circle-check UserName_icon__zT+rB" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="font-size: 1.2rem;"><path fill="currentColor" d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM371.8 211.8C382.7 200.9 382.7 183.1 371.8 172.2C360.9 161.3 343.1 161.3 332.2 172.2L224 280.4L179.8 236.2C168.9 225.3 151.1 225.3 140.2 236.2C129.3 247.1 129.3 264.9 140.2 275.8L204.2 339.8C215.1 350.7 232.9 350.7 243.8 339.8L371.8 211.8z"></path></svg>
                                                <?php endif; ?> 
                                            </small>
                                            <?php if( $statusLogin->getStatus() ) : ?>
                                                <?php if( ($item['total_follow']) < 1 ) : ?>
                                                    <?php if(!showInfoYourSelf::checkYourSelf($item['userId'])) : ?>
                                                        <button class="btn-follower" data-id="<?= $item['userId'] ?>">
                                                        <span>+ Theo dõi</span>
                                                        </button>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <?php if(!showInfoYourSelf::checkYourSelf($item['userId'])) : ?>
                                                        <button class="btn-follower" data-id="<?= $item['userId'] ?>">
                                                            <i class="fa-regular fa-circle-check"></i>  
                                                            <span>Đã theo dõi</span>
                                                        </button>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item-info tag-form flex">
                                <img src="<?= _TEMPLATE . 'images/icons/hashtag.png' ?>" width="20">
                                <a href="/usego/search?q=<?= showInfo::handleKeyWord(showInfo::analysis2Character( $item['tags'] ), $item['title']) ?? _no_data ?>">
                                    <?= showInfo::handleKeyWord(showInfo::analysis2Character( $item['tags'] ), $item['title']) ?? _no_data ?>
                                </a>
                            </div>
                        </article>
                    <?php endif; ?>
                </div>
            </section>
            <?php $count++; endforeach; ?>
            </div>
        </div>
        <div class="part-tags flex flex-juscenter">
            <div class="pt-items flex">
                <div class="f-item f-item-blue flex">
                    <i class="fa-solid fa-square-poll-horizontal item-fa-gem"></i>
                    <div class="content">
                        <h3>Thiết kế giao diện</h3>
                        <small>Nóng! 1091 bài viết đã được đăng tải</small>
                    </div>
                </div>
                <div class="f-item item-fa-link flex">
                    <i class="fa-solid fa-link item-fa-link"></i>
                    <div class="content">
                        <h3>Thiết kế giao diện</h3>
                        <small>Nóng! 1091 bài viết đã được đăng tải</small>
                    </div>
                </div>
                <div class="f-item f-item-blue flex">
                    <i class="fa-solid fa-gem item-fa-gem"></i>
                    <div class="content">
                        <h3>Chi tiết giao diện</h3>
                        <small>160 bài viết đã xuất bản</small>
                    </div>
                </div>
                <div class="f-item f-item-yellow flex">
                    <i class="fa-solid fa-square-poll-horizontal item-fa-yellow"></i>
                    <div class="content">
                        <h3>AIGC</h3>
                        <small>Nóng! 1091 bài viết đã được đăng tải</small>
                    </div>
                </div>
            </div>
        </div>
        <!-- View all product -->
        <div class="home-list-btns part-tags flex flex-center ">
            <a href="/usego/powerpoint?page=1" class="btn btn-orange button_shaddow">Xem tất cả bài viết</a>
        </div>
        <div class="home-title home-list-btns part-tags">
            <div class="left-title flex">
            <h2 class="flex flex-alicenter">Chuyên mục nổi bật 
                <span class="hot_title">
                    <img src="<?= _TEMPLATE . 'images/icons/usego_hot.png' ?>" width="13">
                </span>
            </h2>
            <small>Nhiều lượt đánh giá cao?</small>
            </div>
        </div>
        <div class="archive-lists flex flex-juscenter">
            <div class="list-item-product flex flex-juscenter">
            <?php 
                $count = 0; 
                foreach ( $dataTopPowerpoint as $key => $item ) : 
                ?>
                    <section class="archive-list-price ">
                        <div class="archive-poster">
                            <a href="/usego/powerpoint/detail?id=<?php if (!empty( $item['id'] )) echo $item['id']; ?>">
                                <img class="poster-product lazyload" 
                                data-src="<?= _TEMPLATE . 'images/uploads/powerpoint-images/' . showInfo::analysis2Character( $item['images'] )[0] ?>" 
                                onerror="this.src='<?= _TEMPLATE . 'images/icons/not-image.png'; ?>'"
                                loading="lazy">
                            </a>
                        </div>
                        <div class="content">
                        <?php if (!empty( $item['like_count'] ) ) : ?>
                            <p>Số lượt thích</p>
                            <div class="item-like">
                                <img src="<?= _TEMPLATE . 'images/icons/like.png' ?>" width="22">
                                <span><?= $item['like_count']; ?></span>
                            </div>
                        <?php endif; ?>
                        </div>
                    </section>
                    <?php 
                    $count++;
                endforeach; 
            ?>
            </div>
        </div>
        <div class="home-title home-list-btns part-tags">
            <div class="left-title flex">
            <h2 class="flex flex-alicenter">Nội dung chính 
                <span class="hot_title">
                <img src="<?= _TEMPLATE . 'images/icons/usego_hot.png' ?>" width="13">
                </span>
            </h2>
            <small>Các chuyên mục hàng đầu</small>
            </div>
        </div>
        <div class="part-tags flex flex-juscenter">
            <div class="pt-items flex">
                <div class="f-item f-item-main main-11 flex">
                    <div class="content">
                        <h3>Kịch bản</h3>
                        <small>Chủ đề được người sáng tạo quan tâm nhất</small>
                    </div>
                    <i class="fa-regular fa-face-smile"></i>
                </div>
                <div class="f-item f-item-main main-22 flex">
                    <div class="content">
                        <h3>Công cụ mới nhất</h3>
                        <small>Điều hướng công cụ hữu ích</small>
                    </div>
                    <i class="fa-solid fa-camera"></i>
                </div>
                <div class="f-item f-item-main main-33 flex">
                    <div class="content">
                        <h3>Xu hướng</h3>
                        <small>Một số cộng nghệ mới</small>
                    </div>
                    <i class="fa-solid fa-arrow-trend-up"></i>
                </div>
                <div class="f-item f-item-main main-44 flex">
                    <div class="content">
                        <h3>Các khóa học</h3>
                        <small>Thông qua video bài hướng dẫn</small>
                    </div>
                    <i class="fa-solid fa-film"></i>
                </div>
                <!-- 2 -->
                <div class="f-item f-item-main main-55 flex">
                    <div class="content">
                        <h3>Giao diện</h3>
                        <small>Thiết kế giao diện dễ sử dụng</small>
                    </div>
                    <i class="fa-solid fa-wand-magic-sparkles"></i>
                </div>
                <div class="f-item f-item-main main-66 flex">
                    <div class="content">
                        <h3>Hành trình</h3>
                        <small>Xây dựng trong vòng 3 tháng</small>
                    </div>
                    <i class="fa-solid fa-medal"></i>
                </div>
                <div class="f-item f-item-main main-77 flex">
                    <div class="content">
                        <h3>Quảng cáo</h3>
                        <small>Bạn có thể hiện hệ chúng tôi</small>
                    </div>
                    <i class="fa-solid fa-audio-description"></i>
                </div>
                <div class="f-item f-item-main main-11 flex">
                    <div class="content">
                        <h3>Xác thực</h3>
                        <small>Tài được xác thực và an toàn</small>
                    </div>
                    <i class="fa-solid fa-envelope-circle-check"></i>
                </div>
            </div>
        </div>
        <div class="home-title home-list-btns part-tags pt-small">
            <div class="left-title flex">
            <h2 class="flex flex-alicenter">Tác giả nổi bật
                <span class="hot_title">
                <img src="<?= _TEMPLATE . 'images/icons/usego_hot.png' ?>" width="13">    
                </span>
            </h2>
            <small>Các tác giả hàng đầu</small>
            </div>
        </div>
        <div class="archive-lists flex flex-juscenter">
            <div class="list-item-product list-item-top-authur flex flex-juscenter">
            <?php $index = 0; foreach ( $dataTopAuthor as $item ) { 
                if( $index !== 7 ) {
                    ?>
                    <article class="article-list-price flex flex-column flex-alicenter">
                        <div class="color-banner" 
                        style="background: url('<?= _TEMPLATE . 'images/background/background-repeat.jpg' ?>');"></div>
                        <div class="article-poster">
                            <div class="infomation-categories flex flex-center">
                                <div class="avarta-inf">
                                <a href="/usego/profile/?id=<?php if (!empty( $item[0]['userId'] )) echo $item[0]['userId']; ?>">    
                                    <img 
                                    src="<?= _TEMPLATE . 'images/icons/usego_n1.png' ?>" width="30">
                                    <img 
                                    src="<?= _TEMPLATE . 'images/uploads/avatar/' . $item[0]['avatar'] ?>" width="80">
                                </a>
                                </div>
                                <div class="title-inf">
                                    <h4>
                                        <a href="/usego/profile/?id=<?php if (!empty( $item[0]['userId'] )) ?>">
                                            <?= showInfo::setFullName($item, 0); ?>
                                            <?php if ( !empty($item['ug_type']) && $item['ug_type'] === 1 ) : ?>
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle-check" class="svg-inline--fa fa-circle-check UserName_icon__zT+rB" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="font-size: 1.2rem;"><path fill="currentColor" d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM371.8 211.8C382.7 200.9 382.7 183.1 371.8 172.2C360.9 161.3 343.1 161.3 332.2 172.2L224 280.4L179.8 236.2C168.9 225.3 151.1 225.3 140.2 236.2C129.3 247.1 129.3 264.9 140.2 275.8L204.2 339.8C215.1 350.7 232.9 350.7 243.8 339.8L371.8 211.8z"></path></svg>
                                            <?php endif; ?>
                                        </a>
                                    </h4>
                                    <small>Mức độ phổ biến <?= $index + 1; ?></small>
                                </div>
                            </div>
                            <span class="small-content">
                                <img src="<?= _TEMPLATE . 'images/icons/post.png' ?>" width="20">
                                Nhà soạn mẫu thiết kế</span>
                        </div>
                        <div class="content">
                            <span class="small-content">bản cập nhật mới nhất</span>
                            <div class="content-head">
                                <div class="item-wrap">
                                    <a href="/usego/powerpoint/detail?id=<?php if (!empty( $item[0]['id'] )) echo $item[0]['id']; ?>">
                                        <img 
                                        src="<?= _TEMPLATE . 'images/uploads/powerpoint-images/' . showInfo::analysis2Character($item[0]['images'])[0] ?>"
                                        width="80">
                                        <div class="content-w flex flex-column flex-between">
                                            <p><?php if (!empty( $item[0]['title'] )) echo $item[0]['title']; ?></p>
                                            <span style="color: var(--main);">
                                            <?php 
                                            if(!empty($item[0]['tags'])) 
                                            {
                                            echo '# ' . showInfo::handleKeyWord(showInfo::analysis2Character($item[0]['tags']), $item[0]['title']);
                                            } ?>
                                            </span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="content-bottom">
                                <?php if (!empty( $item[1] )) : ?>
                                    <div class="item-wrap">
                                        <a href="/usego/powerpoint/detail?id=<?php if (!empty( $item[1]['id'] )) echo $item[1]['id']; ?>">
                                            <img 
                                            src="<?= _TEMPLATE . 'images/uploads/powerpoint-images/' . showInfo::analysis2Character($item[1]['images'])[0] ?>" 
                                            width="80">
                                            <div class="content-w flex flex-column flex-between">
                                                <p><?php if(!empty( $item[1]['title'] )) echo $item[1]['title']; ?></p>
                                                <span style="color: var(--main);">
                                                <?php 
                                                if(!empty( $item[1]['tags'] )) 
                                                {
                                                echo '# ' . showInfo::handleKeyWord(showInfo::analysis2Character($item[1]['tags']), $item[1]['title']);
                                                } ?>
                                                </span>
                                            </div>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </article>          
                <?php
            ?>
            <?php $index++; } else {
                ?>
                <article class="article-list-price article-pen-back flex flex-column flex-alicenter" style="background: url('<?= _TEMPLATE . 'images/background/usego-rank-bg.jpg' ?>')">
                    <div class="white-author">
                        <p class="head">
                        <i class="fa-solid fa-pen-nib"></i>
                        Danh sách tác giả xuất sắc
                        </p>
                        <span>
                            Sử dụng ma trận tiếp xúc khổng lồ để nâng cao
                            toàn diện ảnh hướng cá nhân của bạn và 
                            có được nhiều cơ hội nghề nghiệp thu nhập hơn.
                        </span>
                        <div class="start">
                            <h3>1580</h3>
                            <small>Tác giả</small>
                        </div>
                        <ul>
                            <li><a href="#">Đóng góp</a></li>
                            <li><a href="#">Xem danh sách</a></li>
                        </ul>
                    </div>
                </ả>
                <?php
            }  } ?>
            </div>
        </div>
        <img class="showMobile right-slider" src="<?= _TEMPLATE . 'images/icons/swipe-right.gif' ?>" width="40">
    </div>
</main>
