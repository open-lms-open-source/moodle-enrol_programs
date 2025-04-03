define(['core/templates', 'core_user/repository', 'core/ajax'], function(Templates, UserRepository, Ajax) {
    return {
        init: function(options= {}) {
            attachDropdownListener(options);
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
            const selectedView = event.target.value;
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
            const selectedView = event.target.value;
            UserRepository.setUserPreference('enrol_programs_detailpage_user_view_preference', selectedView)
                .then(() => {
                    fetchTemplateData('details', options).then((data) => {
                        renderTemplate(selectedView, data, 'details');
                    });
                })
                .then(() => {
                    fetchTemplateData('progress', options).then((data) => {
                        renderTemplate(selectedView, data, 'progress');
                    });
                });
            });
        }
    }

    /**
     * Renders the template based on the selected user view and provided data.
     *
     * @function renderTemplate
     * @param {string} selectedView - The selected view option from the dropdown.
     * @param {Array} data - The data to be used for rendering the template.
     * @param {string} area - which area this is used for
     * @returns {void}
     */
    function renderTemplate(selectedView, data, area) {

        let templatename = '';
        if (area == 'block') {
            const pagedContentPage = document.getElementById('block_myprograms_overview');
            templatename = 'enrol_programs/block_myprograms_';
            Templates.render(templatename+selectedView, {programs: data})
            .then(function(html, js) {
                return Templates.replaceNodeContents(pagedContentPage, html, js);
            });
        } else if (area == 'details'){
            const pagedContentPage = document.getElementById('programinfocontainer');
            templatename = 'enrol_programs/programinfo';
            Templates.render(templatename+selectedView, data)
            .then(function(html, js) {
                return Templates.replaceNodeContents(pagedContentPage, html, js);
            });
        } else if (area == 'progress') {
            const pagedContentPage = document.getElementById('programcontentcontainer');
            templatename = 'enrol_programs/programcontent';
            Templates.render(templatename+selectedView, {})
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
                args: {}
            }])[0]
            .then((result) => {
                return result || {};
            });
        } else if (area == 'details') {
            return Ajax.call([{
                methodname: "enrol_programs_get_my_programdetails",
                args: options
            }])[0]
            .then((result) => {
                return result || {};
            });
        } else if (area == 'progress') {
            return Ajax.call([{
                methodname: "enrol_programs_get_my_programuserprogress",
                args:  {
                    programid: options.programid,
                    allocationid: options.allocationid
                }
            }])[0]
            .then((result) => {
                return result || {};
            });
        }
    }
});
