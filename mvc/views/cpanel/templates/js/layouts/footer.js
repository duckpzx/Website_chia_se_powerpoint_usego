// show newFeed 
const modalOverlay = $('.modal-overlay');
const modalContent = $('.modal-content');

// New feed button 
const btNewFeed = $('.item-new-feed');
const btCloseNewFeed = $('.close-new-feed');

// Logout button 
const btAccpectBox = $('#btn-accpect-box');
const btCancelBox = $('#btn-cancel-box');

const btnLogoutUsego = $('.logout-usego');

const footerJavascript = {
    handleEvents: () => {   
        document.addEventListener('DOMContentLoaded', () => {
            // New feed alert 
            btNewFeed.onclick = (e) => {
                AlertUsego.identify('yes');
            }   

            // Close new feed alert 
            modalOverlay.onclick = (e) => {
                if (e.target == e.currentTarget) {
                    btCloseNewFeed.click();
                }
            }

            // Remove new feed alert 
            btCloseNewFeed.onclick = () => {
                AlertUsego.identify('no');
            }
            
            btnLogoutUsego.onclick = () => {
                cuteAlert({
                    type: "question",
                    title: "Xác nhận yêu cầu",
                    message: "Bạn có chắc muốn đăng xuất",
                    confirmText: "Xác nhận",
                    cancelText: "Hủy bỏ"
                }).then((e)=>{
                    if (e == "confirm") {
                        window.location.href = '/usego/account/logout';
                    } 
                });
            };
        });
    },

    start: () => {
        footerJavascript.handleEvents();
    }
}

footerJavascript.start();