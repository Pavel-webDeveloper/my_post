/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.myGlobalObject = {
    currentForm: null,

    openModal(e, item){
        e.preventDefault();
        console.log(item);

        this.currentForm = e.currentTarget.parentNode;
        console.log(this.currentForm);

        if(item['title']){
            $('#deleteModal-body').html(`Sei sicuro di voler eliminare ${item['title']}?`);
        }else if(item['name']){
            $('#deleteModal-body').html(`Sei sicuro di voler eliminare ${item['name']}?`);
        }

        $('#deleteModal').modal('show');
    },
    // invio form
    submitForm(){
        this.currentForm.submit();
    }
}


