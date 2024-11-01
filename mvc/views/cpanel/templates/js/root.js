const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

const loadingWebsite = $('.loadding_website');
const imagePowerpoints = $$('.poster-product');

const buttons = $$('button');
const modalInstructTalk = $('.modal-instruct-talk');

// Function editing class
const TypeClass = {
    class: ( type = 'add', element, className ) => {
        switch ( type ) 
        {
            case 'toggle' : 
                element.classList.toggle( className );
            break;

            case 'add':
                element.classList.add( className );
            break;

            case 'remove':
                element.classList.remove( className );
            break;
        }
    },
};

// Function debounces
const Debounces = {
    listen: (callAjax, delay) => {
        let timerId;
        return (...args) => {
            clearTimeout(timerId);
            timerId = setTimeout(() => {
                callAjax.apply(null, args);
            }, delay);
        };
    },
};

// Function callAjax
const CallAjax = {
    // Function handle get response call ajax 
    get: ( response, status = 'on' ) => {
        try {
            var index = response.indexOf('}{');
            var jsonString = response.substring( index + 1 );
            var dataJson = JSON.parse( jsonString );
            const code = ( dataJson.code === 0 ) ? 'error' : 'success';
            const code_title = ( dataJson.code === 0 ) ? 'Lỗi' : 'Thành công';
            const default_message = ( dataJson.code === 0 ) ? 'Xảy ra lỗi, thử lại sau' : 'Thực hiện thành công';
            const code_message = ( dataJson.err_mess ) ? dataJson.err_mess : default_message;
            const err_message = dataJson.err_mess;
            if ( err_message ) {
                if ( status === 'on' ) {
                    cuteToast({
                        type: code,
                        title: code_title,
                        message: code_message,
                        timer: 3500
                    });
                }
                return dataJson;
            } 
        } 
        catch( err ) {
            return response;
        }
    },

    send: ( method, data = {}, target, callback ) => {
        var xhr = new XMLHttpRequest();
        xhr.open( method, target, true );
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = () => {
            if ( xhr.readyState === 4 ) {
                if( xhr.status === 200 ) {
                    if ( callback ) {
                        const jsonResponse = JSON.stringify( xhr.response );
                        const jsonResponseParse  = JSON.parse( jsonResponse );
                        callback( jsonResponseParse );
                    }
                }
            }
        };
        const keyValuePairs = Object.entries( data );
        const requestData = keyValuePairs.map( ([ key, value ]) => `${ key }=${ value }` );
        const requestDataString = requestData.join('&');
        xhr.send( requestDataString );
    },
};

// Function LocalStorage 
const localStorageCore = {
    storage: (storageName, storageContent) => {
        try {
            const jsonData = JSON.stringify(storageContent);
            localStorage.setItem(storageName, jsonData);
        } catch (error) {
            console.error('Lỗi khi lưu trữ dữ liệu vào local storage:', error);
        }
    },

    retrieve: (storageName) => {
        try {
            const storedData = localStorage.getItem(storageName);
            if (storedData) {
                return JSON.parse(storedData);
            } 
        } catch (error) {
            console.error('Lỗi khi lấy dữ liệu từ local storage:', error);
            return null;
        }
    },

    remove: (storageName) => {
        try {
            localStorage.removeItem(storageName);
            console.log(`Dữ liệu đã được xóa khỏi ${storageName}.`);
        } catch (error) {
            console.error('Lỗi khi xóa dữ liệu từ local storage:', error);
        }
    },

    clearAll: () => {
        try {
            localStorage.clear();
            console.log('Tất cả dữ liệu trong local storage đã được xóa.');
        } catch (error) {
            console.error('Lỗi khi xóa toàn bộ dữ liệu trong local storage:', error);
        }
    }
};


// No scroll html 
const NoScrollHTML = {
    noScroll: ( type ) => {
        const html = $('html');
        const identifyAction = ( type === 'yes' ) ? 'add' : 'remove';
        TypeClass.class(`${ identifyAction }`, html, 'noscroll')
    }
};

// Check is mobile or window 
const DetectMob = {
    check: () => {
        const toMatch = [
            /Android/i,
            /webOS/i,
            /iPhone/i,
            /iPad/i,
            /iPod/i,
            /BlackBerry/i,
            /Windows Phone/i
        ];
        
        return toMatch.some((toMatchItem) => {
            return navigator.userAgent.match(toMatchItem);
        });
    }
};

// Quesiton alert 
const DialogBoxQuestion = {
    dialog: ( content, description ) => {
        const dialogBoxTitle = $('.dialog-box .title-box');
        const dialogBoxDes = $('.dialog-box .des-box');
        // Set text content 
        dialogBoxTitle.textContent = content;
        dialogBoxDes.textContent = description;
    } 
};

// Getdata = getattribute 
const GetDataElement = {
    get: ( element, value ) => {
        return element.getAttribute( value );
    }
};

// Get params url 
const GetCurrentPageOnURL = {
    get: ( param ) => {
        const url = new URL( window.location.href );
        return url.searchParams.get( param ); 
    }
};

// Destroy multiple classes at once
const ResetClasses = {
    lists: ( elements, className ) => {
        elements.forEach(e => { TypeClass.class( 'remove', e, className ) })
    }
};

// Delete class quickly 
const AddClasses = {
    lists: ( elements, className ) => {
        elements.forEach(e => { TypeClass.class( 'add', e, className ) })
    }
};

const AlertUsego = {
    identify: ( type ) => {
        const identifyAction = ( type === 'yes' ) ? 'add' : 'remove';
        const identifyActionHtml = ( type === 'yes' ) ? 'yes' : 'no';

        TypeClass.class(`${ identifyAction }`, $('.modal-content'), 'show');
        TypeClass.class(`${ identifyAction }`, $('.modal-overlay'), 'show');
    
        // Action identify html class no scroll
        NoScrollHTML.noScroll(`${ identifyActionHtml }`);
    },

    show: ( title, content ) => {
        // Title
        $('.modal-newfeed-pad .title h4').innerHTML = title;
        
        // Content
        $('.modal-newfeed-pad .newfeed-new-item').innerHTML = content;
    },

    template: () => {
        return GetDataElement.get( $('.modal-newfeed-pad'), 'data-template' );
    }
};

// Shared Setting root.js 
const rootJavascript = { 
    handleEvents: () => {
        document.addEventListener('DOMContentLoaded', () => {
            TypeClass.class('add', loadingWebsite, 'load');

            imagePowerpoints.forEach((element) => {
                TypeClass.class('add', element, 'loadFinished');
            })

            buttons.forEach(( btn ) => { btn.onclick = ( e ) => { e.preventDefault() } });
        });
    }, 

    start: () => {
        rootJavascript.handleEvents();
    } 
}

// Start 
rootJavascript.start();

// DOMPurify.sanitize(icon, { RETURN_TRUSTED_TYPE: true })