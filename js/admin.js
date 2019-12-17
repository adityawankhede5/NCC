let selected=1;

function showform(option){
    let selectedcontainer = document.getElementById(`option-${selected}`);
    selectedcontainer.style.color="black";
    selectedcontainer.style.backgroundColor="white";
    selected=option;
    selectedcontainer = document.getElementById(`option-${selected}`);
    selectedcontainer.style.color="white";
    selectedcontainer.style.backgroundColor="#fd7e14";

    switch (selected) {
        case 1:
            eventForm();
            break;
        case 2:
            galleryForm();
            break;
        default:
            break;
    }
}

function eventForm(){
    console.log("Show event form");
    let formscontainer = document.getElementById("formscontainer");
    formscontainer.innerText='';
    formscontainer.insertAdjacentHTML('beforeend', '<h1>Add Event</h1><form class="actualform" id="eventform" action="addevent.php" method="POST" enctype="multipart/form-data"></form>');
    let form = document.getElementById("eventform");
    let elements = ["date | Date", "month | Month", "timefrom | Time from", "timeto | Time to", "venue | Venue", "brief | Brief"];
    let types = ["number", "month", "time", "time", "text", "text"];

    elements.forEach((el, i)=>{
        form.insertAdjacentHTML('beforeend', `<div class="formelement"><label>${el.split(' | ')[1]}</label><input type="${types[i]}" name="${el.split(' | ')[0]}" ></input></div>`);
    });
    form.insertAdjacentHTML('beforeend', '<div class="formelement"><label>Description</label><textarea id="description" name="description"></textarea></div>');
    form.insertAdjacentHTML('beforeend', '<div class="formelement"><label>Upload Images</label><input type="file" name="filename"></input></div>');
    form.insertAdjacentHTML('beforeend', '<div class="formelement"><input type="submit" value="Add" name="submit"></div>');
}

function galleryForm(){
    console.log("Show gallery form");
    let formscontainer = document.getElementById("formscontainer");
    formscontainer.innerText='';
    formscontainer.insertAdjacentHTML('beforeend', '<h1>Add to Gallery</h1><form class="actualform" id="galleryform" action="#" method="GET"></form>');
    let form = document.getElementById("galleryform");
    let elements = ["date | Date", "month | Month", "year | Year", "albumname | Album Name"];
    let types = ["number", "month", "year", "text"];

    elements.forEach((el, i)=>{
        form.insertAdjacentHTML('beforeend', `<div class="formelement"><label>${el.split('|')[1]}</label><input type="${types[i]}" name="${el.split('|'[0])}" required></input></div>`);
    });

    form.insertAdjacentHTML('beforeend', '<div class="formelement"><label>Upload Images</label><input type="file" name="filename" multiple></input></div>');
    form.insertAdjacentHTML('beforeend', '<div class="formelement"><input type="submit" value="Submit"></div>')
}
