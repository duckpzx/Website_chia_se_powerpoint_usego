function detectMob() {
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

// Add of remove class 
function tpyeClass(type = 'add', e, className) {
    switch (type) {
        case 'add':
            e.classList.add(className);
            break;
        case 'toggle':
            e.classList.toggle(className);
            break;
        default:
            e.classList.remove(className);
    }
}

function resetClass(e, className) {
    e.forEach((item) => {
        tpyeClass('remove', item, className);
    })
}

const btnShowContact = $('#btn-showcontact');
const mobileViewContact = $('.mobile-view-contact');
const aboutContact = $('.about-contact');
const btnBackContact = $('#btn_backContact');

document.addEventListener('DOMContentLoaded', function() 
{
    tpyeClass('add', mobileViewContact, 'show');
});

btnShowContact.addEventListener('click', (e) => {
    tpyeClass('add', aboutContact, 'show');
    tpyeClass('remove', mobileViewContact, 'show');
})

btnBackContact.addEventListener('click', () => {
    tpyeClass('remove', aboutContact, 'show');
    tpyeClass('add', mobileViewContact, 'show');
})

// Click on show details wrapper-services section 

const wrapperServiceSections = $$('.wrapper-services section');
const wrapperSectionDes = $$('.item-des');
const btnDetail = $$('.btn-detail');
let currentIndexDes = null;

if(detectMob()) {
    wrapperServiceSections.forEach((section, index) => {
        section.addEventListener('click', () => {
            if (currentIndexDes !== null) {
                tpyeClass('remove', wrapperSectionDes[currentIndexDes], 'detail');
            }
            if (currentIndexDes !== index) {
                tpyeClass('add', wrapperSectionDes[index], 'detail');
                currentIndexDes = index;
            } else {
                currentIndexDes = null;
            }
        });
    });
}

btnDetail.forEach((button, index) => {
    button.addEventListener('click', () => {
        tpyeClass('add', wrapperSectionDes[index], 'detail');
        if (currentIndexDes !== null) {
            tpyeClass('remove', wrapperSectionDes[currentIndexDes], 'detail');
        }
        if (currentIndexDes !== index) {
            tpyeClass('add', wrapperSectionDes[index], 'detail');
            currentIndexDes = index;
        } else {
            currentIndexDes = null;
        }
    })
})