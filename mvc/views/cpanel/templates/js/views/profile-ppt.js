/* Additional profile files to upload presentations */
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

function getTabParameterFromURL( value ) {
    const url = window.location.href;
    const searchParams = new URLSearchParams(new URL(url).search);
    return searchParams.get( value );
}

const titlePowerpoint = $('input[name="title-powerpoint"]');
const tagsPowerpoint = $('input[name="tags-powerpoint"]');
const arrayTagsPowerpoint = [];

function getValueFile(value, maximun, maxAlert = 80) {
    if (value.length > maximun) {
    cuteToast({
        type: "error",
        title: "Lỗi",
        message: `Tiêu đề cần ngắn hơn ${maxAlert} kí tự`,
        timer: 3000
    })
    } else {
        btnUpPowerpoint.disabled = false;
        return value;
    }
}

function isEmpty(value, wrapper) {
    const errorElement = wrapper.parentElement.querySelector('.error');
    if (value.trim() === '') {
        if (!errorElement) {
            const render = `
            <span class="error"> 
                Vui lòng nhập dữ liệu
            </span>`;

            const div = document.createElement('div');
            TypeClass.class('add', div, 'error');
            div.textContent = 'Vui lòng nhập dữ liệu';
            wrapper.parentElement.appendChild(div);

            titlePowerpoint.style.border = '1.5px solid #f33a58';
            btnUpPowerpoint.disabled = true;
        }
    } 
}

function getTags() {
    arrayTagsPowerpoint.length = 0;
    const tags = listTagsPowerpoints.querySelectorAll('li');
    tags.forEach(tag => {
        const text = `${tag.textContent}||`;
        arrayTagsPowerpoint.push(text);
    });
    return arrayTagsPowerpoint;
}

// Displays input and output keywords
function displayKeywords() {
    var storedValues = JSON.parse(localStorage.getItem('storedValues')) || [];    
    storedValues.forEach(function( keyword ) {
        var listItem = document.createElement('li');
        const html = `
            ${ keyword }
            <i class="fa-solid fa-clock-rotate-left" data-type="history"></i>
        `;
        listItem.innerHTML = DOMPurify.sanitize(html, {RETURN_TRUSTED_TYPE: true});
        
        if ($('#list-suggests')) {
            listSuggests.appendChild( listItem );
        }
    });
}

// Saves the value to localStorage when the user types and presses enter
function storesKeywordInput(value) {
    const key = value.toLowerCase();
    var storedValues = JSON.parse(localStorage.getItem('storedValues')) || [];

    // Check if the key is not present in storedValues
    if (!storedValues.includes(key)) {
        storedValues.unshift(key);

        // Slice the array if it's longer than 9
        if (storedValues.length > 9) {
            storedValues = storedValues.slice(0, 9);
        }

        localStorage.setItem('storedValues', JSON.stringify(storedValues));
    }
}

const btnSendPowerpoint = $('#send-powerpoint');
const uploadWrapper2 = $('.upload-wrapper-2');
const selectAddContent = $('.select-add-content');
const uploadWrapperUl = $('.upload-wrapper ul');
const productLists = $('.product-lists');
// Button close 
const btnCombackUploadTitle = $('#btn-comback-upload-title');
const btnClPowerpoint = $('#btn-cl-powerpoint');
// Button upload 
const btnUpPowerpoint = $('#btn-up-powerpoint');


function showInputTextFile(type) {
    const identify = ( type === 'add' ) ? 'add' : 'remove';
    TypeClass.class(identify, uploadWrapper2, 'show');
    TypeClass.class(identify, selectAddContent, 'show');
    TypeClass.class(identify, uploadWrapperUl, 'hidden');
}

function prepareData() {
    const formData = new FormData();

    const addFormData = (key, value, errorMessage) => {
        if (value.trim() !== '') {
            formData.append(key, value);
        } else {
            cuteToast({
                type: "error",
                title: "Lỗi",
                message: errorMessage,
                timer: 3000
            });
            return null; 
        }
    };

    addFormData('title', getValueFile(titlePowerpoint.value), 'Tiêu đề, lỗi!');
    formData.append('tags', getTags());

    if (identifyAutomatic) {
        formData.append('powerpoint', selectPowerpoint[0].name);
        formData.append('images-uploads', arrayImageFiles.join('||'));
    } else {
        if (selectPowerpoint[0]) {
            formData.append('powerpoint', selectPowerpoint[0]);
        } else {
            cuteToast({
                type: "error",
                title: "Lỗi",
                message: "File, lỗi!",
                timer: 3000
            });
            return null; 
        }
    
        if ( arrayImageFiles ) 
        {
            for( const file of arrayImageFiles ) 
            {
                formData.append('image-uploads[]', file);
            }
        } else {
            cuteToast({
                type: "error",
                title: "Lỗi",
                message: "Ảnh, lỗi!",
                timer: 3000
            });
            return null; 
        }
    }

    formData.append('class', 'UploadPowerpoint');
    formData.append('identify', (identifyAutomatic) ? 'automatic' : 'manual');
    return formData; 
}

function resetDataUpload() {
    selectPowerpoint.length = 0;
    // Hidden 'wrapperInfoFileUpload'
    TypeClass.class('remove', wrapperInfoFileUpload, 'show');
    selectListImages.innerHTML = DOMPurify.sanitize('', {RETURN_TRUSTED_TYPE: true});
    arrayImageFiles.length = 0;
    arrayImageUploads.length = 0;
    // Reset array contains informational images
    TypeClass.class('remove', listTagsPowerpoints, 'show');
    titlePowerpoint.value = '';
    tagsPowerpoint.value = '';
    listTagsPowerpoints.innerHTML = DOMPurify.sanitize('', {RETURN_TRUSTED_TYPE: true});
    arrayTagsPowerpoint.length = 0;
    // Reset title & tag 
    showInputTextFile('remove');
    // Interface
    titlePowerpoint.style.border = '1.5px solid rgba(22,24,35,.06)';
    if($('.upload-wrapper-2 .title .error'))
    $('.upload-wrapper-2 .title .error').remove();
}

function isLoading(type) {
    if ($('.upload-wrapper .loading-wrapper')) {
        const loadding = $('.upload-wrapper .loading-wrapper');
        (type === 'add') ? TypeClass.class('add', loadding, 'show') : TypeClass.class('remove', loadding, 'show');
    }
}

const dataJsonProfile = [];

// Handle click suggest card tags 
const listTagsPowerpoints = $('#list-tags-powerpoints');
const listSuggests = $('#list-suggests');

function toggleClass(element, className) {
    element.classList.toggle(className);
}

function changeIconClass(element, removeClass, addClass) {
    const iconElement = element.querySelector('i');
    iconElement.classList.remove(removeClass);
    iconElement.classList.add(addClass);
}

function handleSuggestsClick(clickedElement) {
    if (!clickedElement || !listSuggests.contains(clickedElement)) {
        return;
    }
    TypeClass.class('add', listTagsPowerpoints, 'show');
    
    const copiedElement = clickedElement.cloneNode(true);
    const childCopiedI = copiedElement.querySelector('[data-type="history"]');
    if(childCopiedI) {
        changeIconClass(copiedElement, 'fa-clock-rotate-left', 'fa-xmark');
    } else {
        changeIconClass(copiedElement, 'fa-arrow-trend-up', 'fa-xmark');
    }

    listTagsPowerpoints.appendChild(copiedElement);

    if (listSuggests.children.length === 1) {
        toggleClass(listSuggests, 'hidden');
    }

    clickedElement.remove();
}

function handleTagsPowerpointsClick(clickedRemoveIcon) {
    if (!clickedRemoveIcon || !listTagsPowerpoints.contains(clickedRemoveIcon.parentElement)) {
        return;
    }
    const index = Array.from(listTagsPowerpoints.children).indexOf(clickedRemoveIcon.parentElement);

    if (listTagsPowerpoints.children.length === 1) {
        TypeClass.class('remove', listTagsPowerpoints, 'show');
    }

    const copiedElement = listTagsPowerpoints.children[index].cloneNode(true);
    const childCopiedI = copiedElement.querySelector('[data-type="history"]');

    if(childCopiedI) {
        changeIconClass(copiedElement, 'fa-xmark', 'fa-clock-rotate-left');
    }
    else {
        changeIconClass(copiedElement, 'fa-xmark', 'fa-arrow-trend-up');
    }

    listTagsPowerpoints.children[index].remove();
    TypeClass.class('remove', listSuggests, 'hidden');
    listSuggests.appendChild(copiedElement);
}

/* Get data of collections added to favorites */

function renderFavourites( data ) {
    const html = data.reduce(( result, item ) => {
    const imageArray = item.images;
    const arrayFiles = imageArray.split("||");
    const firstFileImage = arrayFiles[0];
    var template = GetDataElement.get( $('.menu-lists'), 'data-template');
    var owner = GetDataElement.get( productLists , 'data-owner' );

    const seeMore = ( parseInt( owner ) == 1 ) ? `<button class="auth-see-more">
        <i class="fa-solid fa-ellipsis"></i>
        </button>
        <div class="detail-extended">
            <div class="wrapper-auth">
                <div class="btn-extended">
                    <span class="btn-remove-ex">
                        Hủy bỏ
                    </span>
                </div>
                <div class="btn-extended">
                    <span class="btn-delete-ex" data-id="${ item.id }">
                        Xóa bỏ
                    </span>
                </div>
            </div>
        </div>` : '';

        return (
            result + `
            <section class="card-product">
                ${ seeMore }
                <div class="poster">
                <a href="/usego/powerpoint/detail?id=${ (myParam != null) ? item.id : item.id }">    
                    <img class="lazyload"
                    data-src="${ template + firstFileImage }">
                </a>
                </div>
                <div class="info">
                    <a href="/usego/powerpoint/detail?id=${ (myParam != null) ? item.id : item.id }">
                        <div class="title">
                            ${ item.title }
                        </div>
                    </a>
                    <div class="des">
                        <small class="topic">
                            <p title="Powerpoint">Powerpoint</p>
                        </small>
                        <small class="date">
                            <p>2 Ngày trước</p>
                        </small>
                    </div>
                </div>
            </section>
            `
        );
    }, '');

    productLists.innerHTML = DOMPurify.sanitize(html, {RETURN_TRUSTED_TYPE: true});

    // Options 
    $$('.auth-see-more').forEach((element) => {
        element.addEventListener('click', () => {
            hanldeButtonSeeMore( element );
        });
    });

    // Remove options
    $$('.btn-remove-ex').forEach((element) => {
        element.addEventListener('click', () => {
            resetExtended( $$('.detail-extended'), 'show' );
        });
    });
    
    // Delete post  
    $$('.btn-delete-ex').forEach((element) => {
        element.addEventListener('click', () => {
            prepareDataDelete( element );
        });
    });
}

function renderBlog( data ) {
    const html = data.reduce(( result, item ) => {
        var alert = '';
    
        if ( item.topic === 'service' ) {
            alert = ( item.status === 'HT' ) 
            ? '<span class="alert success"> Đã hoàn thành </span>' 
            : '<span class="alert error"> Chưa hoàn thành </span>'; 
        } else {
            alert = '';
        }

        const paramId = ( item.topic === 'service' ) 
        ? `/usego/profile/action?id=${ item.id } ` 
        : `/usego/instruct/read?id=${ item.id } `;

        const total = (item.total !== null) 
        ? `<span class="action" title="Số lượng yêu cầu">${ item.total }</span>`
        : '';

        const hide = (item.hide === 'false')
        ?  `<img class="not-display" src="${AlertUsego.template()}images/icons/not-display.png" width="20">`
        : '';

        return (
            result + `
            <section class="card-action">
                <a href="${ paramId }">
                    <div class="content">
                        <h3> ${ item.title } </h3>
                        <div class="des">
                            ${ alert }
                            <span> ${ item.createAt } </span>
                        </div>
                    </div>
                </a>
                ${ total }
                ${ hide }
                <span class="view"> ${ item.view } Lượt xem </span>
            </section>
            `
        );
    }, '');

    productLists.innerHTML = DOMPurify.sanitize(html, {RETURN_TRUSTED_TYPE: true});
}

// const dataJsonFavourites = [];
const btnCollectionMenu = $('.btn-collection-menu');
const btnCollectionFeed = $('.btn-collection-feeds');

function handleUrlBrowser( type ) {
    const page = getTabParameterFromURL( 'id' );
    if (type === 'profile') {
        history.pushState(null, null, `?id=${ page }`)
    } else if (type === 'favorite') {
        history.pushState(null, null, `?id=${ page }&tab=c`);
    } else {
        history.pushState(null, null, `?id=${ page }&tab=d`);
    }
}

function loadNoPostValue() {
    const temp = GetDataElement.get( productLists, 'data-temp' )

    const html = `
    <div class="no-posts-yet">
        <div class="poster">
            <img 
            src="${ temp }images/icons/no-value.png" width="90">
        </div>
        <span>Không có kết quả nào</span>
    </div> `;

    productLists.innerHTML = DOMPurify.sanitize(html, {RETURN_TRUSTED_TYPE: true});
}

/* View Author's posts */

const btnAuthorMenu = $('.btn-author-menu');

// Options 
const btnSeeMores = $$('.auth-see-more');
const btnRemoveExs = $$('.btn-remove-ex');
const btnDeleteExs = $$('.btn-delete-ex');
const detailExtendeds = $$('.detail-extended');

function resetExtended( wrapper, className ) {
    wrapper.forEach((e) => { TypeClass.class('remove', e, className) });
}

function hanldeButtonSeeMore( element ) {
    const cardProduct = element.closest('.card-product');
    const detailExtended = cardProduct.querySelector('.detail-extended');

    if (detailExtended.classList.contains('show')) {
        TypeClass.class('remove', detailExtended, 'show')
    } else {
        resetExtended( $$('.detail-extended'), 'show' );
        TypeClass.class('add', detailExtended, 'show');
    }
}

function checkEmptyPosted() {
    if ( $$('.card-product').length <= 0 ) {
        loadNoPostValue();
    }
}

function prepareDataDelete( element ) {
    const dataId = element.getAttribute('data-id');
    const tab = getTabParameterFromURL( 'tab' );
    const data = {
        'id' : dataId,
        'tab' : tab,
        'class' : 'removeprofile'
    };
    CallAjax.send('POST', data, 'mvc/core/HandleActionInteract.php', function ( response ) {
        try {
            const dataJson = CallAjax.get( response, 'off' );
            if ( dataJson.code !== 0 ) {
                const item = element.closest('.card-product');
                item.remove();
                checkEmptyPosted();
            }
        } 
        catch ( err ) {
            console.log( err );
        }
    });   
}

// Check are staying 'tab'
const myParam = getTabParameterFromURL( 'tab' );

/* Arrange */
const identifyObj = $('.topic-lists ul li a.focus').innerText;

// Functions arrange 
function arrangePost( typeArrange ) {
    if ( identifyObj && identifyObj === 'Powerpoint' ) {
        const idValue  = getTabParameterFromURL( 'id' );
        const data = {
            'id': idValue,
            'type' : typeArrange,
            'class': 'arrangepost'
        };
        CallAjax.send('POST', data, 'mvc/core/HandleActionInteract.php', function (response) {
            try {
                const dataJson = CallAjax.get( response, 'off' ).err_mess;
                renderFavourites( dataJson );
                handleUrlBrowser('favorite');
            } 
            catch (err) {
                loadNoPostValue();
            }
        });
    }
    
}

const btnKindAz = $('.btn-kind-like-az');
const btnKindZa = $('.btn-kind-like-za');

const profilePowerpointJavascript = {
    handleEvents() {        
        document.addEventListener('DOMContentLoaded', () => {
            this.initializeEventListeners();
        });
    },

    initializeEventListeners() {
        titlePowerpoint?.addEventListener('input', this.debounceInputTitle);
        titlePowerpoint?.addEventListener('blur', this.debounceBlurTitle);
        tagsPowerpoint?.addEventListener('input', this.debounceInputTags);
        tagsPowerpoint?.addEventListener('keydown', this.handleEnterKey);
        btnCombackUploadTitle?.addEventListener('click', this.handleCombackUpload);
        btnClPowerpoint?.addEventListener('click', this.handleClearUpload);
        btnSendPowerpoint?.addEventListener('click', this.handleSendPowerpoint);
        btnAuthorMenu?.addEventListener('click', this.handleAuthorPosts);
        this.setupButtonSeeMore();
        this.setupCloseSelected();
        this.setupDeleteSelectedPosts();
        btnUpPowerpoint?.addEventListener('click', this.handleUploadPowerpoint);
        listSuggests?.addEventListener('click', this.handleSuggestsClick);
        listTagsPowerpoints?.addEventListener('click', this.handleTagsPowerpointsClick);
        btnCollectionMenu?.addEventListener('click', this.handleGetFavourites);
        btnCollectionFeed?.addEventListener('click', this.handleGetBlogData);
        this.checkAndLoadFavourites();
        this.checkAndLoadsFeeds();
        btnKindAz?.addEventListener('click', () => arrangePost('kinaz'));
        btnKindZa?.addEventListener('click', () => {
        });
    },

    debounceInputTitle: Debounces.listen((event) => {
        const value = event.target.value;
        if (value !== '') {
            titlePowerpoint.style.border = '1.5px solid rgba(22,24,35,.06)';
        }
        getValueFile(value, 79, 80);
    }, 300),

    debounceBlurTitle: Debounces.listen((event) => {
        const value = event.target.value;
        isEmpty(value, titlePowerpoint);
        TypeClass.class('add', btnUpPowerpoint, 'show');
    }, 300),

    debounceInputTags: Debounces.listen((event) => {
        const value = event.target.value;
        getValueFile(value, 59, 60);
    }, 300),

    handleEnterKey: (event) => {
        if (event.keyCode === 13) {
            const value = event.target.value;
            storesKeywordInput(value);
            if (value.trim() !== '') {
                const render = `
                    <li>${value} <i class="fa-solid fa-xmark" data-type="history"></i></li>`;
                TypeClass.class('add', listTagsPowerpoints, 'show');
                listTagsPowerpoints.insertAdjacentHTML('beforeend', DOMPurify.sanitize(render, { RETURN_TRUSTED_TYPE: true }));
                tagsPowerpoint.value = '';
            }
        }
    },

    handleCombackUpload: () => {
        showInputTextFile('remove');
    },

    handleClearUpload: () => {
        showInputTextFile('remove');
        titlePowerpoint.value = '';
        tagsPowerpoint.value = '';
        const tags = listTagsPowerpoints.querySelectorAll('li');
        tags.forEach(tag => {
            tag.remove();
        });
        arrayTagsPowerpoint.length = 0;
    },

    handleSendPowerpoint: (e) => {
        const powerpoint = selectPowerpoint[0];
        const images = arrayImageFiles;
        if (powerpoint && images.length > 0) {
            showInputTextFile('add');
            displayKeywords();
        }
    },

    handleAuthorPosts: () => {
        const idValue = getTabParameterFromURL('id');
        const data = { 'id': idValue, 'class': 'authorposts' };
        CallAjax.send('POST', data, 'mvc/core/HandleActionInteract.php', (response) => {
            const dataJson = CallAjax.get(response, 'off').err_mess;
            try {
                renderFavourites(dataJson);
                handleUrlBrowser('profile');
            } catch (err) {
                loadNoPostValue();   
            }
        });
    },

    setupButtonSeeMore() {
        btnSeeMores?.forEach((element) => {
            element.addEventListener('click', () => {
                hanldeButtonSeeMore(element);
            });
        });
    },

    setupCloseSelected() {
        btnRemoveExs?.forEach((element) => {
            element.addEventListener('click', () => {
                resetExtended($$('.detail-extended'), 'show');
            });
        });
    },

    setupDeleteSelectedPosts() {
        btnDeleteExs?.forEach((element) => {
            element.addEventListener('click', () => {
                prepareDataDelete(element);
            });
        });
    },

    handleUploadPowerpoint: () => {
        isLoading('add');
        const formData = prepareData();
        if (formData !== null) {
            callAjaxWithFormData('POST', formData, 'mvc/core/HandleDataUpload.php', (response) => {
                const dataJson = CallAjax.get(response, 'off').err_mess;
                try {
                    if (dataJson) {
                        resetDataUpload();
                        isLoading('remove');
                        btnAuthorMenu.click();
                        cuteToast({
                            type: "success",
                            title: "Thành công",
                            message: "Bài đăng đã sẵn sàng.",
                            timer: 3000
                        });
                    }
                } catch (err) {
                    console.log(err);
                }
            });
        }
    },

    handleSuggestsClick: (event) => {
        const clickedElement = event.target.closest('li');
        handleSuggestsClick(clickedElement);
    },

    handleTagsPowerpointsClick: (event) => {
        const clickedRemoveIcon = event.target.closest('li i');
        handleTagsPowerpointsClick(clickedRemoveIcon);
    },

    handleGetFavourites: () => {
        const idValue = getTabParameterFromURL('id');
        const data = { 'id': idValue, 'class': 'getdatafavourite' };
        CallAjax.send('POST', data, 'mvc/core/HandleActionInteract.php', (response) => {
            const dataJson = CallAjax.get(response, 'off').err_mess;
            try {
                renderFavourites(dataJson);
                handleUrlBrowser('favorite');
            } catch (err) {
                loadNoPostValue();
            }
        });
    },

    handleGetBlogData: () => {
        const idValue = getTabParameterFromURL('id');
        const data = { 'id': idValue, 'class': 'GetDataAction' };
        CallAjax.send('POST', data, 'mvc/core/HandleActionInteract.php', (response) => {
            const dataJson = CallAjax.get(response, 'off').err_mess;
            try {
                renderBlog(dataJson);
                handleUrlBrowser('feeds');
            } catch (err) {
                loadNoPostValue();
            }
        });
    },

    checkAndLoadFavourites() {
        if (myParam === 'c') {
            btnCollectionMenu.click();  
        }
    },

    checkAndLoadsFeeds() {
        if (myParam === 'd') {
            btnCollectionFeed.click();  
        }
    },

    start() {
        this.handleEvents();
    }
};

profilePowerpointJavascript.start();
