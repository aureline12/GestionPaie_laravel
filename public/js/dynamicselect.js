var unite = {

    littoral : ['littoral1' , 'littoral2' , 'littoral3'],
    centre : ['centre1' , 'centre2' , 'centre3'],
    ouest : ['ouest1' , 'ouest2' , 'ouest3'],

}

var main = document.getElementById('secteur');
var submain = document.getElementById('unite');

main.addEventListener('change' , function(){

    var selected_option = unite[this.value] ;

    while(submain.options.length>0){

        submain.options.remove(0);

    }

    Array.from(selected_option).forEach(function(el){
      
        let option = new Option(el ,el);
        submain.appendChild(option);
        
    });
});