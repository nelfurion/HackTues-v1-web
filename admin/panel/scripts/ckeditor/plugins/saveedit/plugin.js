CKEDITOR.plugins.add( 'saveedit', {
    icons: 'save-edit',
    init: function( editor ) {
    	console.log(editor.getData());
        //saveData();
    }
});