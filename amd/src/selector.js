define(['core/templates', 'core_user/repository', 'core/ajax', 'core/str'], function(Templates, UserRepository, Ajax, Str) {
    let currentPage = 1;
    let selectedView;
    let totalPages;
    let perPage;
    let filterbyStatus = '';
    let OrderBy = 'fullname';
    let searchTimeout;
    let searchQuery = '';
    let moduleOptions = {};
    let isMyProgramsPage = false;

    const PER_PAGE_OPTIONS = [6, 12, 24, 48];

    /**
     * Updates the enabled/disabled state of the pagination arrows based on the current page.
     */
    function updateArrowsState() {
        document.querySelectorAll('.programs-previous').forEach(btn => {
            btn.classList.toggle('disabled', currentPage <= 1);
            btn.closest('.page-item')?.classList.toggle('disabled', currentPage <= 1);
        });
        document.querySelectorAll('.programs-next').forEach(btn => {
            btn.classList.toggle('disabled', currentPage >= totalPages);
            btn.closest('.page-item')?.classList.toggle('disabled', currentPage >= totalPages);
        });
    }

    /**
     * Renders numbered pagination buttons with ellipsis into every .programs-pagination-numbers container.
     */
    function renderPageNumbers() {
        document.querySelectorAll('.programs-pagination-numbers').forEach(container => {
            container.innerHTML = '';
            if (totalPages <= 1) {
                return;
            }

            const pages = buildPageRange(currentPage, totalPages);

            pages.forEach(p => {
                if (p === '...') {
                    const li = document.createElement('span');
                    li.className = 'page-link disabled programs-pagination-ellipsis';
                    li.textContent = '…';
                    container.appendChild(li);
                } else {
                    const btn = document.createElement('button');
                    btn.className = 'page-link' + (p === currentPage ? ' active' : '');
                    btn.textContent = p;
                    btn.setAttribute('aria-label', 'Page ' + p);
                    if (p === currentPage) {
                        btn.setAttribute('aria-current', 'page');
                    }
                    btn.addEventListener('click', () => {
                        currentPage = p;
                        fetchAndRender();
                    });
                    container.appendChild(btn);
                }
            });
        });
    }
    /**
     * Builds the array of page numbers/ellipsis to display.
     *
     * @param {number} current - The current page number.
     * @param {number} total - The total number of pages.
     * @returns {Array} Array of page numbers and ellipsis strings.
     */
    function buildPageRange(current, total) {
        if (total <= 7) {
            return Array.from({length: total}, (_, i) => i + 1);
        }
        const delta = 2;
        const range = [];
        const left = Math.max(2, current - delta);
        const right = Math.min(total - 1, current + delta);

        range.push(1);
        if (left > 2) {
            range.push('...');
        }
        for (let i = left; i <= right; i++) {
            range.push(i);
        }
        if (right < total - 1) {
            range.push('...');
        }
        range.push(total);

        return range;
    }

    /**
     * Renders the per-page dropdown into every .programs-perpage-container.
     */
    function renderPerPageDropdown() {
        document.querySelectorAll('.programs-perpage-container').forEach(container => {
            container.innerHTML = '';

            const wrapper = document.createElement('div');
            wrapper.className = 'd-flex align-items-center gap-2';

            const label = document.createElement('label');
            label.textContent = 'Per page:';
            label.className = 'col-form-label col-form-label-sm text-nowrap mb-0';

            const select = document.createElement('select');
            select.className = 'form-select form-select-sm w-auto';

            PER_PAGE_OPTIONS.forEach(opt => {
                const option = document.createElement('option');
                option.value = opt;
                option.textContent = opt;
                if (opt === perPage) {
                    option.selected = true;
                }
                select.appendChild(option);
            });
            Str.get_string('all').then(function(allText) {
                const allOption = document.createElement('option');
                allOption.value = 0;
                allOption.textContent = allText;
                if (perPage === 0) {
                    allOption.selected = true;
                }
                select.appendChild(allOption);
            });
            select.addEventListener('change', function () {
                perPage = parseInt(this.value);
                currentPage = 1;
                UserRepository.setUserPreference('enrol_programs_block_user_perpage', perPage);
                fetchAndRender();
            });

            wrapper.appendChild(label);
            wrapper.appendChild(select);
            container.appendChild(wrapper);
        });
    }
    /**
     * Toggle pagination visibility.
     */
    function togglePaginationVisibility() {
        document.querySelectorAll('.programs-pagination').forEach(container => {
            container.style.display = perPage === 0 ? 'none' : '';
        });
    }
    /**
     * Fetches fresh data, recalculates totalPages, re-renders everything.
     */
    function fetchAndRender() {
        const container = document.getElementById('block_myprograms_overview');
        Templates.render('core/loading', {}).then(function(html) {
            container.innerHTML = html;
            UserRepository.setUserPreference('enrol_programs_block_user_view_preference', selectedView);
            fetchTemplateData('block')
                .then(data => {
                    if (!data) {
                        return;
                    }
                    if (data.totalpages !== undefined) {
                        totalPages = data.totalpages;
                    }
                    if (isMyProgramsPage) {
                        togglePaginationVisibility();
                        if (perPage !== 0) {
                            updateArrowsState();
                            renderPageNumbers();
                        }
                        renderPerPageDropdown();
                    } else {
                        updateArrowsState();
                    }
                    renderTemplate(selectedView, data.programs, 'block');
                });
        });
    }

    return {
        /**
         * Initialises the program selector block.
         *
         * @param {Object} options - Options passed from PHP including totalpages and perpage.
         */
        init: async function(options = {}) {
            const preferences = await new Promise((resolve, reject) => {
                Ajax.call([{
                    methodname: 'enrol_programs_get_userprogram_preferences',
                    args: {},
                    done: resolve,
                    fail: reject
                }]);
            });

            moduleOptions = options;
            selectedView = preferences.blockview;
            totalPages = options.totalpages;
            perPage = options.perpage ?? 12;
            isMyProgramsPage = document.getElementById('ismyprogramspage')?.value === "1";
            if (isMyProgramsPage && perPage !== 0) {
                renderPageNumbers();
                renderPerPageDropdown();
            } else if (isMyProgramsPage) {
                renderPerPageDropdown();
            }
            if (!isMyProgramsPage) {
                perPage = 12;
            }
            updateArrowsState();
            togglePaginationVisibility();

            document.querySelectorAll('.programs-previous').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (!btn.classList.contains('disabled') && currentPage > 1) {
                        currentPage--;
                        fetchAndRender();
                    }
                });
            });

            document.querySelectorAll('.programs-next').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (!btn.classList.contains('disabled')) {
                        currentPage++;
                        fetchAndRender();
                    }
                });
            });

            attachDropdownListener();
        }
    };

    /**
     * Attaches event listeners for view toggles, filters, sort, and search.
     */
    function attachDropdownListener() {

        document.addEventListener('click', function(e) {
            const item = e.target.closest('#statusfilter .dropdown-item');
            if (!item) {
                return;
            }
            e.preventDefault();
            filterbyStatus = item.dataset.status;
            item.closest('.dropdown-menu').querySelectorAll('.dropdown-item')
                .forEach(el => el.classList.remove('active'));
            item.classList.add('active');
            const label = document.querySelector('#statusfilterdropdown .dropdown-label');
            if (label) {
                label.textContent = item.textContent.trim();
            }
            UserRepository.setUserPreference('enrol_programs_block_user_filterby', filterbyStatus);
            currentPage = 1;
            fetchAndRender();
        });

        document.addEventListener('click', function(e) {
            const item = e.target.closest('#sortbyfilter .dropdown-item');
            if (!item) {
                return;
            }
            e.preventDefault();
            OrderBy = item.dataset.status;
            const btn = document.querySelector('#sortbyfilterdropdown');
            if (btn) {
                btn.textContent = item.textContent;
            }
            const isDesc = OrderBy.endsWith('_desc');
            const newStatus = isDesc ? OrderBy.replace('_desc', '') : `${OrderBy}_desc`;
            const newArrow = isDesc ? '↑' : '↓';
            item.dataset.status = newStatus;
            item.closest('.dropdown-menu').querySelectorAll('.dropdown-item')
                .forEach(el => el.classList.remove('active'));
            item.classList.add('active');
            item.textContent = `${item.textContent.trim().replace(/[↑↓]/g, '').trim()} ${newArrow}`;
            UserRepository.setUserPreference('enrol_programs_block_user_orderby', OrderBy);
            currentPage = 1;
            fetchAndRender();
        });

        document.addEventListener('click', function(e) {
            const link = e.target.closest('#programview-toggle .programviewtoggle-button');
            if (!link) {
                return;
            }
            e.preventDefault();
            selectedView = link.getAttribute('data-view');
            document.querySelectorAll('#programview-toggle .programviewtoggle-button')
                .forEach(l => l.classList.remove('selected'));
            link.classList.add('selected');
            currentPage = 1;
            fetchAndRender();
        });

        document.addEventListener('click', function(e) {
            const link = e.target.closest('#programdetail-programview-toggle .programviewtoggle-button');
            if (!link) {
                return;
            }
            e.preventDefault();
            const view = link.getAttribute('data-view');
            document.querySelectorAll('#programdetail-programview-toggle .programviewtoggle-button')
                .forEach(l => l.classList.remove('selected'));
            link.classList.add('selected');
            Templates.render('core/loading', {}).then(function(spinnerHtml) {
                document.getElementById('programcontentcontainer').innerHTML = spinnerHtml;
                return UserRepository.setUserPreference('enrol_programs_detailpage_user_view_preference', view)
                    .then(() => fetchTemplateData('details', moduleOptions))
                    .then(data => renderTemplate(view, data, 'details'))
                    .then(() => fetchTemplateData('progress', moduleOptions))
                    .then(data => renderTemplate(view, data, 'progress'));
            });
        });

        const searchEl = document.getElementById('programsearch');
        if (searchEl) {
            searchEl.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchQuery = this.value.trim();
                searchTimeout = setTimeout(() => {
                    currentPage = 1;
                    fetchAndRender();
                }, 300);
            });
        }
    }

    /**
     * Renders the template based on the selected view and area.
     *
     * @param {string} view - The selected view (grid or table).
     * @param {Array} data - The data to render.
     * @param {string} area - Which area to render (block, details, progress).
     */
    function renderTemplate(view, data, area) {
        if (area === 'block') {
            const container = document.getElementById('block_myprograms_overview');
            Templates.render('enrol_programs/block_myprograms_' + view, {
                ismyprogramspage: isMyProgramsPage,
                programs: data
            }).then(function(html, js) {
                return Templates.replaceNodeContents(container, html, js);
            });
        } else if (area === 'details') {
            const container = document.getElementById('programinfocontainer');
            Templates.render('enrol_programs/programinfo' + view, data)
                .then(function(html, js) {
                    return Templates.replaceNodeContents(container, html, js);
                });
        } else if (area === 'progress') {
            const container = document.getElementById('programcontentcontainer');
            Templates.render('enrol_programs/programcontent' + view, {})
                .then(function(html, js) {
                    return Templates.replaceNodeContents(container, data, js);
                });
        }
    }

    /**
     * Fetches template data from the server via AJAX.
     *
     * @param {string} area - Which area to fetch data for (block, details, progress).
     * @param {Object} options - Options including programid and allocationid.
     * @returns {Promise<Object>} A promise resolving to the fetched data.
     */
    function fetchTemplateData(area, options = {}) {
        if (area === 'block') {
            return Ajax.call([{
                methodname: "enrol_programs_get_my_programsoverview",
                args: {
                    currentpage: currentPage,
                    perpage: isMyProgramsPage ? perPage : 12,
                    status: filterbyStatus,
                    search: searchQuery,
                    orderby: OrderBy
                }
            }])[0].then(result => result || {});
        } else if (area === 'details') {
            return Ajax.call([{
                methodname: "enrol_programs_get_my_programdetails",
                args: options
            }])[0].then(result => result || {});
        } else if (area === 'progress') {
            return Ajax.call([{
                methodname: "enrol_programs_get_my_programuserprogress",
                args: {programid: options.programid, allocationid: options.allocationid}
            }])[0].then(result => result || {});
        }
    }
});