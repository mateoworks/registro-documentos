import{v as w,r as y,x as q,u as r,q as i,z as p,s as v,d as s,t as l,A as e,aa as o,ab as z,F as T,ar as B,ap as V,B as F,Q as k}from"./index.16fafb50.js";import{a as b,Q as R}from"./QCard.9550f461.js";import{Q as I}from"./QPage.bd9db12d.js";import{Q as L}from"./QBtnGroup.8a143a29.js";import{Q as N}from"./QMarkupTable.c292dae4.js";import{Q as U}from"./QPagination.0ffb27c3.js";import{d as j}from"./documentosApi.d4af84c5.js";import{_ as D}from"./DialogEliminar.48da2dec.js";import{_ as M}from"./LoaderSpinner.196fa089.js";import{a as K,u as G}from"./useForzarEliminaci\xF3nRecurso.225e6ff9.js";import{u as H}from"./useRestaurarRecurso.c88508a3.js";import{u as S}from"./useQuery.esm.48506497.js";import{_ as J}from"./BreadcrumbNav.24a9f6cf.js";import{u as O}from"./usePerfil.b3feeda6.js";import"./use-dark.fd3c0586.js";import"./QInput.ec90feeb.js";import"./use-key-composition.749118dd.js";import"./uid.42677368.js";import"./focus-manager.05708ea9.js";import"./use-form.e491c393.js";import"./format.2bc25e5f.js";import"./axios.a596eead.js";import"./QCardActions.4c1c4976.js";import"./QDialog.82b87909.js";import"./use-prevent-scroll.175dc396.js";import"./focusout.5c99f0fb.js";import"./ClosePopup.159f4ab9.js";import"./useQueryClient.esm.ad4fb503.js";import"./utils.esm.429db25b.js";import"./useMutation.esm.3aac1ad5.js";import"./mutation.esm.54ea4acf.js";const W=()=>K("estudiantes-force-delete","estudiantes-trashed"),X=()=>H("/estudiantes-restore","estudiantes","estudiantes-trashed"),Y={key:1},Z=e("thead",null,[e("tr",null,[e("th",{class:"text-left"},"Estudiante"),e("th",{class:"text-left"},"Carrera"),e("th",{class:"text-left"},"Tel\xE9fono"),e("th",null,"Acci\xF3n")])],-1),ee={class:"text-left"},te={class:"flex items-center q-gutter-xs"},se=["src"],ae={class:"row"},oe={class:"row text-weight-medium"},re={class:"text-left"},le={class:"text-left"},ie={class:"q-mt-xs flex justify-end items-center q-gutter-md"},ne=w({__name:"TablaEstudianteEliminado",setup(A){const{eliminarRecurso:E}=W(),{restaurarRecurso:d}=X(),g=async x=>{const{data:_}=await j.get("/estudiantes-trashed",{params:{page:x.value,perPage:15,included:"carrera,user"}});return _},n=y(1);q();const c=y(!1),$=y(""),{isLoading:m,data:f}=S({queryKey:["estudiantes-trashed",n],queryFn:()=>g(n),keepPreviousData:!0,staleTime:1e3*60*60}),Q=x=>{c.value=!0,$.value=x};return(x,_)=>r(m)?(i(),p(M,{key:0})):r(f)?(i(),v("div",Y,[s(D,{modelValue:c.value,"onUpdate:modelValue":_[0]||(_[0]=t=>c.value=t),"recurso-id":$.value,onEliminar:r(E)},null,8,["modelValue","recurso-id","onEliminar"]),s(N,null,{default:l(()=>[Z,e("tbody",null,[(i(!0),v(T,null,B(r(f).data,t=>{var u,a;return i(),v("tr",{key:t.id},[e("td",ee,[e("div",te,[e("div",null,[(u=t.user)!=null&&u.url_foto?(i(),p(V,{key:0},{default:l(()=>{var h;return[e("img",{src:(h=t.user)==null?void 0:h.url_foto},null,8,se)]}),_:2},1024)):(i(),p(V,{key:1,color:"primary","text-color":"white"},{default:l(()=>[F(o(t.nombre.charAt(0))+o(t.apellidos.charAt(0)),1)]),_:2},1024))]),e("div",null,[e("div",ae,o(t.nombre)+" "+o(t.apellidos),1),e("div",oe,o(t.email),1)])])]),e("td",re,o((a=t.carrera)==null?void 0:a.nombre),1),e("td",le,o(t.telefono),1),e("td",null,[s(L,{push:""},{default:l(()=>[s(k,{size:"sm",color:"secondary",push:"",glossy:"",icon:"restore",onClick:h=>r(d)(t.id)},null,8,["onClick"]),s(k,{size:"sm",color:"negative",push:"",glossy:"",icon:"delete_forever",onClick:h=>Q(t.id)},null,8,["onClick"])]),_:2},1024)])])}),128))])]),_:1}),e("div",ie,[e("div",null,"Mostrando "+o(r(f).meta.to)+" de "+o(r(f).meta.total),1),s(U,{modelValue:n.value,"onUpdate:modelValue":_[1]||(_[1]=t=>n.value=t),max:r(f).meta.last_page,"max-pages":6,"direction-links":"",push:"",color:"teal","active-design":"push","active-color":"orange"},null,8,["modelValue","max"])])])):z("",!0)}}),ue=()=>G("/estudiantes","Se elimin\xF3 el estudiante"),de={key:1},ce=e("thead",null,[e("tr",null,[e("th",{class:"text-left"},"Estudiante"),e("th",{class:"text-left"},"Carrera"),e("th",{class:"text-left"},"Tel\xE9fono"),e("th",null,"Acci\xF3n")])],-1),me={class:"text-left"},_e={class:"flex items-center q-gutter-xs"},pe=["src"],fe={class:"row"},he={class:"row text-weight-medium"},ve={class:"text-left"},ge={class:"text-left"},xe={class:"q-mt-xs flex justify-end items-center q-gutter-md"},ye=w({__name:"TablaEstudiantePaginado",setup(A){const E=async t=>{const{data:u}=await j.get("/estudiantes",{params:{page:t.value,perPage:15,included:"carrera,user"}});return u},d=y(1),g=q(),n=y(!1),c=y(""),{isLoading:$,data:m}=S({queryKey:["estudiantes",d],queryFn:()=>E(d),keepPreviousData:!0,staleTime:1e3*60*60}),{eliminarRecurso:f}=ue(),Q=t=>{g.push({name:"ver-estudiante",params:{id:t}})},x=t=>{g.push({name:"editar-estudiante",params:{id:t}})},_=t=>{n.value=!0,c.value=t};return(t,u)=>r($)?(i(),p(M,{key:0})):r(m)?(i(),v("div",de,[s(D,{modelValue:n.value,"onUpdate:modelValue":u[0]||(u[0]=a=>n.value=a),"recurso-id":c.value,onEliminar:r(f)},null,8,["modelValue","recurso-id","onEliminar"]),s(N,null,{default:l(()=>[ce,e("tbody",null,[(i(!0),v(T,null,B(r(m).data,a=>{var h,P;return i(),v("tr",{key:a.id},[e("td",me,[e("div",_e,[e("div",null,[(h=a.user)!=null&&h.url_foto?(i(),p(V,{key:0},{default:l(()=>{var C;return[e("img",{src:(C=a.user)==null?void 0:C.url_foto},null,8,pe)]}),_:2},1024)):(i(),p(V,{key:1,color:"primary","text-color":"white"},{default:l(()=>[F(o(a.nombre.charAt(0))+o(a.apellidos.charAt(0)),1)]),_:2},1024))]),e("div",null,[e("div",fe,o(a.nombre)+" "+o(a.apellidos),1),e("div",he,o(a.email),1)])])]),e("td",ve,o((P=a.carrera)==null?void 0:P.nombre),1),e("td",ge,o(a.telefono),1),e("td",null,[s(L,{push:""},{default:l(()=>[s(k,{size:"sm",color:"info",push:"",glossy:"",icon:"visibility",onClick:C=>Q(a.id)},null,8,["onClick"]),s(k,{size:"sm",color:"secondary",push:"",glossy:"",icon:"edit",onClick:C=>x(a.id)},null,8,["onClick"]),s(k,{size:"sm",color:"negative",push:"",glossy:"",icon:"delete",onClick:C=>_(a.id)},null,8,["onClick"])]),_:2},1024)])])}),128))])]),_:1}),e("div",xe,[e("div",null,"Mostrando "+o(r(m).meta.to)+" de "+o(r(m).meta.total),1),s(U,{modelValue:d.value,"onUpdate:modelValue":u[1]||(u[1]=a=>d.value=a),max:r(m).meta.last_page,"max-pages":6,"direction-links":"",push:"",color:"teal","active-design":"push","active-color":"orange"},null,8,["modelValue","max"])])])):z("",!0)}}),ke={class:"flex justify-between items-center"},Ee=e("div",{class:"fontsize-15 text-weight-light"},"Estudiantes",-1),$e={key:0},tt=w({__name:"ListarEstudiante",setup(A){const E=q(),d=()=>{E.push({name:"crear-estudiante"})},{user:g,isLoading:n}=O(),c=[{label:"Estudiantes",icon:"school"}];return($,m)=>(i(),p(I,{padding:""},{default:l(()=>[s(J,{pages:c,titlePage:"Lista de estudiantes"}),s(R,null,{default:l(()=>[s(b,null,{default:l(()=>[e("div",ke,[Ee,s(k,{label:"Nuevo",icon:"add_circle_outline",color:"secondary",size:"md",padding:"xs",onClick:d})])]),_:1}),s(b,null,{default:l(()=>[s(ye)]),_:1})]),_:1}),r(n)?(i(),v("div",$e,"Cargando ---")):r(g).roles[0].name==="admin"?(i(),p(R,{key:1,class:"q-mt-md"},{default:l(()=>[s(b,null,{default:l(()=>[F(" Estudiantes eliminados ")]),_:1}),s(b,null,{default:l(()=>[s(ne)]),_:1})]),_:1})):z("",!0)]),_:1}))}});export{tt as default};