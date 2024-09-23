const btnDashboards = $$('.btn-dashboard');

btnDashboards.forEach((button) => {
    button.addEventListener('click', () => {
        const ulElement = button.nextElementSibling;
        const btnDashboardsIcon = button.querySelector('i');

        if (ulElement && ulElement.tagName.toLowerCase() === 'ul') {
            TypeClass.class('toggle', ulElement, 'active');
            TypeClass.class('toggle', btnDashboardsIcon, 'fa-angle-down');
            TypeClass.class('toggle', btnDashboardsIcon, 'fa-angle-up');
        };
    });
});
