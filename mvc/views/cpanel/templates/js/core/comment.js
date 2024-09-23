// Seemore comment feedback
const feedbacks = $$('.feedback');
// Options 
const options = $$('.options');

// Auto height  
const boxChats = $$('textarea');
const bSends = $$('.b-send');

function renderInterface( data, type, container, location ) {
    const template = showComments.getAttribute('data-template');
    const userId = parseInt(showComments.getAttribute('data-id'));

    const dataType = ( type === 'comment' ) ? 'data-id_cmt' : 'data-id';
    const optionsHtml = ( data.userId === userId ) ? `
        <div class="options">
            <i class="fa-solid fa-ellipsis"></i>
            <ul class="module-comment module-buttons">
                <li class="remove" ${dataType}="${(type === 'comment' ? data.id_cmt : data.id)}">
                    <span><i class="fa-regular fa-trash-can"></i> Xóa bình luận</span>
                </li>
            </ul>
        </div>
    ` : '';

    const comment = `
        <div class="item-wrap talk-feedback">
            <div class="talk-ask">
                <div class="form-item">
                    <a href="/usego/profile/?id=${ data.userId }">
                        <i class="avata">
                            <img src="${ template + data.avatar }">
                        </i>
                    </a>
                </div>
                <section class="general-settings">
                    <div class="item-main">
                        <div class="item-title-wrap">
                            <h3>
                                <span>${ data.firstName } ${ data.lastName }</span>
                            </h3>
                        </div>
                        <div class="item-entry">
                            <span>${ data.content }</span>
                        </div>
                    </div>
                    <div class="meta">
                        <div class="time">
                            <span></span>
                        </div>        
                        <div class="feedback">
                            <span>Phản hồi</span>
                        </div>
                        ${ optionsHtml }
                    </div>
                    <section class="container-feedbacks" data-id_cmt="${ data.id_cmt }">
                        <form method="POST" class="form-actions form-feedback">
                            <textarea name="detail-comment" class="comment-text" placeholder="Phản hồi..." required="">
                            </textarea>
                            <div class="form-send">
                                <button class="b-send btn-send-talk" id="btn-send-detail" disabled="">
                                    <span>Phản hồi</span>
                                </button>
                            </div>
                        </form>
                    </section>
                </section>
            </div>       
        </div>`;

    const respond = `
        <div class="talk-ask">
            <div class="form-item">
                <a href="/usego/profile/?id=${ data.userId }">
                    <i class="avata">
                        <img src="${ template + data.avatar }">
                    </i>
                </a>
            </div>
            <section class="general-settings general-comments">
                <div class="item-main">
                    <div class="item-title-wrap">
                        <h3>
                            <span>${ data.firstName } ${ data.lastName }</span>
                        </h3>
                    </div>
                    <div class="item-entry">
                        <span>${ data.content }</span>
                    </div>
                </div>
                <div class="meta">
                    <div class="time">
                        <span></span>
                    </div>        
                    ${ optionsHtml }         
                </div>
            </section>
        </div>`;

    try {
        container.insertAdjacentHTML( location, DOMPurify.sanitize(( type === 'comment' ) ? comment : respond, { RETURN_TRUSTED_TYPE: true }));
    } catch ( err ) { 
        console.error( err.message );
    }  
    // FUNCTION'S DUTIES

    $$('.b-send').forEach(( bt ) => {
        bt.onclick = handleB_SendClick;
    });

    $$('.remove').forEach(( bt ) => {
        removeComment( bt );
    });    

    $$('.options').forEach(( bt ) => {
        bt.onclick = handleOptionsClick;
    });

    $$('.feedback').forEach(( bt ) => {
        bt.onclick = handleFeedbackClick;
    });

    $$('textarea').forEach((boxChat) => {
        boxChat.oninput = autoHeight;
    });
}

const containerFeedbacks = $$('.container-feedbacks');

function getElementContainingRespond( idCmt ) {
    const array = Array.from( $$('.container-feedbacks') );
    return array.findIndex( item => parseInt( GetDataElement.get( item, 'data-id_cmt' )) === idCmt );
}

function resetValueTextarea() {
    $$('textarea').forEach( e => e.value = '' );
}

function prepareDataSend( type, value, idCmt ) {
    const data = {
        'idpost' : GetCurrentPageOnURL.get('id'),
        'content' : value,
        'id_cmt' : ( type === 'respond' ) ? idCmt : '',
        'class' : ( type === 'comment' ) ? 'comment' : 'respond'
    };

    CallAjax.send('POST', data, 'mvc/core/HandleActionInteract.php', ( response ) => {
        const dataJson = CallAjax.get( response );
        try {
            const jsonSend = {
                'info' : dataJson
            };
            const id = dataJson[0].id;

            if ( id ) {
                // Comment respond 
                const idCmt = dataJson[0].id_cmt;
                const index = getElementContainingRespond( idCmt );

                $$('.feedback')[ index ].innerHTML = DOMPurify.sanitize('<span>Xem bình luận khác</span>', {RETURN_TRUSTED_TYPE: true});
                renderInterface( jsonSend.info[0], 'respond', $$('.container-feedbacks')[ index ], 'beforeend');
            } else {
                // Comment main 
                renderInterface( jsonSend.info[0], 'comment', showComments, 'afterbegin');
            }
            
            resetValueTextarea();
            ResetClasses.lists( bSends, 'active' );

            conn.send( JSON.stringify( jsonSend ));
        } 
        catch ( err ) {
            cuteToast({
                type: "error",
                title: "Lỗi",
                message: "Thất bại, thử lại sau",
                timer: 2500
            });
        }
    });
}

function handleB_SendClick( event ) {
    event.preventDefault();
    event.stopPropagation(); 
    const element = event.currentTarget;

    const containerBoxChat = element.closest('.wrapper-comment, .container-feedbacks');
    if (!containerBoxChat) return;

    const textarea = containerBoxChat.querySelector('textarea');
    if (!textarea) return;

    const textareaValue = textarea.value.trim();

    const idComment = containerBoxChat.getAttribute('data-id_cmt');
    const actionType = containerBoxChat.classList.contains('wrapper-comment') ? 'comment' : 'respond';

    prepareDataSend( actionType, textareaValue, idComment );
}

// Remove content 
function removeCommentInterface( type, idneedRemove ) {
    const selector = ( type === 0 ) ? '.remove[data-id_cmt]' : '.remove[data-id]';
    const buttons = $$( selector );

    buttons.forEach(( button ) => {
        const id = GetDataElement.get( button, ( type === 0 ) ? 'data-id_cmt' : 'data-id' );
        if ( id == idneedRemove ) {
            const wrapper = button.closest(( type === 0 ) ? '.item-wrap' : '.talk-ask' );
            wrapper.remove();
        } 
    });
}

const removes = $$('.remove');

function removeComment( button ) {
    button.onclick = () => {
        const idCmt = button.getAttribute('data-id_cmt');
        const id = button.getAttribute('data-id');
        let data = {};

        if ( idCmt || id ) {
            data = {
                ...( idCmt ? { 'id_cmt': idCmt } : { 'id': id }),
                'class': 'removecomment'
            };
        }

        CallAjax.send( 'POST', data, 'mvc/core/HandleActionInteract.php', ( response ) => {
            const jsonResponse = CallAjax.get( response );
            try {             
                if ( jsonResponse.id_cmt ) {
                    removeCommentInterface(0, jsonResponse.id_cmt);
                } else {
                    removeCommentInterface(1, jsonResponse.id);
                }
            } catch ( err ) { 
                cuteToast({
                    type: "error",
                    title: "Lỗi",
                    message: "Thất bại, thử lại sau",
                    timer: 2500
                });
             }
        });
    };
}

// Remove comment 

function handleFeedbackClick( event ) {
    event.stopPropagation(); 
    let element = event.currentTarget;
    let wrapper = element.closest('.general-settings').querySelector('.container-feedbacks');
    TypeClass.class('toggle', wrapper, 'show');
}

function handleOptionsClick( event ) {
    event.stopPropagation(); 
    const moduleComments = $$('.module-comment');
    const element = event.currentTarget;

    const moduleComment = element.querySelector('.module-comment');
    if ( !moduleComment.classList.contains('show') ) {
        ResetClasses.lists( moduleComments, 'show' );
        TypeClass.class('add', moduleComment, 'show');
    } 

    // Close 
    const closeListener = ( event ) => {
        const isModuleCommentClicked = event.target.closest('.module-comment');
        if (!isModuleCommentClicked) {
            ResetClasses.lists( moduleComments, 'show' );
            document.removeEventListener('click', closeListener); 
        }
    };

    document.onclick = closeListener;
}

function autoHeight( event ) {
    const element = event.currentTarget;
    const containerBoxChat = element.closest('.wrapper-comment, .container-feedbacks');
    const bSend = containerBoxChat.querySelector('.b-send');
    const value = event.target.value;

    resizeBoxComment();
    toggleActiveState( value, bSend );

    function resizeBoxComment() {
        element.style.height = 'auto';
        element.style.height = (element.scrollHeight) + 'px';
    }

    function toggleActiveState( value, button ) {
        let identifyAction = ( value.trim() !== '' ) ? 'add' : 'remove';
        TypeClass.class(`${ identifyAction }`, button, 'active');
        button.disabled = ( identifyAction === 'add' ) ? false : true;
    }

    element.onclick = resizeBoxComment;

    element.onblur = () => {
        if ( element.value.trim() === '' ) {
            element.style.height = '30px';
        }
    };
}

// Conect comment 
var conn = new WebSocket('ws://localhost:8080');

const commentJavascript = {
    handleEvents: () => {
        document.addEventListener('DOMContentLoaded', () => {
             // Bt seemore comment 
            feedbacks.forEach(( bt ) => {
                bt.onclick = handleFeedbackClick
            });

            // Auto height textare 
            boxChats.forEach(( chat ) => {
                chat.oninput = autoHeight;
            });

            // Setting show options 
            options.forEach(( bt ) => {
                bt.onclick = handleOptionsClick;
            });

            // Send comment 
            bSends.forEach(( bt ) => {
                bt.onclick = handleB_SendClick;
            });

            // Remove comment 
            removes.forEach(( button ) => {
                removeComment( button );
            });

            // Chat realtime 
            try {
                // Listen data realtime
                conn.onopen = ( event ) => {
                    conn.onmessage = ( event ) => {
                        const value = event.data;
                        // Get data from server socket 
                        const jsonSend = JSON.parse( value );

                        // inspect the object 
                        const id = jsonSend.info[0].id;
                        if ( id ) {
                            const idCmt = jsonSend.info[0].id_cmt;
                            const index = getElementContainingRespond( idCmt );
                            $$( '.feedback')[index].innerHTML = DOMPurify.sanitize('<span>Xem bình luận khác</span>', {RETURN_TRUSTED_TYPE: true} );
                            renderInterface( jsonSend.info[0], 'respond', $$('.container-feedbacks')[index], 'beforeend' );
                        } else {
                            renderInterface( jsonSend.info[0], 'comment', showComments, 'afterbegin' );
                        }
                    };
                };    
            }
            catch ( err ) { 
                cuteToast({
                    type: "error",
                    title: "Lỗi",
                    message: 'Không thể bình luận lúc này.',
                    timer: 2500
                });
            };
        });
    },

    start: () => {
        commentJavascript.handleEvents();
    }
}

commentJavascript.start();