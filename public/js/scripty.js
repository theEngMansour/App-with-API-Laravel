/* panal */
function toggle_visibility(id) {
var e = document.getElementById(id);
if (e.style.display == 'none' || e.style.display=='') e.style.display = 'block';
else e.style.display = 'none';
var ee = document.getElementById(id);
/* Name id : Idpanal */
if (id=='Idpanal') document.getElementById('login').style.display = 'none';
if (id=='login') document.getElementById('Idpanal').style.display = 'none';


}
function toggle_visibility2(id) {
var e = document.getElementById(id);
if (e.style.display == 'none' || e.style.display=='') {
e.style.display = 'flex';
e.style.top = '60px';


}
else {e.style.display = 'none';}
}

function toggle_visibility3() {
var bg = document.getElementById("box_bg");
var box = document.getElementById("box_container");
if (bg.style.display == 'none' || bg.style.display=='') {
bg.style.display = 'block';
box.style.display = 'block';
bg.style.opacity = '.7';


}
else {
bg.style.display = 'none';
box.style.display = 'none';

}
}

/* مكان الذي بيظهر فية */
{/* <div id="Idpanal"  class="dropdown-menu dropdown-menu-right p-0">
    
</div> */}
/* مكان الذي بيظهر فية */

/* الزر */
{/* <a onclick="toggle_visibility('multibrands')"></a>
   
</a> */}
/* الزر */
/* END-panal */