<?php require_once ( dirname(__DIR__) . "/templates/layouts/handle/header.getData.php") ?>
<?php
    $statusLogin = new showInfo();
    $dataInfoUser = $statusLogin->checkStatusLogin();

    $dataKeys = ['dataTrade', 'totalTrade', 'totalAmount'];
    
    foreach ($dataKeys as $key) {
        if (!empty($dataSql[$key])) {
            ${$key} = Compact::compactData($dataSql, $key);
        }
    }
?>

<main>
    <div class="container">
        <div class="block"></div>
        <div class="group-wallet">
            <div class="wallet-mains">
                <div class="wallet-main wallet-left">
                    <div class="wallet-bg profile">
                    <img class="poster-avt" 
                    draggable="false"
                    src="<?= _TEMPLATE . 'images/uploads/avatar/' . showInfo::setAvatar($dataInfoUser, 0); ?>" width="96">
                        <button class="b-rules"> 
                        <i class="fa-solid fa-question" style="color: #FFFFFF;"></i>
                        </button>
                        <div class="avatar">
                            <img class="border"
                                src="<?= _TEMPLATE . 'images/icons/Avatar_Frame_Summer_Cool.webp' ?>" width="96" draggable="false">
                            <img class="avt"
                            src="<?= _TEMPLATE . 'images/uploads/avatar/' . showInfo::setAvatar($dataInfoUser, 0); ?>" width="96">
                        </div>
                        <div class="name">
                            <span> <?= showInfo::setFullName($dataInfoUser, 0); ?> </span>
                        </div>
                        <div class="text money">
                            <span>Số dư : 
                                <span id="amountCoin"><?= showInfo::formatCoin($dataInfoUser[0]['coin'] ?? 0 ) ?></span>
                            </span>
                            <img src="<?= _TEMPLATE . 'images/icons/coin.png' ?>" width="21">
                        </div>
                        <div class="action-coin withdraw">
                            <button id="btn-withdraw">
                                <span> Rút tiền </span>
                            </button>
                        </div>
                        <div class="action-coin deposit">
                            <button id="btn-deposit">
                                <span> Nạp tiền </span>
                            </button>
                        </div>
                    </div>
                    <div class="wallet-bg description">
                        <div class="text text-bottom">
                            <span>Tổng giao dịch: 
                                <?= $totalTrade ?? '' ?>
                            </span>
                            <img src="<?= _TEMPLATE . 'images/icons/trade-bag.png' ?>" width="21">
                        </div>
                        <div class="text text-bottom">
                            <span>Tổng giá trị: 
                                <?= showInfo::formatCoin($totalAmount[0]['total']) ?? '' ?>
                            </span>
                            <img src="<?= _TEMPLATE . 'images/icons/clock.png' ?>" width="21">
                        </div>
                    </div>
                </div>
                <div class="wallet-main wallet-right">
                    <div class="history-trade">
                    <?php if (!empty($dataTrade)) : ?>
                        <table>
                            <tr class="title">
                                <th style="text-align: left"> Mã giao dịch </th>
                                <th width="18%"> Hành động </th>
                                <th width="10%"> Số tiền </th>
                                <th width="18%"> Tình trạng </th>
                                <th width="18%"> Thời gian </th>
                                <th width="16%"> Yêu cầu </th>
                            </tr>

                            <?php 
                            $lastDate = '';
                            foreach ($dataTrade as $item) : 
                                $dateTimeString = $item['createAt'] ?? '';
                                $dateTime = new DateTime($dateTimeString);
                                $formattedDate = $dateTime->format('d-m-Y');
                            ?>
                                <?php 
                                if ($formattedDate !== $lastDate) {
                                    echo "<tr class='day-time'><td colspan='6' style='text-align: center;'>
                                    <p>
                                    <svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-star' width='22' height='22' viewBox='0 0 24 24' stroke-width='1.3' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round' style='fill: rgb(255, 174, 31); stroke: rgb(255, 174, 31);'>
                                        <path stroke='none' d='M0 0h24v24H0z' fill='none'></path>
                                        <path d='M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z'></path>
                                    </svg>
                                    Ngày: $formattedDate</p></td></tr>";
                                    $lastDate = $formattedDate; 
                                }
                                ?>
                                <tr>
                                    <td> 
                                        <span class="code-trade"> 
                                            <?= $item['code_trade'] ?? '' ?>
                                        </span>
                                    </td>
                                    <td> 
                                        <span class="
                                                <?php 
                                                if ($item['trade_status'] === 'deposit') { echo 'green'; }
                                                if ($item['trade_status'] === 'withdraw') { echo 'blue'; }
                                                if ($item['trade_status'] === 'payment_deduct') { echo 'red'; }
                                                if ($item['trade_status'] === 'payment_add') { echo 'yellow'; } ?>"> 
                                            <?= $item['trade_message'] ?? '' ?>
                                        </span>
                                    </td>
                                    <td> 
                                        <span>
                                            <?= showInfo::formatCoin($item['coin'] ?? 0) ?>
                                        </span>  
                                    </td>
                                    <td> 
                                        <span class="<?php 
                                                    if ($item['status'] === 'HT') { echo 'green'; }
                                                    if ($item['status'] === 'TB') { echo 'red'; }
                                                    if ($item['status'] === 'XL') { echo 'yellow'; } ?>"> 
                                            <?= $item['status_message'] ?? '' ?>
                                        </span>  
                                    </td>
                                    <td title="<?= $item['createAt'] ?? ''; ?>"> 
                                        <span> 
                                            <?php 
                                                if (!empty($dateTimeString)) {
                                                    echo $dateTime->format('H') . ' giờ ' . $dateTime->format('H') . ' phút'; 
                                                }
                                            ?>
                                        </span>    
                                    </td>
                                    <td> 
                                        <?php 
                                            $status = $item['status'] ?? '';
                                            if ($status === 'HT') {
                                            ?>
                                                <button> 
                                                    <span> Đã xong </span>
                                                </button> 
                                            <?php 
                                            } else if ($status === 'TB') {
                                            ?>
                                                <button id="btn-resend"> 
                                                    <span> Gửi lại </span>
                                                    <small class="icon">
                                                        <i class="fa-solid fa-question" style="color: #000000; transform: translateY(-0.75px)"></i>
                                                    </small>
                                                    <small class="message">
                                                        Thông tin rút tiền không hợp lệ! Vui lòng kiểm tra và thử lại
                                                    </small>
                                                </button> 
                                            <?php 
                                            } else {
                                            ?>
                                                <button> 
                                                    <span> Chờ đợi </span>
                                                </button> 
                                            <?php
                                            } 
                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                        <?php else : ?>
                            <div class="product-lists">
                                <div class="no-posts-yet">
                                    <div class="poster">
                                        <img 
                                        src="<?= _TEMPLATE . 'images/icons/no-value.png' ?>" width="90">
                                    </div>
                                    <span>Chưa có giao dịch nào</span>
                                </div>
                            </div>
                        <?php endif; ?> 
                    </div>
                </div>
                    <!-- Deposit -->
                <div class="upload-wrapper">
                    <!-- Loading -->
                    <div class="loading-wrapper">
                        <img 
                        src="<?= _TEMPLATE . 'images/icons/circle-Loading.gif' ?>" width="70">
                        <span> Đang xử lý... </span>
                    </div>
                    <ul>
                        <li>
                            <section class="item-deposit">
                                <div class="top">
                                    <div class="content">
                                    <img class="poster-title"
                                    draggable="false"
                                    src="<?= _TEMPLATE . 'images/icons/deposit.png' ?>" width="70">
                                        <span class="title"> Nạp Tiền </span>
                                    </div>
                                </div>
                                <div class="bottom">
                                    <section class="title">
                                        <div>
                                        <input 
                                            type="text" 
                                            name="coin_deposit"
                                            placeholder="Nhập số tiền"
                                            class="coin_payment"
                                            required>
                                        </div>
                                        <button class="wallet-tranp" id="accept-deposit">
                                            <span>Xác nhận đã chuyển</span>
                                        </button>
                                    </section>
                                    <section class="item-info-trade">
                                        <div class="infomation">
                                            <div class="full_name stroke-effect">
                                                <span class="hidden">Tên người nhận:</span>
                                                <span class="hidden">PHAM VAN A</span>
                                            </div>
                                            <div class="name_bank stroke-effect">
                                                <span class="hidden">Tên ngâng hàng:</span>
                                                <span class="hidden">MbBank</span>
                                            </div>
                                            <div class="number_bank stroke-effect">
                                                <span class="hidden">Số tài khoản:</span>
                                                <span class="hidden">0000000000</span>
                                            </div>
                                            <div class="number_money stroke-effect">
                                                <span class="hidden">Số tiền nạp:</span>
                                                <span class="hidden">500.000 VND</span>
                                            </div>
                                            <div class="code_trade stroke-effect">
                                                <span class="hidden">Nội dung</span>
                                                <span class="hidden">U10000000000000</span>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </section>
                        </li>
                        <li>
                            <section class="item-qr">
                                <div class="qr-btn">
                                <img class="poster"
                                draggable="false"
                                src="<?= _TEMPLATE . 'images/icons/poster-deposit.avif' ?>" width="70">
                                    <button class="wallet-tranp" id="accept-get-qr">
                                        <span> Lấy Mã QR </span>
                                    </button>
                                </div>
                                <div class="qr-show hidden"></div>
                            </section>
                        </li>
                    </ul>
                </div>
                    <!-- Withdraw -->
                <div class="upload-wrapper">
                    <!-- Loading -->
                    <div class="loading-wrapper">
                        <img 
                        src="<?= _TEMPLATE . 'images/icons/circle-Loading.gif' ?>" width="70">
                        <span> Đang xử lý... </span>
                    </div>
                    <ul>
                        <li>
                            <section class="item-withdraw">
                                <div class="top">
                                    <div class="content">
                                    <img class="poster-title"
                                    style="filter: hue-rotate(210deg)"
                                    draggable="false"
                                    src="<?= _TEMPLATE . 'images/icons/withdraw.png' ?>" width="70">
                                        <span class="title"> Rút tiền </span>
                                    </div>
                                </div>
                                <div class="bottom">
                                    <section class="item-info-withdraw">
                                        <div class="infomation">
                                            <div class="number-money stroke-effect">
                                                <div>
                                                <input 
                                                    type="text" 
                                                    name="coin_withdraw"
                                                    placeholder="Nhập số tiền"
                                                    class="coin_payment"
                                                    required>
                                                </div>
                                            </div>
                                            <div class="full-banks stroke-effect" id="full-banks">
                                                <div class="input hidden">
                                                    <select name="name_bank">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="name-user stroke-effect">
                                                <div>
                                                <input 
                                                    type="text" 
                                                    name="name_user"
                                                    placeholder="Tên tài khoản ngân hàng"
                                                    required>
                                                </div>
                                            </div>
                                            <div class="number-bank stroke-effect">
                                                <div>
                                                <input 
                                                    type="text" 
                                                    name="number_bank"
                                                    placeholder="Số tài khoản ngân hàng"
                                                    required>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <section>
                                        <button class="wallet-tranp" id="accept-withdraw">
                                            <span>Thực hiện rút</span>
                                        </button>
                                    </section>
                                </div>
                            </section>
                        </li>
                        <li>
                            <section class="item-history hidden">
                                <img class="poster"
                                draggable="false"
                                src="<?= _TEMPLATE . 'images/icons/poster-withdraw.avif' ?>" width="70">
                            </section>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</main>