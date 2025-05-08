define(['core/templates', 'core_user/repository', 'core/ajax'], function(Templates, UserRepository, Ajax) {
    let currentPage = 1;
    let selectedView; // For block view
    let detailSelectedView; // For detail page view
    let totalPages;

    /**
     * Updates the enabled/disabled state of the pagination arrows based on the current page.
     */
    function updateArrowsState() {
        const prevBtn = document.querySelector('.programs-previous');
        const nextBtn = document.querySelector('.programs-next');
        if (prevBtn) {
            prevBtn.classList.toggle('disabled', currentPage <= 1);
        }
        if (nextBtn) {
            nextBtn.classList.toggle('disabled', currentPage >= totalPages);
        }
    }

    return {
        init: async function(options = {}) {
            const preferences = await new Promise((resolve, reject) => {
                Ajax.call([{
                    methodname: 'enrol_programs_get_userprogram_preferences',
                    args: {},
                    done: resolve,
                    fail: reject
                }]);
            });

            selectedView = preferences.blockview;
            detailSelectedView = preferences.detailview;
            totalPages = options.totalpages;
            updateArrowsState();

            const prevBtn = document.querySelector('.programs-previous');
            const nextBtn = document.querySelector('.programs-next');

            // Add individual event listener for the Previous button
            if (prevBtn) {
                prevBtn.addEventListener('click', function(e) {
                    if (prevBtn.classList.contains('disabled')) {
                        e.preventDefault();
                        e.stopPropagation();
                    } else {
                        e.preventDefault();
                        if (currentPage > 1) {
                            currentPage--;
                            fetchTemplateData('block', options).then((data) => {
                                renderTemplate(selectedView, Object.values(data), 'block');
                            });
                            updateArrowsState();
                        }
                    }
                });
            }

            // Add individual event listener for the Next button
            if (nextBtn) {
                nextBtn.addEventListener('click', function(e) {
                    if (nextBtn.classList.contains('disabled')) {
                        e.preventDefault();
                        e.stopPropagation();
                    } else {
                        e.preventDefault();
                        currentPage++;
                        fetchTemplateData('block', options).then((data) => {
                            renderTemplate(selectedView, Object.values(data), 'block');
                        });
                        updateArrowsState();
                    }
                });
            }

            attachDropdownListener(options); // Attach event listeners for both dropdowns
        }
    };

    /**
     * Attaches an event listener to the user view dropdown.
     * When the dropdown value changes, it updates the user's preference
     * and re-renders the template with new data.
     *
     * @function attachDropdownListener
     * @param {Object} options options for the fetch
     * @returns {void}
     */
    function attachDropdownListener(options = {}) {
        const dropdown = document.getElementById('user-view-dropdown');
        if (dropdown) {
            dropdown.addEventListener('change', function(event) {
                selectedView = event.target.value;
                UserRepository.setUserPreference('enrol_programs_block_user_view_preference', selectedView)
                    .then(() => {
                        fetchTemplateData('block', options).then((data) => {
                            renderTemplate(selectedView, Object.values(data), 'block');
                        });
                    });
            });
        }

        const detaildropdown = document.getElementById('programdetail-user-view-dropdown');
        if (detaildropdown) {
            detaildropdown.addEventListener('change', function(event) {
                detailSelectedView = event.target.value;
                UserRepository.setUserPreference('enrol_programs_detailpage_user_view_preference', detailSelectedView)
                    .then(() => {
                        fetchTemplateData('details', options).then((data) => {
                            renderTemplate(detailSelectedView, data, 'details');
                        });
                    })
                    .then(() => {
                        fetchTemplateData('progress', options).then((data) => {
                            renderTemplate(detailSelectedView, data, 'progress');
                        });
                    });
            });
        }
    }

    /**
     * Renders the template based on the selected user view and provided data.
     *
     * @function renderTemplate
     * @param {string} view - The selected view option from the dropdown.
     * @param {Array} data - The data to be used for rendering the template.
     * @param {string} area - which area this is used for
     * @returns {void}
     */
    function renderTemplate(view, data, area) {
        let templatename = '';
        if (area == 'block') {
            const pagedContentPage = document.getElementById('block_myprograms_overview');
            templatename = 'enrol_programs/block_myprograms_';
            Templates.render(templatename + view, { programs: data })
                .then(function(html, js) {
                    return Templates.replaceNodeContents(pagedContentPage, html, js);
                });
        } else if (area == 'details') {
            const pagedContentPage = document.getElementById('programinfocontainer');
            templatename = 'enrol_programs/programinfo';
            Templates.render(templatename + view, data)
                .then(function(html, js) {
                    return Templates.replaceNodeContents(pagedContentPage, html, js);
                });
        } else if (area == 'progress') {
            const pagedContentPage = document.getElementById('programcontentcontainer');
            templatename = 'enrol_programs/programcontent';
            Templates.render(templatename + view, {})
                .then(function(html, js) {
                    return Templates.replaceNodeContents(pagedContentPage, data, js);
                });
        }
    }

    /**
     * Fetches the template data required for rendering.
     *
     * @function fetchTemplateData
     * @param {string} area which area is this used for
     * @param {Object} options options for the fetch
     * @returns {Promise<Object>} A promise that resolves to an object containing the template data.
     */
    function fetchTemplateData(area, options = {}) {
        if (area == 'block') {
            return Ajax.call([{
                methodname: "enrol_programs_get_my_programsoverview",
                args: {
                    currentpage: currentPage
                }
            }])[0]
                .then((result) => result || {});
        } else if (area == 'details') {
            return Ajax.call([{
                methodname: "enrol_programs_get_my_programdetails",
                args: options
            }])[0]
                .then((result) => result || {});
        } else if (area == 'progress') {
            return Ajax.call([{
                methodname: "enrol_programs_get_my_programuserprogress",
                args: {
                    programid: options.programid,
                    allocationid: options.allocationid
                }
            }])[0]
                .then((result) => result || {});
        }
    }
});
