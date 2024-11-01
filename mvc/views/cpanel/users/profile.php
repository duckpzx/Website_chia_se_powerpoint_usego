<?php 
    $statusLogin = new showInfo();  

    $dataKeys = ['dataProfile', 'dataAvatars', 'dataPowerpoints', 'dataCheckFollow'];
    
    foreach ($dataKeys as $key) {
        if (!empty($dataSql[$key])) {
            ${$key} = Compact::compactData($dataSql, $key);
        }
    }
?>
<main>
    <div class="container">
        <div class="block"></div>
        <?php if(!showInfoYourSelf::setDateYourSelf($_GET, 'id')): ?>
        <div class="show-item-kind">
        <img class="show-item-banner"
            src="<?= _TEMPLATE . 'images/icons/banner_website_pro.jpeg' ?>">
            <div class="show-item-text"></div>
        </div>
        <?php else: ?>
        <div class="show-item-kind">
        <img class="show-item-banner"
            src="<?= _TEMPLATE . 'images/icons/banner_website_pro.jpeg' ?>">
            <?php if (showInfoYourSelf::setDateYourSelf($_GET, 'id')) : ?>
            <div class="show-item-text">
                <h3> Chia sẻ các mẫu thiết kế của bạn </h3>
                <button class="btn-call" id="btn-user-upload-ppt">
                <i class="fa-solid fa-circle-up"></i> Đăng tải 
                </button>
                <button class="b-rules"> 
                <i class="fa-solid fa-question" style="color: #FFFFFF;"></i>
                </button>
            </div>
            <?php endif; ?>
        </div>
        <div class="upload-wrapper">
            <!-- Loading -->
            <div class="loading-wrapper">
                <img 
                src="<?= _TEMPLATE . 'images/icons/circle-Loading.gif' ?>" width="70">
            </div>
            <ul>
                <li>
                    <section class="item-upload-ppt">
                        <div class="top">
                            <img 
                            src="<?= _TEMPLATE . 'images/icons/upload-file-data.svg' ?>" 
                            width="150"
                            title="Chấp nhận pptx và các loại file nén khác">
                            <span>Acpt: <small>Rar</small>, <small>Zip</small>,...</span>
                            <div class="content">
                                <span>Tạo File Nén: </span>
                                <button class="suggest-compressed">
                                <i class="fa-solid fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="bottom">
                            <div class="list-item-file-ppt">
                                <label for="item-file-ppt" class="manual">
                                    <span class="btn-item-file-ppt">Tải thủ công</span>
                                </label>
                                <label for="item-file-ppt" class="automatic">
                                    <span class="btn-item-file-ppt">Tải tự động</span>
                                </label>
                            </div>
                            <form method="POST" enctype="multipart/form-data">
                                <input 
                                type="file" 
                                name="powerpoint" 
                                id="item-file-ppt" 
                                class="hidden"> 
                            </form>
                            <article class="ppt-hidden wrapper-info-file-upload">
                                <section>
                                    <div class="photo">
                                        <img src="<?= _TEMPLATE . 'images/icons/' ?>" width="40">
                                    </div>
                                    <div class="info-file">
                                        <span></span>
                                        <small></small>
                                    </div>
                                </section>
                                <section>
                                    <button class="btn-cirlce-x btn-close-x">❌</button>
                                </section>
                            </article>
                        </div>
                    </section>
                </li>
                <li>
                    <section class="item-upload-photos">
                        <div class="select-images">
                            <ul class="select-list-images">
                                <!-- Img -->
                            </ul>
                            <section class="wrapper-compressed">
                                <button class="btn-comeback-upload-image">
                                <i class='bx bx-chevron-left'></i>
                                <span>⟲ Quay lại</span>
                                </button>
                                <input 
                                type="file" 
                                name="compressed"
                                id="file-compressed"
                                class="hidden-none"> 
                                <label for="file-compressed" id="dropZone">
                                    <div class="content">
                                    <img 
                                    src="<?= _TEMPLATE . 'images/icons/add-new-document.jpg' ?>" 
                                    width="200">
                                    <span>Chọn hoặc thả File </span>
                                    </div>
                                </label>
                                <ul class="list-file-compressed">
                                </ul>
                            </section>
                        </div>
                        <div class="attention">
                            <form enctype="multipart/form-data" method="POST" enctype="multipart/form-data">
                            <input 
                            type="file" 
                            name="image-uploads[]" 
                            id="ppt-image-uploads"
                            class="hidden" 
                            multiple accept="image/*">
                            </form>
                            <label for="ppt-image-uploads" class="btn-cirlce-x">
                                <span> Chọn <i class="fa-regular fa-image"></i></span>
                            </label>
                            <button class="btn-cirlce-x btn-gradient-x"
                            id="send-powerpoint">
                                <span> Tiếp tục </span>
                            </button>
                        </div>
                    </section>
                </li>
            </ul>
            <div class="upload-wrapper-2">
                <div class="select-add-content">
                    <button class="btn-comeback-upload-image" id="btn-comback-upload-title">
                        <i class='bx bx-chevron-left'></i>
                        <span>⟲ Quay lại</span>
                    </button>
                    <section class="title">
                        <input 
                        type="text" 
                        name="title-powerpoint"
                        placeholder="Tiêu đề"
                        required>
                    </section>
                    <section class="tags">
                        <ul class="list-tags" id="list-tags-powerpoints"></ul>
                        <input 
                        type="text" 
                        name="tags-powerpoint"
                        placeholder="Tag">
                        <div class="tips">
                        <ul id="list-suggests">
                            <li>Công nghệ <i class="fa-solid fa-arrow-trend-up"></i></li>
                            <li>Hiện đại <i class="fa-solid fa-arrow-trend-up"></i></li>
                            <li>Thông tin <i class="fa-solid fa-arrow-trend-up"></i></li>
                            <li>Hóa học <i class="fa-solid fa-arrow-trend-up"></i></li>
                        </ul>
                        </div>
                    </section>
                    <section class="button">
                        <button id="btn-cl-powerpoint">
                            <span>Hủy bỏ</span>
                        </button>
                        <button id="btn-up-powerpoint" disabled>
                            <span>Đăng tải</span>
                        </button>
                    </section>
                </div>
            </div>
        </div>
        <!-- Zoom -->
        <div class="view-image-zoom">
            <img class="wallper-wrapper"
                src="">
            <div class="wallper-blur"></div>
            <div class="view-image-main">
                <div class="view-image-content">
                    <button class="btn-close-zoom" title="Nhấn để đóng">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                    <section>
                        <button class="btn-fn-zoom-img btn-prev-zoom-img">
                            <i class="fa-solid fa-chevron-left flex flex-center"></i>
                        </button>
                            <img class="wallper-wrapper-view"
                                src="">
                        <button class="btn-fn-zoom-img btn-next-zoom-img">
                            <i class="fa-solid fa-chevron-right flex flex-center"></i>
                        </button>
                    </section>
                </div>
                <div class="view-image-lists"></div>
            </div>
        </div>
        <?php endif; ?>
        <div class="user-header">
            <div class="bg-mobile-site">
                <img 
                src="<?= _TEMPLATE . 'images/uploads/avatar/' . showInfo::setAvatar($dataProfile, 0); ?>" 
                onerror="this.src='<?php echo _TEMPLATE . 'images/icons/not-image.png'; ?>'"
                width="40">
            </div>
            <div class="user-info">
                <div class="user-avatar" >
                    <img id="main-avatar"
                    src="<?= _TEMPLATE . 'images/uploads/avatar/' . showInfo::setAvatar($dataProfile, 0); ?>" 
                    width="40"
                    onerror="this.src='<?php echo _TEMPLATE . 'images/icons/not-images.png'; ?>'"
                    title="Nhấn để mở rộng">
                    <?php if(showInfoYourSelf::setDateYourSelf($_GET, 'id')): ?>
                    <div class="change-avatar">
                        <i class="fa-solid fa-camera"></i>
                    </div>
                    <?php endif; ?>
                </div>    
                <?php if(showInfoYourSelf::setDateYourSelf($_GET, 'id')): ?>
                    <div class="preview-poster-wrapper">
                        <div class="preview-poster">
                        <div class="reset">
                            <button class="btn-reset-avatar">
                                <i class="fa-solid fa-rotate-left"></i>
                            </button>
                        </div>
                        <section>
                            <img 
                                src="<?= _TEMPLATE . 'images/icons/not-images.png' ?>" width="100" 
                                class="preview-poster-image">
                            <img 
                                src="<?= _TEMPLATE . 'images/icons/hand-pointer.gif' ?>" width="10"
                                class="preview-icons-poster">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="avatar-auth" class="avatar-btn">Chọn ảnh đại diện</label>
                                    <input 
                                    type="file" 
                                    name="avatar" 
                                    id="avatar-auth" accept="image/*">
                                    <button class="btn-avatar-f close-avatar">Hủy bỏ</button>
                                    <button class="btn-avatar-f update-avatar" disabled>Lưu thay đổi</button>
                                </div>
                            </form>
                            <!-- View old avatar -->
                            <?php if(!empty( $dataAvatars )): ?>
                            <div class="wrapper-old-avatars">
                                <ul id="list-avatars">
                                <?php 
                                    $interFace = '
                                    <li>
                                    <div class="item-avatar-old">
                                        <img 
                                            src="' . _TEMPLATE . 'images/uploads/avatar/' . '{{avatar}}' . '" width="50">
                                    </div>
                                    </li>
                                ';
                                showInfoYourSelf::showDataLists($dataAvatars, $interFace, 'avatar');
                                ?>
                                </ul>
                            </div>
                            <?php endif; ?>
                        </section>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="user-profile">
                    <section>
                        <div class="user-text">
                            <div class="user-name">
                                <h4>
                                    <span>
                                    <?= showInfo::setFullName( $dataProfile, 0 ) ?>    
                                    <?php if ( !empty($dataProfile[0]['ug_type']) && $dataProfile[0]['ug_type'] === 1 ) : ?>
                                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle-check" class="svg-inline--fa fa-circle-check UserName_icon__zT+rB" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="font-size: 1.2rem;"><path fill="currentColor" d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM371.8 211.8C382.7 200.9 382.7 183.1 371.8 172.2C360.9 161.3 343.1 161.3 332.2 172.2L224 280.4L179.8 236.2C168.9 225.3 151.1 225.3 140.2 236.2C129.3 247.1 129.3 264.9 140.2 275.8L204.2 339.8C215.1 350.7 232.9 350.7 243.8 339.8L371.8 211.8z"></path></svg>
                                    <?php endif; ?>
                                    </span>
                                </h4>
                                <?php if( showInfoYourSelf::setDateYourSelf($_GET, 'id') ): ?>
                                    <input 
                                    type="item-input" 
                                    name="edit-fullname" 
                                    title="Họ và tên chỉ được phép có 1 khoảng trắng"
                                    maxlength="12"
                                    value="<?= showInfo::setFullName( $dataProfile, 0 ) ?>">
                                <?php endif; ?>
                            </div>
                            <?php if (!empty( $dataPowerpoints[0]['total_topics'] ) > 0) : ?>
                            <i>
                            <img 
                            src="<?= _TEMPLATE . 'images/icons/author-short-4.svg' ?>" 
                            width="20"
                            title="Huy hiệu nhà sáng tạo">
                            </i>
                            <?php endif; ?>
                            <?php if( !showInfoYourSelf::setDateYourSelf( $_GET, 'id' ) && $statusLogin->getStatus() ): ?>
                                <?php if( empty( $dataCheckFollow )) : ?>
                                    <button class="btn-follower" data-id="<?php if (!empty( $_GET['id'] )) echo $_GET['id']; ?>">
                                        <span>+ Theo dõi</span>
                                    </button>
                                <?php else : ?>
                                    <button class="btn-follower" data-id="<?php if (!empty( $_GET['id'] )) echo $_GET['id']; ?>">
                                        <i class="fa-regular fa-circle-check"></i>  
                                        <span>Đã theo dõi</span>
                                    </button>
                                <?php endif; ?>
                            <?php else: ?>
                                <button class="edit-text">
                                    <i class="fa-solid fa-pen-clip"></i>
                                </button>
                            <?php endif; ?>
                        </div>
                    </section>
                    <article>
                        <div class="form-describes">
                            <?php if( empty( showInfo::setInfomation( $dataProfile, 'describes' ) )): ?>
                            <span class="describe-join">
                                Usego bao gồm số lượng thành viên chất lượng trọng bộ phận cung cấp 
                                các sản phẩm thiết kế tốt cho người dùng để mang đến trải nghiệm tốt 
                                nhất. Sử dụng trang web để học tập và học hỏi thêm kiến thức về cách 
                                thiết kế...
                            </span>
                            <?php else: ?>
                            <span class="describe-join">
                                <?php echo showInfo::setInfomation($dataProfile, 'describes'); ?>
                            </span>
                            <?php endif; ?>
                            <?php if( showInfoYourSelf::setDateYourSelf( $_GET, 'id') ): ?>
                                <textarea class="edit-describes" 
                                name="edit-describe" 
                                maxlength="310"?><?php echo showInfo::setInfomation($dataProfile, 'describes'); ?></textarea>
                            <?php endif; ?>
                        </div>
                        <?php if( showInfoYourSelf::setDateYourSelf($_GET, 'id' )): ?>
                            <div class="perform-edit-text">
                                <button class="btn-remove-info">Hủy bỏ </button>
                                <button class="btn-update-info">Cập nhật</button>
                            </div>
                        <?php endif; ?>
                        <div class="form-joins">
                            <div class="user-join">
                                <i class='bx bx-message-rounded-dots'></i>
                                <small>
                                    Tham gia UseGo.com, 2 tháng trước ✍
                                </small>
                            </div>
                            <button class="desk-hidden btn-seemore-des">
                                <i class="fa-solid fa-caret-down"></i>
                            </button>
                        </div>
                    </article>
                </div>
            </div>
            <div class="user-quanity">
                <ul>
                    <li>
                        <?php
                        if (!empty( $dataPowerpoints )) {
                            $totalLike = array_reduce($dataPowerpoints, function($total, $item) {
                                return $total + $item['total_likes'];
                            }, 0); 
                        } 
                        ?>
                        <h4><?php if ( !empty( $totalLike ) ) echo $totalLike ?></h4>
                        <small>Lượt thích</small>
                    </li>
                    <li>
                        <h4><?php if ( !empty( $dataPowerpoints[0]['total_topics'] ) ) echo $dataPowerpoints[0]['total_topics'] ?></h4>
                        <small>Bài viết</small>
                    </li>
                    <li>
                        <h4><?php if ( !empty( $dataProfile[0]['total_follow'] ) ) echo $dataProfile[0]['total_follow'] ?></h4>
                        <small>Theo dõi</small>
                    </li>
                </ul>
            </div>
        </div>
        <div class="user-menu">
            <ul class="menu-lists" 
            data-template="<?= _TEMPLATE . 'images/uploads/powerpoint-images/' ?>">
                <?php if(showInfoYourSelf::setDateYourSelf($_GET, 'id')) : ?>
                <li class="btn-editor-menu">
                    <img src="<?= _TEMPLATE . 'images/icons/edit.png' ?>" width="20">
                    <span>Chỉnh sửa trang</span>
                    <hr class="line-hr">
                </li>
                <?php endif; ?>
                <li class="btn-author-menu activers">
                    <img src="<?= _TEMPLATE . 'images/icons/post.png' ?>" width="20">
                    <span>Được đăng bởi tác giả</span>
                    <hr class="line-hr show">
                </li>
                <li class="btn-collection-menu">
                    <img src="<?= _TEMPLATE . 'images/icons/favorite.png' ?>" width="20">
                    <span>Được sưu tầm bởi tác giả</span>
                    <hr class="line-hr">
                </li>
                <?php if(showInfoYourSelf::setDateYourSelf($_GET, 'id')) : ?>
                <li class="btn-collection-feeds">
                    <img src="<?= _TEMPLATE . 'images/icons/action.png' ?>" width="20">
                    <span>Được soạn bởi tác giả</span>
                    <hr class="line-hr">
                </li>
                <?php endif; ?>
            </ul>
        </div>
        <div class="user-product">
            <?php if(!empty( $dataPowerpoints )) : ?>
            <div class="topic-lists">
                <section>
                    <ul>
                        <li>
                            <a href="#" class="focus">
                                Tất cả bài đăng
                            </a>
                        </li>
                    </ul>
                </section>
                <div class="filter-lists">
                    <button class="btn-kind-like-az"
                            title="Sắp xếp tăng dần A > Z">
                        <i class="fa-solid fa-arrow-down-a-z"></i>
                    </button>

                    <button class="btn-kind-like-za"
                            title="Sắp xếp giảm dần Z > A">
                        <i class="fa-solid fa-arrow-down-z-a"></i>
                    </button>

                    <button title="Sắp xếp theo ngày cũ nhất">
                        <i class="fa-regular fa-calendar"></i>
                    </button>
                </div>
            </div>
            <div class="product-lists" 
            data-owner="<?= ( showInfoYourSelf::checkYourSelf( $dataPowerpoints[0]['userId'] )) ? 1 : 0; ?>"
            data-temp="<?= _TEMPLATE ?>">
                <?php foreach( $dataPowerpoints as $file ): ?>
                    <section class="card-product">
                        <?php if( showInfoYourSelf::checkYourSelf( $file['userId'] ) ) { ?>
                            <button class="auth-see-more flex flex-center">
                                <i class="fa-solid fa-ellipsis"></i>
                            </button>
                            <div class="detail-extended">
                                <div class="wrapper-auth">
                                    <div class="btn-extended">
                                        <span class="btn-remove-ex">
                                            Hủy bỏ
                                        </span>
                                    </div>
                                    <div class="btn-extended">
                                        <span class="btn-delete-ex" 
                                        data-id="<?php if (!empty( $file['id'] )) echo $file['id']; ?>">
                                            Xóa bỏ
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="poster">
                        <a href="/usego/powerpoint/detail?id=<?php if (!empty( $file['id'] )) echo $file['id']; ?>">    
                            <img 
                            src="<?= _TEMPLATE . 'images/uploads/powerpoint-images/' . 
                            showInfo::analysis2Character( $file['images'])[0] ?>">
                        </a>
                        </div>
                        <div class="info">
                            <a href="/usego/powerpoint/detail?id=<?php if (!empty( $file['id']) ) echo $file['id']; ?>">
                                <div class="title">
                                    <?php if (!empty( $file['title'] )) echo $file['title']; ?>
                                </div>
                            </a>
                            <div class="des">
                                <small class="topic">
                                    <p title="Powerpoint">Powerpoint</p>
                                </small>
                                <small class="date">
                                    <p>2 Ngày trước</p>
                                </small>
                            </div>
                        </div>
                    </section>
                <?php endforeach; ?>
            </div>
        </div>
        <?php else : ?>
            <div class="product-lists" data-temp="<?= _TEMPLATE ?>">
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
</main>