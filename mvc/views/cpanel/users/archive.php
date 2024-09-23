<?php 
    if(!empty($dataSql['dataArchive'])) :
    $dataArchive = $dataSql['dataArchive'];
    endif; // Get data 
?>

<main>
    <div class="container">
    <div class="block"></div>
        <div class="group-wrapper">
            <div class="group-title">
                <h1>
                    <strong>
                    <span>Nội dung tải xuống</span> 
                    </strong>
                    <?php 
                    define('_show_download', 'Danh sách nội dung tải xuống của bạn.');
                    define('_no_download', 'Bạn chưa tải xuống nội dung nào.');
                    ?>
                    <span> 
                        <?php echo (!empty($dataArchive)) ? _show_download : _no_download ?> 
                    </span>
                </h1>
                <div class="remove-post">
                    <button id="remove">
                        <svg class="module-svg" xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24">
                            <path d="m22.242,5.272l-3.515-3.515c-1.133-1.133-2.64-1.757-4.242-1.757h-4.971c-1.602,0-3.109.624-4.243,1.757l-3.515,3.515c-1.133,1.134-1.757,2.641-1.757,4.243v4.971c0,1.602.624,3.109,1.757,4.243l3.515,3.515c1.134,1.133,2.641,1.757,4.243,1.757h4.971c1.603,0,3.109-.624,4.242-1.757l3.515-3.514c1.134-1.133,1.758-2.64,1.758-4.243v-4.971c0-1.603-.624-3.11-1.758-4.243Zm-.242,9.213c0,1.069-.416,2.073-1.172,2.829l-3.515,3.515c-.756.755-1.76,1.171-2.828,1.171h-4.971c-1.068,0-2.073-.416-2.829-1.171l-3.514-3.515c-.756-.756-1.172-1.76-1.172-2.829v-4.971c0-1.068.416-2.073,1.171-2.829l3.515-3.514c.756-.756,1.76-1.172,2.829-1.172h4.971c1.068,0,2.072.416,2.828,1.171l3.515,3.515c.756.755,1.172,1.759,1.172,2.828v4.971Zm-5.561-5.511l-3.043,3.043,3.043,3.043c.391.391.391,1.023,0,1.414-.195.195-.451.293-.707.293s-.512-.098-.707-.293l-3.043-3.043-3.043,3.043c-.195.195-.451.293-.707.293s-.512-.098-.707-.293c-.391-.391-.391-1.023,0-1.414l3.043-3.043-3.043-3.043c-.391-.391-.391-1.023,0-1.414s1.023-.391,1.414,0l3.043,3.043,3.043-3.043c.391-.391,1.023-.391,1.414,0s.391,1.023,0,1.414Z"/>
                        </svg>
                        Xóa nội dung
                    </button>
                </div>
            </div>
        </div>
        <div class="group-wrapper group-filter">
            <div class="group-title">
                <article>
                    <div class="group-search">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="10" cy="10" r="7"></circle><line x1="21" y1="21" x2="15" y2="15"></line></svg>
                        <input 
                        type="search" 
                        name="search-archive" 
                        placeholder="Tìm kiếm...">
                    </div>
                    <div class="group-selector">
                        <section>
                            <button class="new filter">Mới</button>
                            <button class="date">
                                Theo ngày <i class="fa-solid fa-caret-down"></i></label>
                            </button>
                        </section>
                        <section>
                            <button class="collection">Bộ sưu tầm</button>
                            <button class="like">Thích</button>
                        </section>
                    </div>
                </article>
                <?php if (!empty( $dataArchive )) : ?>
                    <button class="select">Chọn nội dung</button>
                <?php endif; ?>
            </div>
        </div>
        <div class="container-body">
            <div class="lists-body" 
            data-template="<?= _TEMPLATE . 'images/uploads/powerpoint-images/' ?>">
                <?php if (!empty( $dataArchive )) : ?>
                    <?php foreach ( $dataArchive as $item ) : ?>
                    <section>
                        <a href="/usego/powerpoint/detail?id=<?php if (!empty( $item['id'] )) echo $item['id']; ?>">
                        <input type="checkbox" name="selective" 
                        data-id="<?php if (!empty( $item['id'] )) echo $item['id']; ?>">    
                            <img class="poster"
                            src="<?= _TEMPLATE . 'images/uploads/powerpoint-images/' . 
                            showInfo::analysis2Character( $item['images'])[0] ?>" 
                            width="237">
                            <!-- Content -->
                            <div class="content">
                                <h3><?php if (!empty( $item['title'] )) echo $item['title']; ?></h3>
                            </div>
                        </a>
                        <p>
                        <small>
                        <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuv" width="18" height="18" focusable="false" aria-hidden="true" viewBox="0 0 24 24" data-testid="ClockIcon"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"></path><path d="M12.5 7H11v6l5.25 3.15.75-1.23-4.5-2.67z"></path></svg>
                            <?php if (!empty( $item['timeAt'] )) : ?>
                                <?php showInfo::dateDiffInMinutes( $item['timeAt'] ) ?>
                            <?php endif; ?>
                        </small>
                        </p>
                    </section>
                    <?php endforeach; ?>
                <?php endif; ?>
                <section class="add-download">
                    <a href="/usego/powerpoint?page=1">
                        <img class="poster"
                        src="<?= _TEMPLATE . 'images/icons/istockphoto-background.jpg' ?>" 
                        width="237">
                        <div class="effect">
                            <article>
                                <i class="fa-solid fa-plus"></i>
                                <div class="add-down">Thêm nội dung</div>
                            </article>
                        </div>
                        <img class="poster-effect"
                        src="<?= _TEMPLATE . 'images/icons/effect-star.svg' ?>" 
                        width="237">
                    </a>
                </section>
            </div>
        </div>
    </div>
</main>