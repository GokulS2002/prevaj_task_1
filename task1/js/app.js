
    // Infinite Slider 
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slide');
    const totalSlides = slides.length;

    function moveSlide(step) {
      currentSlide = (currentSlide + step + totalSlides) % totalSlides;
      document.getElementById('slider-wrapper').style.transform = `translateX(${-currentSlide * 100}%)`;
    }

    function startAutoSlide() {
      setInterval(() => moveSlide(1), 3000);
    }

    document.querySelector('.arrow-left').addEventListener('click', () => moveSlide(-1));
    document.querySelector('.arrow-right').addEventListener('click', () => moveSlide(1));
    startAutoSlide();

    // Pagination and Table Sorting Variables
    let currentPage = 1;
    const rowsPerPage = 7;
    const originalTableBody = document.getElementById('table-body').innerHTML;

    function sortTable() {
      const tableBody = document.getElementById('table-body');
      const rows = Array.from(tableBody.rows);
      const sortBy = document.getElementById('sort-input').value.toLowerCase().trim();
      const filteredRows = rows.filter(row => {
        if (!isNaN(sortBy)) {
          return row.cells[0].textContent == sortBy;
        } else {
          return row.cells[1].textContent.toLowerCase().startsWith(sortBy);
        }
      });

      tableBody.innerHTML = '';
      if (filteredRows.length > 0) {
        filteredRows.forEach(row => tableBody.appendChild(row));
      } else {
        tableBody.innerHTML = '<tr><td colspan="4" class="text-center">No data found</td></tr>';
      }
 // Reset to the first page after sorting
      currentPage = 1;
      showPage(currentPage);
    }

    function resetTable() {
      document.getElementById('table-body').innerHTML = originalTableBody;
      document.getElementById('sort-input').value = '';
      currentPage = 1;
      showPage(currentPage);
    }

    function showPage(page) {
      currentPage = page;
      const tableBody = document.getElementById('table-body');
      const rows = Array.from(tableBody.rows);
      const start = (currentPage - 1) * rowsPerPage;
      const end = start + rowsPerPage;

      rows.forEach((row, index) => {
        row.style.display = index >= start && index < end ? '' : 'none';
      });

      updatePagination();
    }

    function updatePagination() {
      const totalPages = Math.ceil(document.getElementById('table-body').rows.length / rowsPerPage);
      document.getElementById('prev-page').classList.toggle('disabled', currentPage === 1);
      document.getElementById('next-page').classList.toggle('disabled', currentPage === totalPages);

      for (let i = 1; i <= 5; i++) {
        const pageLink = document.getElementById(`page-${i}`);
        if (i <= totalPages) {
          pageLink.style.display = 'block';
          pageLink.classList.toggle('active', i === currentPage);
        } else {
          pageLink.style.display = 'none';
        }
      }
    }

    document.getElementById('prev-page').addEventListener('click', (e) => {
      e.preventDefault();
      if (currentPage > 1) showPage(currentPage - 1);
    });

    document.getElementById('next-page').addEventListener('click', (e) => {
      e.preventDefault();
      if (currentPage < Math.ceil(document.getElementById('table-body').rows.length / rowsPerPage)) {
        showPage(currentPage + 1);
      }
    });

    for (let i = 1; i <= 5; i++) {
      document.getElementById(`page-${i}`).addEventListener('click', (e) => {
        e.preventDefault();
        showPage(i);
      });
    }

    showPage(currentPage);
  