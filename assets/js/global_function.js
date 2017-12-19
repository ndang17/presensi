function print(element) {
    $(''+element).printThis({

        // shows debug info
        debug: false,

        // import page CSS
        importCSS: true,

        // import styles
        importStyle: false,

        // print outer container
        printContainer: true,

        // additonal CSS file
        loadCSS: "",

        // page title
        pageTitle: "Presensi System",

        // remove inline styles
        removeInline: false,

        // print delay in ms
        printDelay: 333,

        // header
        header: null,

        // footer
        footer: null,

        // preserve input/form values
        formValues: true,

        // preserve the base tag (if available)
        base: false,

        // copy canvas elements (experimental)
        canvas: false,

        // html doctype
        doctypeString: '<!DOCTYPE html>',

        // remove script tags before appending
        removeScripts: false,

        // // copy classes from the html & body tag
        copyTagClasses: false

    });
}