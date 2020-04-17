


//variable usada en input type="date"
var es={
    monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre','Noviembre', 'Diciembre'],
    monthsShort: [ "ene","feb","mar","abr","may","jun","jul","ago","sep","oct","nov","dic" ],
    weekdaysFull: [ "domingo","lunes","martes","miércoles","jueves","viernes","sábado" ],
    weekdaysShort: [ "dom","lun","mar","mié","jue","vie","sáb" ],

    // Buttons
    today: 'Hoy',
    clear: 'Limpiar',
    close: 'Cerrar',

    // Accessibility labels
    labelMonthNext: 'Siguiente mes',
    labelMonthPrev: 'Mes anterios',
    labelMonthSelect: 'Seleccionar mes',
    labelYearSelect: 'Seleccionar año',

    // Formats
    format: 'd mmmm yyyy',
    formatSubmit: 'yyyy-mm-dd',
    hiddenPrefix: undefined,
    hiddenSuffix: '_submit',
    hiddenName: undefined,

    showMonthsShort: undefined,
    showWeekdaysFull: undefined,

    firstDay: 1,
}

function getFechaAnoMesDia(fechaEuropea){
    if(!fechaEuropea) {
        return "";
        // var f = new Date();
        // return f.getFullYear()+"-"+(("0" + (f.getMonth() + 1)).slice(-2)) +"-"+("0" + f.getDate()).slice(-2)
    }
        return fechaEuropea.substr(6,4)+'-'+fechaEuropea.substr(3,2)+'-'+fechaEuropea.substr(0,2);
}

