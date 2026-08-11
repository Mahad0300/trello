/**
 * Admin Activity Log Page JavaScript
 */

document.addEventListener('DOMContentLoaded', () => {
  const searchInput = document.getElementById('log-search-input');
  const categoryFilter = document.getElementById('log-category-filter');
  const perPageSelect = document.getElementById('log-per-page-select');
  const allRows = Array.from(document.querySelectorAll('.log-row'));
  const exportCsvBtn = document.getElementById('export-activity-csv-btn');
  const paginationWrapper = document.querySelector('.pagination-numbers');
  const prevBtn = document.querySelector('.pagination-btn-prev');
  const nextBtn = document.querySelector('.pagination-btn-next');
  const footerInfo = document.querySelector('.table-footer-info');

  let currentPage = 1;
  let filteredRows = [...allRows];

  function getItemsPerPage() {
    if (!perPageSelect) return 10;
    const val = perPageSelect.value;
    if (val === 'all') return filteredRows.length || 1;
    return parseInt(val, 10) || 10;
  }

  function renderPagination() {
    const itemsPerPage = getItemsPerPage();
    const totalPages = Math.ceil(filteredRows.length / itemsPerPage) || 1;

    if (currentPage > totalPages) currentPage = totalPages;
    if (currentPage < 1) currentPage = 1;

    // Show/Hide Rows
    allRows.forEach(row => row.style.display = 'none');

    const startIdx = (currentPage - 1) * itemsPerPage;
    const endIdx = startIdx + itemsPerPage;
    const visibleRows = filteredRows.slice(startIdx, endIdx);

    visibleRows.forEach(row => row.style.display = '');

    // Update Footer Info Text
    if (footerInfo) {
      const from = filteredRows.length === 0 ? 0 : startIdx + 1;
      const to = Math.min(endIdx, filteredRows.length);
      footerInfo.innerHTML = `Showing <strong class="text-main">${from}-${to}</strong> of <strong class="text-main">${filteredRows.length}</strong> system audit entries`;
    }

    // Update Prev / Next Buttons
    if (prevBtn) prevBtn.disabled = currentPage === 1;
    if (nextBtn) nextBtn.disabled = currentPage === totalPages || totalPages === 0;

    // Build Page Number Buttons
    if (paginationWrapper) {
      paginationWrapper.innerHTML = '';
      if (totalPages <= 1) {
        const pageBtn = document.createElement('button');
        pageBtn.type = 'button';
        pageBtn.className = 'pagination-num active';
        pageBtn.textContent = '1';
        paginationWrapper.appendChild(pageBtn);
      } else {
        for (let i = 1; i <= totalPages; i++) {
          const pageBtn = document.createElement('button');
          pageBtn.type = 'button';
          pageBtn.className = `pagination-num ${i === currentPage ? 'active' : ''}`;
          pageBtn.textContent = i;
          pageBtn.addEventListener('click', () => {
            currentPage = i;
            renderPagination();
          });
          paginationWrapper.appendChild(pageBtn);
        }
      }
    }
  }

  // Filter Function
  function filterActivityLogs() {
    const searchTerm = searchInput ? searchInput.value.toLowerCase().trim() : '';
    const selectedCategory = categoryFilter ? categoryFilter.value : 'all';

    filteredRows = allRows.filter((row) => {
      const textContent = row.textContent.toLowerCase();
      const rowCategory = row.getAttribute('data-category') || 'cards';

      const matchesSearch = !searchTerm || textContent.includes(searchTerm);
      const matchesCategory = selectedCategory === 'all' || rowCategory === selectedCategory;

      return matchesSearch && matchesCategory;
    });

    currentPage = 1;
    renderPagination();
  }

  // Event Listeners for Prev & Next
  if (prevBtn) {
    prevBtn.addEventListener('click', () => {
      if (currentPage > 1) {
        currentPage--;
        renderPagination();
      }
    });
  }

  if (nextBtn) {
    nextBtn.addEventListener('click', () => {
      const totalPages = Math.ceil(filteredRows.length / getItemsPerPage());
      if (currentPage < totalPages) {
        currentPage++;
        renderPagination();
      }
    });
  }

  if (searchInput) searchInput.addEventListener('input', filterActivityLogs);
  if (categoryFilter) categoryFilter.addEventListener('change', filterActivityLogs);
  if (perPageSelect) {
    perPageSelect.addEventListener('change', () => {
      currentPage = 1;
      renderPagination();
    });
  }

  // Initial Pagination Render
  renderPagination();

  // Export CSV Functionality
  if (exportCsvBtn) {
    exportCsvBtn.addEventListener('click', () => {
      let csvContent = "data:text/csv;charset=utf-8,";
      csvContent += "USER,ACTION,TARGET,WORKSPACE_BOARD,IP_ADDRESS,TIMESTAMP\n";

      filteredRows.forEach((row) => {
        const cells = Array.from(row.querySelectorAll('td')).slice(0, 6);
        const rowData = cells.map(td => `"${td.innerText.replace(/\n/g, ' ').replace(/"/g, '""')}"`).join(",");
        csvContent += rowData + "\n";
      });

      const encodedUri = encodeURI(csvContent);
      const link = document.createElement("a");
      link.setAttribute("href", encodedUri);
      link.setAttribute("download", `activity_log_export_${Date.now()}.csv`);
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
    });
  }
});
