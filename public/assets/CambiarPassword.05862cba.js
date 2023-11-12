import{a as h,Q as C}from"./QCard.9550f461.js";import{Q as P}from"./QBanner.f76ac382.js";import{Q as w}from"./QInput.ec90feeb.js";import{x as q,r as V,aU as x,aV as f,v as S,c as z,q as p,z as b,t as o,A as s,d as r,B as c,ac as B,u as g,aa as y,s as F,ar as E,F as L,ab as D,Q as N}from"./index.16fafb50.js";import{Q as k}from"./QForm.5f43623c.js";import{Q as U}from"./QPage.bd9db12d.js";import{g as A}from"./errorUtils.9be85d5d.js";import{d as M}from"./documentosApi.d4af84c5.js";import{u as T}from"./useMutation.esm.3aac1ad5.js";import"./use-dark.fd3c0586.js";import"./use-key-composition.749118dd.js";import"./uid.42677368.js";import"./focus-manager.05708ea9.js";import"./use-form.e491c393.js";import"./axios.a596eead.js";import"./utils.esm.429db25b.js";import"./useQueryClient.esm.ad4fb503.js";import"./mutation.esm.54ea4acf.js";const I=async l=>{try{f.show({delay:500,message:"Actualizando..."}),l.append("_method","PUT");const{data:a}=await M.post("editar-password",l,{headers:{"Content-Type":"multipart/form-data"}});return f.hide(),a}catch(a){throw f.hide(),a}},R=()=>{const l=q(),a=V(null),{mutate:m,isLoading:_,error:i}=T(I,{onSuccess:()=>{x.create({message:"Se actualiz\xF3 la contrase\xF1a",color:"positive",position:"top-right",type:"positive"}),l.push({name:"perfil-estudiante"})},onError:t=>{var u;x.create({message:t+"",color:"negative",position:"top-right",type:"negative"}),t.response?a.value=(u=t.response)==null?void 0:u.data:a.value=t}});return{actalizarPassword:m,isLoadingPassword:_,errorPassword:i,errorServer:a}},j={class:"row"},G={class:"col-md-8 col-sm-10 col-xs-12 q-pa-lg"},H={class:"row q-col-gutter-md"},J={class:"col-12"},K={class:"col-xs-12 col-sm-6"},O=s("span",{class:"required-star"},"*",-1),W={class:"col-xs-12 col-sm-6"},X=s("span",{class:"required-star"},"*",-1),Y={class:"col-xs-12 col-sm-6"},Z=s("span",{class:"required-star"},"*",-1),$={class:"col-xs-12 col-sm-7"},ve=S({__name:"CambiarPassword",setup(l){const a=V({current_password:"",password:"",password_confirmation:""}),{actalizarPassword:m,isLoadingPassword:_,errorServer:i}=R(),t=i.value,u=z(()=>A(i.value)),Q=()=>{const d=new FormData;d.append("current_password",a.value.current_password),d.append("password",a.value.password),d.append("password_confirmation",a.value.password_confirmation),m(d)};return(d,n)=>(p(),b(U,{padding:""},{default:o(()=>[s("div",j,[s("div",G,[r(C,null,{default:o(()=>[r(h,null,{default:o(()=>[c(" Cambiar contrase\xF1a ")]),_:1}),r(h,null,{default:o(()=>[r(k,{onSubmit:B(Q,["prevent"])},{default:o(()=>[s("div",H,[s("div",J,[g(i)?(p(),b(P,{key:0,"inline-actions":"",class:"text-white bg-red"},{default:o(()=>{var e;return[c(y(((e=g(t))==null?void 0:e.message)||"")+" ",1),s("ul",null,[(p(!0),F(L,null,E(u.value,v=>(p(),F("li",{key:v},y(v),1))),128))])]}),_:1})):D("",!0)])]),s("div",K,[r(w,{modelValue:a.value.current_password,"onUpdate:modelValue":n[0]||(n[0]=e=>a.value.current_password=e),"label-slot":"",rules:[e=>!!e||"La contrase\xF1a actual es requerida",e=>e.length>3&&e.length<255||"Debe tener m\xE1s de 3 caracteres y menos de 255"],type:"password"},{label:o(()=>[c(" Contrase\xF1a actual "),O]),_:1},8,["modelValue","rules"])]),s("div",W,[r(w,{modelValue:a.value.password,"onUpdate:modelValue":n[1]||(n[1]=e=>a.value.password=e),"label-slot":"",rules:[e=>!!e||"La nueva contrase\xF1a es requerida",e=>e.length>5&&e.length<255||"Debe tener m\xE1s de 5 caracteres y menos de 255"],type:"password"},{label:o(()=>[c(" Nueva contrase\xF1a "),X]),_:1},8,["modelValue","rules"])]),s("div",Y,[r(w,{modelValue:a.value.password_confirmation,"onUpdate:modelValue":n[2]||(n[2]=e=>a.value.password_confirmation=e),"label-slot":"",rules:[e=>!!e||"La confirmaci\xF3n de contrase\xF1a es requerida",e=>e.length>5&&e.length<255||"Debe tener m\xE1s de 5 caracteres y menos de 255"],type:"password"},{label:o(()=>[c(" Confirmar contrase\xF1a "),Z]),_:1},8,["modelValue","rules"])]),s("div",$,[r(N,{label:"Cambiar contrase\xF1a",color:"primary",type:"submit",loading:g(_)},null,8,["loading"])])]),_:1},8,["onSubmit"])]),_:1})]),_:1})])])]),_:1}))}});export{ve as default};
