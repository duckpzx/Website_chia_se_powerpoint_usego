<?php 
    $getActionParams = new App();
    $arrayCrumbs = $getActionParams->urlProcess();

    $dataKeys = ['dataRead', 'dataService', 'dataServiceOnwer'];
    
    foreach ($dataKeys as $key) {
        if (!empty($dataSql[$key])) {
            ${$key} = Compact::compactData($dataSql, $key);
        }
    }
?>

<main>
    <div class="container">
            <div class="block"></div>
            <div class="show-item-kind">
                <img class="show-item-banner" src="<?= _TEMPLATE . 'images/icons/banner_website_pro.jpeg' ?>">
            </div>
            <div class="news-header">
                <div class="path-crumbs">
                    <div class="category-header">
                        <div class="part-crumbs">
                            <ul>
                                <a href="/usego">
                                    <li>Usego <i class="fa-solid fa-angle-right"></i></li>
                                </a>
                                <?php foreach ($arrayCrumbs as $key => $crumb): ?>
                                    <li>
                                        <?php if ($key < count($arrayCrumbs) - 1): ?>
                                            <a href="/usego/<?= $crumb ?>" class="title">
                                                <?= $crumb ?>
                                                <i class="fa-solid fa-angle-right"></i>
                                            </a>
                                        <?php else: ?>
                                            <a href="#" class="title param"><?= $crumb ?></a>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="wrapper">
                        <div class="news-main">
                            <div class="content">
                                <h3>Cộng Đồng Usego Hướng Tới</h3>
                                <span>Sự tiện lợi, xu hướng, thiết kế kết hợp ba trong một</span>
                            </div>
                            <div class="buttons">
                                <button class="border-main" id="talk-read">Mới nhất</button>
                                <button class="border-main" id="talk-other">Bài viết khác</button>
                            </div>
                        </div>
                        <div class="header-image">
                            <img class="poster" src="<?= _TEMPLATE . 'images/icons/top-banner-news-winter.jpg' ?>" width="200">
                            <button>
                                <img src="<?= _TEMPLATE . 'images/icons/author-setting.png' ?>" width="30">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br/>
        <div class="detail-talk">
        <div class="news-item">
            <div class="date-item">
                <div class="button-wraps">
                    <article>
                        <section>
                            <?php if (!showInfoYourSelf::checkYourSelf($dataRead[0]['userId'])) : ?>
                                <div class="cf-status">
                                    <?php if (!empty($dataService)) : ?>
                                        <span class="<?= $dataService[0]['status'] === 'PD' ? 'wait' : 'success'; ?>">
                                            <?= $dataService[0]['status'] === 'PD' ? 'Đang chờ duyệt' : 'Đã được chọn'; ?>
                                        </span>
                                    <?php else : ?>
                                        <span class="error">Chưa gửi yêu cầu</span>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </section>
                        <section>
                            <div class="cf-result">
                                <span class="<?= $dataSql['dataStatus'] === 0 ? 'wait' : 'success'; ?>">
                                    <?= $dataSql['dataStatus'] === 0 ? 'Công việc chưa được hoàn thành' : 'Công việc đã được hoàn thành'; ?>
                                </span>
                            </div>
                        </section>
                    </article>
                    <article>
                        <section>
                            <span>Lượt xem:</span>
                            <span><?= !empty($dataRead[0]['view']) ? $dataRead[0]['view'] : ''; ?></span>
                        </section>
                        <section class="author-id">
                            <span data-id="<?= !empty($dataRead[0]['userId']) ? $dataRead[0]['userId'] : ''; ?>">Tác giả:</span>
                            <a href="/usego/profile/?id=<?= $dataRead[0]['userId'] ?? ''; ?>">
                                <?= !empty($dataRead[0]['firstName']) ? showInfo::setFullName($dataRead, 0) : ''; ?>
                            </a>
                        </section>
                    </article>
                </div>
            </div>
            <div class="content" id="content">
                <h2><p><?= !empty($dataRead) ? showInfo::setInfomation($dataRead, 'title') : ''; ?></p></h2>
                <div class="des">
                    <span><?= !empty($dataRead) ? showInfo::setInfomation($dataRead, 'content') : ''; ?></span>
                </div>
            </div>
        </div>

        <?php if (!empty($dataRead[0]['topic']) && $dataRead[0]['topic'] == 'service') : ?>
            <div class="confirm-wrapper">
                <article>
                    <button title="Ẩn phần này đi" class="hide-icons-content">
                        <i class="fa-solid fa-eye-slash"></i>
                    </button>
                </article>

                <?php if (!showInfoYourSelf::checkYourSelf($dataRead[0]['userId'])) : ?>
                    <?php if (empty($dataService[0]['status'])) : ?>
                        <article>
                            <input type="text" name="money" placeholder="Giá nhận">
                        </article>
                    <?php endif; ?>
                    
                    <article>
                        <?php if (!empty($dataService)) : ?>
                            <button id="<?= $dataService[0]['status'] === 'XN' ? 'confirmed-post' : 'revert-confirm'; ?>" 
                                    title="<?= $dataService[0]['status'] === 'XN' ? 'Bạn đã được xác nhận làm công việc này' : 'Nếu không thể làm hay hủy bỏ công việc'; ?>">
                                <span><?= $dataService[0]['status'] === 'XN' ? 'Đã xác nhận' : 'Hủy bỏ yêu cầu'; ?></span>
                            </button>
                        <?php else : ?>
                            <button id="<?= $dataRead[0]['status'] !== 'XN' ? 'confirm-post' : ''; ?>"
                                    title="<?= $dataRead[0]['status'] !== 'XN' ? 'Gửi yêu cầu tới người dùng này' : 'Tác giả đã chọn được người'; ?>">
                                <span><?= $dataRead[0]['status'] !== 'XN' ? 'Gửi yêu cầu' : 'Đã có người được chọn'; ?></span>
                            </button>
                        <?php endif; ?>
                    </article>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
    <div id="template" data-template="<?= _TEMPLATE . 'images/uploads/proof-images/' ?>" hidden></div>
<?php
    function renderImageList($images) {
    $arrayImage = showInfo::analysis2Character($images);
    ?>
    <div class="seriver-wrapper">
        <ul id="lists-proof">
            <?php foreach ($arrayImage as $image): ?>
                <li class="item-proof">
                    <img 
                        class="lazyload" 
                        loading="lazy" 
                        data-src="<?= _TEMPLATE . 'images/uploads/proof-images/' . $image; ?>" 
                        onerror="this.src='<?= _TEMPLATE . 'images/icons/not-image.png'; ?>'"
                    >
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php
}

if (!empty($dataService) && ($dataService[0]['status'] === 'XN' || $dataService[0]['status'] === 'TB') && empty($dataService[0]['images'])) : ?>
    <div class="detail-talk" id="detail-proof">
        <div class="seriver-wrapper">
            <div class="modal">
                <div class="modal-body">
                    <label for="upload-proof">
                        <div class="upload-area">
                            <svg class="border-style" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                                <rect width="100%" height="100%" fill="none" rx="10" ry="10" stroke="#e8e8e8" stroke-width="3" stroke-dasharray="6.5" stroke-dashoffset="56" stroke-linecap="square"></rect>
                            </svg>
                            <span class="upload-area-icon">
                                <img src="<?= _TEMPLATE . 'images/icons/camera.png' ?>" width="50">
                            </span>
                            <span class="upload-area-description">Vui lòng tải lên 1 File</span>
                        </div>
                    </label>
                    <input id="upload-proof" type="file" hidden>
                </div>
                <div class="modal-footer">
                    <button class="btn-secondary">Hủy bỏ</button>
                    <button class="btn-primary" id="btn-proof">Đăng tải</button>
                </div>
            </div>
            <div class="loading-ss">
                <img src="<?= _TEMPLATE . 'images/icons/circle-Loading.gif' ?>" width="40">
            </div>
        </div>
    </div>
<?php endif; ?>

<?php 
if (!empty($dataService) && ($dataService[0]['status'] === 'XN' || $dataService[0]['status'] === 'TB' || $dataService[0]['status'] === 'HT') && !empty($dataService[0]['images'])) :
    renderImageList($dataService[0]['images']);
    endif; 
?>

<?php if (showInfoYourSelf::checkYourSelf($dataRead[0]['userId']) && !empty($dataServiceOnwer[0]['images'])) : ?>
    <?php renderImageList($dataServiceOnwer[0]['images']); ?>
    <div class="detail-talk">
        <div class="seriver-wrapper">
            <section>
                <?php if (!empty($dataServiceOnwer)) : ?>
                    <?php 
                    $status = $dataServiceOnwer[0]['status'];
                    $isUserSelf = showInfoYourSelf::checkYourSelf($dataRead[0]['userId']);
                    ?>

                    <?php if ($status === 'XN') : ?>
                        <?php if ($isUserSelf) : ?>
                            <button class="border-main error" id="btn-not-satisfied">
                                <span>Không hài lòng</span>
                            </button>
                            <button class="border-main success" id="btn-satisfied">
                                <span>Tôi hài lòng</span>
                            </button>
                        <?php else : ?>
                            <button class="border-main error" id="btn-remove-satisfied">
                                <span>Thu hồi lại</span>
                            </button>
                        <?php endif; ?>

                    <?php elseif ($status === 'HT') : ?>
                        <button class="border-main success">
                            <span>Hoàn thành, Tôi hài lòng</span>
                        </button>

                    <?php else : ?>
                        <button class="border-main error">
                            <span>Thất bại, Không hài lòng</span>
                        </button>
                    <?php endif; ?>
                <?php else : ?>
                    <p>Không có dữ liệu dịch vụ.</p>
                <?php endif; ?>
            </section>
        </div>
    </div>
<?php endif; ?>


<?php 
if (showInfoYourSelf::checkYourSelf($dataRead[0]['userId']) && empty($dataServiceOnwer[0]['images'])) : ?>
    <div class="detail-talk">
        <div class="seriver-wrapper">
            <div class="product-lists">
                <div class="no-posts-yet">
                    <div class="poster">
                        <img src="<?= _TEMPLATE . 'images/icons/no-value.png' ?>" width="90">
                    </div>
                    <span> Chưa có dữ liệu nào </span>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
</div>
</main>