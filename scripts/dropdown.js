var historydropdown; 
window.onload = function() {
    historydropdown = document.getElementById('historydropdown');
    
    historydropdown.onchange = function(){
        var link = this.value;
        window.location = "/history/" + link;

};

};

