import{Q as S,a as g}from"./QCard.9550f461.js";import{Q as q}from"./QBanner.f76ac382.js";import{Q as p}from"./QInput.ec90feeb.js";import{v as E,aM as v,r as V,c as N,q as m,z as Q,t as o,d as l,A as t,B as u,aa as x,u as U,s as h,ar as I,F as M,ab as P,ao as _,as as j,Q as y,ac as f}from"./index.16fafb50.js";import{Q as z}from"./QDate.75e05ac0.js";import{Q as A}from"./QPopupProxy.2db034ac.js";import{Q as L}from"./QFile.0d542f19.js";import{Q as G}from"./QForm.5f43623c.js";import{C as R}from"./ClosePopup.159f4ab9.js";import{g as T}from"./errorUtils.9be85d5d.js";const $=t("div",{class:"fontsize-15 text-weight-light"},"Introduce los datos",-1),H={class:"row q-col-gutter-md"},J={class:"col-12"},K={class:"col-xs-12 col-sm-6"},O=t("span",{class:"required-star"},"*",-1),W={class:"col-xs-12 col-sm-6"},X={class:"col-xs-12 col-sm-6"},Y=t("span",{class:"required-star"},"*",-1),Z={class:"row items-center justify-end"},ee={class:"col-xs-12 col-sm-6"},oe={class:"col-xs-12 col-sm-7"},ce=E({__name:"FormDocumento",props:{documento:{},loading:{type:Boolean},errorServer:{}},emits:["guardar"],setup(C,{emit:w}){const i=C,s=v(i,"documento"),D=v(i,"loading"),c=v(i,"errorServer"),F=c.value,n=V(null),d=V(s.value.fecha_limite+""),k=()=>{const r=new FormData;r.append("id",s.value.id+""),r.append("nombre_documento",s.value.nombre_documento),r.append("abrev_nombre",s.value.abrev_nombre+""),r.append("fecha_limite",d.value),n.value&&r.append("url_formato",n.value[0]),w("guardar",r)},B=N(()=>T(c.value));return(r,a)=>(m(),Q(S,null,{default:o(()=>[l(g,null,{default:o(()=>[$]),_:1}),l(G,{onSubmit:f(k,["prevent"])},{default:o(()=>[l(g,null,{default:o(()=>[t("div",H,[t("div",J,[c.value?(m(),Q(q,{key:0,"inline-actions":"",class:"text-white bg-red"},{default:o(()=>{var e;return[u(x(((e=U(F))==null?void 0:e.message)||"")+" ",1),t("ul",null,[(m(!0),h(M,null,I(B.value,b=>(m(),h("li",{key:b},x(b),1))),128))])]}),_:1})):P("",!0)]),t("div",K,[l(p,{modelValue:s.value.nombre_documento,"onUpdate:modelValue":a[0]||(a[0]=e=>s.value.nombre_documento=e),"label-slot":"",rules:[e=>!!e||"El nombre del documento es requerido",e=>e.length>3&&e.length<255||"Debe tener m\xE1s de 3 caracteres y menos de 255"]},{label:o(()=>[u(" Nombre del documento "),O]),_:1},8,["modelValue","rules"])]),t("div",W,[l(p,{modelValue:s.value.abrev_nombre,"onUpdate:modelValue":a[1]||(a[1]=e=>s.value.abrev_nombre=e),"label-slot":"",rules:[e=>e.length<255||"Debe tener m\xE1s de 3 caracteres y menos de 255"]},{label:o(()=>[u(" Abreviaci\xF3n del nombre del documento ")]),_:1},8,["modelValue","rules"])]),t("div",X,[l(p,{modelValue:d.value,"onUpdate:modelValue":a[3]||(a[3]=e=>d.value=e),mask:"date",rules:[e=>!!e||"La fecha es requerida"],"label-slot":""},{label:o(()=>[u(" Fecha l\xEDmite de entrega "),Y]),append:o(()=>[l(_,{name:"event",class:"cursor-pointer"},{default:o(()=>[l(A,{cover:"","transition-show":"scale","transition-hide":"scale"},{default:o(()=>[l(z,{modelValue:d.value,"onUpdate:modelValue":a[2]||(a[2]=e=>d.value=e)},{default:o(()=>[t("div",Z,[j(l(y,{label:"Close",color:"primary",flat:""},null,512),[[R]])])]),_:1},8,["modelValue"])]),_:1})]),_:1})]),_:1},8,["modelValue","rules"])]),t("div",ee,[l(L,{"bottom-slots":"",modelValue:n.value,"onUpdate:modelValue":a[6]||(a[6]=e=>n.value=e),"label-slot":"",counter:"",multiple:"",accept:".jpg, image/*, .doc, .docx, .pdf"},{label:o(()=>[u(" Formato del documento: ")]),prepend:o(()=>[l(_,{name:"cloud_upload",onClick:a[4]||(a[4]=f(()=>{},["stop","prevent"]))})]),append:o(()=>[l(_,{name:"close",onClick:a[5]||(a[5]=f(e=>n.value=null,["stop","prevent"])),class:"cursor-pointer"})]),_:1},8,["modelValue"])]),t("div",oe,[l(y,{label:"Guardar",color:"primary",type:"submit",loading:D.value},null,8,["loading"])])])]),_:1})]),_:1},8,["onSubmit"])]),_:1}))}});export{ce as _};
