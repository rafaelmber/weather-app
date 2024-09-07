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
      const result = data['result'];
      showWeather(result);
    })
    .catch((error) => console.log('Error:', error));
});

function showWeather(weather_data) {
  const location = document.getElementById('current_weather__location');
  console.log(weather_data.name);
  location.innerText = weather_data['name'];

  const weatherDescription = document.getElementById('current-weather__description');
  weatherDescription.innerText = `${weather_data['weather'][0]['main']}: ${weather_data['weather'][0]['description']}`;

  const temperature = document.getElementById('current_weather__temperature');
  temperature.innerText = weather_data['main']['temp'] + '°C';

  const moreTemp = document.getElementById('current_weather__more_temp');
  moreTemp.innerText = `${weather_data['main']['temp_min']}° | ${weather_data['main']['temp_max']}°. Sensación térmica: ${weather_data['main']['feels_like']}°`;

  const weatherIcon = document.getElementById('current-weather__icon');
  weatherIcon.src = `https://openweathermap.org/img/wn/${weather_data['weather'][0]['icon']}@2x.png`;
}
