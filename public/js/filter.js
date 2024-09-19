document.addEventListener("DOMContentLoaded", function () {
    const filterFromInput = document.getElementById('filter-from');
    const filterSubjectInput = document.getElementById('filter-subject');
    const filterStartDateInput = document.getElementById('filter-start-date');
    const filterEndDateInput = document.getElementById('filter-end-date');
    const clearFiltersButton = document.getElementById('clear-filters');

    function extractDateOnly(dateString) {
        if (!dateString) return null;
        const [datePart] = dateString.split(' ');
        return datePart;
    }

    function filterMessages() {
        const fromFilter = filterFromInput.value.toLowerCase();
        const subjectFilter = filterSubjectInput.value.toLowerCase();
        const startDateFilter = filterStartDateInput.value;
        const endDateFilter = filterEndDateInput.value;

        const startDate = startDateFilter ? new Date(startDateFilter).toISOString().split('T')[0] : null;
        const endDate = endDateFilter ? new Date(endDateFilter).toISOString().split('T')[0] : null;

        const messageRows = document.querySelectorAll('.inbox-row');

        messageRows.forEach(messageRow => {
            const fromText = messageRow.querySelector('.from').textContent.toLowerCase();
            const subjectText = messageRow.querySelector('.subject').textContent.toLowerCase();
            const messageDate = messageRow.querySelector('.date').textContent.trim();

            const messageDateOnly = extractDateOnly(messageDate);

            const isDateInRange = (!startDate || messageDateOnly >= startDate) &&
                (!endDate || messageDateOnly <= endDate);

            const actionColumn = messageRow.nextElementSibling;

            if ((fromText.includes(fromFilter) || fromFilter === '') &&
                (subjectText.includes(subjectFilter) || subjectFilter === '') &&
                isDateInRange) {
                messageRow.style.display = '';
                if (actionColumn && actionColumn.classList.contains('inbox-column')) {
                    actionColumn.style.display = '';
                }
            } else {
                messageRow.style.display = 'none';
                if (actionColumn && actionColumn.classList.contains('inbox-column')) {
                    actionColumn.style.display = 'none';
                }
            }
        });
    }

    clearFiltersButton.addEventListener('click', function () {
        filterFromInput.value = '';
        filterSubjectInput.value = '';
        filterStartDateInput.value = '';
        filterEndDateInput.value = '';

        filterMessages();
    });

    filterFromInput.addEventListener('input', filterMessages);
    filterSubjectInput.addEventListener('input', filterMessages);
    filterStartDateInput.addEventListener('input', filterMessages);
    filterEndDateInput.addEventListener('input', filterMessages);
});
