let imageUploads = '';

new FroalaEditor('#editor', {
    placeholderText: 'Nội dung viết ở đây',
    quickInsertEnabled: false,
    fontFamilyDefault: 'usego-Regular', 
    fontFamilySelection: true,
    
    imageUploadURL: 'talk/mvc/core/HandleNewPost.php',  
    imageUploadParams: {
        class: 'UploadImageNewFeeds'
    }, 
    imageAllowedTypes: ['jpeg', 'jpg', 'png', 'gif'],

    events: {
        'image.uploaded': function (response) {
            const jsonResponse = JSON.parse(response);

            if (imageUploads) {
                imageUploads += '||' + jsonResponse.link;
            } else {
                imageUploads = jsonResponse.link;
            }
            imageUploads = decodeURIComponent(imageUploads);
        },
        'image.error': function (error) {
            console.error('Lỗi upload ảnh:', error);
        }
    }
});