let questions = $('#lists');

function refreshSelects(){
    let selects = questions.find('select');

    // Listen for changes
    selects.unbind('change').bind('change',function(){

        // The selected option
        let selected = $(this).find('option').eq(this.selectedIndex);
        // Look up the data-connection attribute
        let connection = selected.data('connection');

        let price = selected.data('price');

        // Removing the li containers that follow (if any)
        selected.closest('#questions li').nextAll().remove();

        if(connection){
            fetchSelect(connection);
        }
    });
}
let working = false;

function fetchSelect(val){

    if(working){
        return false;
    }
    working = true;

    $.get('/devis/getProductsForm',{k:val},function(r){
        let connection, options;
        if(r.items[0].length === 0) {
            refreshSelects();
            $('.submitButton').show();

            working = false;
        }else {
            refreshSelects();
            $('.submitButton').hide();
            $.each(r.items, function (key, value) {

                if(value.parent == null){
                    connection = '';
                    if(value.name){
                        connection = 'data-connection="'+value.id+'"';
                        options+= '<option value="'+key+'" '+connection+'>'+value.name+'</option>';
                    }

                }else{
                    $.each(r.items, function (key, value) {
                        $.each(value, function (key, value) {
                                connection = 'data-connection="'+value.id+'"';
                                options+= '<option value="'+key+'" '+connection+'>'+value.name+'</option>';


                        })
                    });
                }



            });
            options = '<option></option>'+options;
            $('<li>\
				<p>Choisissez votre produit</p>\
				<select data-placeholder="Votre produit" class="selectors form-control">\
					'+ options +'\
				</select>\
				<span class="divider"></span>\
			</li>').appendTo(questions);

            working = false;
        }
        refreshSelects();
    });

}

fetchSelect('firstList');