const btnRules = $('.b-rules');

const btnDeposit = $('#btn-deposit');
const btnAcceptDeposit = $('#accept-deposit');

const btnWithdraw = $('#btn-withdraw');
const btnAcceptWithdraw = $('#accept-withdraw');

const amountCoin = $('#amountCoin');

let isPrepare = false;
const btnAcceptGetQR = $('#accept-get-qr');
const inputPayments = $$('.coin_payment');
const inputCoinDeposit = $('input[name="coin_deposit"]');
const inputCoinWidthdraw = $('input[name="coin_withdraw"]');

// Widthdraw 
const inputNameUser = $('input[name="name_user"');
const inputNumberBank = $('input[name="number_bank"');

let storageDataTrade = JSON; 

function loadingPayment(type) {
    TypeClass.class(type, $('.loading-wrapper'), 'show');
}

function contentChangeRules() {
    const title = 'Hướng dẫn, nạp và rút tiền';

    const html = `
        <div class="instruct">
            <div class="text">
                <b class="ins-title"> Hướng dẫn rút tiền </b>
                <span class="ins-content">
                   <b>Lưu ý: </b> Nếu sau 12h từ khi rút tiền không nhận được hãy liên hệ admin
                </span>
                <span class="ins-content">
                   Zalo: Pham Duc hoặc Fanpage Qr bên trang chúng tôi 
                </span>
            </div>
            <img 
            src="${ AlertUsego.template() }images/icons/rules_withdraw.png" 
            width="200">
            <div class="text">
                <b class="ins-title"> Hướng dẫn nạp tiền </b>
                <span class="ins-content">
                   <b>Lưu ý: </b> Nếu sau khi thanh toán mà vẫn không thành công vui lòng bấm lại nút <b>Xác nhận đã chuyển <b>
                </span>

                <span class="ins-content">
                   <b>Chú ý: </b> Số tiền nạp phải lớn hơn 1.000 VND 
                </span>
            </div>
            <img 
            src="${ AlertUsego.template() }images/icons/deposit_rules_01.png" 
            width="200">
        </div>
    `;

    return [title, html];
}

function IdentifyPayment( type, status ) {
    const identify = ( type === 'add' ) ? 'add' : 'remove';
    const identifyActionHtml = ( type === 'add' ) ? 'yes' : 'no';

    const index = ( status === 'deposit' ) ? 0 : 1;
    const element = $$('.upload-wrapper')[index];

    TypeClass.class(`${ identify }`, element, 'show');
    TypeClass.class(`${ identify }`, $('.modal-overlay'), 'show');
    NoScrollHTML.noScroll(`${ identifyActionHtml }`);
}

async function handleQR(data) {
    const stk = data.number_bank;
    const name = data.full_name;
    const bank = data.name_bank;
    const moneyAgrees = data.number_money;
    const codeTrade = data.code_trade;

    const urlQR = `https://qr.ecaptcha.vn/api/generate/${bank}/${stk}/${name}?amount=${moneyAgrees}&memo=${codeTrade}&is_mask=0&bg=14`;

    try {
        const response = await fetch(urlQR);
        if (!response.ok) {
            throw new Error(`Lỗi: ${response.status} - ${response.statusText}`);
        }
        const html = `
            <img src="${urlQR}" width="150">
        `;
        const qrShow = $('.qr-show');
        TypeClass.class('remove', qrShow, 'hidden');
        qrShow.innerHTML = html;

        return urlQR;
    } catch (error) {
        cuteToast({
            type: "error",
            title: "Lỗi",
            message: 'Không thể tạo mã QR, thử lại sau',
            timer: 3500
        });
    }
}

function renderInfoTrade( data ) {
    const html = `
    <div class="infomation">
        <div class="full_name stroke-effect">
            <span>Tên người nhận</span>
            <b>${ data.full_name }</b>
        </div>
        <div class="name_bank stroke-effect">
            <span>Tên ngâng hàng</span>
            <b>${ data.name_bank + ' Bank' }</b>
        </div>
        <div class="number_bank stroke-effect">
            <span>Số tài khoản</span>
            <b>${ data.number_bank }</b>
        </div>
        <div class="number_money stroke-effect">
            <span>Số tiền nạp</span>
            <b>${ data.number_money + ' Đồng' }</b>
        </div>
        <div class="code_trade stroke-effect">
            <span>Nội dung</span>
            <b>${ data.code_trade }</b>
        </div>
    </div>
    `;

    $('.item-info-trade').innerHTML = html;
}

function handleDataDeposit() {
    const amount = inputCoinDeposit.value.replace(/[^0-9,.]/g, '');
    
    if ( amount && amount.replace(/\./g, '') > 999 ) {
        const data = {
            'coin': amount,
            'class': 'PrepareDeposit'
        };
    
        CallAjax.send('POST', data, 'talk/mvc/core/HandleWallet.php', function (response) {
            const dataJson = CallAjax.get( response, 'off' );
            try {
                if ( dataJson.err_mess ) {
                    loadingPayment('add');
                    renderInfoTrade( dataJson.err_mess );
                    storageDataTrade = dataJson.err_mess;
                    storageDataTrade.image_qr = handleQR( dataJson.err_mess );
                    isPrepare = true; 
                    loadingPayment('remove');
                }
            } catch (error) {
                console.log(error);
            }
        });
    }
    else {
        cuteToast({
            type: "error",
            title: "Lỗi, không hợp lệ",
            message: 'Số tiền phải lớn hơn 1.000 VND',
            timer: 3500
        });
    }
}

function handleAcceptDeposit() {
    if ( isPrepare ) {
        loadingPayment('add');

        let paymentTimeout = null;
    
        if ( paymentTimeout === null ) {
            paymentTimeout = setTimeout(() => {
                const data = {
                    'code_trade': storageDataTrade.code_trade,
                    'coin': storageDataTrade.number_money,
                    'image_qr': storageDataTrade.image_qr,
                    'class': 'AcceptDeposit'
                };
            
                CallAjax.send('POST', data, 'talk/mvc/core/bin/ImapEmail.php', function (response) {
                    const dataJson = CallAjax.get( response, 'off' ).err_mess;
                    try {
                        if ( dataJson ) {
                            const code = ( dataJson.code === 0 ) ? 'error' : 'success';
                            const code_title = ( dataJson.code === 0 ) ? 'Thất bại' : 'Thành công';
                            cuteToast({
                                type: code,
                                title: code_title,
                                message: dataJson.message,
                                timer: 3500
                            });
                        }
                    } catch (error) {
                        console.log(error);
                    }
                    loadingPayment('remove');
                });
            }, 10500);
        }
    } else {
        cuteToast({
            type: "error",
            title: "Lỗi",
            message: 'Vui lòng chuyển tiền trước',
            timer: 3500
        });
    }
}

function showErrorInput(input, type = 'empty', value, balance) {
    const parent = input.parentNode;
    let message = null;

    if (type === 'balance') {
        const moneyValue = parseFloat(value.replace(/\s+/g, '')); 
        
        if (!input.value.trim()) {
            message = 'Không được để trống';
        } else if (moneyValue > balance) {
            message = 'Vượt quá số dư';
        } else if (moneyValue < 1000) {
            message = 'Phải lớn hơn 1.000';
        }
    } else {
        if (!input.value.trim()) {
            message = 'Không được để trống';
        }
    }

    const existingAlert = parent.querySelector('.error-input');
    
    if (message) {
        if (existingAlert) existingAlert.remove();
        const alert = `
            <span class="error-input" style="position: absolute; display: flex; align-items: center; padding: 0 10px; right: 5px; top: 0; border-radius: 0 4px 4px 0; height: 100%; font-size: 14.5px; padding-left: 50px; background: linear-gradient(to left, rgb(253, 237, 232) 60%, transparent); color: rgb(250, 137, 107); cursor: not-allowed;">
                ${message}
            </span>`;
        parent.insertAdjacentHTML('beforeend', alert);
    } else if (existingAlert) {
        existingAlert.remove();
    }
}

function handleAcceptWithdraw(balance) {
    const coin = inputCoinWidthdraw.value.replace(/[^0-9,.]/g, '');
    
    function isFormValid(coin, bankName, userName, numberBank) {
        return (
            coin.length > 0 &&
            bankName.value.length > 0 &&
            userName.value.length > 0 &&
            numberBank.value.length > 0
        );
    }

    const selectNameBank = $('select[name="name_bank"]');
    // Name bank 
    if (isFormValid(coin, selectNameBank, inputNameUser, inputNumberBank)) {
        const amount = parseFloat(coin.replace(/\./g, ''));
        if ( amount && amount > 999 && amount <= balance ) {
            const data = {
                'coin': amount,
                'name_bank': selectNameBank.value,
                'number_bank': inputNumberBank.value,
                'name_user': inputNameUser.value,
                'class': 'AcceptWithdraw'
            };

            CallAjax.send('POST', data, 'talk/mvc/core/HandleWallet.php', function (response) {
                const dataJson = CallAjax.get( response, 'off' );
                const code = ( dataJson.code === 0 ) ? 'error' : 'success';
                const code_title = ( dataJson.code === 0 ) ? 'Không hợp lệ' : 'Thành công';
                const message = ( dataJson.err_mess.message ) ? dataJson.err_mess.message : dataJson.err_mess;
                try {
                    if ( dataJson ) {
                        cuteToast({
                            type: code,
                            title: code_title,
                            message: message,
                            timer: 3500
                        });
                        if ( dataJson.err_mess.amount )
                            amountCoin.textContent = dataJson.err_mess.amount;
                    }
                } catch (error) {
                    console.log(error);
                }
            });
        }
        else {
            cuteToast({
                type: "error",
                title: "Lỗi, không hợp lệ",
                message: 'Số tiền không vượt quá số dư và lớn hơn 1.000 VND',
                timer: 3500
            });
        }
    } else {
        cuteToast({
            type: "error",
            title: "Không hợp lệ",
            message: 'Vui lòng cung cấp đầy đủ thông tin',
            timer: 3500
        });
    }
}

async function fetchBankData() {
    try {
        const response = await fetch('https://qr.ecaptcha.vn/api/banks');
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        const data = await response.json();
        let options = '';

        data.forEach(item => {
            options += `<option value="${item.code}">${ item.shortName }</option>`;
        });

        const html = `
            <div class="input">
                <select name="name_bank">
                    ${ options }
                </select>
            </div>
        `;

        $('#full-banks').innerHTML = html;

    } catch (error) {
        console.error('Có lỗi xảy ra:', error);
    }
}

function historyPayment() {
    const itemHistory = $('.item-history');

    const data = {
        'class': 'HistoryPayment'
    };

    CallAjax.send('POST', data, 'talk/mvc/core/HandleWallet.php', function (response) {
        const dataJson = CallAjax.get(response, 'off').err_mess;
        try {
            if (Array.isArray(dataJson) && dataJson.length > 0) {
                const html = `
                <div class="history-show">
                    <ul>
                    ${dataJson.map(item => `
                        <li class="his-infomation">
                            <div class="content">
                                <p> ${item.name_user} </p>
                                <span> ${item.number_bank} </span>
                            </div>
                            <div class="photo">
                                <img 
                                draggable="false"
                                src="https://api.vietqr.io/img/${ item.name_bank }.png" width="45">
                                <span class="act"> 
                                    <p>${item.name_bank}</p>
                                </span> 
                            </div>
                        </li>
                    `).join('')}
                    </ul>
                </div>`;

                const historyShow = itemHistory.querySelector('.history-show');
                
                if (historyShow) historyShow.remove();
                TypeClass.class('remove', itemHistory, 'hidden');
                itemHistory.insertAdjacentHTML('beforeend', html);

                // Last info widthdraw 
                const hisInfomations = $$('.his-infomation');

                hisInfomations.forEach((item) => {
                    item.addEventListener('click', () => {
                        const name_user = item.querySelector('.content p');
                        const number_bank = item.querySelector('.content span');
                        const name_bank = item.querySelector('.act');
                        // Set value 
                        inputNameUser.value = name_user.textContent;
                        inputNumberBank.value = number_bank.textContent;
                        $('select[name="name_bank"]').value = name_bank.textContent.replace(/\s+/g, '');
                    })
                });
            }
        } catch (error) {
            console.log(error);
        }
    });
}

const walletJavascript = {
    init: () => {
        document.addEventListener('DOMContentLoaded', walletJavascript.handleEvents.bind(walletJavascript));
    },

    async handleEvents() {
        const balance = await this.getCurrentBalance();

        btnRules?.addEventListener('click', () => {
            AlertUsego.identify('yes');
            AlertUsego.show(contentChangeRules()[0], contentChangeRules()[1]);
        });

        btnDeposit?.addEventListener('click', () => {
            IdentifyPayment('add', 'deposit');
        });

        modalOverlay.onclick = (e) => {
            if (e.target === e.currentTarget) {
                IdentifyPayment('remove', 'deposit');
                IdentifyPayment('remove', 'withdraw');
                AlertUsego.identify('no');
            }
        };

        const VND = new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND',
        });

        inputPayments?.forEach((inputCoin) => {
            inputCoin?.addEventListener('input', (e) => {
                let value = e.target.value.replace(/[^0-9]/g, '');
                inputCoin.value = value ? VND.format(parseFloat(value)).replace('₫', '').trim() : '';
            });
        });

        btnAcceptGetQR?.addEventListener('click', handleDataDeposit);
        btnAcceptDeposit?.addEventListener('click', handleAcceptDeposit);
        btnAcceptWithdraw?.addEventListener('click', handleAcceptWithdraw.bind(null, balance));

        btnWithdraw?.addEventListener('click', () => {
            IdentifyPayment('add', 'withdraw');
            fetchBankData();
            historyPayment();
        });

        const debouncedWithdrawCoin = Debounces.listen((event) => {
            const value = event.target.value;
            const money = value.replace(/[\.,]/g, '');
                showErrorInput(inputCoinWidthdraw, 'balance', money, balance);
        }, 300);

        inputCoinWidthdraw?.addEventListener('input', debouncedWithdrawCoin);

        inputCoinDeposit.addEventListener('blur', showErrorInput.bind(null, inputCoinDeposit));
        inputCoinWidthdraw.addEventListener('blur', showErrorInput.bind(null, inputCoinWidthdraw, 'balance'));
        inputNameUser.addEventListener('blur', showErrorInput.bind(null, inputNameUser));
        inputNumberBank.addEventListener('blur', showErrorInput.bind(null, inputNumberBank));
    },

    async getCurrentBalance() {
        const data = { 'class': 'CurrentBalance' };

        const response = await new Promise((resolve, reject) => {
            CallAjax.send('POST', data, 'talk/mvc/core/HandleWallet.php', (response) => {
                const dataJson = CallAjax.get(response, 'off').err_mess;
                if (dataJson) {
                    resolve(dataJson);
                } else {
                    resolve(null); 
                }
            });
        });

        return response; 
    },

    start: () => {
        walletJavascript.init();
    }
};

walletJavascript.start();