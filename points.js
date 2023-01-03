class Point {
    constructor(id, title, colour, toi) {
        this.id = id;
        this.title = title;
        this.colour = colour;
    }
}

class TOI {
    constructor(dateTaken) {
        this.dateTaken = dateTaken;
    }
};

export const points = [
    {
        "id": "1",
        "position": {
            "lat": 50.701870298467696,
            "lng": -1.2895803407729292
        },
        "title": "Newport Rail Tunnel",
        "buttonlabel": "",
        "color": "#ff0000",
		"date-added": "",
		"date-updated": "",
        "g-maps": "",
		"history": [
			{
                "id": "1-1",
				"date-taken": "2022-01-01",
				"image": "https://source.unsplash.com/1600x900/?beach",
				"credit": {
                    "name": "",
                    "email" : "",
                    "source" : "",
                },
				"description": "An image of course",
				"date-added": "",
				"date-updated": "",
                "direction": ""
			},
            {
                "id": "1-1",
				"date-taken": "2022-01-01",
				"image": "https://source.unsplash.com/1600x900/?sea",
				"credit": {
                    "name": "",
                    "email" : "",
                    "source" : "",
                },
				"description": "",
				"date-added": "",
				"date-updated": "",
                "direction": ""
			}
		]
    },
    {
        "id": "2",
        "position": {
            "lat": 50.59802389332379,
            "lng": -1.2083137035369875
        },
        "title": "Ventnor Rail Tunnel",
        "buttonlabel": "",
        "color": "#ff0000",
		"date-added": "",
		"date-updated": "",
        "g-maps": "",
		"history": [
			{
                "id": "2-1",
				"date-taken": "2022-01-01",
				"image": "https://source.unsplash.com/1600x900/?beach",
				"credit": {
                    "name": "",
                    "email" : "",
                    "source" : "",
                },
				"description": "",
				"date-added": "",
				"date-updated": "",
                "direction": ""
			}
		]
    }
];