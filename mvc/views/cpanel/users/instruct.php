<?php 
    // Getdata Action Params 
    $getActionParams = new App();

    $arrayCrumbs = $getActionParams->urlProcess();

    $dataKeys = ['allPosts', 'topPost', 'serviceUnfinished'];
    
    foreach ($dataKeys as $key) {
        if (!empty($dataSql[$key])) {
            ${$key} = Compact::compactData($dataSql, $key);
        }
    }
?>
<main>
    <div class="container">
        <div class="block"></div>
    </div>
    <div class="archive-app">
        <div class="archive-header" style="background: url('<?= _TEMPLATE . 'images/background/MTYwNDYzMzMzNDYzNiMgNDIjcG5n.png' ?>')">
            <section>
                <div class="main">
                    <i>
                        <img src="<?= _TEMPLATE . 'images/icons/cartoon-astronaut.png' ?>">
                    </i>
                </div>
                <div class="bottom">
                    <div class="snow"></div>
                </div>
            </section>
        </div>
        <div class="archive-content">
            <?php if ( !empty( $serviceUnfinished ) ) : ?>
                <div class="archive-part">
                    <section class="hot-title">
                        <a href="/usego/instruct/newpost" title="Truy cập tạo bài viết mới">
                            <img src="<?= _TEMPLATE . 'images/icons/new-posts.png'?>">
                            <span>Tạo mới</span>
                        </a>
                        <a href="/usego/profile/?id=7&tab=d" title="Truy cập quản lý bài viết">
                            <img src="<?= _TEMPLATE . 'images/icons/new-feed.png'?>">
                            <span>Bài đăng</span>
                        </a>
                        <span class="text">👇 Một số các bài viết bạn có thể quan tâm </span>
                    </section>
                    <section>
                        <ul>
                            <?php foreach ( $serviceUnfinished as $item ) : ?>
                                <li>
                                    <a href="/usego/instruct/read?id=<?= $item['id'] ?? '' ?>">
                                        <img src="<?= _TEMPLATE . 'images/uploads/avatar/' . $item['avatar'] ?>" width="30">   
                                        <span><?= $item['title'] ?? '' ?></span> 
                                    </a>
                                </li>
                            <?php endforeach; ?> 
                        </ul>
                    </section>
                </div>
            <?php endif; ?>
            <div class="archive-lists">
                <?php if ( !empty( $allPosts ) ) : ?>
                    <?php foreach ( $allPosts as $item ) : ?>
                    <section>
                        <a href="/usego/instruct/read?id=<?= $item['id'] ?>">
                        <div class="preview">
                            <img 
                                src="<?= _TEMPLATE . 'images/uploads/posts/' . showInfo::analysis2Character($item['images'])[0] ?>"
                                onerror="this.src='<?= _TEMPLATE . 'images/icons/not-image.png'; ?>'">
                            <?php ?>
                            <div class="view">
                                <span>
                                <i class="fa-regular fa-eye"></i>    
                                    <?php if ( !empty( $item['view'] ) ) : ?>
                                        <?= $item['view'] ?>
                                    <?php endif; ?>
                                </span>
                            </div>
                        </div>
                        </a>
                        <div class="content">
                            <div class="title">
                                <span>
                                    <?php if (!empty( $item['title'] )) : ?>
                                        <?php echo $item['title']; ?>
                                    <?php endif; ?>
                                </span>
                            </div>
                            <div class="topic">
                                <?php if (!empty( $item['topic'] )) : ?>
                                    <span class="<?= $item['topic'] ?? '' ?>">
                                        <?php 
                                            switch( $item['topic'] ) 
                                            { 
                                                case 'service':
                                                    echo 'Dịch vụ';
                                                    break;
                                                case 'post':
                                                    echo 'Bài viết';
                                                    break;
                                                default:
                                                    echo 'Không xác định';
                                                    break;
                                            }?>
                                    </span>
                                <?php endif; ?>
                                <?php if( !empty( $item['topic'] ) && $item['topic'] !== "post" ) : ?>
                                    <?php 
                                        switch( $item['status'] ) 
                                        { 
                                            case 'PD':
                                                echo '<span class="blue">Phê duyệt</span>';
                                                break;
                                            case 'XN':
                                                echo '<span class="yellow">Xác nhận</span>';
                                                break;
                                            case 'HT':
                                                echo '<span class="green">Hoàn thành</span>';
                                                break;
                                            case 'TB':
                                                echo '<span class="red">Thất bại</span>';
                                                break;
                                            default:
                                                echo '<span class="red">Chờ đợi</span>';
                                                break;
                                        }?>
                                <?php endif; ?>
                            </div>
                            <div class="interplay">
                                <div class="info">
                                    <a href="/usego/profile/?id=<?= $item['userId'] ?? null ?>">
                                        <img class="avatar" 
                                            src="<?= _TEMPLATE . 'images/uploads/avatar/' . $item['avatar'] ?>" width="25">
                                        <?= showInfo::setFullName( $item, 'no_key' ) ?? _no_data ?> 
                                    </a>
                                </div>
                                <div>
                                    <span>
                                        <?php if (!empty( $item['createAt'] )) : ?>
                                            <?= showInfo::dateDiffInMinutes( $item['createAt'] ) ?>
                                        <?php endif; ?>
                                    </span>
                                </div>
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
                    <?php if ( !empty( $topPost ) ) : ?>
                        <?php $index = 1; foreach ( $topPost as $item ) : ?>

                            <a href="/usego/instruct/read?id=<?= $item['id'] ?? null ?>">
                                <article>
                                    <div class="rank">
                                        <img 
                                        src="<?= _TEMPLATE . 'images/icons/' . $index++ . '.png' ?>" width="30">
                                    </div>
                                    <div class="content">
                                        <div class="image">
                                            <img 
                                            src="<?= _TEMPLATE . 'images/uploads/post/' . showInfo::analysis2Character( $item['images'] )[0] ?>" width="130">
                                        </div>
                                        <div class="wrapper">
                                            <div class="titler">
                                                <span>
                                                    <?= $item['title'] ?? null ?>
                                                </span>
                                            </div>
                                            <div class="infomation">
                                                <div class="link">
                                                    <a href="#">
                                                        <span>Các hướng dẫn khác</span>
                                                    </a>
                                                    <a href="#">
                                                        <span>
                                                            <?= showInfo::setFullName($topPost, ($index - 2)); ?> 
                                                        </span>
                                                    </a>
                                                </div>
                                                <div class="view">
                                                    <span><?= showInfo::formatCoin($item['view'] ?? 0 ) ?><p>người xem</p></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </a>

                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </section>
        </div>
    </div>
</main>
