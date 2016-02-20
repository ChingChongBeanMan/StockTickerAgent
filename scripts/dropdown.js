var historydropdown; 
var playerdropdwon;
window.onload = function() {
    historydropdown = document.getElementById('historydropdown');
    playerdropdown = document.getElementById('playerdropdown');
 
    if(historydropdown != null){
    historydropdown.onchange = function(){
        var link = this.value;
        window.location = "/history/" + link;
    };
    }
    if(playerdropdown != null){
     playerdropdown.onchange = function(){
        var link = this.value;
        window.location = "/portfolio/" + link;
    };
    }
};

