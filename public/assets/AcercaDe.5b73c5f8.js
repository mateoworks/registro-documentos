import{Q as f,a as u}from"./QCard.9550f461.js";import{_ as h,x as y,y as v,q as r,z as g,t as a,d as s,A as e,u as x,s as p,B as n,ap as b,C as Q,D as S}from"./index.16fafb50.js";import{Q as k}from"./QChip.fc1367d4.js";import{Q as z}from"./QPage.bd9db12d.js";import{Q as C,a as I}from"./QLayout.e9b31ca3.js";import{u as q}from"./use-quasar.7f5a756d.js";import"./use-dark.fd3c0586.js";import"./QResizeObserver.100b10e6.js";const o=t=>(Q("data-v-3642ff98"),t=t(),S(),t),A={class:"alto flex justify-between items-center"},B=o(()=>e("div",{class:"logo"},[e("div",{class:"fontsize-18 text-center text-weight-light titulo"}," DDEP - ITT ")],-1)),D={class:"menu"},E={key:0},w={key:1},P=o(()=>e("div",{class:"text-h6"},"Acerca de",-1)),N=o(()=>e("div",{class:"text-body1"}," Esta aplicaci\xF3n web de Residencias Profesionales es el resultado de un proyecto de tesis desarrollado por Hern\xE1ndez, quien se dedic\xF3 a crear una soluci\xF3n vers\xE1til que simplifica y potencia la gesti\xF3n de proyectos de residencias profesionales, tanto para estudiantes como para administradores. ",-1)),H=o(()=>e("div",{class:"text-body1"}," Para los estudiantes, representa una puerta de acceso al control de su progreso y proyectos, con la capacidad de rastrear el estado de sus residencias, acceder a documentos entregados y descargar formatos esenciales para la documentaci\xF3n. Esta herramienta proporciona una experiencia de usuario intuitiva y segura. ",-1)),L=o(()=>e("div",{class:"text-body1"}," Los administradores, por su parte, disfrutan de la posibilidad de validar y administrar documentos de manera eficiente, garantizando un proceso fluido y simplificado para todos los involucrados. La plataforma asegura la confidencialidad y seguridad de la informaci\xF3n. ",-1)),T=o(()=>e("div",{class:"text-body1"}," Esta aplicaci\xF3n est\xE1 dedicada a la misi\xF3n de unir esfuerzos, brindando un apoyo s\xF3lido a estudiantes y administradores para alcanzar el \xE9xito en las residencias profesionales. Se destaca por su accesibilidad y eficacia en la gesti\xF3n de proyectos educativos y profesionales. \xA1Bienvenidos a una herramienta que impulsa el \xE9xito de todos sus usuarios, desarrollada por Hern\xE1ndez como parte de su proyecto de tesis! ",-1)),V={class:"flex justify-end"},j=o(()=>e("img",{src:"https://cdn.quasar.dev/img/boy-avatar.png"},null,-1)),R={__name:"AcercaDe",setup(t){const _=q().localStorage.getItem("user"),c=JSON.parse(_+""),i=y(),m=()=>{const d=c.role;d.includes("admin")?i.push({name:"dashboard-home"}):d.includes("capturista")?i.push({name:"dashboard-home"}):d.includes("estudiante")?i.push({name:"dashboard-estudiante"}):i.push({name:"not-found"})};return(d,J)=>{const l=v("router-link");return r(),g(C,{class:"home-page"},{default:a(()=>[s(I,null,{default:a(()=>[s(z,{padding:""},{default:a(()=>[e("div",A,[B,e("div",D,[e("ul",null,[x(c)?(r(),p("li",E,[e("a",{onClick:m},"Entrar")])):(r(),p("li",w,[s(l,{to:{name:"login"}},{default:a(()=>[n("Inicio de Sesi\xF3n")]),_:1})])),e("li",null,[s(l,{to:{name:"home"}},{default:a(()=>[n("Inicio")]),_:1})])])])]),s(f,null,{default:a(()=>[s(u,null,{default:a(()=>[P]),_:1}),s(u,null,{default:a(()=>[N,H,L,T,e("div",V,[s(k,null,{default:a(()=>[s(b,null,{default:a(()=>[j]),_:1}),n(" Hern\xE1ndez ")]),_:1})])]),_:1})]),_:1})]),_:1})]),_:1})]),_:1})}}};var Y=h(R,[["__scopeId","data-v-3642ff98"]]);export{Y as default};
