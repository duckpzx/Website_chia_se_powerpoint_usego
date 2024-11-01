<?php 
    $dataKeys = ['dataArchive'];
    
    foreach ($dataKeys as $key) {
        if (!empty($dataSql[$key])) {
            ${$key} = Compact::compactData($dataSql, $key);
        }
    }
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
                        ❌ Xóa nội dung
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
                                <?= showInfo::dateDiffInMinutes( $item['timeAt'] ) ?>
                            <?php endif; ?>
                        </small>
                        </p>
                    </section>
                    <?php endforeach; ?>
                <?php endif; ?>
                <section class="add-download">
                    <svg class="border-style" width='100%' height='100%' xmlns='http://www.w3.org/2000/svg'><rect width='100%' height='100%' fill='none' rx='10' ry='10' stroke='#e8e8e8' stroke-width='3' stroke-dasharray='6.5' stroke-dashoffset='56' stroke-linecap='square'/></svg>
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

