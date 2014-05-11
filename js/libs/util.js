function log(data){
    console.log(data);
}

function getParameter(param){
    var prmstr = window.location.search.substr(1);
    var prmarr = prmstr.split ("&");
    var params = {};

    for ( var i = 0; i < prmarr.length; i++) {
        var tmparr = prmarr[i].split("=");
        params[tmparr[0]] = tmparr[1];
    }
    return params[param];
}

function sortByString(arr, str, sortOrder){
        
    if (sortOrder === 'asc'){
        return arr.sort(function(a,b){
            var nameA = a[str].toLowerCase(), nameB = b[str].toLowerCase();
            if (nameA < nameB) //sort string ascending
             return -1; 
            if (nameA > nameB)
             return 1;
            return 0; //default return value (no sorting)
        });
    }else{
        return arr.sort(function(a,b){
            var nameA = a[str].toLowerCase(), nameB = b[str].toLowerCase();
            if (nameA > nameB) //sort string ascending
             return -1; 
            if (nameA < nameB)
             return 1;
            return 0; //default return value (no sorting)
        });
    }
}

function sortByDate(arr, sortOrder){
        
    if (sortOrder === 'asc'){
        return arr.sort(function(a,b){
            var dateA = new Date(a.date), dateB = new Date(b.date);
            return dateA - dateB;
        });
    }else{
        return arr.sort(function(a,b){
            var dateA = new Date(a.date), dateB = new Date(b.date);
            return dateB - dateA;
        });
    }
}

function sortByNum(arr, num, sortOrder){
        
    if (sortOrder === 'asc'){
        return arr.sort(function(a,b){
            return a[num]-b[num];
        });
    }else{
        return arr.sort(function(a,b){
            return b[num]-a[num];
        });
    }
}