function loadRenderFollow( id , html ) {
    $$('.btn-follower').forEach(( element ) => {
        const idValue = parseInt( GetDataElement.get( element, 'data-id'));
        if ( idValue == id )
        {
            element.innerHTML = DOMPurify.sanitize(html, {RETURN_TRUSTED_TYPE: true});
        }
    })   
}

function handleUrlBrowser( page ) {
    history.pushState(null, null, `?page=${ page }`);
}

// Pagination 
const buttonPages = $$('.list-paginations a');

function renderInterface( data ) {
    const listItemProduct = $('.list-item-product');

    var html = data.reduce((result, item) => {
        // Images
        const images = item.images;
        const arrayFiles = images.split("||");
        const imageFirst = arrayFiles[0];
        const template = GetDataElement.get(listItemProduct, 'data-template');
        const temp = GetDataElement.get(listItemProduct, 'data-temp'); 
        // Get id 
        const dataId = GetDataElement.get( $('#detailUserHeader'), 'data-id');
        // userId
        const id = ( item.id_onwser ) ? item.id_onwser : item.id;
        // Tags 
        let tags = item.tags.replace(/ \|\|/g, '');
        tags = tags.replace(/,/g, ' , ');
        // Handle follow user 
        let handleFollower = (dataId && dataId != item.userId) ? `
        <button class="btn-follower" data-id="${ item.userId }">
            ${ item.total_follow > 0 ? '<i class="fa-regular fa-circle-check"></i> <span>Đã theo dõi</span>' : '<span>+ Theo dõi</span>'}
        </button>` : '';

        let typeUser = (item.ug_type === 1) ? '<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle-check" class="svg-inline--fa fa-circle-check UserName_icon__zT+rB" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="font-size: 1.2rem;"><path fill="currentColor" d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM371.8 211.8C382.7 200.9 382.7 183.1 371.8 172.2C360.9 161.3 343.1 161.3 332.2 172.2L224 280.4L179.8 236.2C168.9 225.3 151.1 225.3 140.2 236.2C129.3 247.1 129.3 264.9 140.2 275.8L204.2 339.8C215.1 350.7 232.9 350.7 243.8 339.8L371.8 211.8z"></path></svg>' : '';
    
        return (
        result + `
        <section class="archive-list-price">
            <div class="archive-poster">
                <a href="/usego/powerpoint/detail?id=${ id }">
                    <img class="poster-product"
                    src="${ template + imageFirst }"
                    onerror="${ this.src = template + 'images/icons/not-image.png' }"
                    loading="lazy"
                    title="${ item.title }"/>
                </a>
                <div class="item-like">
                    <img src="${ temp + 'images/icons/like.png' }">
                    <span>${ item.like_count }</span>
                </div>
            </div>
            <div class="content">
                <p class="title"> 
                    ${ item.title }
                </p>
                <small class="description"> ${ tags } </small>
                <article class="infomation">
                    <div class="item-info info-detail">
                        <a class="on-Pewview" href="/usego/profile/?id=${ item.userId }">
                        <img class="avarta" src="${ temp + '/images/uploads/avatar/' + item.avatar }" width="30">
                        <small class="name"> Phạm Đức </small>
                        </a>
                        <div class="preview_user">
                            <div class="info">
                                <a href="/usego/profile/?id=${ item.userId }">
                                    <img class="avarta" src="${ temp + '/images/uploads/avatar/' + item.avatar }" width="30">
                                </a>
                                <div class="text">
                                <small class="name">
                                    ${ item.firstName + ' ' + item.lastName }
                                    ${ typeUser }
                                </small>
                                ${ handleFollower }
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item-info tag-form">
                        <i class="fa-solid fa-hashtag"></i>
                        <small>
                            kinh doanh
                        </small>
                    </div>
                </article>
            </div>
        </section>
            ` 
        );
    }, '');

    listItemProduct.innerHTML = DOMPurify.sanitize(html, {RETURN_TRUSTED_TYPE: true});

    // follow 
    ActionFollowUses.action();
}

function addButtonPage() {
    const pageValue = GetCurrentPageOnURL.get('page');
    
    buttonPages.forEach(( element ) => {
        TypeClass.class('remove', element, 'pageAt');
        const page = GetDataElement.get(element, 'data-page');
        if ( page == pageValue ) {
            TypeClass.class('add', element, 'pageAt');
        }
    });
}

function handlePagination( page ) { 
    const data = {
        'page' : page, 
        'class' : 'pagination'
    }
    CallAjax.send('POST', data, 'talk/mvc/core/HandleActionInteract.php', ( response ) => {
        const dataJson = CallAjax.get( response );
        try {
            addButtonPage();
            renderInterface( dataJson );
        }         
        catch (err) {
            console.log(err);
        }
    });
}

// Next Prev
const pagePrev = $('#prev-page');
const pageNext = $('#next-page');

const pageItemPrev = $('.pageItem-prev');
const pageItemNext = $('.pageItem-next');

function exceptionHanlePrevNext( page ) {
    const paginationPage = $('.pagination_page');
    const maxPage = parseInt( GetDataElement.get(paginationPage, 'data-max') );
    page = Math.max(1, Math.min(page, maxPage));
    
    if (page === maxPage) {
        TypeClass.class('remove', pageItemPrev, 'blur');
        pageItemPrev.disabled = false;
        TypeClass.class('add', pageItemNext, 'blur');
        pageItemNext.disabled = true;
    } else if ( page === 1 ) {
        TypeClass.class('add', pageItemPrev, 'blur');
        pageItemPrev.disabled = true;
        TypeClass.class('remove', pageItemNext, 'blur');
        pageItemNext.disabled = false;
    }  
    
    return page;
}

function handlePrevNext( type ) {
    let page = GetCurrentPageOnURL.get('page');
    ( type === 'next' ) ? page++ : page--;
    paginationJavascript.corePaginationDisplay( page );
    paginationJavascript.corePaginationUrlBrowser( page );

    window.scrollTo({
        top: 0,
        left: 0,
        behavior: 'smooth'
    });

    paginationJavascript.corePaginationHandle( page );
}

// Top pagination list 
const paginationJavascript = {
    corePaginationUrlBrowser: ( page ) => {
        handleUrlBrowser( page );
    },

    corePaginationHandle: ( page ) => {
        handlePagination( page );
    },

    corePaginationDisplay: ( page ) => {
        exceptionHanlePrevNext( page );
    },

    handleEvents: () => {
        pageItemPrev.addEventListener('click', () => {
            handlePrevNext('prev');
        })

        pageItemNext.addEventListener('click', () => {
            handlePrevNext('next');
        });

        buttonPages.forEach(( element ) => 
        {
            element.addEventListener('click', () => {
                const page = GetDataElement.get( element, 'data-page');
                // Url
                paginationJavascript.corePaginationDisplay( page );
                paginationJavascript.corePaginationUrlBrowser( page );

                window.scrollTo({
                    top: 0,
                    left: 0,
                    behavior: 'smooth'
                });
        
                paginationJavascript.corePaginationHandle( page );
            });
        });

        if ( pagePrev && pageNext ) 
        {
            pagePrev.addEventListener('click', () => {
                pageItemPrev.click(); 
            });
            
            pageNext.addEventListener('click', () => {
                pageItemNext.click(); 
            });
        }        
    },

    start: () => {
        paginationJavascript.handleEvents();
    }
}

paginationJavascript.start();