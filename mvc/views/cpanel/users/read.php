<?php 
    $getActionParams = new App();
    $arrayCrumbs = $getActionParams->urlProcess();

    if(!empty($dataSql['dataRead'])) :
    $dataRead = Compact::compactData($dataSql, 'dataRead');
    endif;  

    if(!empty($dataSql['dataService'])) :
    $dataService = Compact::compactData($dataSql, 'dataService');
    endif; 

    
    if(!empty($dataSql['dataServiceOnwer'])) :
    $dataServiceOnwer = Compact::compactData($dataSql, 'dataServiceOnwer');
    endif; 
?>
<main>
    <div class="container">
        <div class="block"></div>
        <div class="show-item-kind">
        <img class="show-item-banner"
            src="<?= _TEMPLATE . 'images/icons/banner_website_pro.jpeg' ?>">
        </div>
        <div class="news-header">
            <div class="path-crumbs">
                <div class="category-header">
                    <div class="part-crumbs">
                        <ul>
                            <a href="/usego">
                                <li>Usego <i class="fa-solid fa-angle-right"></i></li>
                            </a>
                            <?php $totalCrumbs = count($arrayCrumbs); ?>
                            <!-- sum element array -->
                            <?php foreach( $arrayCrumbs as $key => $crumb ): ?>
                                <?php if ( $key < $totalCrumbs - 1 ): ?>
                                    <li>
                                        <a href="/usego/<?= $crumb ?>" class="title">
                                            <?= $crumb ?>
                                            <i class="fa-solid fa-angle-right"></i>
                                        </a>
                                    </li>
                                <?php else: ?>
                                    <li>
                                        <a href="#" class="title param">
                                            <?= $crumb ?>    
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="wrapper">
                    <div class="news-main">
                        <div class="content">
                            <h3> Cộng Đồng Usego Phát Triển </h3>
                            <span>Xu hướng và thông tin ngành thiết kế trong một </span>
                        </div>
                        <div class="buttons">
                            <button class="border-main" id="talk-read"> Mới nhất </button>
                            <button class="border-main" id="talk-other"> Bài viết khác </button>
                        </div>
                    </div>
                    <div class="header-image">
                        <img 
                        src="<?= _TEMPLATE . 'images/icons/top-banner-news-winter.jpg' ?>" 
                        width="200">
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
                                <?php if (!showInfoYourSelf::checkYourSelf( $dataRead[0]['userId'] )) : ?>
                                <div class="cf-status"> 
                                    <?php if ( !empty( $dataService ) ) : ?>
                                        <?php if ( $dataService[0]['status'] === 'PD' ) : ?>
                                            <span class="wait"> Đang chờ duyệt </span>
                                        <?php endif; ?>
                                        <?php if ( $dataService[0]['status'] === 'XN' ) : ?>
                                            <span class="success"> Đã được chọn </span>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <span class="error"> Chưa gửi yêu cầu </span>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>
                            </section>
                            <section>
                                <div class="cf-result">
                                    <?php if ( $dataSql['dataStatus'] === 0 ) : ?>
                                        <span class="wait">
                                            Công việc chưa được hoàn thành
                                        </span>
                                        <?php else : ?>
                                        <span class="success">
                                            Công việc đã được hoàn thành
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </section>
                        </article>
                        <article>
                            <section>
                                <span>Lượt xem: </span>
                                <span> 
                                    <?php if (!empty( $dataRead[0]['view'] )) : ?>
                                        <?= $dataRead[0]['view'] ?>
                                    <?php endif; ?>
                                </span>
                            </section>
                            <section class="author-id">
                                <span data-id="<?php if (!empty( $dataRead[0]['userId'] )) echo $dataRead[0]['userId']; ?>">Tác giả: </span>
                                <a href="/usego/profile/?id=<?php if (!empty( $dataRead[0]['userId'] )) echo $dataRead[0]['userId']; ?>">
                                    <?php if (!empty( $dataRead[0]['firstName'] )) : ?>
                                        <?= showInfo::setFullName( $dataRead, 0 ); ?>
                                    <?php endif; ?>
                                </a>
                            </section>
                        </article>
                    </div>
                </div>
                <div class="content" id="content">
                    <h2>
                    <p>
                    <?php if (!empty( $dataRead )) echo showInfo::setInfomation($dataRead, 'title'); ?>
                    </p>
                    </h2>
                    <div class="des">
                        <span>
                        <?php if (!empty( $dataRead )) echo showInfo::setInfomation($dataRead, 'content'); ?>
                        </span>
                    </div>
                </div>
            </div>
            <?php if ( !empty( $dataRead[0]['topic'] ) && $dataRead[0]['topic'] == 'service' ) : ?>
                <div class="confirm-wrapper">
                    <?php if ( showInfoYourSelf::checkYourSelf( $dataRead[0]['userId'] ||
                    $dataService[0]['status'] === 'XN')) : ?>
                        <article>
                            <button title="Ẩn phần này đi" 
                                class="hide-icons-content">
                                <i class="fa-solid fa-eye-slash"></i>
                            </button>
                        </article>
                    <?php endif; ?>
                    <?php if (!showInfoYourSelf::checkYourSelf( $dataRead[0]['userId'] )) : ?>
                        <?php if ( empty( $dataService[0]['status'] ) ) : ?>
                            <article>
                                <input type="text" name="money" placeholder="Giá nhận làm">
                            </article>
                            <article>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if (!showInfoYourSelf::checkYourSelf( $dataRead[0]['userId'] )) : ?>
                    <?php if ( !empty( $dataService ) ) : ?>
                        <?php if ( $dataService[0]['status'] === 'XN' ) : ?>
                            <button id="confirmed-post" 
                            title="Bạn đã được xác nhận làm công việc này">
                                <span>Đã xác nhận</span>
                            </button>
                        <?php else : ?>
                            <button id="revert-confirm"
                            title="Nếu không thể làm hay hủy bỏ công việc">
                                <span>Hủy bỏ yêu cầu</span>
                            </button>
                        <?php endif; ?>
                    <?php else : ?>
                        <?php if ( $dataRead[0]['status'] === 'XN' ) : ?>
                            <button id="confirm-post"
                            title="Gửi yêu cầu tới người dùng này">
                                <span>Gửi yêu cầu</span>
                            </button>
                        <?php else : ?>
                            <button
                            title="Tác giả đã chọn được người">
                                <span> Đã có người được chọn </span>
                            </button>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php endif; ?>
                    </article>
                </div>
            <?php endif; ?>
        </div>
        <div id="template" data-template="<?= _TEMPLATE . 'images/uploads/proof-images/' ?>" hidden></div>
        <?php if (!empty($dataService[0]['status']) && 
            $dataService[0]['status'] === 'XN' &&
            empty($dataService[0]['images'])) : ?>
        <div class="detail-talk" id="detail-proof">
            <div class="seriver-wrapper">
                <div class="modal">
                    <div class="modal-body">
                        <label for="upload-proof">
                            <div class="upload-area">
                                <span class="upload-area-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="340.531" height="419.116" viewBox="0 0 340.531 419.116">
                            <g id="files-new" clip-path="url(#clip-files-new)">
                                <path id="Union_2" data-name="Union 2" d="M-2904.708-8.885A39.292,39.292,0,0,1-2944-48.177V-388.708A39.292,39.292,0,0,1-2904.708-428h209.558a13.1,13.1,0,0,1,9.3,3.8l78.584,78.584a13.1,13.1,0,0,1,3.8,9.3V-48.177a39.292,39.292,0,0,1-39.292,39.292Zm-13.1-379.823V-48.177a13.1,13.1,0,0,0,13.1,13.1h261.947a13.1,13.1,0,0,0,13.1-13.1V-323.221h-52.39a26.2,26.2,0,0,1-26.194-26.195v-52.39h-196.46A13.1,13.1,0,0,0-2917.805-388.708Zm146.5,241.621a14.269,14.269,0,0,1-7.883-12.758v-19.113h-68.841c-7.869,0-7.87-47.619,0-47.619h68.842v-18.8a14.271,14.271,0,0,1,7.882-12.758,14.239,14.239,0,0,1,14.925,1.354l57.019,42.764c.242.185.328.485.555.671a13.9,13.9,0,0,1,2.751,3.292,14.57,14.57,0,0,1,.984,1.454,14.114,14.114,0,0,1,1.411,5.987,14.006,14.006,0,0,1-1.411,5.973,14.653,14.653,0,0,1-.984,1.468,13.9,13.9,0,0,1-2.751,3.293c-.228.2-.313.485-.555.671l-57.019,42.764a14.26,14.26,0,0,1-8.558,2.847A14.326,14.326,0,0,1-2771.3-147.087Z" transform="translate(2944 428)"/>
                            </g>
                            </svg>
                                </span>
                                <span class="upload-area-description">
                                    Vui lòng tải lên 1 File PPTX
                                </span>
                            </div>
                        </label>
                        <input id="upload-proof" type="file" hidden>
                    </div>
                    <div class="modal-footer">
                        <button class="btn-secondary">Hủy bỏ</button>
                        <button class="btn-primary" id="btn-proof">Đăng tải</button>
                    </div>
                </div>
                <!-- Laoding -->
                <div class="loading-ss">
                    <img src="<?= _TEMPLATE . 'images/icons/circle-Loading.gif' ?>" width="40">
                </div>
            </div> 
        </div>
        <?php endif; ?>
        <?php if (!empty($dataService[0]['status']) &&
        $dataService[0]['status'] === 'XN' && 
        !empty($dataService[0]['images'])) : ?>
            <div class="seriver-wrapper">
                <?php $arrayImage = showInfo::analysis2Character($dataService[0]['images']); ?>
                <ul id="lists-proof">
                    <?php foreach($arrayImage as $image) : ?>
                        <li class="item-proof">
                        <img class="lazyload" loading="lazy" 
                            data-src="<?= _TEMPLATE . 'images/uploads/proof-images/' . $image ?>"
                            onerror="this.src='<?= _TEMPLATE . 'images/icons/not-image.png' ?>'">
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <?php if (showInfoYourSelf::checkYourSelf( $dataRead[0]['userId'] ) &&
        !empty($dataServiceOnwer[0]['images'])) : ?>
            <div class="seriver-wrapper">
                <?php $arrayImage = showInfo::analysis2Character($dataServiceOnwer[0]['images']); ?>
                <ul id="lists-proof">
                    <?php foreach($arrayImage as $image) : ?>
                        <li class="item-proof">
                        <img class="lazyload" loading="lazy" 
                            data-src="<?= _TEMPLATE . 'images/uploads/proof-images/' . $image ?>"
                            onerror="this.src='<?= _TEMPLATE . 'images/icons/not-image.png' ?>'">
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="detail-talk">
                <div class="seriver-wrapper">
                    <section>
                        <button class="border-main" id="btn-not-satisfied">
                            <span> Không hài lòng </span>
                        </button>
                        <button class="border-main" id="btn-satisfied">
                            <span> Tôi hài lòng </span>
                        </button>
                    </section>
                </div>
            </div>
        <?php endif; ?>
        <?php if (showInfoYourSelf::checkYourSelf( $dataRead[0]['userId'] )) : ?>
            <?php if ( empty( $dataServiceOnwer[0]['images'] ) ) : ?>
                <div class="detail-talk">
                    <div class="seriver-wrapper">
                        <div class="product-lists">
                            <div class="no-posts-yet">
                                <div class="poster">
                                    <img 
                                    src="<?= _TEMPLATE . 'images/icons/no-value.png' ?>" width="90">
                                </div>
                                <span> Chưa có dữ liệu nào </span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
        </div>
</main>