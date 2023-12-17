function changeSelectedTeam(container){
    while (container.lastChild){
        container.removeChild(container.lastChild);
    }
}

function createAddFieldsForTeamMates(quantity, container,usersData=[], userTeam= [] ){
    while (container.children.length>quantity ) {
        if (container.lastChild.lastChild.checked == true){
            container.removeChild(container.lastChild);
            container.lastChild.lastChild.checked = true;
        }else{
            container.removeChild(container.lastChild);
        }
    }

    if(quantity < userTeam.length){
        quantity=userTeam.length;
    }

    let options = makeAnOptionsList(usersData);

    for(let i=container.children.length;i<quantity;i++){
        let div = document.createElement('div');
        let select = document.createElement('select');
        select.name = 'selectTeam' + i;
        select.id=i;

        let opt = document.createElement('option');
        
            if(i<userTeam.length){
                opt.innerText = userTeam[i].lastname + '\t' + userTeam[i].firstname;
                opt.value = userTeam[i].idUser;
            }
            else{
                opt.innerText = 'Sélectionnez';
                opt.value = null;
            }
            select.appendChild(opt);
        
        options.forEach(option => {
            select.appendChild(option.cloneNode(true));
        });

        select.addEventListener("change", function (){
            console.log(select.value);
        })

        div.appendChild(select);

        radio = document.createElement('input');
        radio.setAttribute('type','radio');
        radio.setAttribute('name', 'captain');
        radio.setAttribute('value',i);
        radio.setAttribute('class',"m-2");
        if (i<1){
            radio.setAttribute('checked','checked');
        }
        
        div.appendChild(radio);
        div.setAttribute('class',"mb-2");
        container.appendChild(div);
    }
    let selects = container.querySelectorAll('select');
    disableSelectedOptions(selects);
}



function makeAnOptionsList(usersData){
    let options = [] ;
    usersData.forEach( userData => {
        let option = document.createElement('option');
        option.innerText = userData.lastname + '\t' + userData.firstname;
        option.value = userData.idUser;
        options.push(option);
    });
    return options;
}

function disableSelectedOptions(selects){
    let lesOptionsSelected = [];
    for (var i = 0; i < selects.length; i++) {
    lesOptionsSelected.push(selects[i].value);
    }   
    selects.forEach(select => {
    let options = select.options;
   
    Array.from(options).forEach(option => {
        if (lesOptionsSelected.includes(option.value)) {
            option.disabled = true;
        } else {
            option.disabled = false;
        }
    });
})
}

function selectsIsValid(selects) {
for (let i = 0; i < selects.length; i++) {
    if (selects[i].value != "null") {
        for (let j = i+1; j < selects.length; j++) {
            if (selects[i].value == selects[j].value || selects[j].value == "null") {
                return false;
            }
        }
    } else {
        return false;
    }
}
return true;
}

//les joueurs de l'équipe courante
function currentTeamMember(dataUT,team){
    data=[];
    for(let i=0;i<dataUT.length;i++){
        if (dataUT[i].idTeam == team){
            data.push(dataUT[i]);
        }
    }
return data;
}