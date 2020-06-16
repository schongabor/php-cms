
$(document).ready(function(){

    //CK EDITOR
    ClassicEditor
        .create( document.querySelector( '#body' ) )
        .catch( error => {
            console.error( error );
        } );
    //REST OF THE CODE
    
    
    
});


$(document).ready(function(){
    
    $('#selectAllBoxes').click(function(event){
    
        if(this.checked){
        
            $('.checkBoxes').each(function(){
            
                this.checked = true;
            
            });
            
        } else {
            
            $('.checkBoxes').each(function(){
        
                this.checked = false;
        
            });    
        
        }
    
    });

});

