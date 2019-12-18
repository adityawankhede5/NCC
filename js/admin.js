let selected=1;
const months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

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
    formscontainer.insertAdjacentHTML('beforeend', '<h1>Add Event</h1><form class="actualform" id="eventform" action="addevent.php" method="POST" enctype="multipart/form-data" ></form>');
    let form = document.getElementById("eventform");
    let elements = ["date | Date", "timefrom | Time from", "timeto | Time to", "venue | Venue", "brief | Brief"];
    let types = ["date", "time", "time", "text", "text"];

    elements.forEach((el, i)=>{
        form.insertAdjacentHTML('beforeend', `<div class="formelement"><label>${el.split(' | ')[1]}</label><input type="${types[i]}" name="${el.split(' | ')[0]}" required></input></div>`);
    });
    form.insertAdjacentHTML('beforeend', '<div class="formelement"><label>Description</label><textarea id="description" name="description" required></textarea></div>');
    form.insertAdjacentHTML('beforeend', '<div class="formelement"><label>Upload Images</label><input type="file" name="filename" required></input></div>');
    form.insertAdjacentHTML('beforeend', '<div class="formelement"><input type="submit" value="Add" name="submit"></div>');
}

function galleryForm(){
    console.log("Show gallery form");
    let formscontainer = document.getElementById("formscontainer");
    formscontainer.innerText='';
    formscontainer.insertAdjacentHTML('beforeend', '<h1>Add to Gallery</h1><form class="actualform" id="galleryform" action="addalbum.php" method="POST" enctype="multipart/form-data"></form>');
    let form = document.getElementById("galleryform");
    let elements = ["albumname | Album Name", "date | Date"];
    let types = ["text", "date"];

    elements.forEach((el, i)=>{
        form.insertAdjacentHTML('beforeend', `<div class="formelement"><label>${el.split(' | ')[1]}</label><input type="${types[i]}" name="${el.split(' | ')[0]}" required></input></div>`);
    });

    form.insertAdjacentHTML('beforeend', '<div class="formelement"><label>Upload Images</label><input type="file" name="albumfile[]" multiple required></input></div>');
    form.insertAdjacentHTML('beforeend', '<div class="formelement"><input type="submit" value="Submit" name="submit"></div>')
}
