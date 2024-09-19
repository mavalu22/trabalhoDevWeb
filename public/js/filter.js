document.addEventListener("DOMContentLoaded", function () {
    const filterFromInput = document.getElementById('filter-from');
    const filterSubjectInput = document.getElementById('filter-subject');
    const filterStartDateInput = document.getElementById('filter-start-date');
    const filterEndDateInput = document.getElementById('filter-end-date');
    const errorContainer = document.createElement('div');
    errorContainer.style.color = 'red';
    filterEndDateInput.parentElement.appendChild(errorContainer);

    function validateDateRange() {
        const startDate = filterStartDateInput.value;
        const endDate = filterEndDateInput.value;

        if (startDate && endDate && new Date(startDate) > new Date(endDate)) {
            errorContainer.textContent = "End date must be later than or equal to the start date.";
            return false;
        } else {
            errorContainer.textContent = "";
            return true;
        }
    }

    function filterMessages() {
        if (!validateDateRange()) {
            return;
        }

        const fromFilter = filterFromInput.value.toLowerCase();
        const subjectFilter = filterSubjectInput.value.toLowerCase();
        const startDateFilter = filterStartDateInput.value;
        const endDateFilter = filterEndDateInput.value;

        const messageRows = document.querySelectorAll('.inbox-row');

        messageRows.forEach(messageRow => {
            const fromText = messageRow.querySelector('.from').textContent.toLowerCase();
            const subjectText = messageRow.querySelector('.subject').textContent.toLowerCase();
            const messageDate = messageRow.querySelector('.date').textContent.trim();

            const messageDateObj = new Date(messageDate);
            const startDateObj = startDateFilter ? new Date(startDateFilter) : null;
            const endDateObj = endDateFilter ? new Date(endDateFilter) : null;

            const isDateInRange = (!startDateObj || messageDateObj >= startDateObj) &&
                (!endDateObj || messageDateObj <= endDateObj);

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

    filterFromInput.addEventListener('input', filterMessages);
    filterSubjectInput.addEventListener('input', filterMessages);
    filterStartDateInput.addEventListener('input', filterMessages);
    filterEndDateInput.addEventListener('input', filterMessages);
});
