<?php
    $getActionParams = new App();
    $arrayCrumbs = $getActionParams->urlProcess();

    $showInfo = new showInfo(); 
        if(!empty( $showInfo->getTopKeywords() )) :
        $dataKeywords = $showInfo->getTopKeywords();
    endif;

    $dataKeys = ['dataTopic', 'dataPowerpoint', 'dataUser', 'dataCountPost'];
    
    foreach ($dataKeys as $key) {
        if (!empty($dataSql[$key])) {
            ${$key} = Compact::compactData($dataSql, $key);
        }
    }
?>
<main>
    <div class="container">
        <div class="block"></div>
        <div class="post-meta">
            <img class="post-poster"
                src="<?= _TEMPLATE . 'images/uploads/powerpoint-images/' . showInfo::analysis2Character($dataPowerpoint[0]['images'])[0] ?>"
                onerror="this.src='<?= _TEMPLATE . 'images/icons/not-image.png'; ?>'"
                draggable="false">
            <div class="post-poster-before"></div>
            <div class="category-header">
                <div class="part-crumbs">
                    <ul class="flex flex-alicenter">
                        <li class="show-params">
                            <a href="/usego">
                            Usego 
                            <i class="fa-solid fa-angle-right"></i>
                            </a>
                        </li>
                        <?php $totalCrumbs = count( $arrayCrumbs ); ?>
                        <!-- sum element array -->
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
                    </ul>
                </div>
            </div>
            <div class="cat-info">
                <article class="cont-info flex flex-between">
                    <div class="poster-info">
                        <img 
                        src="<?= _TEMPLATE . 'images/uploads/powerpoint-images/' . showInfo::analysis2Character($dataPowerpoint[0]['images'])[0] ?>"
                        onerror="this.src='<?= _TEMPLATE . 'images/icons/not-image.png'; ?>'"
                        draggable="false">
                    </div>
                    <div class="text-info">
                        <h2>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-star" width="22" height="22" viewBox="0 0 24 24" stroke-width="1.3" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" style="fill: rgb(255, 174, 31); stroke: rgb(255, 174, 31);"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path></svg>
                            <span><?= Compact::identifyTopic('text');  ?></span>
                        </h2>
                        <p>
                            Xu hướng thiết kế tiên tiến, phương pháp và kinh nghiệm từ các nhà sản xuất lớn mà người sáng tạo phải đọc hàng ngày. Tập trung vào ngành và nội dung
                        </p>
                        <ul>
                            <li>
                                <span>Chủ đề được đề xuất:</span>
                            </li>
                            <?php $count = 0; foreach ( $dataKeywords as $tags ) : ?>
                                <li>
                                    <a href="/usego/search?q=<?= str_ireplace( ',', '', $tags ); ?>">
                                        <?= str_ireplace(',', '', $tags); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="quantity-info">
                        <section>
                            <strong title="Số lượng file thiết kế">
                                <?php if (!empty( $dataCountPost )) echo $dataCountPost; ?>
                            </strong>
                            <span>Nội dung của bài viết này được cập nhật liên tục.</span>
                            <a href="#">
                                Danh sách bài viết
                            </a>
                        </section>
                    </div>
                </article>
            </div>
            <div class="category-list-title">
            <ul class="category-content">
                <li>
                    <a href="#">
                        <i class="fa-regular fa-newspaper"></i>
                        <span>Tất cả bài viết</span>
                    </a>
                </li>
                <li>
                    <a href="/usego/search?q=xã hội">
                        <i class="fa-regular fa-message"></i>
                        <span>Xã hội</span>
                    </a>
                </li>
                <li>
                    <a href="/usego/search?q=sang trọng">
                        <i class="fa-regular fa-gem"></i>
                        <span>Sang trọng</span>
                    </a>
                </li>
                <li>
                    <a href="/usego/search?q=tình yêu">
                        <i class="fa-regular fa-heart"></i>
                        <span>Tình yêu</span>
                    </a>
                </li>
                <li>
                    <a href="/usego/search?q=thương mại">
                        <i class="fa-solid fa-store"></i>
                        <span>Thương mại</span>
                    </a>
                </li>
                <li>
                    <a href="/usego/search?q=kinh doanh">
                        <i class="fa-regular fa-credit-card"></i>
                        <span>Kinh doanh online</span>
                    </a>
                </li>
                <li>
                    <a href="/usego/search?q=robot">
                        <i class="fa-brands fa-bilibili"></i>
                        <span>Robot</span>
                    </a>
                </li>
                <li>
                    <a href="/usego/search?q=công nghệ">
                        <i class="fa-solid fa-laptop-code"></i>
                        <span>Công nghệ</span>
                    </a>
                </li>
                <li>
                    <a href="/usego/search?q=sách">
                        <i class='bx bx-book-open'></i>
                        <span>Sách</span>
                    </a>
                </li>
                <li>
                    <a href="/usego/search?q=thế giới">
                        <i class="fa-solid fa-earth-europe"></i>
                        <span>Thế giới</span>
                    </a>
                </li>
                <li>
                    <a href="/usego/search?q=phim">
                        <i class="fa-solid fa-film"></i>
                        <span>Phim</span>
                    </a>
                </li>
                <li>
                    <a href="/usego/search?q=du lịch">
                        <i class="fa-regular fa-paper-plane"></i>
                        <span>Du lịch</span>
                    </a>
                </li>
            </ul>
            </div>
        </div>
        <div class="post-container">
            <div class="pagination-top">
                <span class="title">
                    <img src="<?= _TEMPLATE . 'images/icons/aigc-short-4.svg' ?>" width="40">
                    <p>Bạn có thể chuyển tiếp trang ở đây 
                    </p>
                </span>
                <div class="pagination-t">
                    <button id="prev-page" class="btn-pagination-page">
                    <i class="fa-solid fa-angle-left"></i>
                    </button>
                    <input type="number" name="page" class="page-text" required="" min="1" max="3">
                    <p>
                        <button class="page-search">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </p>
                    <button id="next-page" class="btn-pagination-page">
                    <i class="fa-solid fa-angle-right"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="archive-lists">
            <div class="list-item-product" 
            data-temp="<?= _TEMPLATE ?>"
            data-template="<?= _TEMPLATE . 'images/uploads/powerpoint-images/' ?>">
            <?php if ( !empty( $dataPowerpoint ) ) : ?>
                <?php $count = 0; foreach( $dataPowerpoint as $item ) : ?>
                <section class="archive-list-price">
                    <div class="archive-poster">
                        <a href="/usego/powerpoint/detail?id=<?php if (!empty( $item['id'] )) echo $item['id']; ?>">
                            <img class="poster-product lazyload" 
                            data-src="<?= _TEMPLATE . 'images/uploads/powerpoint-images/' . showInfo::analysis2Character($item['images'])[0] ?>" 
                            onerror="this.src='<?php echo _TEMPLATE . 'images/icons/not-image.png'; ?>'"
                            loading="lazy"
                            title="<?= $item['title'] ?>">
                        </a>
                        <?php if(!empty( $item['like_count'] )) : ?>
                            <div class="item-like">
                                <img src="<?= _TEMPLATE . 'images/icons/like.png' ?>" width="25">
                                <span><?= $item['like_count']; ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="content">
                        <p class="title"> 
                            <?= $item['title'] ?? _no_data ?> 
                        </p>
                        <small class="description">
                            <?= str_replace(',', ', ', implode(' ', showInfo::analysis2Character( $item['tags'] ))) ?? _no_data ?>
                        </small>
                        <article class="infomation">
                            <div class="item-info info-detail">
                                <a class="on-Pewview" href="/usego/profile/?id=<?= $item['userId'] ?>">
                                <img class="avarta" 
                                src="<?= _TEMPLATE . 'images/uploads/avatar/' . $item['avatar'] ?>" width="30">
                                <small class="name"> 
                                    <?= showInfo::setFullName( $dataPowerpoint, $count ); ?> 
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

                                            <?= showInfo::setFullName( $dataPowerpoint, $count ); $count++; ?>

                                            <?php if ( !empty( $item['ug_type'] ) && $item['ug_type'] === 1 ) : ?>
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle-check" class="svg-inline--fa fa-circle-check UserName_icon__zT+rB" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="font-size: 1.2rem;"><path fill="currentColor" d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM371.8 211.8C382.7 200.9 382.7 183.1 371.8 172.2C360.9 161.3 343.1 161.3 332.2 172.2L224 280.4L179.8 236.2C168.9 225.3 151.1 225.3 140.2 236.2C129.3 247.1 129.3 264.9 140.2 275.8L204.2 339.8C215.1 350.7 232.9 350.7 243.8 339.8L371.8 211.8z"></path></svg>
                                            <?php endif; ?> 

                                            </small>
                                            <?php if( $showInfo->getStatus() ) : ?>
                                                <?php if( !empty(( $item['total_follow'] )) && ( $item['total_follow'] ) > 0 ) : ?>
                                                <?php if( !showInfoYourSelf::checkYourSelf( $item['userId'] )) : ?>
                                                    <button class="btn-follower" data-id="<?= $item['userId'] ?>">
                                                        <i class="fa-regular fa-circle-check"></i>  
                                                        <span>Đã theo dõi</span>
                                                    </button>
                                                <?php endif; ?>
                                                <?php else: ?>
                                                    <?php if( !showInfoYourSelf::checkYourSelf( $item['userId'] )) : ?>
                                                        <button class="btn-follower" data-id="<?= $item['userId'] ?>">
                                                        <span>+ Theo dõi</span>
                                                        </button>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item-info tag-form">
                                <img src="<?= _TEMPLATE . 'images/icons/hashtag.png' ?>" width="20">
                                <small>
                                    <?= showInfo::handleKeyWord(showInfo::analysis2Character( $item['tags'] ), $item['title'] ) ?? _no_data ?>
                                </small>
                            </div>
                        </article>
                    </div>
                </section>
                <?php endforeach; ?>
            <?php endif; ?>
            </div>
        </div>
        <?php 
            if ( empty( $arrayCrumbs[1] ) ) {
                $controller = new Controller;
                $controller->pagination('pagination', 'powerpoints');
            }
        ?>
    </div>
</main>