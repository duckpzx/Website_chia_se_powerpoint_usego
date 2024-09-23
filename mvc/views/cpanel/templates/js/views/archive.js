const btnSelect = $('.select');
const posters = $$('.lists-body .poster');
const downloadPoster = $('.add-download .poster');
const inputCheckboxes = $$('input[type=checkbox]');
const remove = $('#remove');

const arrayToRemove = [];

function handleCheckboxClick( checkbox ) {
    const checkeds = $$('input[type="checkbox"]:checked');
    const idPost = GetDataElement.get(checkbox, 'data-id');

    if ( checkbox.checked ) {
        remove.disabled = false;
        TypeClass.class('add', remove, 'select');
        if (!arrayToRemove.includes( idPost )) {
            arrayToRemove.push( idPost );
        }
    } else {
        const index = arrayToRemove.indexOf( idPost );
        if ( index !== -1 ) {
            arrayToRemove.splice(index, 1);
        }
        if ( checkeds.length === 0 ) {
            remove.disabled = true;
            TypeClass.class('remove', remove, 'select');
        }
    }
}

function handleRemoveButtonClick() {
    const data = {
        'arrays': arrayToRemove,
        'class': 'removearchive',
    };
    const checkeds = $$('input[type="checkbox"]:checked');

    checkeds.forEach(( element ) => {
        const dataItValue = GetDataElement.get( element, 'data-id');
        if ( arrayToRemove.includes( dataItValue ) ) {
            const section = element.closest('section');
            if ( section ) {
                section.remove();
            }
        }
    })
    CallAjax.send('POST', data, 'mvc/core/HandleActionInteract.php', function ( response ) {
        const dataJson = CallAjax.get( response );
        if ( dataJson ) {
            cuteToast({
                type: "success",
                title: "Thành công",
                message: dataJson,
                timer: 2500
            });
            TypeClass.class('remove', remove, 'select');
            btnSelect.click();
        }
    });
}

// button filter click 
const btnFilters = $$('.group-selector button');
const btnNew = $('.group-selector .new');
const btnDate = $('.group-selector .date');
const btnCollection = $('.group-selector .collection');
const btnLike = $('.group-selector .like');
// Lists post 
const listsBody = $('.lists-body');
const dataJsonArchive = [];
const addDownloadSection = $('.add-download').outerHTML;

function arrayResetClass( array, className ) {
    array.forEach(( e ) => {
        TypeClass.class('remove', e, className);
    })
}

function renderBody( data ) {
    var html = data.reduce((result, item) => {
    const images = item.images;
    const arrayFiles = images.split("||");
    const imageFirst = arrayFiles[0];
    const template = GetDataElement.get( $('.lists-body'), 'data-template');
    const id = ( item.id_onwser ) ? item.id_onwser : item.id;

        return (
            result + 
            `<section>
                <a href="/usego/powerpoint/detail?id=${ id }">
                <input type="checkbox" name="selective" data-id="${ id }">    
                    <img class="poster"
                    src="${ template + imageFirst }"
                    onerror="${ this.src = template + 'images/icons/not-image.png' }"/>
                    <!-- Content -->
                    <div class="content">
                        <h3>${ item.title }</h3>
                    </div>
                </a>
                <p>
                <small><i class="fa-regular fa-clock"></i>${ item.timeAt }</small>
                </p>
            </section> `
        );
    }, '');

    html += addDownloadSection;
    listsBody.innerHTML = DOMPurify.sanitize(html, {RETURN_TRUSTED_TYPE: true});

    const posters = $$('.lists-body .poster');
    const downloadPoster = $('.add-download .poster');
    const inputCheckboxes = $$('input[type=checkbox]');

    $('.select').addEventListener('click', () => {
        posters.forEach((element) => {
            TypeClass.class('toggle', element, 'select');
        });
        
        TypeClass.class('remove', downloadPoster, 'select');
    
        inputCheckboxes.forEach((element) => {
            TypeClass.class('toggle', element, 'select');
        });
        // push id To delete
    })

    $$('input[type=checkbox]').forEach((checkbox) => {
        checkbox.addEventListener('click', () => {
            handleCheckboxClick(checkbox);
        });
    });
    
    $('#remove').addEventListener('click', () => {
        handleRemoveButtonClick();
    });
}

function confirmIcon(button) {
    const icon = button.querySelector('i');
    const isCaretDown = icon.classList.contains('fa-caret-down');
    const action = isCaretDown ? 'add' : 'remove';
    const newClass = isCaretDown ? 'fa-caret-up' : 'fa-caret-down';
    
    TypeClass.class( action, icon, newClass );
    icon.classList.toggle('fa-caret-down');
}
// Search archive 

const searchArchive = $('input[name=search-archive]');

const archiveJavascript = 
{
    renderError: () => {
        var html = 
        `<div class="product-lists">
                <span>Không có kết quả nào phù hợp😩</span>
        </div>`;
        listsBody.innerHTML = DOMPurify.sanitize( html, { RETURN_TRUSTED_TYPE: true }); 
    },

    handleEvents: () => 
    {
        document.addEventListener('DOMContentLoaded', () => 
        {
            btnSelect.addEventListener('click', () => {
                posters.forEach((element) => {
                    TypeClass.class('toggle', element, 'select');
                });
                
                TypeClass.class('remove', downloadPoster, 'select');
            
                inputCheckboxes.forEach((element) => {
                    TypeClass.class('toggle', element, 'select');
                });
            
                // identify title action 
                if (btnSelect.innerHTML === 'Hủy chọn') {
                    btnSelect.innerHTML = 'Chọn nội dung';
                } else {
                    btnSelect.innerHTML = 'Hủy chọn';
                }
            });
    
            inputCheckboxes.forEach((checkbox) => {
                checkbox.addEventListener('click', () => {
                    handleCheckboxClick(checkbox);
                });
            });
            
            remove.addEventListener('click', () => {
                handleRemoveButtonClick();
            });
    
            btnFilters.forEach((btn) => {
                btn.addEventListener('click', () => {
                    arrayResetClass(btnFilters, 'filter');
                    TypeClass.class('add', btn, 'filter');
                })
            })
            
            btnNew.addEventListener('click', () => {
                const data = {
                    'class' : 'newpost'
                };
                CallAjax.send('POST', data, 'mvc/core/HandleActionInteract.php', function( response ) {
                    const dataJson = CallAjax.get( response );
                    try {
                        renderBody( dataJson );
                    } 
                    catch ( err ) {
                        archiveJavascript.renderError();
                    }
                });
            })
            
            btnDate.addEventListener('click', () => {
                confirmIcon(btnDate);
                const icon = btnDate.querySelector('i');
                // If exists, sort oldest, otherwise, sort newest
                let data = {};
                if (icon.classList.contains('fa-caret-down')) 
                {
                    data = {
                        'class' : 'firstdate'
                    };
                    
                } else {
                    data = {
                        'class' : 'oldestdate'
                    };
                }

                CallAjax.send('POST', data, 'mvc/core/HandleActionInteract.php', function(response) {
                    const dataJson = CallAjax.get( response );
                    try {
                        renderBody( dataJson );
                    } 
                    catch ( err ) {
                        archiveJavascript.renderError();
                    }
                });
            });
    
            btnCollection.addEventListener('click', () => {
                const data = {
                    'class' : 'hascollection'
                };
                CallAjax.send('POST', data, 'mvc/core/HandleActionInteract.php', function(response) {
                    const dataJson = CallAjax.get( response );
                    console.log( dataJson );
                    try {
                        renderBody( dataJson );
                    } 
                    catch ( err ) {
                        archiveJavascript.renderError();
                    }
                });
            });
            
            btnLike.addEventListener('click', () => {
                const data = {
                    'class' : 'haslike'
                };
                CallAjax.send('POST', data, 'mvc/core/HandleActionInteract.php', function(response) {
                    const dataJson = CallAjax.get( response );
                    try {
                        renderBody( dataJson );
                    } 
                    catch ( err ) {
                        archiveJavascript.renderError();
                    }
                });
            });
            
            searchArchive.addEventListener('input', Debounces.listen(function (event) {
                const value = event.target.value;
                // get data 
                const data = {
                    'class' : 'searcharchive',
                    'keyword' : value
                };
                
                if ( value.trim() !== '' && value.length > 1 )
                {
                    CallAjax.send('POST', data, 'mvc/core/HandleActionInteract.php', function(response) {
                        const dataJson = CallAjax.get( response );
                        try {
                            renderBody( dataJson );
                        } 
                        catch ( err ) {
                            archiveJavascript.renderError();
                        }
                    });
                } else {
                    const data = {
                        'class' : 'newpost'
                    };
    
                    CallAjax.send('POST', data, 'mvc/core/HandleActionInteract.php', function(response) {
                        const dataJson = CallAjax.get( response );
                        try {
                            renderBody( dataJson );
                        } 
                        catch ( err ) {
                            archiveJavascript.renderError();
                        }
                    });
                }
            }, 300));
        })
    },

    start: () => {
        archiveJavascript.handleEvents();
    }
}

archiveJavascript.start();