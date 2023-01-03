export function setDisplay(points) {

    const locations = document.getElementById('locations');

    points.forEach(point => {
        locations.innerHTML += `
            <div>
                <button data-id="${point.id}">
                    <h2>${point.buttonlabel != "" ? point.buttonlabel : point.title}</h2>
                </button>
            </div>
        `;
    });
}