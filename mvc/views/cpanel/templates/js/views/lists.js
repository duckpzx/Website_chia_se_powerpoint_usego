// Pagination = input number 
const pageInputNumber = $("input[name='page']");
const buttonPageSearch = $('.page-search');

const listsJavascript = {
    handleEvents: () => {
        // input number you want to advance
        buttonPageSearch.addEventListener('click', () => {
            const page = pageInputNumber.value;
            paginationJavascript.corePaginationDisplay( page );
            paginationJavascript.corePaginationUrlBrowser( page );

            window.scrollTo({
                top: 0,
                left: 0,
                behavior: 'smooth'
            });

            paginationJavascript.corePaginationHandle( page );
        });
    },

    start: () => {
        listsJavascript.handleEvents();
    }
}

listsJavascript.start();