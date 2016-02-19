var historydropdown; 
var playerdropdwon;
window.onload = function() {
    historydropdown = document.getElementById('historydropdown');
    playerdropdown = document.getElementById('playerdropdown');
    historydropdown.onchange = function(){
        var link = this.value;
        window.location = "/history/" + link;
    };
     playerdropdown.onchange = function(){
        var link = this.value;
        window.location = "/portfolio/" + link;
    };

};

