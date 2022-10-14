var menu_items = new Array(4)
var selected_menu_item;
var spinner;
var op
var rot;
var a,b,c;


window.onload = ()=>{
  
  document.msg_simp.addEventListener("submit",()=>{
    with(document.msg_simp){
      let btn = msg_simp.msg
      btn.value = ""
      
      btn.style.boxShadow="inset 2px 3px 10px black"
      
      
      btn.style.width= "50px"
      btn.style.height = "50px"
      btn.style.marginLeft="30%"
      btn.style.borderRadius="50%"
      btn.setAttribute("class","spinner-border")
    }
  })
  
  document.msg_com.addEventListener("submit",()=>{
    with(document.msg_com){
      let btn = msg_com.sent_o
      btn.value = ""
      
      btn.style.color="green"
      btn.style.boxShadow="inset 2px 3px 5px black"
      btn.style.width= "50px"
      btn.style.height = "50px"
      btn.style.marginLeft="40%"
      btn.style.borderRadius="50%"
      btn.setAttribute("class","spinner-border")
    }
  })
  
  setInterval(c_border,1000)
  
  op = 0;
  rot = 10

  var f = document.getElementById("first_")
  var s = document.getElementById("second_")
  f.removeAttribute("hidden")
  s.removeAttribute("hidden")
 
 a = setInterval(()=>{
    
    dis_first(f)
  },30)
  b = setInterval(()=>{
    
    dis_second(s)
  },30)
  c = setInterval(()=>{
    
    dis_logo(document.getElementById("logo"))
  },3000)

  spinner = document.getElementById("spinner")
  menu_items = 
  [
    document.getElementById("home"),
    document.getElementById("orcar"),
    document.getElementById("pro"),
    document.getElementById("contact")
  ]
  selected_menu_item = menu_items[0]
  display_form(0)
  
   menu_items[0].onclick = ()=>{
      display_form(0)
    }
  
    menu_items[1].onclick = ()=>{
      display_form(1)
    }
    menu_items[2].onclick = ()=>{
      display_form(2)
    }
    menu_items[3].onclick = ()=>{
      display_form(3)
    }
    
    /*for(var c = 0; c < menu_items.length; c++){
      menu_items[c].onclick = ()=>{
        display_form(c)
      }
    }*/
}


function display_form(index)
{
  spinner.style.display="block"
  
  
  selected_menu_item.style.backgroundColor="inherit"
  selected_menu_item.style.color="inherit"
  selected_menu_item.style.boxShadow="none"
  document.getElementById(`f-${selected_menu_item.id}`).style.display="none"
  
  selected_menu_item = menu_items[index]
  
  selected_menu_item.style.backgroundColor="teal"
  selected_menu_item.style.color="white"
  selected_menu_item.style.boxShadow="inset 10px 10px 10px rgb(0,0,0,0.378)"
  setTimeout(()=>
  {
    document.getElementById(`f-${selected_menu_item.id}`).style.display="block"
    spinner.style.display="none"
  },1500);
}

function dis_first(el){
  op++
  if(op == 100){
    clearInterval(a)
  }
  el.style.opacity=`${op}%`
}

function dis_second(el){
  
  if(op == 100){
    clearInterval(b)
  }
  el.style.opacity=`${op}%`
}

function dis_logo(el){
  
  if(op == 100){
    //clearInterval(c)
    setTimeout(()=>{
      el.style.color = "lightgreen"
      setTimeout(()=>{
        el.style.color = "darkgreen"
        setTimeout(()=>{
          el.style.color = "green"
          setTimeout(()=>{
            el.style.color = "lightgreen"
          },1000)
          },500)
      },2000)
    },500)
  }
  el.style.opacity=`${op}%`
}

function c_border(){
  rot += 10
  if(rot == 360){
    rot = 10;
  }
  var r = Math.round(Math.random()*255)
  var g = Math.round(Math.random()*255)
  var b = Math.round(Math.random()*255)
  var shadow = Math.random()*0.7
  
  document.getElementById("me").style.border=`5px double rgb(${r},${g},${b})`
  //document.getElementById("me").style.transform=`rotate(${rot}deg)`
  document.getElementById("i-pessoal").children[0].children[2].style.textShadow=`1px 1px 3px rgb(0,0,0,${shadow})`

  document.getElementById("i-pessoal").children[0].children[4].style.textShadow=`1px 1px 3px rgb(0,0,0,${shadow})`
  
}
