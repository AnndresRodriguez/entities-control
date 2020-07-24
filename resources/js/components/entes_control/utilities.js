
const URL_HUEM =  'http://localhost:3000'


export function validateEmail(email){
    const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

export function removeBlankSpaces(data){
    return data.replace(/\s/g, '');
}


export function addDays(date, days) {

    let result = new Date(date.setDate(date.getDate() + days));
    return result;
}

export function addMonths(date, months) {

    let result = new Date(date.setMonth(date.getMonth() + months));
    return result;
}

export function addYear(date, years) {

    let result = new Date(date.setFullYear(date.getFullYear() + years));
    return result;
}

export function discountDays(date, days) {
    let result = new Date(date);
    result.setDate(date.getDate() - days);
    return result;
}

export function formatHour(hour){
    let timeString = hour;
    let H = + timeString.substr(0, 2);
    let h = (H % 12) || 12;
    let ampm = H < 12 ? " A.M." : " P.M.";
    let M = timeString.substr(2, 3)

    if(h < 10){
        h = `0${h}`;
    }

    if(parseInt(timeString.substr(2, 3).split(':')[1]) < 10 ){
        M = `:0${timeString.substr(2, 3).split(':')[1]}`
    }

    timeString = h + M + ampm;

    return timeString;
}

export function formatDate(date) {

    return `Alarma creada para el ${(date.getDate())} de ${(getNameMonth(date.getMonth() + 1 ))} de ${date.getFullYear()} a las ${formatHour(`${date.getHours()}:${date.getMinutes()}`)}`

}

export function formatISO8601(date){


    let month = date.getMonth() + 1
    let day = date.getDate()

    month < 10 ? month = `0${month}` : date.getMonth() + 1
    day < 10 ? day = `0${day}` : date.getDate()

    return `${date.getFullYear()}-${month}-${day}`

}


function getNameMonth(month){

    switch (month) {
        case 1:
            return 'Enero'
        case 2:
            return 'Febrero'
        case 3:
            return 'Marzo'
        case 4:
            return 'Abril'
        case 5:
            return 'Mayo'
        case 6:
            return 'Junio'
        case 7:
            return 'Julio'
        case 8:
            return 'Agosto'
        case 9:
            return 'Septiembre'
        case 10:
            return 'Octubre'
        case 11:
            return 'Noviembre'
        case 12:
            return 'Diciembre'
        default:
            return month
    }


}

export default URL_HUEM;
