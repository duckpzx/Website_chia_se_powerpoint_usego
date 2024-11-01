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
                    <span>
                        ❌ Xóa bình luận
                    </span>
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
        const dataJson = CallAjax.get( response, 'off' ).err_mess;
        try {
            const jsonSend = {
                'info' : dataJson
            };
            const id = dataJson[0].id;
            if ( id ) {
                // Comment respond 
                const idCmt = dataJson[0].id_cmt;
                const index = getElementContainingRespond( idCmt );

                $$('.feedback')[ index ].innerHTML = '<span>Xem bình luận khác</span>'
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

function handleB_SendClick(event) {
    event.preventDefault();
    event.stopPropagation();

    const containerBoxChat = event.currentTarget.closest('.wrapper-comment, .container-feedbacks');
    if (!containerBoxChat) return;

    const textarea = containerBoxChat.querySelector('textarea');
    if (!textarea) return;

    const textareaValue = textarea.value.trim();
    const idComment = containerBoxChat.getAttribute('data-id_cmt');
    const actionType = containerBoxChat.classList.contains('wrapper-comment') ? 'comment' : 'respond';

    prepareDataSend(actionType, textareaValue, idComment);
}

// Remove content 
function removeCommentInterface(type, idToRemove) {
    const selector = type === 0 ? '.remove[data-id_cmt]' : '.remove[data-id]';
    const buttons = $$(selector);

    buttons.forEach((button) => {
        const id = GetDataElement.get(button, type === 0 ? 'data-id_cmt' : 'data-id');
        if (id == idToRemove) {
            const wrapper = button.closest(type === 0 ? '.item-wrap' : '.talk-ask');
            wrapper.remove();
        }
    });
}

const removes = $$('.remove');

function removeComment(button) {
    button.onclick = () => {
        const idCmt = button.getAttribute('data-id_cmt');
        const id = button.getAttribute('data-id');
        const data = {
            class: 'removecomment',
            ...(idCmt ? { id_cmt: idCmt } : { id })
        };

        CallAjax.send('POST', data, 'mvc/core/HandleActionInteract.php', (response) => {
            const dataJson = CallAjax.get(response, 'off').err_mess;
            try {
                if (dataJson.id_cmt) {
                    removeCommentInterface(0, dataJson.id_cmt);
                } else {
                    removeCommentInterface(1, dataJson.id);
                }
            } catch (err) {
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

// Feedback click handler
function handleFeedbackClick(event) {
    event.stopPropagation();
    const wrapper = event.currentTarget.closest('.general-settings').querySelector('.container-feedbacks');
    TypeClass.class('toggle', wrapper, 'show');
}

// Options click handler
function handleOptionsClick(event) {
    event.stopPropagation();
    const moduleComments = $$('.module-comment');
    const element = event.currentTarget;
    const moduleComment = element.querySelector('.module-comment');

    if (!moduleComment.classList.contains('show')) {
        ResetClasses.lists(moduleComments, 'show');
        TypeClass.class('add', moduleComment, 'show');
    }

    // Close listener
    document.onclick = (closeEvent) => {
        if (!closeEvent.target.closest('.module-comment')) {
            ResetClasses.lists(moduleComments, 'show');
            document.onclick = null; 
        }
    };
}

// Auto-height for textarea
function autoHeight(event) {
    const textarea = event.currentTarget;
    const containerBoxChat = textarea.closest('.wrapper-comment, .container-feedbacks');
    const bSend = containerBoxChat.querySelector('.b-send');
    const value = textarea.value;

    resizeBoxComment();
    toggleActiveState(value, bSend);

    function resizeBoxComment() {
        textarea.style.height = 'auto';
        textarea.style.height = `${textarea.scrollHeight}px`;
    }

    function toggleActiveState(value, button) {
        const action = value.trim() !== '' ? 'add' : 'remove';
        TypeClass.class(action, button, 'active');
        button.disabled = action === 'remove';
    }

    textarea.onblur = () => {
        if (textarea.value.trim() === '') {
            textarea.style.height = '30px';
        }
    };
}

function initializeWebSocket(url) {
    const conn = new WebSocket(url);

    conn.onopen = () => {
        console.log('%cWebSocket connection opened', 'color: rgb(19, 222, 185);');
    };
    conn.onmessage = (event) => {
        const jsonSend = JSON.parse(event.data);
        handleWebSocketMessage(jsonSend);
    };
    conn.onclose = () => {
        console.log('%cWebSocket connection closed', 'color: rgb(250, 137, 107);');
    };
    conn.onerror = (error) => {
        console.error('%cWebSocket error:', 'color: rgb(250, 137, 107);', error);
    };

    return conn;
}


function handleWebSocketMessage(jsonSend) {
    const id = jsonSend.info[0].id;
    const container = id ? $$('.container-feedbacks') : showComments;

    if (id) {
        const idCmt = jsonSend.info[0].id_cmt;
        const index = getElementContainingRespond(idCmt);
        $$('.feedback')[index].innerHTML = DOMPurify.sanitize('<span>Xem bình luận khác</span>', { RETURN_TRUSTED_TYPE: true });
        renderInterface(jsonSend.info[0], 'respond', container[index], 'beforeend');
    } else {
        renderInterface(jsonSend.info[0], 'comment', container, 'afterbegin');
    }
}

const commentJavascript = {
    handleEvents: () => {
        document.addEventListener('DOMContentLoaded', () => {
            // Gán các sự kiện cho các phần tử
            feedbacks.forEach(bt => bt.onclick = handleFeedbackClick);
            boxChats.forEach(chat => chat.oninput = autoHeight);
            options.forEach(bt => bt.onclick = handleOptionsClick);
            bSends.forEach(bt => bt.onclick = handleB_SendClick);
            removes.forEach(button => removeComment(button));
        });
    },

    start: () => {
        commentJavascript.handleEvents();
    }
};

commentJavascript.start();
var conn = initializeWebSocket('ws://localhost:8080');