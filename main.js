regions.addEventListener('click', update);
date.addEventListener('change', update);
update();
function update(){
    let form = regions.parentNode;
    let data = new FormData(form);
    
    arrival_date.value = getDate().toLocaleDateString();

    fetch('getCouriers.php', {
        method: 'post',
        body: data
    }).then(r=>r.json()).then(fillCouriers);
}

function getDate(){
    let travel_time = parseInt(regions.selectedOptions[0].dataset.travelTime);
    let newDate = new Date(date.value);
    newDate.setDate(newDate.getDate() + travel_time);
    return newDate;
}

function fillCouriers(courierList){
    couriers.innerHTML = null;

    for(let courier of courierList){
        let option = document.createElement("option");
        option.value = courier.id, option.innerText = courier.name;
        couriers.appendChild(option);
    }    
}