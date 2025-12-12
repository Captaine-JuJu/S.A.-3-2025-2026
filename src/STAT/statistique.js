window.onload = init;

function init(){




    // Parse CSV string
    var data = Papa.parse(csv);

    // Convert back to CSV
    var csv = Papa.unparse(data);

    // Parse local CSV file
    Papa.parse(file, {
        complete: function(results) {
            console.log("Finished:", results.data);
        }
    });

    // Stream big file in worker thread
    Papa.parse(bigFile, {
        worker: true,
        step: function(results) {
            console.log("Row:", results.data);
        }
    });


    // const Papa = require("papaparse"),
    //     fs = require("fs");

    try {
        let connections = fs.readFileSync("./données/connections.csv", "utf-8")
        let connections_json = Papa.parse(connections, {encoding: "utf-8"})
        console.log(connections_json.data);

        let inventory_devices = fs.readFileSync("./données/inventory_devices.csv", "utf-8")
        let inventory_devices_json = Papa.parse(inventory_devices, {encoding: "utf-8"})
        console.log(inventory_devices_json.data);

        let inventory_monitors2 = fs.readFileSync("./données/inventory_monitors2.csv", "utf-8")
        let inventory_monitors2_json = Papa.parse(inventory_monitors2, {encoding: "utf-8"})
        console.log(inventory_monitors2_json.data);

    } catch(e){
        console.error(e);
    }

    let statistiqueUC = document.getElementById("statistiqueUC")
    let statistiqueM = document.getElementById("statistiqueM")
    let statistiqueE = document.getElementById("statistiqueE")
    let statistiqueC = document.getElementById("statistiqueC")

    statistiqueUC.appendChild(console.createTextNode("sous garantie"))

    statistiqueUC.appendChild(console.createTextNode("hors garantie"))

    statistiqueUC.appendChild(console.createTextNode("répartition filière"))

    statistiqueUC.appendChild(console.createTextNode("proba de tombé sur un hors garantie"))

    statistiqueUC.appendChild(console.createTextNode("répartition cpu"))



    zoneStat = document.createElement("div")
}

function distanceQ(liste){
    taille = liste.length
    if (taille % 2 === 1){
        distance = (taille/2)-0.5
    }
    else{
        distance1 = (taille/2)-1
        distance2 = (taille/2)+1
        const liste=[distance1,distance2]
        distance = moyenne(liste)
    }
    return distance
}

function sommeDe(liste, x){
    s=0
    for (let i = 0; i < liste.length; i++) {
        if (liste[i]===x)
            s++
    }
    return s
}

function moyenne(liste){
    resultat = 0
    for (let i = 0; i < liste.length; i++) {
        resultat = resultat + liste[i]
    }
    resultat = resultat/liste.length
    return resultat
}

function mediane(liste, distance){
    taille = liste.length
    if (taille % 2 === 1){
        resultat = distance
    }
    else{
        resultat = distance
    }
    return resultat
}

function quartile1(liste, distance){
    taille = distanceQ(liste, distance)
    for (let i = 0; i < taille; i++) {
        l1 = liste[i]
    }
    d1 = distance(l1)
    resultat = mediane(l1,d1)
}

function quartile3(liste, distance){
    taille = distanceQ(liste, distance)
    for (let i = 0; taille < liste.length; i++) {
        l1 = liste[i]
    }
    d1 = distance(l1)
    resultat = mediane(l1,d1)
}

function correlation(liste){
    moy = moyenne(liste)
    taille = liste.length
    cor = 0
    for (let i = 0; i < taille; i++) {
        cor = cor + (liste[i] - moy)
    }
    cor1 = cor*cor
    r = cor/cor1
    return r
}

function covariance(liste){
    moy = moyenne(liste)
    taille = liste.length
    cov = 0
    for (let i = 0; i < taille; i++) {
        cor = cor + (liste[i] - moy)
    }
    r = cor/(taille-1)
    return r
}