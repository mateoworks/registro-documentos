import{v as C,y as R,u as n,q as r,z as c,t,ab as L,_ as G,A as a,d as e,ap as V,aa as f,aq as A,s as b,F as w,ar as k,as as y,ao as g,B as Q,at as q,C as E,D as U,x as T,Q as D,r as S,au as K,a2 as M,av as j}from"./index.16fafb50.js";import{Q as H,u as O,a as W,b as J,c as B,_ as X,d as Y,e as Z}from"./useLogout.160d9a9a.js";import{Q as ee}from"./QInput.ec90feeb.js";import{Q as te,a as ae}from"./QLayout.e9b31ca3.js";import{u as se}from"./use-quasar.7f5a756d.js";import{Q as $,a as x}from"./QItem.98cb2d4c.js";import{Q as I}from"./QItemLabel.bb4f8a3f.js";import{Q as N}from"./QSeparator.c2a03803.js";import{Q as oe}from"./QList.747496ef.js";import{Q as re}from"./QImg.f997db3b.js";import{_ as F}from"./LoaderSpinner.196fa089.js";import{u as P}from"./usePerfil.b3feeda6.js";import{Q as ne}from"./QMenu.ab6378a2.js";import{C as ie}from"./ClosePopup.159f4ab9.js";import"./QResizeObserver.100b10e6.js";import"./use-prevent-scroll.175dc396.js";import"./focusout.5c99f0fb.js";import"./focus-manager.05708ea9.js";import"./use-dark.fd3c0586.js";import"./TouchPan.e467a571.js";import"./touch.3df10340.js";import"./selection.fb3d903a.js";import"./format.2bc25e5f.js";import"./QToggle.31e3c23d.js";import"./use-checkbox.abf6af25.js";import"./use-form.e491c393.js";import"./documentosApi.d4af84c5.js";import"./axios.a596eead.js";import"./useQueryClient.esm.ad4fb503.js";import"./utils.esm.429db25b.js";import"./use-key-composition.749118dd.js";import"./uid.42677368.js";import"./useQuery.esm.48506497.js";const le={class:"absolute-bottom bg-transparent"},ce=["src"],ue={class:"text-weight-bold shadow"},_e={class:"shadow"},de=C({__name:"CabeceraDrawer",setup(m){const{user:s,isLoading:i}=P();return(p,u)=>{var _;const l=R("RouterLink");return n(i)?(r(),c(F,{key:0})):n(s)?(r(),c(re,{key:1,class:"absolute-top",src:(_=n(s))==null?void 0:_.url_portada,style:{height:"150px"}},{default:t(()=>[a("div",le,[e(V,{size:"56px",class:"q-mb-sm"},{default:t(()=>{var d;return[a("img",{src:(d=n(s))==null?void 0:d.url_foto},null,8,ce)]}),_:1}),e(l,{to:{name:"perfil-admin"}},{default:t(()=>[a("div",ue,f(n(s).name),1),a("div",_e,f(n(s).email),1)]),_:1})])]),_:1},8,["src"])):L("",!0)}}});var me=G(de,[["__scopeId","data-v-523386b6"]]);const pe=m=>(E("data-v-6fd6c9a8"),m=m(),U(),m),fe=pe(()=>a("div",{class:"q-mt-md"},[a("div",{class:"flex flex-center q-gutter-xs"},[a("a",{class:"GNL__drawer-footer-link",href:"javascript:void(0)","aria-label":"Privacidad"},"Privacidad"),a("span",null," \xB7 "),a("a",{class:"GNL__drawer-footer-link",href:"javascript:void(0)","aria-label":"Terminos"},"Terminos")])],-1)),ve=C({__name:"DrawerDashboard",setup(m){const s=A(),i=[{icon:"analytics",text:"Dashboard",to:"dashboard-home"},{icon:"assignment_turned_in",text:"Entregas",to:"listar-entrega"},{icon:"people",text:"Usuarios",to:"listar-usuario"},{icon:"history_edu",text:"Residentes",to:"listar-residente"},{icon:"school",text:"Estudiantes",to:"listar-estudiante"}],p=[{icon:"domain",text:"Empresas",to:"listar-empresa"},{icon:"date_range",text:"Periodos",to:"listar-periodo"},{icon:"description",text:"Documentos",to:"listar-documento"},{icon:"local_library",text:"Carreras",to:"listar-carrera"},{icon:"account_balance",text:"Departamentos",to:"listar-departamento"}],u=[{icon:"",text:"Configuraci\xF3n"}],l=_=>{var d;return s.name===_||(((d=s.name)==null?void 0:d.toString())+"").startsWith(_)};return(_,d)=>(r(),b(w,null,[e(H,{style:{height:"calc(100% - 150px)","margin-top":"150px","border-right":"1px solid #ddd"}},{default:t(()=>[e(oe,{padding:""},{default:t(()=>[(r(),b(w,null,k(i,o=>y(e($,{class:"GNL__drawer-item",key:o.text,clickable:"",to:{name:o.to},active:l(o.to)},{default:t(()=>[e(x,{avatar:""},{default:t(()=>[e(g,{name:o.icon,class:"icon-color"},null,8,["name"])]),_:2},1024),e(x,null,{default:t(()=>[e(I,null,{default:t(()=>[Q(f(o.text),1)]),_:2},1024)]),_:2},1024)]),_:2},1032,["to","active"]),[[q]])),64)),e(N,{inset:"",class:"q-my-sm"}),(r(),b(w,null,k(p,o=>y(e($,{class:"GNL__drawer-item",key:o.text,clickable:"",to:{name:o.to},active:l(o.to)},{default:t(()=>[e(x,{avatar:""},{default:t(()=>[e(g,{name:o.icon,class:"icon-color"},null,8,["name"])]),_:2},1024),e(x,null,{default:t(()=>[e(I,null,{default:t(()=>[Q(f(o.text),1)]),_:2},1024)]),_:2},1024)]),_:2},1032,["to","active"]),[[q]])),64)),e(N,{inset:"",class:"q-my-sm"}),(r(),b(w,null,k(u,o=>y(e($,{class:"GNL__drawer-item",key:o.text,clickable:""},{default:t(()=>[e(x,null,{default:t(()=>[e(I,null,{default:t(()=>[Q(f(o.text)+" ",1),o.icon?(r(),c(g,{key:0,color:"primary",name:o.icon},null,8,["name"])):L("",!0)]),_:2},1024)]),_:2},1024)]),_:2},1024),[[q]])),64)),fe]),_:1})]),_:1}),e(me)],64))}});var he=G(ve,[["__scopeId","data-v-6fd6c9a8"]]);const xe={key:1,class:"row no-wrap q-pa-md"},be={class:"column"},ge=a("div",{class:"text-h6 q-mb-md"},"Configuraci\xF3n",-1),we={class:"text-subtitle1"},ye={class:"text-center q-mt-xs"},Qe={class:"column items-center"},De=["src"],Ce={class:"text-subtitle1 q-mt-md q-mb-xs"},Le=C({__name:"MenuUser",setup(m){const s=T(),{logout:i}=O(),p=()=>{s.push({name:"perfil-admin"})},{user:u,isLoading:l}=P();return(_,d)=>(r(),c(ne,null,{default:t(()=>[n(l)?(r(),c(F,{key:0})):n(u)?(r(),b("div",xe,[a("div",be,[ge,a("div",null,[Q(" Rol: "),a("span",we,f(n(u).roles[0].name||""),1)]),a("div",ye,[e(D,{label:"Perfil",color:"accent",onClick:p})])]),e(N,{vertical:"",inset:"",class:"q-mx-lg"}),a("div",Qe,[e(V,{size:"72px"},{default:t(()=>[a("img",{src:n(u).url_foto},null,8,De)]),_:1}),a("div",Ce,f(n(u).name),1),y(e(D,{color:"primary",label:"Cerrar sesi\xF3n",push:"",size:"sm",onClick:n(i)},null,8,["onClick"]),[[ie]])])])):L("",!0)]),_:1}))}}),ke=["src"],qe=C({__name:"AvatarUsuario",setup(m){const{user:s,isLoading:i}=P();return(p,u)=>(r(),c(D,{round:"",flat:"",loading:n(i)},{default:t(()=>[e(V,{size:"30px"},{default:t(()=>{var l;return[a("img",{src:(l=n(s))==null?void 0:l.url_foto},null,8,ke)]}),_:1}),e(Le)]),_:1},8,["loading"]))}});const $e=a("img",{src:"/src/assets/logo-180x180.png",width:"45"},null,-1),Ie=a("span",{class:"q-ml-sm"},"DDEP",-1),Ne={class:"q-gutter-sm row items-center no-wrap"},_t={__name:"DashboardLayout",setup(m){const s=S(!1),i=S(""),p=se();function u(){s.value=!s.value}const l=T(),_=()=>{l.push({name:"buscar",query:{q:i.value}})},d=()=>{l.push("/")};return(o,v)=>{const z=R("router-view");return r(),c(te,{view:"hHh LpR fFf"},{default:t(()=>[e(Y,{elevated:"",class:"bg-primary text-white","height-hint":"64"},{default:t(()=>[e(W,{class:"GNL__toolbar"},{default:t(()=>[e(D,{flat:"",dense:"",round:"",onClick:u,"aria-label":"Menu",icon:"menu",class:"q-mr-sm"}),n(p).screen.gt.xs?(r(),c(J,{key:0,shrink:"",class:"row items-center no-wrap inicio",onClick:d},{default:t(()=>[$e,Ie]),_:1})):L("",!0),e(B),e(ee,{class:"GNL__toolbar-input color-input",outlined:"",dense:"",modelValue:i.value,"onUpdate:modelValue":v[1]||(v[1]=h=>i.value=h),placeholder:"Buscar estudiante",onKeydown:K(_,["enter"]),color:"white","label-color":"white"},{prepend:t(()=>[i.value===""?(r(),c(g,{key:0,name:"search"})):(r(),c(g,{key:1,name:"clear",class:"cursor-pointer",onClick:v[0]||(v[0]=h=>i.value="")}))]),_:1},8,["modelValue","onKeydown"]),e(B),a("div",Ne,[e(X),e(qe)])]),_:1})]),_:1}),e(Z,{modelValue:s.value,"onUpdate:modelValue":v[2]||(v[2]=h=>s.value=h),"show-if-above":"",bordered:"",width:280},{default:t(()=>[e(he)]),_:1},8,["modelValue"]),e(ae,null,{default:t(()=>[e(z,null,{default:t(({Component:h})=>[e(M,{name:"route",mode:"out-in"},{default:t(()=>[(r(),c(j(h)))]),_:2},1024)]),_:1})]),_:1})]),_:1})}}};export{_t as default};
