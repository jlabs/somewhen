export function setDisplay(points) {

    const locations = document.getElementById('locations');

    points.forEach(point => {
        locations.innerHTML += `
            <div>
                <button data-lat="${point.position.lat}" data-lng="${point.position.lng}">
                    <h2>${point.buttonlabel != "" ? point.buttonlabel : point.title}</h2>
                </button>
            </div>
        `;
    });
}

export function signup(event, map) {
    console.log(event.currentTarget.dataset.lat);
    //console.log(event.currentTarget);
    map.panTo([event.currentTarget.dataset.lat,event.currentTarget.dataset.lng])
}