const searchForm = document.getElementById('search-form');

searchForm.addEventListener('submit', function (event) {
  event.preventDefault();
  console.log('clicked');
  const city = document.getElementById('search-text').value;
  console.log(city);

  fetch('search.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({ searchInput: city }),
  })
    .then((response) => response.json())
    .then((data) => {
      console.log(data);
    })
    .catch((error) => console.log(error));
});
