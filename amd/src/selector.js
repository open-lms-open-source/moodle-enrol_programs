define(['core/templates', 'core_user/repository', 'core/ajax'], function(Templates, UserRepository, Ajax) {
    let currentPage = 1;
    let selectedView; // For block view
    let totalPages;
    let filterbyStatus = '';
    let OrderBy = 'fullname';
    let searchTimeout;
    let searchQuery = '';

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
        const viewLayouts = document.querySelectorAll('#programview-toggle .programviewtoggle-button');
        viewLayouts.forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                selectedView = this.getAttribute('data-view');
                viewLayouts.forEach(l => l.classList.remove('selected'));
                this.classList.add('selected');
                loadandrender(options);
            });
        });

        const viewLinks = document.querySelectorAll('#programdetail-programview-toggle .programviewtoggle-button');
        viewLinks.forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const selectedView = this.getAttribute('data-view');
                viewLinks.forEach(l => l.classList.remove('selected'));
                this.classList.add('selected');
                Templates.render('core/loading', {}).then(function(spinnerHtml) {
                    const pagedContentPage = document.getElementById('programcontentcontainer');
                    pagedContentPage.innerHTML = spinnerHtml;
                    UserRepository.setUserPreference('enrol_programs_detailpage_user_view_preference', selectedView)
                    .then(() => fetchTemplateData('details', options))
                    .then(data => renderTemplate(selectedView, data, 'details'))
                    .then(() => fetchTemplateData('progress', options))
                    .then(data => renderTemplate(selectedView, data, 'progress'));
                });
            });
        });

        document.querySelectorAll('#statusfilter .dropdown-item').forEach(item => {
            item.addEventListener('click', function (e) {
                e.preventDefault();
                let filterbystatus = this.dataset.status;
                const dropdown = this.closest('.dropdown-menu');
                dropdown.querySelectorAll('.dropdown-item').forEach(el => el.classList.remove('active'));
                this.classList.add('active');
                document.querySelector('#statusfilterdropdown .dropdown-label').textContent = this.textContent.trim();
                UserRepository.setUserPreference('enrol_programs_block_user_filterby', filterbystatus);
                filterbyStatus = filterbystatus;
                loadandrender(options);
            });
        });

        document.querySelectorAll('#sortbyfilter .dropdown-item').forEach(item => {
            item.addEventListener('click', function (e) {
                e.preventDefault();
                OrderBy = this.dataset.status;
                const button = document.querySelector('#sortbyfilterdropdown');
                if (button) {
                    button.textContent = this.textContent;
                }
                let newStatus, newArrow;
                if (OrderBy.endsWith('_desc')) {
                    // If already descending, toggle to ascending
                    newStatus = OrderBy.replace('_desc', '');
                    newArrow = '↑'; // ascending
                } else {
                    // If ascending, toggle to descending
                    newStatus = `${OrderBy}_desc`;
                    newArrow = '↓'; // descending
                }
                this.dataset.status = newStatus;
                const dropdown = this.closest('.dropdown-menu');
                dropdown.querySelectorAll('.dropdown-item').forEach(el => el.classList.remove('active'));
                this.classList.add('active');
                const baseText = this.textContent.trim().replace(/[↑↓]/g, '').trim();
                this.textContent = `${baseText} ${newArrow}`;
                UserRepository.setUserPreference('enrol_programs_block_user_orderby', OrderBy);
                loadandrender(options);
            });
        });
        document.getElementById('programsearch').addEventListener('input', function () {
            clearTimeout(searchTimeout);
            searchQuery = this.value.trim();
            searchTimeout = setTimeout(() => {
                loadandrender(options);
            }, 300);
        });

    }

    /**
     * Load spining wheel and then render the content.
     * @param {Object} options options for the fetch
     */
    function loadandrender(options) {
        const pagedContentPage = document.getElementById('block_myprograms_overview');
        Templates.render('core/loading', {}).then(function(spinnerHtml) {
            pagedContentPage.innerHTML = spinnerHtml;
            UserRepository.setUserPreference('enrol_programs_block_user_view_preference', selectedView)
                .then(() => {
                    fetchTemplateData('block', options).then((data) => {
                        renderTemplate(selectedView, Object.values(data), 'block');
                    });
                });
        });
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
            const isMyProgramsPage = document.getElementById('ismyprogramspage')?.value === "1";
            Templates.render(templatename + view, { ismyprogramspage: isMyProgramsPage, programs: data })
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
                    currentpage: currentPage,
                    status: filterbyStatus,
                    search: searchQuery,
                    orderby: OrderBy
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
