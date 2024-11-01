<?php 
    $dataKeys = ['dataAction', 'requestAction'];
    
    foreach ($dataKeys as $key) {
        if (!empty($dataSql[$key])) {
            ${$key} = Compact::compactData($dataSql, $key);
        }
    }
?>
<main>
    <div class="container">
    <div class="block"></div>
       <div class="container-action">
            <div class="group-wrapper">
                <div class="group-title">
                    <div class="content">
                        <div class="title">
                            <p>- Cho phép hiển thị nội dung này </p>
                            <div class="checkbox <?php echo ( $dataAction[0]['hide'] == 'false' ? 'active' : '' ) ?>" id="btn-hide"></div>
                        </div>
                        <div class="infomation">
                        <span> <p> Mã giao dịch: </s> 
                        <div id="token-trade" style="color: rgb(99, 102, 241);" ><?php if (!empty( $dataAction[0]['token_trade'] )) echo  $dataAction[0]['token_trade']; ?></div>
                            <button id="btn-qr" title="Coppy QR">
                                <i class="fa-solid fa-qrcode"></i>
                            </button> 
                        </span>
                        <span> <p> <i class="fa-regular fa-clock"></i> </p> 
                        <?php if (!empty( $dataAction[0]['createAt'] )) : ?>
                            <?php showInfo::dateDiffInMinutes( $dataAction[0]['createAt'] ) ?>
                        <?php endif; ?>
                        </span>
                        </div>
                    </div>
                </div>
                <div class="group-filter">
                    <div class="control">
                        <span> Tìm kiếm </span>
                        <input 
                            type="text" 
                            name="search_sercive" 
                            placeholder="Nhập tên người dùng">
                    </div>
                    <div class="control">
                        <span> Bộ lọc </span>
                        <select>
                            <option> Giá cao nhất </option>
                            <option> Giá thấp nhất </option>
                        </select>
                    </div>
                </div>
                <div class="group-alert">
                    <?php if (!empty($requestAction) && $requestAction[0]['money_agrees']) : ?>
                        <section>
                            <b> <i class="fa-solid fa-circle-exclamation"></i></b>        
                            <span> Số tiền bạn thanh toán không đủ, vui lòng nạp thêm</span>
                        </section>
                    <?php else : ?>
                        <?php if (!empty($requestAction[0]['images'])) : ?>
                            <section>
                                <b>Thông báo: </b>        
                                <span> Người làm nhiệm vụ đã hoàn thành công việc</span>
                            </section>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="group-action">
                    <table id="table-header">
                        <tr>
                            <th width="5%"> STT </small> </th>
                            <th width="20%"> Tài khoản <small>
                                <i class="fa-solid fa-question" style="transform: translateY(-0.75px); font-weight: 500; font-size: 12px"
                                title="Thông tin của người gửi yêu cầu"></i>
                            </small> </th>
                            <th width="15%"> Tín nhiệm <small>
                                <i class="fa-solid fa-question" style="transform: translateY(-0.75px); font-weight: 500; font-size: 12px"
                                title="Độ tín nhiệm dựa vào số bài đăng"></i>
                            </small> </th>
                            <th width="15%"> Hoàn thành <small>
                                <i class="fa-solid fa-question" style="transform: translateY(-0.75px); font-weight: 500; font-size: 12px"
                                title="Tổng yêu cầu dịch vụ hoàn thành"></i>
                            </small> </th>
                            <th width="15%"> Giá yêu cầu <small>
                                <i class="fa-solid fa-question" style="transform: translateY(-0.75px); font-weight: 500; font-size: 12px"
                                title="Giá người yêu cầu để làm"></i>
                            </small> </th>
                            <th width="15%"> Thời gian <small>
                                <i class="fa-solid fa-question" style="transform: translateY(-0.75px); font-weight: 500; font-size: 12px"
                                title="Thời gian gửi yêu cầu"></i>
                            </small> </th>
                            <th width="15%"> Hành động <small>
                                <i class="fa-solid fa-question" style="transform: translateY(-0.75px); font-weight: 500; font-size: 12px"
                                title="Xác nhận phê duyệt người này"></i>
                            </small> </th>
                        </tr>
                    </table>
                    <table id="table-content">
                        <?php if (!empty( $requestAction )) : ?>
                            <?php
                                $isTrue = false;
                                foreach( $requestAction as $item )
                                {
                                    if ( $item['status'] === 'XN' ) 
                                    $isTrue = true;
                                }    
                            ?>
                        <?php endif; ?>
                        <tr>
                            <td colspan="<?php echo ( $isTrue ) ? 6 : 5 ?>" class="title"> 
                                <b>Tiêu đề:</b> 
                                <a href="/usego/instruct/read?id=<?php if (!empty( $dataAction[0]['nfId'] )) echo $dataAction[0]['nfId'] ?> "> 
                                <?php if (!empty( $dataAction[0]['title'] )) echo $dataAction[0]['title'] ?> 
                                </a> 
                            </td>
                            <?php if ( !empty( $isTrue ) && !$isTrue ) : ?>
                            <td width="15%">   
                                <button id="remove-service">
                                    <span> Xóa bỏ </span>
                                </button>
                            </td>
                            <?php endif; ?>
                        </tr>
                        <?php if (!empty( $requestAction )) : ?>
                            <?php $count = 1; foreach( $requestAction as $item ) : ?>
                                <tr>
                                    <td width="5%" data-id="<?= $item['id_server'] ?? '' ?>"> 
                                        <span> 
                                            <?= $count++ ?? '' ?>
                                        </span> 
                                    </td>
                                    <td width="20%"> 
                                        <a href="/usego/profile/?id=<?= $item['user_id'] ?>"> 
                                            <img class="avt-zoom" 
                                                src="<?= _TEMPLATE . 'images/uploads/avatar/' . $item['avatar'] ?? ''  ?>" 
                                                onerror="this.src='<?php echo _TEMPLATE . 'images/icons/not-images.png'; ?>'"
                                                width="40">
                                            <?= showInfo::setFullName($item, 'no_key') ?> 
                                        </a> 
                                    </td>
                                    <td width="15%"> 
                                        <?php if (!empty( $item['topic_level'] )) : ?>
                                            <?php
                                                $regime = '';
                                                switch( $item['topic_level'] ) {
                                                    case 'Cao':
                                                        $regime = 'high';
                                                        break;
                                                    
                                                    case 'Trung bình':
                                                        $regime = 'medium';
                                                        break;
                                                    
                                                    case 'Thấp':
                                                        $regime = 'short';
                                                        break;

                                                    default: 'Không xác định';
                                                }; 
                                            ?>
                                            <span class="<?= $regime ?>">  
                                                <?= $item['topic_level'] ?? '' ?>
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td width="15%"> 
                                        <span> 
                                            <?= $item['total_server'] ?? 'No data' ?> Dich vụ
                                        </span> 
                                    </td>
                                    <td width="15%"> 
                                        <span>
                                            <?= showInfo::formatCoin($item['money_agrees'] ?? 0 ) ?>
                                        </span> 
                                    </td>
                                    <td width="15%"> 
                                        <span>
                                            <?= $item['createAt'] ?? '' ?>
                                        </span> 
                                    </td>
                                    <td width="15%"> 
                                        <?php if ( $item['status'] === 'XN' || $item['status'] === 'HT' ) : ?>
                                            <button class="btn-active" 
                                                data-id="<?php if (!empty( $item['userId'] )) echo $item['userId'] ?>">
                                                <span> Đã xác nhận </span>
                                            </button>   
                                        <?php else : ?>
                                            <button class="<?php echo ( !$isTrue ) ? 'btn-action-cf' : 'nothover' ?>" 
                                                data-id="<?php if (!empty( $item['userId'] )) echo $item['userId'] ?>">
                                                <span> Xác nhận </span>
                                            </button>   
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </table>
                    <?php if (empty( $requestAction )) : ?>
                        <div class="product-lists" data-temp="<?= _TEMPLATE ?>">
                            <div class="no-posts-yet">
                                <div class="poster">
                                    <img 
                                    src="<?= _TEMPLATE . 'images/icons/no-value.png' ?>" width="90">
                                </div>
                                <span> Chưa có yêu cầu nào </span>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
       </div>
    </div>
    <div id="modal-qr">
    <article>
        <section>
            <img src="">
        </section>
        <section>
            <button id="btn-cancel-qr"> Hủy bỏ </button>
            <button id="btn-confirm-qr"> Đã chuyển </button>
        </section>
    </article>
    </div>
</main>