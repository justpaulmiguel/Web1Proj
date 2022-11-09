function sidebar1()
{
    var sideBarToggle = document.getElementById("sideNav");
    if(sideBarToggle.style.width=="0px")
    {
        sideBarToggle.style.width="250px";
        sideBarToggle.style.paddingRight="5em";
        sideBarToggle.style.paddingLeft="1em"
    }
    else
    {
        sideBarToggle.style.paddingRight="0em";
        sideBarToggle.style.paddingLeft="0em";
        sideBarToggle.style.width="0px";
    }
}
function sidebarf2()
{
    var sideBarToggle = document.getElementById("sideNav");
    if(sideBarToggle.style.width=="250px")
    {
        sideBarToggle.style.paddingRight="0em";
        sideBarToggle.style.paddingLeft="0em";
        sideBarToggle.style.width="0px";
    }
}