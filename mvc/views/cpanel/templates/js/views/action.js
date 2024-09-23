// Remove post service 
const removeService = $('#remove-service');

// Confirm user action service 
const btnActionConfirms = $$('.btn-action-cf');
const modalQr = $('#modal-qr');
const btnConfirmQr = $('#btn-confirm-qr');
const btnCancelQr = $('#btn-cancel-qr');

function removeAction() {
    const currentURL = new URL(window.location.href);
    const idValue  = currentURL.searchParams.get('id');
    const data = {
        'id': idValue,
        'class': 'removeaction'
    };

    CallAjax.send('POST', data, 'talk/mvc/core/HandleActionInteract.php', function (response) {
        const dataJson = CallAjax.get( response );
        try {
            if (dataJson.error) {
                cuteToast({
                    type: "error",
                    title: "Lỗi",
                    message: dataJson,
                    timer: 3500
                });
            } 
        } catch (error) {};
    });
}

function confirmAction( userId ) {
    const currentURL = new URL(window.location.href);
    const idValue  = currentURL.searchParams.get('id');
    const data = {
        'id': idValue,
        'class': 'confirmaction',
        'userId': userId
    };

    CallAjax.send('POST', data, 'talk/mvc/core/HandleActionInteract.php', function (response) {
        const dataJson = CallAjax.get( response );
        try {
            if (dataJson.error) {
                cuteToast({
                    type: "error",
                    title: "Lỗi",
                    message: dataJson,
                    timer: 3500
                });
            } 
            else {

            }
        } catch (error) {};
    });
}

function handleQR(money_agrees, token) {
    const stk = '0396605617';
    const name = 'PHAM XUAN DUC';
    const bank = 'mb';
    const moneyAgrees = money_agrees;
    const tokenTrade = token;
    const urlQr = `https://qr.ecaptcha.vn/api/generate/${bank}/${stk}/${name}?amount=${moneyAgrees}&memo=${tokenTrade}&is_mask=0&bg=6`;
    if (urlQr)
    $('#modal-qr img').src = urlQr;

    TypeClass.class('add', modalQr, 'active');       
    NoScrollHTML.noScroll('yes');
}

function handlePayment(token, money) {
    const data = {
        'token_trade': token,
        'money_agrees': money,
        'class': 'handlepayment'
    };

    CallAjax.send('POST', data, 'talk/mvc/core/bin/ImapEmail.php', function (response) {
        try {
            const responseObject = JSON.parse(response);
            const status = responseObject.data.status;
            const type = ( status === 'success' ) ? 'success' : 'error' ;
            const title = ( status === 'success' ) ? 'Thành công' : 'Lỗi';
            cuteToast({
                type: type,
                title: title,
                message: responseObject.data.message,
                timer: 3500
            });
            if ( status === 'success' )
            removeService.hidden = true;
        } 
        catch (error) {};
    });   
}

const actionJavascript = {
    handleEvents: () => {
        document.addEventListener('DOMContentLoaded', () => {
            removeService.addEventListener('click', ( e ) => {
                cuteAlert({
                    type: "question",
                    title: "Xác nhận yêu cầu",
                    message: "Bạn có chắc muốn xóa bài đăng",
                    confirmText: "Xác nhận",
                    cancelText: "Hủy bỏ"
                }).then((e)=>{
                    if (e == "confirm") {
                        removeAction();
                    } 
                });
            });

            let money_agrees = 0;
            const tokenTrade = $('#token-trade').textContent;
            btnActionConfirms.forEach(function(button) {
                button.addEventListener('click', function() {
                    const row = this.closest('tr');
                    const rowData = Array.from(row.querySelectorAll('td')).map(td => td.textContent.trim());
                        cuteAlert({
                        type: "question",
                        title: "Xác nhận yêu cầu",
                        message: "Sau khi thanh toán hãy ở lại chờ 10s",
                        confirmText: "Xác nhận",
                        cancelText: "Hủy bỏ"
                    }).then((e)=>{
                        if (e == "confirm") {
                            const moneyAgrees = rowData[3].replace(/[^0-9,.]/g, '');
                            handleQR(moneyAgrees, tokenTrade);

                            money_agrees = moneyAgrees;
                            // const userId = GetDataElement.get( btn, 'data-id' );
                            // confirmAction( userId );
                        } 
                    });
                });
            });

            btnCancelQr.addEventListener('click', () => {
                TypeClass.class('remove', modalQr, 'active');       
                NoScrollHTML.noScroll('no');
            });
            
            let paymentTimeout = null;
            btnConfirmQr.addEventListener('click', () => {
                if ( paymentTimeout === null ) {
                    paymentTimeout = setTimeout(() => {
                        handlePayment( tokenTrade, money_agrees );
                        paymentTimeout = null; 
                    }, 10000);
                }
                TypeClass.class('remove', modalQr, 'active');  
                NoScrollHTML.noScroll('yes');
            });

            
        });
    },

    start: () => {
        actionJavascript.handleEvents();
    }
}

actionJavascript.start();