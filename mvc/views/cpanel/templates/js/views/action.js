// Remove post service 
const removeService = $('#remove-service');

// Confirm user action service 
const btnActionConfirms = $$('.btn-action-cf');
const modalQr = $('#modal-qr');
const btnConfirmQr = $('#btn-confirm-qr');
const btnCancelQr = $('#btn-cancel-qr');

const btnHide = $('#btn-hide');

function removeAction() {
    const currentURL = new URL(window.location.href);
    const idValue  = currentURL.searchParams.get('id');
    const data = {
        'id': idValue,
        'class': 'removeaction'
    };

    CallAjax.send('POST', data, 'mvc/core/HandleActionInteract.php', function (response) {
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

    CallAjax.send('POST', data, 'mvc/core/HandleActionInteract.php', function (response) {
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

function acceptService(id) {
    const data = {
        'id' : id,
        'class' : 'AcceptService'
    };

    CallAjax.send('POST', data, 'mvc/core/HandleService.php', function (response) {
        try {
            CallAjax.get( response, 'off' );
        } 
        catch (error) {};
    }); 
}

async function handlePayment(trade) {
    const data = {
        'id_service': trade.id,
        'money_agrees': trade.money_agrees,
        'class': 'AcceptPayment'
    };

    return new Promise((resolve, reject) => {
        CallAjax.send('POST', data, 'mvc/core/HandleWallet.php', function (response) {
            try {
                const dataJson = CallAjax.get(response);
                resolve(dataJson.code === 1); 
            } 
            catch (error) {
                console.log(error);
                reject(error);
            }
        });
    });
}

async function handleTransaction(id_post, id_service) {
    try {
        const data = {
            'id_post' : id_post,
            'id_service': id_service,
            'class' : 'GetDataTrade'
        };
    
        CallAjax.send('POST', data, 'mvc/core/HandleInstruct.php', async function (response) { // Chuyển sang hàm bất đồng bộ
            try {
                const dataJson = CallAjax.get(response, 'off').err_mess[0];
                const result = await handlePayment(dataJson);
           
                if (result) {
                    acceptService(dataJson.id); 
                }
            } 
            catch (error) {
                console.error('Lỗi khi xử lý dữ liệu:', error);
            }
        }); 
    } catch (error) {
        console.error('Lỗi:', error);
    }
}

function handleDisplayMode() {
    const idPost = GetCurrentPageOnURL.get('id');
    const data = {
        'id' : idPost,
        'class' : 'DisplayMode'
    };

    btnHide.classList.contains('active') 
    ? TypeClass.class('remove', btnHide, 'active') 
    : TypeClass.class('add', btnHide, 'active');
     
    CallAjax.send('POST', data, 'mvc/core/HandleInstruct.php', async function (response) { 
        try {
            CallAjax.get(response);
        } 
        catch (error) {
            console.error('Lỗi khi xử lý dữ liệu:', error);
        }
    }); 
}

const actionJavascript = {
    handleEvents() {
        document.addEventListener('DOMContentLoaded', () => {
            this.setupRemoveService();
            this.setupActionConfirms();
            this.setupQrCancelButton();
            this.setupDisplayMode();
        });
    },

    setupRemoveService() {
        if (removeService) {
            removeService.addEventListener('click', (e) => {
                cuteAlert({
                    type: "question",
                    title: "Xác nhận yêu cầu",
                    message: "Bạn sẽ cần thanh toán trước",
                    confirmText: "Xác nhận",
                    cancelText: "Hủy bỏ"
                }).then((response) => {
                    if (response === "confirm") {
                        this.removeAction();
                    }
                });
            });
        }
    },

    setupActionConfirms() {
        const tokenTrade = $('#token-trade').textContent;
        btnActionConfirms.forEach(button => {
            button.addEventListener('click', () => {
                const rows = button.closest('tr');
                cuteAlert({
                    type: "question",
                    title: "Xác nhận yêu cầu",
                    message: "Xác nhận chọn người dùng này",
                    confirmText: "Xác nhận",
                    cancelText: "Hủy bỏ"
                }).then((response) => {
                    if (response === "confirm") {
                        const id_service = GetDataElement.get(rows.querySelectorAll('td')[0], 'data-id');
                        const id_post = GetCurrentPageOnURL.get('id');
                        handleTransaction(id_post, id_service);
                    }
                });
            });
        });
    },

    setupQrCancelButton() {
        btnCancelQr.addEventListener('click', () => {
            TypeClass.class('remove', modalQr, 'active');
            NoScrollHTML.noScroll('no');
        });
    },

    setupDisplayMode() {
        btnHide.addEventListener('click', () => {
            handleDisplayMode();
        });
    },

    start() {
        this.handleEvents();
    }
};

// Khởi chạy script
actionJavascript.start();
