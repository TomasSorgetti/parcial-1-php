document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("filtersForm");
  
  const searchInput = document.getElementById("searchInput");
  const orderSelect = document.getElementById("orderSelect");

  if (orderSelect) {
    orderSelect.addEventListener("change", () => {
      form.submit();
    });
  }

  if (searchInput) {
    let debounceTimeout;
    searchInput.addEventListener("input", () => {
      clearTimeout(debounceTimeout);
      debounceTimeout = setTimeout(() => {
        form.submit();
      }, 500);
    });

    // esto es para que no pierda el focus al cargar la pag
    window.addEventListener("load", () => {
      searchInput.focus();

      const length = searchInput.value.length;
      searchInput.setSelectionRange(length, length);
    });
  }
});
