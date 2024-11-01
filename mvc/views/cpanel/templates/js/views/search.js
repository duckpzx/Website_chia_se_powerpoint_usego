const listsBody = $('.lists-body');

function renderBody(data) {
    const listsBody = $('.lists-body');
    const template = listsBody.getAttribute('data-template');
    const temp = listsBody.getAttribute('data-temp');

    var html = data.reduce((result, item) => {
        const images = item.images.split("||");
        const [ fileImage1, fileImage2, fileImage3 ] = images;

        const id = item.id_onwser || item.id;
        const imageSrcs = [template + fileImage1, template + fileImage2, template + fileImage3];
        
        const sectionHTML = `
            <section>
                <a href="/usego/powerpoint/detail?id=${id}">
                    <div class="posters">
                        ${ imageSrcs.map(src => `<img data-src="${ src }" 
                        class="lazyload" 
                        alt="Photo">`).join('')}
                    </div>
                </a>
                <div class="content">
                    <div class="title">
                        <h3>${ item.title }</h3>
                    </div>
                    <div class="infomation">
                        <div class="flex flex-alicenter heart">
                            <img src="${ temp }images/icons/like.png" width="25">
                            ${ item.like_count }
                        </div>
                        <div class="flex flex-alicenter comment">
                            <img src="${ temp }images/icons/comment.png" width="25">
                            ${ item.comment_count + item.respond_count }
                        </div>
                    </div>
                </div>
            </section>
        `;
        return result + sectionHTML;
    }, '');

    listsBody.innerHTML = DOMPurify.sanitize(html, {RETURN_TRUSTED_TYPE: true});
}

const searchKeyword = $('input[name="search-keyword"]');

function callAjaxSearchKeyWords( data ) {
    CallAjax.send('POST', data,'talk/mvc/core/HandleProposals.php', function(response) {
        const dataJson = CallAjax.get( response, 'off' ).err_mess;
        try { 
            renderBody( dataJson );
        } catch (error) {
            listsBody.innerHTML = "Không có kết quả phù hợp😩";
        }
    });
}

function searchOnUrl() {
    const qParam = GetCurrentPageOnURL.get('q');
    ResetClasses.lists( btnFilters, 'filter' );
    TypeClass.class('add', btnPowerpoint, 'filter');

    if( qParam !== '' && qParam.length > 1 ) 
    {
        const data = {
            'valuesearch': qParam,
            'class': 'searchtips'
        };
        callAjaxSearchKeyWords( data );
    } else {
        listsBody.innerHTML = '';
    }
}

function searchOnInput( value ) {
    const data = {
        'valuesearch': value,
        'class': 'searchtips'
    };

    history.pushState(null, null, `?q=${ value }`);
    callAjaxSearchKeyWords( data );
}

// When clicking on other options

const btnFilters = $$('.group-selector button');
const btnPowerpoint = $('.powerpoint');
const post = $('.post');

const searchJavascript = {
    init: () => {
        document.addEventListener('DOMContentLoaded', searchJavascript.handleEvents);
    },

    handleEvents: () => {
        searchOnUrl();

        btnFilters?.forEach(bt => {
            bt.onclick = () => {
                ResetClasses.lists(btnFilters, 'filter');
                TypeClass.class('add', bt, 'filter');
            };
        });

        searchKeyword?.addEventListener('input', Debounces.listen(searchJavascript.onSearchInput, 300));
    },

    onSearchInput: (event) => {
        const value = event.target.value.trim();
        ResetClasses.lists(btnFilters, 'filter');
        TypeClass.class('add', btnPowerpoint, 'filter');

        const qParam = GetCurrentPageOnURL.get('q');
        if (!qParam) history.pushState(null, null, `?q=`);

        if (value.length > 1) {
            searchOnInput(value);
        } else {
            history.pushState(null, null, `?q=`);
            listsBody.innerHTML = '';
        }
    },

    start: () => {
        searchJavascript.init();
    }
};

searchJavascript.start();
