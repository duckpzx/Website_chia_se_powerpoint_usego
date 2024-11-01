// Show describe 
const btnSeeMore = $('.btn-seemore-des');
const spanDescribe = $('.describe-join');

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

function isLoading(type) {
    if ($('.upload-wrapper .loading-wrapper')) {
        const loadding = $('.upload-wrapper .loading-wrapper');
        (type === 'add') ? TypeClass.class('add', loadding, 'show') : TypeClass.class('remove', loadding, 'show');
    }
}

function updateBtnSeeMore() {
    const iconClass = spanDescribe.classList.contains('fulltext') ? 'fa-caret-up' : 'fa-caret-down';
    const icon = `<i class="fa-solid ${iconClass}"></i>`;
    btnSeeMore.innerHTML = icon;
}

// Click on add class ativerse menu-lists 
const menuLists = $$('.menu-lists li');
const lineHr = $$('.line-hr');

// Show editor 
const btnEditorMenu = $('.btn-editor-menu');
const changeAvatar = $('.change-avatar');

// Background mobile 
const bgSiteMobile = $('.bg-mobile-site img');
const bgSiteMobileSrc = bgSiteMobile.src;

// Header Avatar 
const avtZooms = $$('.avt-zoom');

// Avatar Main 
const mainAvatar = $('#main-avatar');
const mainAvatarSrc = mainAvatar.src;

// Editor settings 
const editorTexts = $('.edit-text');
const editorImages = $('.change-avatar');

function resetActiveMenuList() {
    ResetClasses.lists(menuLists, 'activers');
    ResetClasses.lists(lineHr, 'show');
}

function showUpdateAvatar() {
    TypeClass.class('add', modalOverlay, 'show');
    TypeClass.class('add', $('.preview-poster-wrapper') ,'show');
    NoScrollHTML.noScroll('yes');
}

function removeUpdateAvatar() {
    TypeClass.class('remove', modalOverlay, 'show');
    TypeClass.class('remove', $('.preview-poster-wrapper') ,'show');
    NoScrollHTML.noScroll('no');
}

// Update Avatar user 
const inputAvatar = $('input[name="avatar"]');
const contaiReset = $('.reset');
const buttonContaiReset = $('.reset .btn-reset-avatar');
const buttonCloseContaiMoDal = $('.close-avatar');
const buttonUpdateAvatar = $('.update-avatar');
const previewPosterImageMain = $('.preview-poster-image');
const previewPosterSrcDefault = (previewPosterImageMain && previewPosterImageMain.src) ? previewPosterImageMain.src : "";

// Src default
const btAuthorMenu = $('.btn-author-menu');

function handleNameFile(array, name) {
    return (array.includes(name));
}

function handleSize(size) {
    return (size <= 2000);
}

function checkInputFileImage(infoFile) {
    const name = infoFile.name;
    const size = infoFile.size;
    const arrayNameAccept = ['png', 'jpg', 'jpeg', 'gif', 'svg', 'webp'];

    // Handle name
    const nameTxt = name.split('.').pop();
    const lowerCaseNameTxt = nameTxt.toLowerCase();
    const isValidName = handleNameFile(arrayNameAccept, lowerCaseNameTxt);

    // Handle size
    const fileSizeInKB = size / 1024;
    const isValidSize = handleSize(fileSizeInKB);

    if (!isValidName || !isValidSize) {
        const errorMessage = isValidName
            ? 'Ảnh tải nên, phải bé hơn 2000 KB'
            : 'Ảnh tải nên, không đúng định dạng';

        cuteToast({
            type: "error",
            title: "Lỗi",
            message: errorMessage,
            timer: 3000
        })

        return false;
    }
    return true;
}

// Set preview photos 
function setPreviewPhotos(image, src, srcDefault) {
    image.src = (src) ? src : srcDefault;
}

function revokeObjectURLPosterMain(image) {
    if(image.src) {
        URL.revokeObjectURL(image.src);
    }
}

// Reset default inputFile 
function resetInputFile(input) {
    input.value = '';
}

function buttonUpdateOn() {
    buttonUpdateAvatar.disabled = false;
    TypeClass.class('add', buttonUpdateAvatar, 'disabled');
}

function buttonUpdateOff() {
    buttonUpdateAvatar.disabled = true;
    TypeClass.class('remove', buttonUpdateAvatar, 'disabled');
}

function setAvatarHeader(srcSet) 
{
    avtZooms.forEach((img) => {
        img.src = srcSet;
    })
}

let selectedFile;
const selectPowerpoint = [];

function showStatusAlertUpdate( src ) {
    // Perform change avatar realtime 
    setPreviewPhotos(mainAvatar,  src, mainAvatarSrc);
    // Delete the class to display the main avatar
    TypeClass.class('remove', changeAvatar, 'showedit');
    // Set background if mobile 
    setPreviewPhotos(bgSiteMobile, src, bgSiteMobileSrc)
    // Set avatar realtime header
    setAvatarHeader(src);
    // Delete status change 
    removeUpdateAvatar();
    // Reset input File 
    resetInputFile(inputAvatar);
    // Prepare the page back to its original state
}

// Upload infomation text 
const btnEditText = $('.edit-text');
const iconBtnEditText = (btnEditText) ? btnEditText.querySelector(".fa-pen-clip") : "";
// properties
const textEditDescribes = $('.edit-describes');
const describeJoin = $('.describe-join');
// Textarea
const textEditFullname = $('input[name="edit-fullname"]');
const formUserName = $('.user-name');
const formUserNameH4 = $('.user-name h4');
// Input 
const formDescribes = $('.form-describes');
const performButton = $('.perform-edit-text');
// performButtons 
const btnRemoveInfo = $('.btn-remove-info');
const buttonUpdateIfno = $('.btn-update-info');

let isFlag = true;
function changeContentButtonEdit() {
    if ( isFlag ) {
        TypeClass.class('remove', iconBtnEditText, 'fa-pen-clip');
        TypeClass.class('add', iconBtnEditText, 'fa-xmark');
        isFlag = false;
    } else {
        TypeClass.class('remove', iconBtnEditText, 'fa-xmark');
        TypeClass.class('add', iconBtnEditText, 'fa-pen-clip');
        isFlag = true;
    }
}

function setStatusEditText() {
    TypeClass.class('toggle', formUserNameH4, 'hidden');
    TypeClass.class('toggle', describeJoin, 'hidden');
    TypeClass.class('toggle', formUserName, 'edit')
    TypeClass.class('toggle', textEditDescribes, 'edit');
    removeBrTag();
    
    TypeClass.class('toggle', textEditFullname, 'edit');
    TypeClass.class('toggle', performButton, 'edit');
    TypeClass.class('toggle', formDescribes, 'height');
}

// handle input Data 
const inputTextUser = {
    fullname: textEditFullname,
    describe: textEditDescribes
}

function nl2br(str) {
    return str.replace(/(?:\r\n|\r|\n)/g, '<br>');
}

function removeBrTag() {
    textEditDescribes.value = textEditDescribes.value.replace(/<br\s*\/?>/g, '');
}

function limitConsecutiveSpaces( inputElement, limit ) {
    let value = inputElement.value;
    const parts = value.split(' ');

    if ( parts.length > limit ) {
        let newValue = parts.slice( 0, limit ).join(' ');
        inputElement.value = newValue;
    }
}

const inputTextValues = {};

function hasErrors(errors) {
    for ( const key in errors ) 
    {
        if ( Object.keys( errors[key] ).length > 0 ) 
        {
            return false; 
        }
    }
    return true; 
}

function setStatusChangeInfo(data) {
    if (data['fullname']) {
        formUserNameH4.textContent = data['fullname'];
    }
    if (data['describe']) {
        const content = nl2br(data['describe']);
        describeJoin.innerHTML = DOMPurify.sanitize(content, {RETURN_TRUSTED_TYPE: true});
    }
}

const uploadWrapper = $('.upload-wrapper');
const btnUserUpPPT = $('#btn-user-upload-ppt');
const btnRules = $('.b-rules');
const btnUserService = $('#btn-user-service');
const itemUploadPPTBottom = $('.item-upload-ppt .bottom');
const inputPowerpoint = $('input[name="powerpoint"]');
// const powerpointHidden = $$('.wrapper-info-file-upload');
let identifyAutomatic = false;


function showUploadWrapper() {
    TypeClass.class('add', modalOverlay, 'show')
    TypeClass.class('add', uploadWrapper, 'show');
    NoScrollHTML.noScroll('yes');
}

function closeUploadWrapper() {
    TypeClass.class('remove', modalOverlay, 'show')
    TypeClass.class('remove', uploadWrapper, 'show');
    NoScrollHTML.noScroll('no');
}

const iconFile = $('.wrapper-info-file-upload .photo img');
const pathDefault = (iconFile) ? iconFile.getAttribute('src') : "";
// get Src Path 
function loadIconNameTxtFileUpload(src) {
    iconFile.src = `${pathDefault + src}`;
}

function checkInputFilePowerpoint( infoFile ) {
    const name = infoFile.name;
    const arrayNameAccept = ['rar', 'zip', 'pptx'];
    // Handle name
    const nameTxt = name.split('.').pop();
    // Identify 
    switch(nameTxt) {
        case 'rar':
            loadIconNameTxtFileUpload('rar.png');
            break;
        case 'zip': 
            loadIconNameTxtFileUpload('zip.png');
            break;
        case 'pptx': 
            loadIconNameTxtFileUpload('pptx.png');
            break;
        default:
            loadIconNameTxtFileUpload('pptx.png');
      }
    const isValidName = handleNameFile( arrayNameAccept, nameTxt );
    // Handle size
    return isValidName;
}

function handleSizeInterfaceFile( infoFile ) {
    const size = infoFile.size;
    return ( size / 1024 ).toFixed();
}

function handleNameInterfaceFile(infoFile, maxLengthName) {
    const name = infoFile.name;
    const nameTxt = name.split('.').pop();
    if( name.length - 3 > maxLengthName ) 
    {
        return name.substring( 0, maxLengthName ) + '...' + nameTxt;
    }
    return name;
}

function powerpointHiddenOn( name, size ) {
    TypeClass.class('add', wrapperInfoFileUpload, 'show');
    $('.info-file span').textContent = name;
    $('.info-file small').textContent = 'Size: ' + size + ' KB';
}

function closePowerpoint() {
    if($('.btn-close-x')) {
        const close = $('.btn-close-x');
        close.onclick = () => {
            selectPowerpoint.pop();
            TypeClass.class('remove', wrapperInfoFileUpload, 'show'); 
        };
    }
    resetInputFile( inputPowerpoint );
    identifyAutomatic = false;
}

// Show compressed file 
const wrapperCompressed = $('.wrapper-compressed');
const itemUploadPhotos = $('.item-upload-photos');
const btnSuggestCompressed = $('.suggest-compressed');
const btnCloseSuggestCompressed = $('.btn-comeback-upload-image');
// List upload 
const listFileCompressed = $('.list-file-compressed');
// File compressed upload ( mobile )
const wrapperInfoFileUpload = $('.wrapper-info-file-upload');

// Compress handle upload 
// get extension File VD: .txt .pdf ... 
function getExtensionFile( fileName ) {
    return fileName.split('.').pop();
}

function checkContainTxt(extension) {
    const allowedExtensions = ['rar', 'txt', '7z', 'bin', 'cab', 'zip', 'pptx'];
    return allowedExtensions.includes( extension );
}

function handleCompressed(name, selectedFile) {
    const newNameFileZip = (name.split('.').shift()).toLowerCase();
    // Create new file ZIP
    const zip = new JSZip();
    const reader = new FileReader();
    reader.onload = function (event) {
        const fileData = event.target.result;
        // Add files to ZIP
        zip.file(name, fileData);

        // Create a ZIP file and store it as Blob
        zip.generateAsync({ type: "blob" })
            .then(function (content) {
                // Create download link
                const zipBlob = content;
                const zipUrl = URL.createObjectURL(zipBlob);

                // Create a link to download the ZIP file
                const downloadLink = document.createElement("a");
                downloadLink.href = zipUrl;
                downloadLink.download = `${newNameFileZip}.zip`;
                document.body.appendChild(downloadLink);

                // Click the link to download the ZIP file
                downloadLink.click();

                // Remove the link after downloading is complete
                document.body.removeChild(downloadLink);
            });
    };
    
    // Check selectedFile is File 
    if (selectedFile instanceof FileList && selectedFile.length > 0) {
        reader.readAsArrayBuffer(selectedFile[0]);
    } else if (selectedFile instanceof File) {
        reader.readAsArrayBuffer(selectedFile);
    } 
}

// Input 
const inputCompressed = $('input[name="compressed"]');

// Drag
const dropZone = $('#dropZone');

// Upload photos 
const selectListImages = $('.select-list-images');
const inputImageUploads = $('input[name="image-uploads[]"]'); 
const arrayImageUploads = [];
const arrayImageFiles = [];
let indexImage = null;
// Below list images
const viewImageListBelow = $('.view-image-lists');

function prepareObjectImage(name, size, src) {
    return { name, size, src };
}

function renderPreviewImageUpload(src) {
    return `
        <li class="item-upload-li">
            <img class="item-image-upload" src="${ src }">
            <button class="more-select-image">
                <i class="fa-solid fa-ellipsis"></i>
            </button>
            <div class="wrapper-more">
                <button class="fn-more-zoom">Phóng lớn</button>
                <button class="fn-more-remove">Xóa bỏ</button>
            </div>
        </li>
    `;
}

function resetWrapperOptions(options) {
    options.forEach(item => TypeClass.class('remove', item, 'show'));
}

function handleMoreButtonClick(index, wrapperOptions) {
    const check = wrapperOptions[index].classList.contains('show');
    if (!check) {
        resetWrapperOptions(wrapperOptions);
        TypeClass.class('add', wrapperOptions[index], 'show');
    }
    else {
        resetWrapperOptions(wrapperOptions);
    }
}

function handleImageClick(wrapperOptions) {
    return (event) => {
        if (event.target.classList.contains('item-image-upload')) {
            resetWrapperOptions(wrapperOptions);
        }
    };
}

function handleRemoveButtonClick(index, itemUploadLis) {
    return () => {
        itemUploadLis[index].remove();
        const liImage = itemUploadLis[index].querySelector('img');
        URL.revokeObjectURL(liImage.src);
        arrayImageUploads.splice(index, 1);
        arrayImageFiles.splice(index, 1);
        showImagesBelow();
        screenRender();
    };
}

function attachSrcImageZoom(src, wrapper1, wrapper2) {
    wrapper1.src = wrapper2.src = src;
}

function handleZoomButtonClick(wrapper, type) {
    if(type == 'add') {
        TypeClass.class('add', wrapper, 'zoom');
    } else {
        TypeClass.class('remove', wrapper, 'zoom');
    }
}

function updateImageSources(images, array) {
    images.forEach((img, index) => {
        if (index < array.length) {
            img.src = array[index].src;
        }
    });  
}

function showImagesBelow() {
    // Delete the previous elements and store them back in the array
    const html = arrayImageUploads.reduce((result, image) => {
        return (
            result + `
                <img src="${ image.src }" title=""/>
            `
        ); 
    }, "");
    viewImageListBelow.innerHTML = DOMPurify.sanitize(html, {RETURN_TRUSTED_TYPE: true});
    
    const images = viewImageListBelow.querySelectorAll('img');
    updateImageSources(images, arrayImageUploads);
    // Set src value for image lists below tags 
}

function activeImageBelow(wallper) {
    wallper.forEach((e) => { TypeClass.class('remove', e, 'select');});
    TypeClass.class('add', wallper[indexImage], 'select');
}

function attachEventListeners() {
    const buttonOptions = $$('.more-select-image');
    const wrapperOptions = $$('.wrapper-more');
    const itemUploadLis = $$('.item-upload-li');
    // Zoom & Src & button close Zoom
    const wrapperImageZoom = $('.view-image-zoom');
    const wallperWrapper = $('.wallper-wrapper');
    const wallperWrapperView = $('.wallper-wrapper-view');
    const buttonCloseZoom = $('.btn-close-zoom');
    // Below list images 
    const ImageViewImageLists = viewImageListBelow.querySelectorAll('img');

    buttonOptions.forEach((button, index) => {
        button.onclick = () => handleMoreButtonClick(index, wrapperOptions);
    });
    // Close option image
    const imageUploads = $$('.item-image-upload');
    imageUploads.forEach((img) => {
        img.onclick = handleImageClick(wrapperOptions);
    });
    // Remove image upload
    const btnFnMoreRemove = $$('.fn-more-remove');
    btnFnMoreRemove.forEach((btn, index) => {
        btn.addEventListener('click', handleRemoveButtonClick(index, itemUploadLis));
    });
    // Zoom image upload 
    const btnMoreZoom = $$('.fn-more-zoom');
    btnMoreZoom.forEach((btn, index) => {
        btn.addEventListener('click', () => {
            indexImage = index;
            handleZoomButtonClick(wrapperImageZoom, 'add');
            attachSrcImageZoom(imageUploads[index].src, wallperWrapper, wallperWrapperView);
            activeImageBelow(ImageViewImageLists);
        });
    });

    buttonCloseZoom.addEventListener('click', 
    () => { handleZoomButtonClick(wrapperImageZoom, 'remove') });
    
    ImageViewImageLists.forEach((image, index) => {
        image.onclick = () => {
            attachSrcImageZoom(imageUploads[index].src, wallperWrapper, wallperWrapperView);
            indexImage = index;
            activeImageBelow(ImageViewImageLists);
        }
    });
}

function screenRender() {
    const html = arrayImageUploads.map(item => renderPreviewImageUpload(item.src)).join('');
    selectListImages.innerHTML = DOMPurify.sanitize(html, { RETURN_TRUSTED_TYPE: true });
        
    const images = selectListImages.querySelectorAll('li img');
    updateImageSources(images, arrayImageUploads);
    // Set src value for image tags

    attachEventListeners();
    // Some events after adding photos
}

function checkMaxLengthFileUpload(array) {
    const sizeArray = array.length;
    if(sizeArray > 31) {
        cuteAlert({
            type: "error",
            title: "Lỗi",
            message: "Ảnh tải lên, không vượt qua 31 ảnh",
            buttonText: "Okay"
        });
        return true;
    }; 
    return false;
}

// Button Prev & Next 
const btnPrevZoomImg = $('.btn-prev-zoom-img');
const btnNextZoomImg = $('.btn-next-zoom-img');

// Zoom next & Zoom prev 
function handleClickNextAndPrev(type) {
    indexImage = (type === 'next') ? 
    Math.min(indexImage + 1, arrayImageUploads.length - 1) : Math.max(indexImage - 1, 0);

    const wallperWrapper = $('.wallper-wrapper');
    const wallperWrapperView = $('.wallper-wrapper-view');
    const ImageViewImageLists = viewImageListBelow.querySelectorAll('img');

    attachSrcImageZoom(ImageViewImageLists[indexImage].src, wallperWrapper, wallperWrapperView);
    activeImageBelow(ImageViewImageLists);
}

function createObjectURLAsync(file) {
    return new Promise(( resolve ) => {
        resolve( URL.createObjectURL( file ));
    });
}

function contentChangeRules() {
    const title = 'Hướng dẫn chuyển đổi File sang ảnh';

    const html = `
        <div class="instruct">
            <div class="text">
                <b class="ins-title"> Hướng dẫn chuyển đổi File sang ảnh </b>
                <span class="ins-content">
                    Chuyển đổi File thành ảnh rồi tải nên sẽ mang lại <b>Tốc độ</b> nhanh hơn
                </span>
                <span class="ins-content">
                    Cách để đổi File PPTX thành "Ảnh" 
                    <b>Chọn</b> File -> Export -> Change File Type -> <b>Chọn</b> "PNG" hoặc "JPEG" sau đó lưu.
                </span>
            </div>
            <img 
            src="${ AlertUsego.template() }images/icons/revert_pptx_rules.png" 
            width="200">
        </div>
    `;

    return [title, html];
}

const profileJavascript = {
    init: () => {
        document.addEventListener('DOMContentLoaded', profileJavascript.handleEvents);
    },

    handleEvents: () => {
        // Show description
        btnSeeMore?.addEventListener('click', updateBtnSeeMore);

        // Click title task 
        menuLists?.forEach((item, index) => {
            item.addEventListener('click', () => {
                resetActiveMenuList();
                const isEditorMenu = item === btnEditorMenu;
                if (editorTexts) TypeClass.class(isEditorMenu ? 'add' : 'remove', editorTexts, 'showedit');
                if (editorImages) TypeClass.class(isEditorMenu ? 'add' : 'remove', editorImages, 'showedit');
                TypeClass.class('add', item, 'activers');
                TypeClass.class('add', lineHr[index], 'show');
            });
        });

        // Click update avatar 
        changeAvatar?.addEventListener('click', showUpdateAvatar);

        // Close background event 
        modalOverlay?.addEventListener('click', (e) => {
            if (e.target === e.currentTarget) {
                removeUpdateAvatar();
                closeUploadWrapper();
            }
        });

        // Edit avatar 
        inputAvatar?.addEventListener('input', (event) => {
            revokeObjectURLPosterMain(previewPosterImageMain);
            selectedFile = event.target.files[0];

            if (checkInputFileImage(selectedFile)) {
                const srcTemporaty = URL.createObjectURL(selectedFile);
                setPreviewPhotos(previewPosterImageMain, srcTemporaty, previewPosterSrcDefault);
                TypeClass.class('add', contaiReset, 'show');
                buttonUpdateOn();
            }
        });

        // Revert avatar 
        buttonContaiReset?.addEventListener('click', () => {
            revokeObjectURLPosterMain(previewPosterImageMain);
            previewPosterImageMain.src = previewPosterSrcDefault;
            resetInputFile(inputAvatar);
            buttonUpdateOff();
            TypeClass.class('remove', contaiReset, 'show');
        });

        // Close change avatar 
        buttonCloseContaiMoDal?.addEventListener('click', () => {
            removeUpdateAvatar();
        });

        // Accept update avatar 
        buttonUpdateAvatar?.addEventListener('click', () => {
            buttonUpdateOff();
            const formData = new FormData();
            formData.append('avatar', selectedFile);
            formData.append('class', 'UpdateAvatar');

            callAjaxWithFormData('POST', formData, 'mvc/core/HandleDataUpload.php', (response) => {
                try {
                    const dataJson = CallAjax.get(response);
                    if (dataJson) {
                        showStatusAlertUpdate(previewPosterImageMain.src);
                    } 
                } catch (err) {
                    console.error(err);
                }
            });
        });

        // Use avatar old
        const listAvatarOlds = $$?.('.item-avatar-old img');
        listAvatarOlds?.forEach((img) => {
            img.onclick = () => {
                const srcImagePath = img.src.split('/').pop();
                const data = { 'avatar': srcImagePath, 'class': 'UseAvatarOld' };

                CallAjax.send('POST', data, 'mvc/core/HandleDataUpload.php', (response) => {
                    const dataJson = CallAjax.get(response);
                    try {
                        if (!dataJson.error) {
                            showStatusAlertUpdate(img.src);
                            setPreviewPhotos(previewPosterImageMain, img.src, previewPosterSrcDefault);
                            previewPosterImageMain.src = previewPosterSrcDefault;
                        }
                    } catch (err) {
                        console.error(err);
                    }
                });
            };
        });

        // Close editor information user
        btnRemoveInfo?.addEventListener('click', () => {
            btnEditText.click();
        });

        // Edit information content user
        btnEditText?.addEventListener('click', () => {
            changeContentButtonEdit();
            setStatusEditText();
        });

        // Accept editor information user 
        buttonUpdateIfno?.addEventListener('click', () => {
            if (!hasErrors(inputTextValues)) {
                const data = { ...inputTextValues, class: 'EditInformation' };
                CallAjax.send('POST', data, 'mvc/core/HandleDataUpload.php', (response) => {
                    try {
                        cuteToast({
                            type: "success",
                            title: "Thành công",
                            message: CallAjax.get(response, 'off'),
                            timer: 2500
                        });
                        setStatusChangeInfo(data);
                        btnRemoveInfo.click();
                        btAuthorMenu.click();
                    } catch (err) {
                        cuteToast({
                            type: "error",
                            title: "Lỗi",
                            message: "Không thể cập nhật thông tin.",
                            timer: 2500
                        });
                    }
                });
            }
        });

        // Handle action convention shared 
        for (const editText in inputTextUser) {
            const inputText = inputTextUser[editText];
            inputText?.addEventListener('input', (e) => {
                const value = e.target.value;
                if (inputText === textEditFullname) {
                    limitConsecutiveSpaces(textEditFullname, 2);
                }
                inputTextValues[editText] = value.trim() || '';
            });
        };

        // Upload file PowerPoint 
        btnUserUpPPT?.addEventListener('click', showUploadWrapper);
        btnRules?.addEventListener('click', () => {
            AlertUsego.identify('yes');
            AlertUsego.show(contentChangeRules()[0], contentChangeRules()[1]);
        });

        // Upload PowerPoint 
        if ($('input[name="powerpoint"]')) {
            $('.manual').addEventListener('click', () => {
                inputPowerpoint.oninput = (event) => {
                    const file = event.target.files[0];
                    if (file && checkInputFilePowerpoint(file)) {
                        selectPowerpoint.pop();
                        selectPowerpoint.push(file);
                        const name = handleNameInterfaceFile(file, 10);
                        const size = handleSizeInterfaceFile(file);
                        powerpointHiddenOn(name, size);
                        closePowerpoint();
                    } else {
                        cuteToast({
                            type: "error",
                            title: "Lỗi",
                            message: "File tải lên không đúng định dạng!",
                            timer: 3500
                        });
                    }
                    resetInputFile(inputPowerpoint);
                };
            });
            
            $('.automatic').addEventListener('click', () => {
                inputPowerpoint.oninput = (event) => {
                    isLoading('add');
                    
                    const file = event.target.files[0];
                    if (file && checkInputFilePowerpoint(file)) {
                        const formData = new FormData();
                        formData.append('uploaded_file', file);
                        formData.append('class', 'AutomaticUpload');
                        selectPowerpoint.pop();
                        selectPowerpoint.push(file);
                        const name = handleNameInterfaceFile(file, 10);
                        const size = handleSizeInterfaceFile(file);
                        powerpointHiddenOn(name, size);

                        callAjaxWithFormData('POST', formData, 'mvc/core/HandleDataUpload.php', function (response) {
                            const dataJson = CallAjax.get(response, 'off').err_mess;
                            try {
                                if (dataJson) {
                                    const images = dataJson.images.split('||');
                                    images.forEach(item => arrayImageFiles.push(item));
                                    images.forEach((item)=> {
                                        const srcPreviewImage = `${AlertUsego.template()}images/uploads/powerpoint-images/${item}`;
                                        arrayImageUploads.push(prepareObjectImage('images', 1, srcPreviewImage));
                                    });
                    
                                    showImagesBelow();
                                    screenRender();

                                    identifyAutomatic = true;
                                    isLoading('remove');
                                }
                            }
                            catch (err) { console.error(err) };
                        });

                        closePowerpoint();
                    } else {
                        cuteToast({
                            type: "error",
                            title: "Lỗi",
                            message: "File tải lên không đúng định dạng!",
                            timer: 3500
                        });
                        isLoading('remove');
                    }
                    resetInputFile(inputPowerpoint);
                };
            });
        }

        // Open compression tip
        btnSuggestCompressed?.addEventListener('click', () => {
            TypeClass.class('add', wrapperCompressed, 'active');
            if (DetectMob.check()) {
                TypeClass.class('add', wrapperCompressed, 'show');
                TypeClass.class('add', itemUploadPhotos, 'show');
            }
        });

        // Close compression tip
        btnCloseSuggestCompressed?.addEventListener('click', () => {
            TypeClass.class('remove', wrapperCompressed, 'active');
            if (DetectMob.check()) {
                TypeClass.class('remove', wrapperCompressed, 'show');
                TypeClass.class('remove', itemUploadPhotos, 'show');
            }
        });

        // Check file compression  
        inputCompressed?.addEventListener('input', (event) => {
            const selectedFile = event.target.files[0];
            if (selectedFile) {
                const nameFileTxt = getExtensionFile(selectedFile.name).toLowerCase();
                if (checkContainTxt(nameFileTxt)) {
                    cuteToast({
                        type: "error",
                        title: "Lỗi",
                        message: "File tải lên đã là File nén!",
                        timer: 3000
                    });
                } else {
                    handleCompressed(selectedFile.name, selectedFile);
                }
            }
            resetInputFile(inputCompressed);
        });

        // Drag files comfortably
        dropZone?.addEventListener('drop', (event) => {
            event.preventDefault();
            const selectedFile = event.dataTransfer.files[0];
            const nameFileTxt = getExtensionFile(selectedFile.name).toLowerCase();
            if (checkContainTxt(nameFileTxt)) {
                cuteToast({
                    type: "error",
                    title: "Lỗi",
                    message: "File tải lên đã là File nén!",
                    timer: 3000
                });
            } else {
                inputCompressed.selectedFile = selectedFile;
                handleCompressed(selectedFile.name, selectedFile);
            }
        });

        dropZone?.addEventListener('dragover', (event) => {
            event.preventDefault();
        });

        // Upload images 
        inputImageUploads?.addEventListener('input', async (event) => {
            const files = event.target.files;
            if (checkMaxLengthFileUpload(files)) return;

            for (const file of files) {
                if (checkInputFileImage(file)) {
                    const srcPreviewImage = await createObjectURLAsync(file);
                    arrayImageUploads.push(prepareObjectImage(file.name, file.size, srcPreviewImage));
                    arrayImageFiles.push(file);
                }
            }

            if (checkMaxLengthFileUpload(arrayImageUploads)) return;

            showImagesBelow();
            screenRender();
            resetInputFile(inputImageUploads);
        });

        // Click next/prev image
        btnNextZoomImg?.addEventListener('click', () => handleClickNextAndPrev('next'));
        btnPrevZoomImg?.addEventListener('click', () => handleClickNextAndPrev('prev'));
    },

    start: () => {
        profileJavascript.init();
    }
};

profileJavascript.init();