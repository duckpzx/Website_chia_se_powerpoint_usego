// show newFeed 
const modalOverlay = $('.modal-overlay');
const modalContent = $('.modal-content');

// New feed button 
const btNewFeed = $('.item-new-feed');
const btCloseNewFeed = $('.close-new-feed');

// Logout button 
const btAccpectBox = $('#btn-accpect-box');
const btCancelBox = $('#btn-cancel-box');

const containerDialogBox = $('.dialog-box');

function identifyClassAlertNewFeeds( wrapper, type ) {
    const identifyAction = ( type === 'yes' ) ? 'add' : 'remove';
    TypeClass.class(`${ identifyAction }`, wrapper, 'show');
    TypeClass.class(`${ identifyAction }`, modalOverlay, 'show');

    // Action identify html class no scroll
    const identifyActionHtml = ( type === 'yes' ) ? 'yes' : 'no';
    NoScrollHTML.noScroll(`${ identifyActionHtml }`);
}

const footerJavascript = {
    handleEvents: () => {   
        document.addEventListener('DOMContentLoaded', () => {
            // New feed alert 
            btNewFeed.onclick = (e) => {
                e.preventDefault();
                identifyClassAlertNewFeeds(modalContent, 'yes');
            }   

            // Close new feed alert 
            modalOverlay.onclick = (e) => {
                if (e.target == e.currentTarget) {
                    btCloseNewFeed.click();
                }
            }

            // Remove new feed alert 
            btCloseNewFeed.onclick = () => {
                identifyClassAlertNewFeeds(modalContent, 'no');
            }

            // show quessions Logout 
            if ( containerDialogBox ) {
                const btnLogoutUsego = $('.logout-usego');

                btnLogoutUsego.onclick = () => {
                    identifyClassAlertNewFeeds(containerDialogBox, 'yes');
                    TypeClass.class('add', modalOverlay, 'accect');
                    DialogBoxQuestion.dialog('Thực hiện, việc đăng xuất', 'Bạn có chắc chắn?');
                };
    
                // Action logout
                btAccpectBox.onclick = () => {
                    window.location.href = '/usego/account/logout';
                }
    
                btCancelBox.onclick = () => {
                    TypeClass.class('remove', modalOverlay, 'accect');
                    identifyClassAlertNewFeeds(containerDialogBox, 'no');
                }
            }
        });
    },

    start: () => {
        footerJavascript.handleEvents();
    }
}

footerJavascript.start();