// Download file 
const btnDownload = $('#btn-download');

const showComments = $('.show-comments');

// Add favorites and likes
const buttonActions = $$('.post-meta .post-btns button');

function swiperSettings() {
    const totalSlide = ( DetectMob.check() ) ? 3 : 4;
    var swiper = new Swiper(".mySwiper", {
        spaceBetween: 10,
        slidesPerView: totalSlide,
        freeMode: true,
        watchSlidesProgress: true,
      });
      var swiper2 = new Swiper(".mySwiper2", {
        spaceBetween: 10,
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        thumbs: {
          swiper: swiper,
        },
    });
}

function downloadPowerpoint( dataJson, fileName ) {
    try {
        if ( dataJson && dataJson.base64Data ) {
            cuteToast({
                type: "info",
                title: "Thông báo",
                message: "Đang tiến hành tải file.",
                timer: 2500
            });
            // Decode base64 data to blob
            var byteCharacters = atob( dataJson.base64Data );
            var byteNumbers = new Array( byteCharacters.length );
            for ( var i = 0; i < byteCharacters.length; i++ ) {
                byteNumbers[i] = byteCharacters.charCodeAt(i);
            }
            var byteArray = new Uint8Array( byteNumbers );
            var blob = new Blob([byteArray], { type: 'application/octet-stream' });
            
            // Create link and download file
            var url = window.URL.createObjectURL( blob );
            var link = document.createElement('a');
            link.href = url;
            link.download = fileName;
            document.body.appendChild( link );
            link.click();
            document.body.removeChild( link );
        } else {
            console.error('An error occurred!');
        }
    }   
    catch( error ) {
        cuteToast({
            type: "error",
            title: "Lỗi",
            message: "Xảy ra lỗi, thử lại sau!",
            timer: 2500
        });
    } 
}

function actionInteractPost( data, index ) 
{
    CallAjax.send('POST', data, 'talk/mvc/core/HandleActionInteract.php', ( response ) => {
        try {
            const dataJson = CallAjax.get( response, 'off' ).err_mess;
            const jsonType = ( dataJson.result === 'insert' ) ? 'add' : 'remove';
            TypeClass.class( `${ jsonType }`, buttonActions[ index ], 'show' );
        }
        catch ( err ) { console.error() } 
    });
}

// POST SUGGESTED ARTICLES
const proposalsPost = $('.proposals-posts');
const getKeywordsProposals = localStorageCore.retrieve('proposals_keywords');
const userId = GetDataElement.get( detailUserHeader, 'data-id' );

// get Tags on support suggest 
function getTags() {
    const data = [];
    const tags = $$('.post-tags ul li a');
    tags.forEach(( tag ) => {
        const textContent = tag.textContent.trim();
        const keyWord = `${ userId + "_" + textContent }`;
        data.push( keyWord );
    });
    return data;
}

function removeDuplicates( array1, array2 ) {
    return array1.filter( item => !array2.includes( item ));
}

function saveSuggestKeyword() {
    if ( userId ) {
        const data = getTags();
        let dataPrepare;

        if ( getKeywordsProposals ) {
            const newTags = data.filter( tag => !getKeywordsProposals.includes( tag ) );

            const combinedData = [ ...getKeywordsProposals, ...newTags ];

            dataPrepare = combinedData;
        } else {
            dataPrepare = data;
        }
        // Saved 
        localStorageCore.storage('proposals_keywords', dataPrepare);
    }
}

function renderSuggestPostInterface( data ) {
    var html = `<span class="title-suggest">⭐ Bài đăng, bạn có thể thích </span>`; 
    html += data.reduce((result, item) => {
        const images = item.images;
        const arrayFiles = images.split("||");
        const imageFirst = arrayFiles[0];
        const template = GetDataElement.get(proposalsPost, 'data-template');
        const id = (item.id_onwser) ? item.id_onwser : item.id;
        return (
            result +
            `<article>
                <a href="/usego/powerpoint/detail?id=${ id }">
                    <img class="poster" src="${ template + imageFirst }"/>
                    <div class="content">
                        <span>${ item.title }</span>
                    </div>
                </a>
            </article>`
        );
    }, '');

    proposalsPost.innerHTML = DOMPurify.sanitize(html, { RETURN_TRUSTED_TYPE: true });
}

// Get suggested articles based on the keywords obtained
function handleSuggestPosts( array ) {
    const data = {
        'title' : $('#title-powerpoint').textContent,
        'keywords' : array.join("|"),
        'id' : GetCurrentPageOnURL.get('id'),
        'class' : 'SuggestPosts'
    };

    CallAjax.send('POST', data ,'mvc/core/HandleProposals.php', ( response ) => {
        const dataJson = CallAjax.get( response, 'off' ).err_mess;
        try {
            renderSuggestPostInterface( dataJson );        
        } 
        catch ( err ) { 
            console.error( err ) 
        }
    });
}

function getSuggestPosts() {
    if ( !userId || !getKeywordsProposals ) {
        proposalsPost.innerHTML = '<span class="alert">Không có đề xuất nào😩</span>';
        return;
    }

    const arrayLoggedKeywords = [];
    Object.values( getKeywordsProposals )
    .filter( keyWord  => {
        const keyPaths = keyWord.split('_');
        arrayLoggedKeywords.push( keyPaths [1] );
        return parseInt( userId ) === parseInt( keyPaths[0] ); 
    });

    if ( arrayLoggedKeywords.length === 0 ) {
        proposalsPost.innerHTML = '<span class="alert">Không có đề xuất nào😩</span>';
        return;
    } 
    else {
        handleSuggestPosts( arrayLoggedKeywords );
    }
}

function savedView() {
    const currentURL = new URL(window.location.href);
    const idValue  = currentURL.searchParams.get('id');
    const data = {
        'id': idValue,
        'type': 'pptx',
        'class': 'savedviewpost'
    };

    CallAjax.send('POST', data, 'talk/mvc/core/HandleActionInteract.php', function (response) {
        const dataJson = CallAjax.get( response, 'off' ).err_mess;
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

// Start Time Measure 
var startTime = new Date();

const detailJavascript = {
    handleEvents() {
        document.addEventListener('DOMContentLoaded', () => {
            this.initializeSwiper();
            this.setupDownloadButton();
            this.setupButtonActions();
            this.setupBeforeUnloadListener();
            this.getSuggestPosts();
        });
    },

    initializeSwiper() {
        swiperSettings(); // Khởi tạo Swiper
    },

    setupDownloadButton() {
        btnDownload.onclick = () => {
            const fileId = GetDataElement.get(btnDownload, 'data-id');
            const fileName = GetDataElement.get(btnDownload, 'data-file');

            const data = {
                file: encodeURIComponent(fileName),
                id: fileId,
                class: 'download',
            };

            CallAjax.send('POST', data, 'mvc/core/Download.php', (response) => {
                try {
                    const dataJson = CallAjax.get(response, 'off').err_mess;
                    if (dataJson) {
                        downloadPowerpoint(dataJson, fileName);
                    }
                } catch (err) {
                    console.error(err);
                }
            });
        };
    },

    setupButtonActions() {
        buttonActions.forEach((bt, index) => {
            bt.onclick = () => {
                const type = index === 0 ? 'ugcollection' : 'uglike';
                const id = GetCurrentPageOnURL.get('id');
                const data = {
                    idPost: id,
                    class: type,
                };
                actionInteractPost(data, index);
            };
        });
    },

    setupBeforeUnloadListener() {
        window.addEventListener('beforeunload', (event) => {
            const endTime = new Date();
            const timeSpent = endTime - startTime;
            const timeSpentInSeconds = Math.round(timeSpent / 1000);

            if (Math.round(timeSpentInSeconds / 60) > 2) {
                saveSuggestKeyword(); 
            }

            if (timeSpentInSeconds > 10) {
                savedView(); 
            }
        });
    },

    getSuggestPosts() {
        getSuggestPosts(); 
    },

    start() {
        this.handleEvents();
    },
};

// Khởi chạy script
detailJavascript.start();
