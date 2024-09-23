<?php 
    if ( !empty( $dataSql['dataAction'] ) ) :
    $dataAction = $dataSql['dataAction'];
    endif; // Get data 
?>

<main>
    <div class="container" style="background: url('<?= _TEMPLATE ?>images/background/introduction_bg.png')">
    <div class="block"></div>
       <div class="container-action">
            <div class="group-wrapper">
                <div class="group-title">
                    <div class="content">
                        <h3> Thông tin chi tiết bài đăng </h3>
                        <div class="infomation">
                        <span> <b> Mã giao dịch: </b> 
                        <div id="token-trade" style="color: rgb(73, 190, 255)" ><?php if (!empty( $dataAction[0]['token_trade'] )) echo  $dataAction[0]['token_trade']; ?></div>
                            <button id="btn-qr" title="Coppy QR">
                                <i class="fa-solid fa-qrcode"></i>
                            </button> 
                        </span>
                        <span> <b>Thời gian:</b> 
                        <?php if (!empty( $dataAction[0]['time'] )) : ?>
                            <?php showInfo::dateDiffInMinutes( $dataAction[0]['time'] ) ?>
                        <?php endif; ?>
                        </span>
                        </div>
                    </div>
                </div>
                <div class="group-filter">
                    <div class="control">
                        <span> Tìm theo tên </span>
                        <input 
                            type="text" 
                            name="search_sercive" 
                            placeholder="Nhập tên cần tìm">
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
                    <?php if (!empty($dataAction) && $dataAction[0]['money_received'] <= $dataAction[0]['money_agrees']) : ?>
                        <section>
                            <b>Thông báo: </b>        
                            <span> Số tiền bạn thanh toán không đủ, vui lòng nạp thêm</span>
                        </section>
                    <?php else : ?>
                        <?php if (!empty($dataAction[0]['images'])) : ?>
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
                                <i class="fa-regular fa-circle-question"
                                title="Tên của người gửi yêu cầu"></i>

                            </small> </th>
                            <th width="20%"> Tín nhiệm <small>
                                <i class="fa-regular fa-circle-question"
                                title="Độ tín nhiệm dựa vào số bài đăng"></i>

                            </small> </th>
                            <th width="20%"> Giá yêu cầu <small>
                                <i class="fa-regular fa-circle-question"
                                title="Giá người yêu cầu để làm"></i>

                            </small> </th>
                            <th width="20%"> Thời gian <small>
                                <i class="fa-regular fa-circle-question"
                                title="Thời gian gửi yêu cầu"></i>

                            </small> </th>
                            <th width="15%"> Hành động <small>
                                <i class="fa-regular fa-circle-question"
                                title="Xác nhận phê duyệt người này"></i>

                            </small> </th>
                        </tr>
                    </table>
                    <table id="table-content">
                        <?php if (!empty( $dataAction )) : ?>
                            <?php
                                $isTrue = false;
                                foreach( $dataAction as $item )
                                {
                                    if ( $item['status'] === 'XN' ) 
                                    $isTrue = true;
                                }    
                            ?>
                        <?php endif; ?>
                        <tr>
                            <td colspan="<?php echo ( $isTrue ) ? 6 : 5 ?>" class="title"> 
                                <a href="/usego/instruct/read?id=<?php if (!empty( $dataAction[0]['nfId'] )) echo $dataAction[0]['nfId'] ?> "> 
                                <b>Tiêu đề:</b> 
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
                        <?php if (!empty( $dataAction )) : ?>
                            <?php foreach( $dataAction as $item ) : ?>
                                <tr>
                                    <td width="5%"> 
                                        <span> 
                                            <?php if (!empty( $item['stt'] )) echo $item['stt'] ?>
                                        </span> 
                                    </td>
                                    <td width="20%"> 
                                        <a href="/usego/profile/?id=<?= $item['userId'] ?>"> 
                                            <?= showInfo::setFullName($item, 'no_key') ?> 
                                        </a> 
                                    </td>
                                    <td width="20%"> 
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
                                                <?= $item['topic_level'] ?>
                                            </span>
                                        <?php endif; ?>
                                     </td>
                                    <td width="20%"> 
                                        <span>
                                            <?php if (!empty( $item['money_agrees'] )) echo $item['money_agrees'] ?>.000 đ 
                                        </span> 
                                    </td>
                                    <td width="20%"> 
                                        <span>
                                            <?php if (!empty( $item['createAt'] )) echo $item['createAt'] ?>
                                        </span> 
                                    </td>
                                    <td width="15%"> 
                                        <?php if ( $item['status'] === 'XN' ) : ?>
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
                    <?php if (empty( $dataAction )) : ?>
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