<?php 
    // Getdata Action Params 
    $getActionParams = new App();

    $arrayCrumbs = $getActionParams->urlProcess();

    if(!empty( $dataSql['allPosts'])) :
    $allPosts = $dataSql['allPosts'];
    endif;
?>
<main>
    <div class="container">
        <div class="block"></div>
    </div>
    <div class="archive-app">
        <div class="archive-header" style="background: url('<?= _TEMPLATE . 'images/background/bg-4-1.png' ?>')">
            <section>
                <div class="partition">
                    <li class="show-params">
                        <a href="/usego/" class="title">
                            Trang chủ
                            <i class="fa-solid fa-angle-right"></i>
                        </a>
                    </li>
                    <?php $totalCrumbs = count($arrayCrumbs); ?>
                    <?php foreach( $arrayCrumbs as $key => $crumb ): ?>
                        <?php if ( $key < $totalCrumbs - 1 ): ?>
                            <li class="show-params">
                                <a href="/usego/<?= $crumb ?>" class="title">
                                    <?= $crumb ?>
                                    <i class="fa-solid fa-angle-right"></i>
                                </a>
                            </li>
                        <?php else: ?>
                            <li class="show-params">
                                <a href="#" class="title param">
                                    <?= $crumb ?>    
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <div class="content">
                    <h1> Tổng hợp bài viết nổi bật </h1>
                    <span class="quatity-topic">76</span>
                </div>
                <div class="footer">
                    <span>
                    Luôn có những bài viết về tiêu chuẩn hướng dẫn và tổng hợp kinh nghiệm, hãy đến và tìm hiểu những hướng dẫn kỹ lưỡng dành cho bạn.
                    </span>
                </div>
                <div class="create-post">
                    <a href="/usego/instruct/newpost">
                        <i class="fa-solid fa-plus"></i>
                    </a>
                    <span>
                    Viết bài viết mới của riêng bạn
                    </span>
                </div>
            </section>
            <article>
                <div class="part-list-title">
                    <div class="item">
                        <div class="left yellow">
                            <i class="fa-solid fa-pager"></i>
                        </div>
                        <div class="right">
                            <h3> Doanh nghiệp </h3>
                            <small> 18 bài viết </small>
                        </div>
                    </div>
                    <div class="item">
                        <div class="left navy">
                            <i class="fa-regular fa-folder-open"></i>
                        </div>
                        <div class="right">
                            <h3> Tài liệu tự học </h3>
                            <small> 18 bài viết </small>
                        </div>
                    </div>
                    <div class="item">
                        <div class="left green">
                            <i class="fa-solid fa-school"></i>
                        </div>
                        <div class="right">
                            <h3> Học tập </h3>
                            <small> 18 bài viết </small>
                        </div>
                    </div>
                    <div class="item">
                        <div class="left grey">
                            <i class="fa-solid fa-gamepad"></i>
                        </div>
                        <div class="right">
                            <h3> Giải trí điện tử </h3>
                            <small> 18 bài viết </small>
                        </div>
                    </div>
                    <div class="item">
                        <div class="left orange">
                            <i class="fa-solid fa-tv"></i>
                        </div>
                        <div class="right">
                            <h3> Bài viết khác </h3>
                            <small> 18 bài viết </small>
                        </div>
                    </div>
                </div>
            </article>
        </div>
        <div class="archive-tags">
        <?php if ( !empty( $allPosts ) ) : ?>
            <div class="title">
                <p>Danh mục</p>
            </div>
            <ul class="list-tags">
                <li>
                    <a href="#">
                        <span>Tổng hợp</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span>Tin mới</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span>Bài viết</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span>Dịch vụ</span>
                    </a>
                </li>
            </ul>
        <?php endif; ?>
        </div>
        <div class="archive-content">
            <div class="archive-lists">
                <?php if ( !empty( $allPosts ) ) : ?>
                    <?php foreach ( $allPosts as $item ) : ?>
                    <section>
                        <div class="preview">
                            <a href="/usego/instruct/read?id=<?= $item['id'] ?>">
                            <?php 
                            $picture = "";
                            if ( !empty( $item['hot'] ) ) {
                                $picture = 'np-hot.png';
                            } else {
                                $picture = ( $item['topic'] === "post" ) ? "np-post.png" : "np-service.png";
                            }
                            ?>
                            <img 
                                src="<?= _TEMPLATE . 'images/icons/' . $picture ?>">
                            <?php ?>
                            </a>
                            <div class="view">
                                <span>
                                <i class="fa-regular fa-eye"></i>    
                                    <?php if ( !empty( $item['view'] ) ) : ?>
                                        <?= $item['view'] ?>
                                    <?php endif; ?>
                                </span>
                            </div>
                            <?php if( !empty( $item['topic'] ) && $item['topic'] !== "post" ) : ?>
                                <?php if( !empty( $item['status'] ) ) : ?>
                                <div class="term-i">
                                    <span title="">
                                        <?= $item['status'] ?>
                                    </span>
                                </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="content">
                            <div class="title">
                                <span>
                                    <?php if (!empty( $item['title'] )) : ?>
                                        <?php echo $item['title']; ?>
                                    <?php endif; ?>
                                </span>
                            </div>
                            <div class="interplay">
                                <span>
                                    <i class="fa-regular fa-clock"></i>
                                    <?php if (!empty( $item['createAt'] )) : ?>
                                        <?php showInfo::dateDiffInMinutes( $item['createAt'] ) ?>
                                    <?php endif; ?>
                                </span>
                                <a href="/usego/instruct/read?id=<?= $item['id'] ?>" class="btn-zt-post-detai">
                                    <span>Xem chủ đề</span>
                                </a>
                            </div>
                        </div>
                    </section>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="product-lists">
                        <div class="no-posts-yet">
                            <div class="poster">
                                <img 
                                src="<?= _TEMPLATE . 'images/icons/no-value.png' ?>" width="90">
                            </div>
                            <span>Chưa có bài đăng nào</span>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="archive-seemore">
            <?php if ( !empty( $allPosts ) ) : ?>
                <button class="btn-seemore-instruct button_shaddow">
                    <span>Tải thêm</span>
                </button>
            <?php endif; ?>
        </div>
        <div class="archive-tags archive-rank">
            <div class="title">
                <p>Danh sách xếp hạng</p>
            </div>
            <section>
                <div class="left">
                    <div class="nth nth-1">
                        <p>Tổng danh sách <b> 5253 </b> bài viết</p>
                    </div>
                    <div class="nth nth-2">
                        <i class="fa-solid fa-circle-play"></i>
                        <p>Hướng dẫn Sử dụng</p>
                    </div>
                    <div class="nth nth-3">
                        <p>
                            Đây là bảng xếp hạng các bài viết hướng dẫn,
                            theo lượng truy cập của người dùng trên trang.
                            Bảng xếp hạng có thể thay đổi theo thời gian
                        </p>
                    </div>
                    <div class="poster-image">
                        <img 
                        src="<?= _TEMPLATE . 'images/icons/uiii-01.png' ?>">
                    </div>
                </div>
                <div class="right">
                    <!-- 1 -->
                    <a href="#">
                        <article>
                            <div class="rank">
                                <img 
                                src="<?= _TEMPLATE . 'images/icons/st1.png' ?>" width="30">
                            </div>
                            <div class="content">
                                <div class="image">
                                    <img 
                                    src="https://image.uisdc.com/wp-content/uploads/2023/12/Food-photography-20231218-01.jpg" width="130">
                                </div>
                                <div class="wrapper">
                                    <div class="titler">
                                        <span>
                                        Hướng dẫn ý tưởng thiết kế! Thiết kế luôn trống rỗng, làm thế nào để giải quyết nhanh chóng?
                                        </span>
                                    </div>
                                    <div class="infomation">
                                        <div class="link">
                                            <a href="#">
                                                <span>Các hướng dẫn khác</span>
                                            </a>
                                            <a href="#">
                                                <span>Tony San San</span>
                                            </a>
                                        </div>
                                        <div class="view">
                                            <span>9,6k <p>người xem</p></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </a>
                    <!-- 2 -->
                    <a href="#">
                    <article>
                        <div class="rank">
                            <img 
                            src="<?= _TEMPLATE . 'images/icons/st2.png' ?>" width="30">
                        </div>
                        <div class="wrapper">
                            <div class="content">
                                <div class="image">
                                    <img 
                                    src="https://image.uisdc.com/wp-content/uploads/2023/12/Food-photography-20231218-01.jpg" width="130">
                                </div>
                                <div class="wrapper">
                                    <div class="titler">
                                        <span>
                                        Hướng dẫn ý tưởng thiết kế! Thiết kế luôn trống rỗng, làm thế nào để giải quyết nhanh chóng?
                                        </span>
                                    </div>
                                    <div class="infomation">
                                        <div class="link">
                                            <a href="#">
                                                <span>Các hướng dẫn khác</span>
                                            </a>
                                            <a href="#">
                                                <span>Tony San San</span>
                                            </a>
                                        </div>
                                        <div class="view">
                                            <span>9,6k <p>người xem</p></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                    </a>
                    <!-- 3 -->
                    <a href="#">
                    <article>
                        <div class="rank">
                            <img 
                            src="<?= _TEMPLATE . 'images/icons/st3.png' ?>" width="30">
                        </div>
                        <div class="content">
                            <div class="image">
                                <img 
                                src="https://image.uisdc.com/wp-content/uploads/2023/12/Food-photography-20231218-01.jpg" width="130">
                            </div>
                            <div class="wrapper">
                                    <div class="titler">
                                        <span>
                                        Hướng dẫn ý tưởng thiết kế! Thiết kế luôn trống rỗng, làm thế nào để giải quyết nhanh chóng?
                                        </span>
                                    </div>
                                    <div class="infomation">
                                        <div class="link">
                                            <a href="#">
                                                <span>Các hướng dẫn khác</span>
                                            </a>
                                            <a href="#">
                                                <span>Tony San San</span>
                                            </a>
                                        </div>
                                        <div class="view">
                                            <span>9,6k <p>người xem</p></span>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </article>
                    </a>
                    <!-- 4 -->
                    <a href="#">
                    <article>
                        <div class="rank">
                            <img 
                            src="<?= _TEMPLATE . 'images/icons/st45.png' ?>" width="30">
                        </div>
                        <div class="content">
                            <div class="image">
                                <img 
                                src="https://images.uiiiuiii.com/wp-content/uploads/2023/11/sd-231116-pefa-01.jpg" width="130">
                            </div>
                            <div class="wrapper">
                                    <div class="titler">
                                        <span>
                                        Hướng dẫn ý tưởng thiết kế! Thiết kế luôn trống rỗng, làm thế nào để giải quyết nhanh chóng?
                                        </span>
                                    </div>
                                    <div class="infomation">
                                        <div class="link">
                                            <a href="#">
                                                <span>Các hướng dẫn khác</span>
                                            </a>
                                            <a href="#">
                                                <span>Tony San San</span>
                                            </a>
                                        </div>
                                        <div class="view">
                                            <span>9,6k <p>người xem</p></span>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </article>
                    </a>
                    <!-- 5 -->
                    <a href="#">
                    <article>
                        <div class="rank">
                            <img 
                            src="<?= _TEMPLATE . 'images/icons/st45.png' ?>" width="30">
                        </div>
                        <div class="content">
                            <div class="image">
                                <img 
                                src="https://images.uiiiuiii.com/wp-content/uploads/2023/11/sd-231116-pefa-01.jpg" width="130">
                            </div>
                            <div class="wrapper">
                                <div class="titler">
                                    <span>
                                    Hướng dẫn ý tưởng thiết kế! Thiết kế luôn trống rỗng, làm thế nào để giải quyết nhanh chóng?
                                    </span>
                                </div>
                                <div class="infomation">
                                    <div class="link">
                                        <a href="#">
                                            <span>Các hướng dẫn khác</span>
                                        </a>
                                        <a href="#">
                                            <span>Tony San San</span>
                                        </a>
                                    </div>
                                    <div class="view">
                                        <span>9,6k <p>người xem</p></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                    </a>
                </div>
            </section>
        </div>
    </div>
</main>
