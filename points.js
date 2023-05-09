class Point {
    constructor({id, title, colour, toi, buttonlabel, position, gmaps}) {
        this.id = id;
        this.title = title;
        this.colour = colour;
        this.buttonlabel = buttonlabel;
        this.position = position;
        this.toi = toi;
        this.gmaps = gmaps;
    }
}

class TOI {
    constructor({id, dateTaken, dateAdded, dateUpdated, direction, image, description}) {
        this.id = id;
        this.dateTaken = dateTaken;
        this.dateAdded = dateAdded;
        this.dateUpdated = dateUpdated;
        this.image = image;
        this.direction = direction;
        this.description = description;
    }
};

class Credit {
    constructor({name, email, source}) {
        this.name = name;
        this.email = email;
        this.source = source;
    }
}

class Position {
    constructor({lat, lng}) {
        this.lat = lat;
        this.lng = lng;
    }
}

const NewportRailTunnel = new Point({
    id: 1,
    title: "Newport Rail Tunnel",
    colour: "#ff0000",
    buttonlabel: "",
    position: new Position({
        lat: 50.701870298467696,
        lng: -1.2895803407729292
    }),
    toi: [
        new TOI({
            id: 1,
            dateTaken: "2022-01-01",
            dateAdded: "",
            dateUpdated: "",
            direction: "",
            image: "https://source.unsplash.com/1600x900/?sea",
            credit: new Credit({
                name: "",
                email: "",
                source: ""
            }),
            description: "",
        })
    ]
})
const VentnorRailTunnel = new Point({
    id: 2,
    position: new Position({
        lat: 50.59802389332379,
        lng: -1.2083137035369875
    }),
    title: "Ventnor Rail Tunnel",
    buttonlabel: "",
    colour: "#ff0000",
    dateAdded: "",
    dateUpdated: "",
    gmaps: "",
    toi: [
        new TOI({
            id: 1,
            dateTaken: "2022-01-01",
            image: "https://source.unsplash.com/1600x900/?beach",
            credit: new Credit({
                name: "",
                email : "",
                source : "",
            }),
            description: "",
            dateAdded: "",
            dateUpdated: "",
            direction: ""
        })
    ]
})

export const points = [
    NewportRailTunnel,
    VentnorRailTunnel
];