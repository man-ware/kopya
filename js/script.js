var sideBarIsOpen = true;

toggleBtn.addEventListener( 'click',  (event) => {
    event.preventDefault();

    if(sideBarIsOpen){
        dashboard_sidebar.style.width = '10%';
        dashboard_sidebar.style.delay = '2s all';
        dashboard_content_container.style.width = '90%';
        dashboard_logo.style.fontSize = '60px';
        userImage.style.fontSize = '60px';
        userImage.style = '60px';
        userRole.style.display = 'none';
        userImage.style.width = '25%';

        menuIcons = document.getElementsByClassName('menuText');
        for(var i=0; i < menuIcons.length;i++){
            menuIcons[i].style.display = 'none' ;
        }

        document.getElementsByClassName('dashboard_menu_lists')[0].style.textAlign = 'center';

    sideBarIsOpen = false;
}

    else {
        dashboard_sidebar.style.width = '20%';
        dashboard_content_container.style.width = '80%';
        dashboard_logo.style.fontSize = '80px';
        userImage.style.fontSize = '80px';
        userRole.style.display = 'inline-block';
        userImage.style.width = '20%';
        
        menuIcons = document.getElementsByClassName('menuText');
        for(var i=0; i < menuIcons.length;i++){
            menuIcons[i].style.display = 'inline-block' ;
        }

        document.getElementsByClassName('dashboard_menu_lists')[0].style.textAlign = 'left';

    sideBarIsOpen = true;
}
    
});

//submenu show hide
document.addEventListener('click', function(e){
    let clickedE1 = e.target;

    if(clickedE1.classList.contains('showHideSubMenu')){
        
        let subMenu = clickedE1.closest('li').querySelector('.subMenus');
        let mainMenuIcon = clickedE1.closest('li').querySelector('.mainMenuIconArrow');

        let subMenus = document.querySelectorAll('.subMenus');
        subMenus.forEach((sub) => {
            if (subMenu !== sub) sub.style.display = 'none';
        });

        showHideSubMenu(subMenu,mainMenuIcon);

    }
});

function showHideSubMenu(subMenu,mainMenuIcon){
    if(subMenu != null){
        if (subMenu.style.display === 'block'){
            subMenu.style.display = 'none';
            mainMenuIcon.classList.remove('fa-angle-up');
            mainMenuIcon.classList.add('fa-angle-down');
        } else {
            subMenu.style.display = 'block'
            mainMenuIcon.classList.remove('fa-angle-down');
            mainMenuIcon.classList.add('fa-angle-up');
        };
    }
}

let pathArray = window.location.pathname.split('/');
let curFile = pathArray[pathArray.length - 1];

let curNav = document.querySelector('a[href="./'+ curFile +'"]');
curNav.classList.add('subMenuActive');

let mainNav = curNav.closest('li.liMainMenu');
mainNav.style.background = '#5094dc';

let subMenu = curNav.closest('.subMenus');
let mainMenuIcon = mainNav.querySelector('i.mainMenuIconArrow');

showHideSubMenu(subMenu,mainMenuIcon);

//pos date
function showClock(){
    let dateObj = new Date;
    let months = ['January','February','March','April','May','June','July','August','September','October','November','December'];

    let year = dateObj.getFullYear();
    let monthNum = dateObj.getMonth();
    let dateCal = dateObj.getDate();
    let hour = dateObj.getHours();
    let min = dateObj.getMinutes();
    let sec = dateObj.getSeconds();

    let timeFormatted = toTwelveHourFormat(hour);

    document.querySelector('.timeAndDate').innerHTML = months[monthNum] + ' ' + dateCal +', ' + year + '    ' + timeFormatted['time'] + ':' + min + ':' + sec + ' ' + timeFormatted['am_pm'];

    setInterval(showClock,1000);
}

function toTwelveHourFormat(time){
    let am_pm = 'AM'
    if(time > 12){
        time = time - 12;
        am_pm = 'PM';
    } 

    return{
        time: time,
        am_pm: am_pm
    };
}

showClock();