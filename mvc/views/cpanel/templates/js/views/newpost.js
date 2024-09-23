const inputTitle = $('input[name="title"]');
const topicPosts = $$('input[name="topic"]');
const inputEditor = $('#editor');
const btSendNewFeed = $('#btn-render');
const ckNewFeed = $('#new-feed');
// Check post new feed hot 
const hotNewFeed = $('#new-feed');

function prepareData() {
    const title = inputTitle.value;
    const content = inputEditor.value;
    const encodedContent = btoa((encodeURIComponent(content)));

    const data = {
        'title': title,
        'content': encodedContent,
        'class': 'newfeeds'
    };
    const identifyHot = "";
    if (hotNewFeed) {
        identifyHot = (hotNewFeed.checked) ? "on" : "";
    } 
    const identifyTopic = (topicPosts[0].checked) ? "post" : "service";
    data.hot = identifyHot;
    data.topic = identifyTopic;

    CallAjax.send('POST', data, 'talk/mvc/core/HandleActionInteract.php', function( response ) {
        try {
            const jsonData = CallAjax.get(response);
            cuteToast({
                type: "success",
                title: "Thành công",
                message: jsonData,
                timer: 3000
            });
        } 
        catch(err) { 
            console.log( err ); 
            cuteToast({
                type: "error",
                title: "Lỗi",
                message: "Xảy ra lỗi, thử lại sau không thể thực hiện!",
                timer: 2500
            });
        }
    });
}

function handleValue( value, minLength ) {
    if ( value > minLength ) {
        TypeClass.class('add', btSendNewFeed, 'click');
    } 
    else {
        TypeClass.class('remove', btSendNewFeed, 'click');
    }
}

const newpostJavascript = {
    handleEvents: () => {
        document.addEventListener('DOMContentLoaded', () => {
            inputTitle.addEventListener('input', Debounces.listen(( event ) => {
                const valueTitle = event.target.value;
                const lengthValue = valueTitle.length;
                handleValue(lengthValue, 10);
            }, 300));
    
            btSendNewFeed.addEventListener('click', () => {
                prepareData();
            });
        });
    },

    start: () => {
        newpostJavascript.handleEvents();
    }
};

newpostJavascript.start();