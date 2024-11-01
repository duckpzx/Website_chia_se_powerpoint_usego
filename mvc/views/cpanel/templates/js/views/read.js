function callAjaxWithFormData(method, formData, target, callback) {
    var xhr = new XMLHttpRequest();
    xhr.open(method, target, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                if (callback) {
                    const jsonResponse = JSON.stringify(xhr.response);
                    const jsonResponseParse = JSON.parse(jsonResponse);
                    callback(jsonResponseParse);
                }
            }
        }
    };

    xhr.setRequestHeader("enctype", "multipart/form-data"); 
    xhr.send(formData);
}

const currentURL = new URL(window.location.href);
const idValue  = currentURL.searchParams.get('id');

function setContentDialog(content, des) {
    dialogBoxTitle.textContent = content;
    dialogBoxDes.textContent = des;
}

function processResponse(response) {
    var index = response.indexOf('}{');
    var jsonString = response.substring(index + 1);
    var dataJson = JSON.parse(jsonString);
    return dataJson;
}

const removePost = $('#remove-post');

// Logout Server 
function setContentDialog(content, des) {
    dialogBoxTitle.textContent = content;
    dialogBoxDes.textContent = des;
}

// Service 
const btnConfirm = $('#confirm-post');
const btnRevertConfirm = $('#revert-confirm');
const btnIconCotnent = $('.hide-icons-content');

// interface 
const cfStatusAlert = $('.cf-status span');

const inputMoney = $('input[name="money"]');

function checkCountService() {
    const data = {
        'class': 'countservice'
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
                return false;
            }
            return true;
        } catch (error) {}
    });
}

const authorId = $('.author-id span');
const id_onwser = GetDataElement.get(authorId, 'data-id');

function servicePosts( money ) {
    checkCountService();
    const data = {
        'id_trade': idValue,
        'id_onwser': id_onwser,
        'money' : money,
        'class': 'SendService'
    };
    CallAjax.send('POST', data, 'talk/mvc/core/HandleNewFeeds.php', function (response) {
        const dataJson = CallAjax.get( response );
        try {
            if ( dataJson.error ) {
                cuteToast({
                    type: "error",
                    title: "Lỗi",
                    message: dataJson,
                    timer: 3500
                });
            } 
            else {
                cuteToast({
                    type: "success",
                    title: "Thành công",
                    message: "Đã gửi yêu cầu tới tác giả",
                    timer: 3500
                });
                cfStatusAlert.innerHTML = 'Đang chờ duyệt';
                TypeClass.class('remove', cfStatusAlert, 'error');
                TypeClass.class('add', cfStatusAlert, 'wait');
            }
        } catch (error) {}
    });
}

function savedView() {
    const data = {
        'id': idValue,
        'type': 'post',
        'class': 'savedviewpost'
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
        } catch (error) {}
    });
}


function revertService() {
    const data = {
        'id': idValue,
        'class': 'revertservice'
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
            } else {
                cfStatusAlert.innerHTML = 'Chưa gửi yêu cầu';
                TypeClass.class('add', cfStatusAlert, 'error');
                TypeClass.class('remove', cfStatusAlert, 'wait');
            }
        } catch (error) {}
    });
}

const content = $('#content');
const iconEye = $('.hide-icons-content .fa-solid');

function identifyEye( type ) {
    if (type === 'yes' ) {
        TypeClass.class('add', iconEye, 'fa-eye-slash');
        TypeClass.class('remove', iconEye, 'fa-eye');
    } else {
        TypeClass.class('remove', iconEye, 'fa-eye-slash');
        TypeClass.class('add', iconEye, 'fa-eye');
    }
}

const btnProof = $('#btn-proof');
const btnCancel = $('.btn-secondary');
const uploadImagesProof = $('#upload-proof');
const descriptionProof = $('.upload-area-description');
// Loading
const loadingSs = $('.loading-ss');

function renderProof( images ) {
    const arrayImages = images.split("||"); 
    const htmlPrepare = arrayImages.reduce((result, item) => {
        var template = GetDataElement.get( $('#template'), 'data-template');
        return (
            result + `
                <li class="item-proof">
                    <img 
                        src="${ template }${ item }">
                </li>
            `
        ); 
    }, '');

    const html = `
    <div class="seriver-wrapper">
        <ul id="lists-proof">
            ${ htmlPrepare }
        </ul>
    </div>
    `;

    $('#template').insertAdjacentHTML('afterend', DOMPurify.sanitize(html, {RETURN_TRUSTED_TYPE: true}));
}

function handleImageProof( file ) {
    // Get ID 
    const id = GetCurrentPageOnURL.get('id');

    TypeClass.class('add', loadingSs, 'loading');
    const formData = new FormData();
    formData.append('uploaded_file', file);
    formData.append('class', 'UploadImageProof');
    formData.append('id', id);

    callAjaxWithFormData('POST', formData, 'mvc/core/HandleDataUpload.php', function (response) {
        const dataJson = CallAjax.get(response, 'off').err_mess;
        try {
            if (dataJson) {
                renderProof( dataJson );
                $('#detail-proof').hidden = true;

                TypeClass.class('remove', loadingSs, 'loading');
                // Reset 
                uploadImagesProof.value = "";
                descriptionProof.innerHTML = "Vui lòng tải lên 1 File";
            }
        }
        catch (err) { console.error(err) };
    });
}

const btnSatisfied = $('#btn-satisfied');
const btnNotSatisfied = $('#btn-not-satisfied');

function paymentService(json) {
    const data = {
        'id': json[0].id,
        'user_id': json[0].userId,
        'money_agrees': json[0].money_agrees,
        'class': 'PaymentService'
    };

    CallAjax.send('POST', data, 'talk/mvc/core/HandleWallet.php', function (response) {
        const dataJson = CallAjax.get( response).err_mess;
    });
}

function satisfied() {
    const id = GetCurrentPageOnURL.get('id');
    const data = {
        'id' : id,
        'class': 'Satisfied'
    };

    CallAjax.send('POST', data, 'talk/mvc/core/HandleInstruct.php', function (response) {
        const dataJson = CallAjax.get( response, 'off' ).err_mess;
        try {
            if (dataJson) {
                paymentService(dataJson);
            } 
        } catch (error) {}
    });
}

function notSatisfied() {
    const id = GetCurrentPageOnURL.get('id');
    const data = {
        'id' : id,
        'class': 'NotSatisfied'
    };

    CallAjax.send('POST', data, 'talk/mvc/core/HandleInstruct.php', function (response) {
        CallAjax.get( response );
    });
}

// Start Time Measure 
var startTime = new Date();

const readJavascript = {
    init: () => {
        document.addEventListener('DOMContentLoaded', readJavascript.handleEvents);
    },

    handleEvents: () => {
        window.addEventListener('beforeunload', readJavascript.handleBeforeUnload);

        btnConfirm?.addEventListener('click', readJavascript.confirmRequest);
        btnRevertConfirm?.addEventListener('click', readJavascript.revertService);
        
        inputMoney?.addEventListener('input', readJavascript.formatCurrency);
        
        readJavascript.setupContentVisibility();
        readJavascript.setupFileUpload();
    },

    handleBeforeUnload: () => {
        const endTime = new Date();
        const timeSpentInSeconds = Math.round((endTime - startTime) / 1000);
        if (timeSpentInSeconds > 10) savedView();
    },

    confirmRequest: () => {
        cuteAlert({
            type: "question",
            title: "Xác nhận yêu cầu",
            message: "Bạn có chắc muốn nhận yêu cầu",
            confirmText: "Xác nhận",
            cancelText: "Hủy bỏ"
        }).then((e) => {
            if (e === "confirm") {
                const money = parseFloat(inputMoney.value.replace(/[\.,]/g, '')); 
                servicePosts(money);
                btnConfirm.hidden = true;
                inputMoney.hidden = true;
            }
        });
    },

    revertService: () => {
        revertService();
        btnRevertConfirm.hidden = true;
    },

    formatCurrency: (e) => {
        const VND = new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND',
        });

        let value = e.target.value.replace(/[^0-9]/g, '');
        inputMoney.value = value ? VND.format(parseFloat(value)).replace('₫', '').trim() : '';
    },

    setupContentVisibility: () => {
        const statusContentStorage = localStorageCore.retrieve('hideContent-saved') === idValue;
        TypeClass.class(statusContentStorage ? 'add' : 'remove', content, 'hidden');
        identifyEye(statusContentStorage ? 'no' : 'yes');

        btnIconCotnent?.addEventListener('click', () => {
            const isHidden = content.classList.toggle('hidden');
            identifyEye(isHidden ? 'no' : 'yes');
            localStorageCore[isHidden ? 'storage' : 'remove']('hideContent-saved', `${idValue}`);
        });
    },

    setupFileUpload: () => {
        btnProof?.addEventListener('click', () => {
            const file = uploadImagesProof.files[0];
            if (!file) {
                cuteToast({
                    type: "error",
                    title: "Lỗi",
                    message: "Vui lòng chọn 1 File tải lên!",
                    timer: 3000
                });
                return false;
            }
            handleImageProof(file);
        });

        btnCancel?.addEventListener('click', () => {
            uploadImagesProof.value = "";
            descriptionProof.innerHTML = "Vui lòng tải lên 1 File PPTX";
        });

        uploadImagesProof?.addEventListener('input', () => {
            descriptionProof.innerHTML = "Đã tải lên 1 File";
        });

        btnSatisfied.addEventListener('click', () => {
            cuteAlert({
                type: "question",
                title: "Xác nhận yêu cầu",
                message: "Bạn hài lòng với dịch vụ",
                confirmText: "Xác nhận",
                cancelText: "Hủy bỏ"
            }).then((response) => {
                if (response === "confirm") {
                    satisfied();  
                }
            });
        });

        btnNotSatisfied.addEventListener('click', () => {
            cuteAlert({
                type: "question",
                title: "Xác nhận yêu cầu",
                message: "Bạn không hài lòng với dịch vụ",
                confirmText: "Xác nhận",
                cancelText: "Hủy bỏ"
            }).then((response) => {
                if (response === "confirm") {
                    notSatisfied();
                }
            });
        });
    },

    start: () => {
        readJavascript.init();
    }
};

readJavascript.start();