
<script src="https://api-maps.yandex.ru/2.1/?apikey=31cc1f1b-e29b-4f22-8505-a913a8d66f5e&lang=ru_RU" type="text/javascript"></script>
<script>
    ymaps.ready(init);function init() {
        let myMap = new ymaps.Map("map", {
            center: [44.842544, 65.502563],
            zoom: 12
        }, {
            searchControlProvider: 'yandex#search'
        });

        let placemark = new ymaps.Placemark([55.684758, 37.738521], null, {
            preset: 'islands#icon',
            iconColor: '#0095b6'
        })
        myMap.events.add('click', function (e) {
            // Получение координат щелчка
            let coords = e.get('coords');

            myMap.geoObjects.remove(placemark)

            placemark = new ymaps.Placemark(coords, null, {
                preset: 'islands#icon',
                iconColor: '#0095b6'
            })
            myMap.geoObjects
                .add(placemark);
            document.getElementsByName('lat').forEach(function (input) {
                input.value = coords[0]
            })
            document.getElementsByName('lng').forEach(function (input) {
                input.value = coords[1]
            })
        });
    }

</script>
