blockUneChambre = document.getElementById('fieldsetUneChambre')
blockPlusieursChambresSimples = document.getElementById('fieldsetPlusieursChambresSimples')
blockPlusieursChambresDoubles = document.getElementById('fieldsetPlusieursChambresDoubles')


inputNbChambres = document.getElementById('input_nb_chambres')
btnNbChambres = document.getElementById('btn_nb_chambres')

span_simple = document.getElementById('spanSimple')
span_double = document.getElementById('spanDouble')

radiosOneRoom = document.querySelectorAll('#fieldsetUneChambre p input')

// hideBlocks
 blockUneChambre.style = "display:none" 
 blockPlusieursChambresSimples.style = "display:none"
 blockPlusieursChambresDoubles.style = "display:none" 

function verifiernombreschambres() {
 blockUneChambre.style = "display:none"
 blockPlusieursChambresSimples.style = "display:none"
 blockPlusieursChambresDoubles.style = "display:none"

      if ( parseInt(inputNbChambres.value) === 1 ) {
         blockUneChambre.style = "display:block" 
     }else if ( parseInt(inputNbChambres.value) !== 1 ) {
         blockPlusieursChambresSimples.style = "display:block"
         blockPlusieursChambresDoubles.style = "display:block"
         
     }
}

function creeSelect(attributValue, optionsVue, test, attributName) {
selectList = document.createElement("select")
selectList.setAttribute('name', attributName) 
test.appendChild(selectList)

for (var i = 0; i < attributValue.length; i++) {
   option = document.createElement("option")
   option.value = attributValue[i]
   option.text = optionsVue[i]
   selectList.appendChild(option)
}
}

function viewChoice (ref){
 document.querySelector(ref).addEventListener('change', function () {
if (this.value === "DeuxlitSimple"){secondSpanDouble.innerHTML = ""
creeSelect(["vueInterieur"],["Vue intérieur"], secondSpanDouble, 'un')}
else if (this.value === "litDouble"){secondSpanDouble.innerHTML = "" 
creeSelect([" ", "vueInterieur","vueExterieur"],["--Choisissez une vue--","Vue intérieur","Vue extérieur"], secondSpanDouble, 'deux')}}, false)

}

function ajouterLaVue (){
 
 for (var i = 0; i < radiosOneRoom.length; i++) {
   if ( radiosOneRoom[i].checked === true ) break }
   {
     if (radiosOneRoom[i].value === "chambreSimple") {
     span_double.innerHTML =""
     secondSpanDouble.innerHTML = "" 
     creeSelect([" ", "vueInterieur","vueExterieur"],["--Choisissez une vue--","Vue intérieur","Vue extérieur"], span_simple, 'trois')
     } else if(radiosOneRoom[i].value === "chambreDouble"){
     span_simple.innerHTML = ""
     creeSelect([" ", "DeuxlitSimple","litDouble"],["--Choisissez une option--","2 lit simple","Lit double"], span_double, 'quatre')
     viewChoice ('#spanDouble select')
     }
   }
 
}



btnNbChambres.addEventListener("click", verifiernombreschambres, false)
document.getElementById('optionChambreSimple').addEventListener("click", ajouterLaVue, false)
document.getElementById('optionChambreDouble').addEventListener("click", ajouterLaVue, false)


// enfants

inputKidsNbr = document.getElementById('input_nb_enfants')
btnEnfants = document.getElementById('btn_nb_enfants')

btnEnfants.addEventListener('click', creerBtnRadio, false)

function creerBtnRadio () {

 attributevalue = ["bebe ", "enfant","adolescent"]
 textsLabel = [" 2ans et moins", "Entre 2ans et 10ans","Entre 14ans et 17ans"]
 
for(var j=1; j <= inputKidsNbr.value; j++){
 createDiv = document.createElement('div')
 createDiv.textContent = `--Choisissez l'age d'enfant   `+j 
 // createDiv.setAttribute('class', 'childCss')
 createSpan = document.createElement('span')
 createSpan.setAttribute('id','spanEnfantInput'+j)
 // createSpan.setAttribute('class', 'childCss')
 createDiv.appendChild(createSpan)
 document.querySelector('#testBtn').appendChild(createDiv)
 createSpanSelect = document.createElement('span')
 createSpanSelect.setAttribute('id','span'+j)
 createSpanSelect.setAttribute('class','createSpanSelectCss')
 createDiv.appendChild(createSpanSelect)
for(var i = 1; i <= 3; i++ ){

 spanCss = document.createElement('span')
 spanCss.setAttribute('class', 'childCss')

 theCreatedBtn = document.createElement('input')
 theCreatedBtn.setAttribute('type', 'radio')
 theCreatedBtn.setAttribute('name', 'btnRadioEnfant'+j)                    //  change the name  done
 theCreatedBtn.setAttribute('value', attributevalue[i-1])
 theCreatedBtn.setAttribute('id', 'btnRadioId'+j+i)

 labelBtn = document.createElement('label')
 labelBtn.setAttribute('for', 'btnRadioId'+j+i)
 labelBtn.textContent = textsLabel[i-1]

 spanCss.append(theCreatedBtn, labelBtn)
 createSpan.appendChild(spanCss)
 createSpan.append(theCreatedBtn, labelBtn)
}

createSpan.addEventListener('change', function(){

 for (var i = 1; i <= inputKidsNbr.value; i++){
 optBtn = document.querySelectorAll(`#spanEnfantInput${i} input`)
 where = document.querySelector(`#span${i} `)
 for (var k = 0; k < optBtn.length; k++) {
   if ( optBtn[k].checked === true ) break }
   {
     if (optBtn[k].value === "bebe ") {
     
     where.innerHTML = "" 
     creeSelect(["supplement","paSupplement"],["lit d'enfant","sans lit d'enfant"], where, 'cinq')
     } else if(optBtn[k].value === "enfant"){
       where.innerHTML = ""
     creeSelect(["halfPrice"],["ajouter une chambre simple 50%"], where, 'six')
     } else if (optBtn[k].value === "adolescent"){
       where.innerHTML = ""
       creeSelect(["addOne","plusLit"],["ajouter une chambre simple 70%","ajouter une chambre simple + lit"], where, 'sept')
     }
   }

 
 }
}, false)
}
}

//  pension

radiosPension = document.querySelectorAll('#pensionRadios input')
blockPension = document.getElementById('pensionRadios')
spanPension = document.getElementById('span_pension')
blockPension.addEventListener('change',function(){for (var i = 0; i < radiosPension.length; i++) {
   if ( radiosPension[i].checked === true ) break }
   {
     if (radiosPension[i].value === "demiPension") {
     creeSelect(["petiDej ", "dinner"],["petit déjeuner/déjeuner","déjeuner/diner"], spanPension, 'huit')
   } else if (radiosPension[i].value !== "demiPension") { spanPension.innerHTML = "" }
   }} , false)


   // plusieurs chambres
           // plusieurs chambres simples

inputNbrChambresSimples = document.getElementById('input_nb_chambres_simples')
btNbrChambresSimples= document.getElementById('btn_nb_chambres_simples')

btNbrChambresSimples.addEventListener('click', creerBtnRadioChambreSimples, false)

function creerBtnRadioChambreSimples () {

 attributevalue = ["vueInterieur", "vueExterieur"]
 textsLabel = ["Vue intérieur", "Vue extérieur"]
 
for( var j=1; j <= inputNbrChambresSimples.value; j++ ){
 createDiv = document.createElement('div')
 createDiv.textContent = `Choisissez la vue de la chambre   `+j
 document.querySelector('#place').appendChild(createDiv)
 
for(var i = 1; i <= 2; i++ ){

 theCreatedBtn = document.createElement('input')
 theCreatedBtn.setAttribute('type', 'radio')
 theCreatedBtn.setAttribute('name', 'btnRadioSimpleRooms'+j)                    //  change the name  done
 theCreatedBtn.setAttribute('value', attributevalue[i-1])
 theCreatedBtn.setAttribute('id', 'btnRadioSimpleRooms'+j+i)

 labelBtn = document.createElement('label')
 labelBtn.setAttribute('for', 'btnRadioSimpleRooms'+j+i)
 
 labelBtn.textContent = textsLabel[i-1]
 createDiv.append(theCreatedBtn, labelBtn)
}
}
}     
          // plusieurs chambres doubles

inputNbrChambresDoubles = document.getElementById('input_nb_chambres_doubles')
btNbrChambresDoubles = document.getElementById('btn_nb_chambres_doubles')

btNbrChambresDoubles.addEventListener('click', creerBtnRadioChambreDoubles, false)

function creerBtnRadioChambreDoubles () {

 attributevalue = ["DeuxlitSimple","litDouble"]
 textsLabel = ["2 lit simple","Lit double"]
 
for(var j=1; j <= inputNbrChambresDoubles.value; j++){
 createDiv = document.createElement('div')
 createDiv.textContent = `Choisissez le lit pour la chambre   `+j
 createSpan = document.createElement('span')
 createSpan.setAttribute('id','spanChambresDoublesinput'+j)
 createDiv.appendChild(createSpan)
 document.querySelector('#place2').appendChild(createDiv)
 createSpanSelect = document.createElement('span')
 createSpanSelect.setAttribute('id','spanVues'+j)
 createDiv.appendChild(createSpanSelect)
for(var i = 1; i <= 2; i++ ){

 theCreatedBtn = document.createElement('input')
 theCreatedBtn.setAttribute('type', 'radio')
 theCreatedBtn.setAttribute('name', 'btnRadioChambredouble'+j)                    //  change the name  done
 theCreatedBtn.setAttribute('value', attributevalue[i-1])
 theCreatedBtn.setAttribute('id', 'btnRadioChambredouble'+j+i)

 labelBtn = document.createElement('label')
 labelBtn.setAttribute('for', 'btnRadioChambredouble'+j+i)
 
 labelBtn.textContent = textsLabel[i-1]
 createSpan.append(theCreatedBtn, labelBtn)
}

createSpan.addEventListener('change', function(){

 for (var i = 1; i <= inputNbrChambresDoubles.value; i++){
 optBtn = document.querySelectorAll(`#spanChambresDoublesinput${i} input`)
 where = document.querySelector(`#spanVues${i} `)
 for (var k = 0; k < optBtn.length; k++) {
   if ( optBtn[k].checked === true ) break }
   {
     if (optBtn[k].value === "DeuxlitSimple") {
     
     where.innerHTML = "" 
     creeSelect(["vueInterieur"],["Vue intérieur"], where, 'neuf')

     } else if(optBtn[k].value === "litDouble"){
       where.innerHTML = ""
     creeSelect([ "vueInterieur","vueExterieur"],["Vue intérieur","Vue extérieur"], where, 'dix')
     } 
   }

 
 }
}, false)
}
}