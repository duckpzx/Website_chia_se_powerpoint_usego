<?php 
    if(!empty($dataSql['dataTopic'])) :
    $dataTopics = $dataSql['dataTopic'];
    endif; // Get data Action Params 
    
    if(!empty($dataSql['dataDetail'])) :
    $dataDetail = $dataSql['dataDetail'];
    else :
    require_once ("./mvc/errors/404.php");
    // Posts No Exits
    endif;

    if(!empty($dataSql['totalComments'])) :
    $totalComments = $dataSql['totalComments'];
    endif; 
    // Get Data comments 
    
    if(!empty($dataSql['dataRespondComment'])) :
    $dataRespondComment = $dataSql['dataRespondComment'];
    endif; 
    // Get Data Respond comment

    $getActionParams = new App();
    $arrayCrumbs = $getActionParams->urlProcess();

    // Check if the user is logged in or not
    $statusLogin = new showInfo();

    // Get user data from session
    $dataInfoUser = $statusLogin->checkStatusLogin();
?>
<main>
    <div class="container">
        <div class="block"></div>
        <div class="post-meta">
            <img class="post-poster"
            src="<?= _TEMPLATE . 'images/uploads/powerpoint-images/' . 
            showInfo::analysis2Character( $dataDetail[0] ['images'] ) [0]; ?>">
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
            <div class="post-title">
                <h4> <?php if (!empty( $dataDetail )) echo showInfo::setInfomation($dataDetail, 'title'); ?> </h4>
                <div class="post-meta-item flex flex-juscenter">
                    <a href="#" class="flex flex-center">
                        <p>4 ngày trước</p>
                    </a>
                    <a href="#" class="flex flex-center">
                        <p>Đề xuất: </p>
                        <span>Good Night Thunder</span>
                    </a>
                    <a href="#" class="flex flex-center">
                        <p>Xem chủ đề tương tự</p>
                    </a>
                    <a href="#" class="flex flex-center">
                        <i class="fa-regular fa-clock"></i>
                        10/17/2023
                    </a>
                </div>
            </div>
            <div class="post-btns flex flex-juscenter">
                <?php if( $statusLogin->getStatus() ) : ?>
                    <button class="btn-collection <?= (( $dataDetail[0]['check_collections'] ) > 0) ? 'show' : ''  ?>">
                        <img src="<?= _TEMPLATE . 'images/icons/favorite.png' ?>" width="25">
                        Bộ sưu tầm
                    </button>
                    <button class="btn-collection <?= (( $dataDetail[0]['check_likes'] ) > 0) ? 'show' : '' ?>">
                        <img src="<?= _TEMPLATE . 'images/icons/like.png' ?>" width="25">
                        Thích
                    </button>
                <?php else : ?>                    
                    <a href="/usego/account/logind" 
                    class="btn-collection <?= (( $dataDetail[0]['check_collections'] ) > 0) ? 'show' : '' ?>">
                        <img src="<?= _TEMPLATE . 'images/icons/favorite.png' ?>" width="25">
                        Bộ sưu tầm
                    </a>
                    <a href="/usego/account/logind" 
                    class="btn-collection <?= (( $dataDetail[0]['check_likes'] ) > 0) ? 'show' : ''  ?>">
                        <img src="<?= _TEMPLATE . 'images/icons/like.png' ?>" width="25">     
                        Thích
                    </a>
                <?php endif; ?>
            </div>
            <div class="post-tags">
                <ul>
                <?php  
                    $arrayTags = [];
                    if(!empty($dataDetail[0]['tags'])) :
                    $arrayTags =showInfo::analysis2Character($dataDetail[0]['tags']);
                    endif;
                ?>
                <?php if(is_array($arrayTags)) foreach($arrayTags as $tag) : $tag = str_replace(',', '', $tag); ?>
                    <li>
                        <a href="/usego/search?q=<?= $tag ?>">
                            <img src="<?= _TEMPLATE . 'images/icons/hashtag.png' ?>" width="20">
                            <?= $tag ?> 
                        </a>
                    </li>
                <?php endforeach; ?>
                </ul>
            </div>
        </div>
            <div class="post-containers">
                <div class="post-container-left">
                    <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2">
                        <div class="swiper-wrapper">
                            <?php if(!empty(showInfo::analysis2Character($dataDetail[0]['images']))) : ?>
                                <?php $arrayImage = showInfo::analysis2Character($dataDetail[0]['images']); ?>
                                <?php foreach($arrayImage as $image) : ?>
                                <div class="swiper-slide">
                                    <img 
                                    src="<?= _TEMPLATE . 'images/uploads/powerpoint-images/' . $image ?>"
                                    onerror="this.src='<?= _TEMPLATE . 'images/icons/not-image.png' ?>'">
                                </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                    <div thumbsSlider="" class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <?php if(!empty(showInfo::analysis2Character($dataDetail[0]['images']))) : ?>
                                <?php $arrayImage = showInfo::analysis2Character($dataDetail[0]['images']); ?>
                                <?php foreach($arrayImage as $image) : ?>
                                <div class="swiper-slide">
                                    <img 
                                    src="<?= _TEMPLATE . 'images/uploads/powerpoint-images/' . $image ?>"
                                    onerror="this.src='<?php echo _TEMPLATE . 'images/icons/not-image.png'; ?>'">
                                </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                <section class="comments">
                <div class="post-wraptitle">
                    <div class="title">
                        <span>
                            <?php if( !empty( $totalComments[0]['total_comments'] ) ) : $total = $totalComments[0]['total_comments']; ?>
                                <?= $total . ' bình luận' ?>
                            <?php else : ?>
                                Không có bình luận nào 
                            <?php endif; ?>
                        </span>
                        <?php if( !empty( $total ) ) : ?>
                            <div class="short-comments" 
                            title="Sắp xếp bình luận"
                            onclick="handleModuleCommentClick(event)">
                                    Sắp xếp theo
                                <ul class="module-arrange module-buttons">
                                    <li class="cmt-top">
                                        <span><i class="fa-solid fa-fire"></i> Hàng đầu</span>
                                    </li>
                                    <li class="cmt-date">
                                        <span><i class="fa-regular fa-calendar"></i> Mới nhất</span>
                                    </li>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php 
                    $controller = new Controller;
                    $controller->comment('comment'); 
                ?>
                </div>
                </section>
            </div>
            <div class="post-container-right">
                <section>
                    <div class="page-right-quantity">
                        <span>
                            <i class="fa-solid fa-eye"></i>
                            <small>
                            <?php if (!empty( $dataDetail[0] ['view'] )) echo $dataDetail[0] ['view']; ?>
                            </small>
                        </span>
                        <span>
                            <i class="fa-solid fa-cloud-arrow-down"></i>
                            <small>
                                <?php if (!empty( $dataDetail[0] ['total_archive'] )) echo $dataDetail[0] ['total_archive']; ?>
                            </small>
                        </span>
                    </div>
                    <table class="page-form">
                        <tr>
                            <td>Tác giả</td>
                            <td>:</td>
                            <td id="id-powerpoint"> 
                                <a
                                href="/usego/profile/?id=<?php if (!empty( $dataDetail[0] ['userId'] )) echo $dataDetail[0] ['userId']; ?>">
                                <?= showInfo::setFullName( $dataDetail, 0 ); ?>
                                <?php if (!empty( $dataDetail[0] ['ug_type'] ) && $dataDetail[0] ['ug_type'] === 1 ) : ?>
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle-check" class="svg-inline--fa fa-circle-check UserName_icon__zT+rB" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="font-size: 1.2rem;"><path fill="currentColor" d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM371.8 211.8C382.7 200.9 382.7 183.1 371.8 172.2C360.9 161.3 343.1 161.3 332.2 172.2L224 280.4L179.8 236.2C168.9 225.3 151.1 225.3 140.2 236.2C129.3 247.1 129.3 264.9 140.2 275.8L204.2 339.8C215.1 350.7 232.9 350.7 243.8 339.8L371.8 211.8z"></path></svg>
                                <?php endif; ?> 
                                </a> 
                            </td>
                        </tr>
                        <tr>
                            <td>Chủ đề</td>
                            <td>:</td>
                            <td>
                            <?php 
                                if(!empty( $dataDetail[0]['tags'] ))
                                {
                                    $arrayTags = showInfo::analysis2Character( $dataDetail[0] ['tags'] );
                                    echo showInfo::handleKeyWord( $arrayTags, $dataDetail[0] ['title'] );
                                }
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Số lượng</td>
                            <td>:</td>
                            <td> 
                            <?php 
                                if(!empty(showInfo::analysis2Character( $dataDetail[0] ['images'] ) )) 
                                {
                                    $arrayImage = showInfo::analysis2Character( $dataDetail[0] ['images'] );
                                    echo count( $arrayImage );
                                }
                            ?>    
                            Slide
                            </td>
                        </tr>
                        <tr>
                            <td>Tỉ lệ</td>
                            <td>:</td>
                            <td>
                            <?php 
                                if(!empty( $dataDetail[0] ['images'] )) :
                            ?>
                            16 : 9
                            <?php else: ?>
                            Không có dữ liệu
                            <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Định dạng</td>
                            <td>:</td>
                            <td>
                            <?php
                                if(!empty( $dataDetail[0] ['fileDownload'] ))
                                {
                                    $file = ( $dataDetail[0] ['fileDownload'] );
                                    echo 'File ' . strtoupper( pathinfo( $file, PATHINFO_EXTENSION ) ); 
                                }
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Bộ sưu tầm</td>
                            <td>:</td>
                            <td>
                            <span style="color: var(--main)">
                                <?php if(!empty( $dataDetail[0] ['total_collections']) ) : ?>
                                    <?= $dataDetail[0] ['total_collections'] ?>
                                <?php else: ?>
                                    Không có 
                                <?php endif; ?>
                            </span> 
                            <?php if(!empty( $dataDetail[0] ['total_collections'] ) ) echo 'lượt thêm'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Giấy phép</td>
                            <td>:</td>
                            <td>
                            <?php if(!empty( $dataDetail[0] ['fileDownload'] )) : ?>
                            Tự do sử dụng
                            <?php else : ?>
                            Không có dữ liệu
                            <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Đánh giá</td>
                            <td>:</td>
                            <td>
                            <span style="color: var(--main)">
                                <?php if(!empty( $dataDetail[0] ['total_likes']) ) : ?>
                                    <?= $dataDetail[0] ['total_likes'] ?>
                                <?php else: ?>
                                    Không có 
                                <?php endif; ?>
                            </span> 
                            <?php if(!empty( $dataDetail[0] ['total_likes'] ) ) echo 'lượt thích'; ?>
                            </td>
                        </tr>
                    </table>
                </section>
                <article>
                    <div class="post-download">
                        <div id="btn-download" 
                            data-id="<?php if (!empty( $dataDetail[0] ['id'] )) echo $dataDetail[0] ['id']; ?>" 
                            data-file="<?php if (!empty( $dataDetail[0] ['fileDownload'] )) echo $dataDetail[0] ['fileDownload']; ?>">
                            <img src="<?= _TEMPLATE . 'images/icons/icon-powerpoint.png' ?>" width="40">
                            <span>MS Powerpoint (16:9)</span>
                            <div class="download-file">
                                <i class="fa-solid fa-download"></i>
                            </div>
                        </div>
                    </div>
                </article>
                <section class="proposals-posts" data-template="<?= _TEMPLATE . 'images/uploads/powerpoint-images/' ?>">
                </section>
            </div>
        </div>
    </div>
</main>
