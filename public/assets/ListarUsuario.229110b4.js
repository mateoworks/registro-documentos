import{v as $,x as S,r as _,q as f,s as g,d as e,u as n,t as o,B as v,aa as k,Q as c,A as V,z as F,ab as A}from"./index.16fafb50.js";import{a as C,Q as B}from"./QCard.9550f461.js";import{Q as L}from"./QPage.bd9db12d.js";import{_ as M}from"./BreadcrumbNav.24a9f6cf.js";import{g as I}from"./getUser.66bacbda.js";import{Q as T,a as N,b as t,c as D,d as P}from"./QTooltip.c51851d1.js";import{Q as j}from"./QBtnGroup.8a143a29.js";import{u as G}from"./useRecursosMultiples.fa0015da.js";import{_ as R}from"./DialogEliminar.48da2dec.js";import{u as O,a as H}from"./useForzarEliminaci\xF3nRecurso.225e6ff9.js";import{u as J}from"./useRecursosEliminados.dcfd38af.js";import{u as K}from"./useRestaurarRecurso.c88508a3.js";import"./use-dark.fd3c0586.js";import"./QSeparator.c2a03803.js";import"./QList.747496ef.js";import"./QMarkupTable.c292dae4.js";import"./QSelect.3768a279.js";import"./use-key-composition.749118dd.js";import"./uid.42677368.js";import"./focus-manager.05708ea9.js";import"./QChip.fc1367d4.js";import"./QItem.98cb2d4c.js";import"./QItemLabel.bb4f8a3f.js";import"./QMenu.ab6378a2.js";import"./selection.fb3d903a.js";import"./focusout.5c99f0fb.js";import"./QDialog.82b87909.js";import"./use-prevent-scroll.175dc396.js";import"./use-form.e491c393.js";import"./format.2bc25e5f.js";import"./use-checkbox.abf6af25.js";import"./use-fullscreen.eb530c2b.js";import"./documentosApi.d4af84c5.js";import"./axios.a596eead.js";import"./useQuery.esm.48506497.js";import"./useQueryClient.esm.ad4fb503.js";import"./utils.esm.429db25b.js";import"./QCardActions.4c1c4976.js";import"./ClosePopup.159f4ab9.js";import"./useMutation.esm.3aac1ad5.js";import"./mutation.esm.54ea4acf.js";const W=()=>G("/users",["users"],{included:"roles"},{staleTime:1e3*60*60}),q=[{field:"name",name:"name",label:"Usuario",align:"left",sortable:!0},{field:"email",name:"email",label:"Correo electr\xF3nico",align:"left",sortable:!0},{field:"rol",name:"rol",label:"Rol",align:"left",sortable:!0},{field:"accion",name:"accion",label:"Acci\xF3n",align:"right"}],X=()=>O("/users","Se elimin\xF3 el usuario"),Y={key:0},Z={key:1},ee=$({__name:"TablaUsers",setup(z){const a=S(),i=_(!1),u=_(""),{data:p,isLoading:y}=W(),{eliminarRecurso:h}=X(),b=d=>{a.push({name:"ver-usuario",params:{id:d}})},w=d=>{a.push({name:"editar-usuario",params:{id:d}})},E=d=>{i.value=!0,u.value=d};return(d,U)=>(f(),g("div",null,[e(R,{modelValue:i.value,"onUpdate:modelValue":U[0]||(U[0]=r=>i.value=r),"recurso-id":u.value,onEliminar:n(h)},null,8,["modelValue","recurso-id","onEliminar"]),e(T,{flat:"",bordered:"",rows:n(p),columns:n(q),"row-key":"name",loading:n(y),pagination:{rowsPerPage:15}},{body:o(r=>[e(N,{props:r},{default:o(()=>[e(t,{key:"name",props:r},{default:o(()=>[v(k(r.row.name),1)]),_:2},1032,["props"]),e(t,{key:"email",props:r},{default:o(()=>[v(k(r.row.email),1)]),_:2},1032,["props"]),e(t,{key:"rol",props:r},{default:o(()=>[r.row.roles&&r.row.roles.length>0?(f(),g("div",Y,k(r.row.roles[0].name),1)):(f(),g("div",Z,"Sin rol"))]),_:2},1032,["props"]),e(t,{key:"accion",props:r},{default:o(()=>[e(j,{push:""},{default:o(()=>[e(c,{size:"sm",color:"info",push:"",glossy:"",icon:"visibility",onClick:x=>b(r.row.id)},null,8,["onClick"]),e(c,{size:"sm",color:"secondary",push:"",glossy:"",icon:"edit",onClick:x=>w(r.row.id)},null,8,["onClick"]),e(c,{size:"sm",color:"negative",push:"",glossy:"",icon:"delete",onClick:x=>E(r.row.id)},null,8,["onClick"])]),_:2},1024)]),_:2},1032,["props"])]),_:2},1032,["props"])]),_:1},8,["rows","columns","loading"])]))}}),oe=()=>J("users-trashed",["users-trashed"],{included:"roles"},{staleTime:1e3*60*60}),se=()=>H("users-force-delete","users-trashed"),re=()=>K("/users-restore","users","users-trashed"),ae={class:"flex justify-end q-gutter-md q-mb-md"},le={key:0},ie={key:1},te=$({__name:"TablaUserEliminado",setup(z){const a=_([]),i=_(!1),u=_(!1),p=_(""),{data:y,isLoading:h}=oe(),{eliminarRecurso:b}=se(),{restaurarRecurso:w}=re(),E=m=>{b(m)},d=()=>{i.value=!0},U=m=>{u.value=!0,p.value=m},r=()=>{const m=a.value.map(l=>l.id.toString());w(m),a.value=[]},x=()=>{const m=a.value.map(l=>l.id.toString());b(m),a.value=[]};return(m,l)=>(f(),g("div",null,[e(R,{modelValue:u.value,"onUpdate:modelValue":l[0]||(l[0]=s=>u.value=s),"recurso-id":p.value,icon:"delete_forever",onEliminar:E,mensaje:"\xBFEstas seguro de eliminar este usuario? Si se llega a eliminar, todos los datos se perder\xE1n para simpre y por simpre. \xA1Piensalo!"},null,8,["modelValue","recurso-id"]),e(R,{modelValue:i.value,"onUpdate:modelValue":l[1]||(l[1]=s=>i.value=s),"recurso-id":a.value,icon:"delete_forever",onEliminar:x,mensaje:"\xBFEstas seguro de eliminar estos usuarios? Si se llega a eliminar, todos los datos se perder\xE1n para simpre y por simpre. \xA1Pi\xE9nsalo!"},null,8,["modelValue","recurso-id"]),V("div",ae,[e(c,{disable:!a.value.length,color:"secondary",icon:"restore",onClick:r},null,8,["disable"]),e(c,{disable:!a.value.length,color:"negative",icon:"delete_forever",onClick:d},null,8,["disable"])]),e(T,{flat:"",bordered:"",rows:n(y),columns:n(q),"row-key":"id",loading:n(h),pagination:{rowsPerPage:10},selection:"multiple",selected:a.value,"onUpdate:selected":l[2]||(l[2]=s=>a.value=s)},{body:o(s=>[e(N,{props:s},{default:o(()=>[e(t,null,{default:o(()=>[e(D,{modelValue:s.selected,"onUpdate:modelValue":Q=>s.selected=Q},null,8,["modelValue","onUpdate:modelValue"])]),_:2},1024),e(t,{key:"name",props:s},{default:o(()=>[v(k(s.row.name),1)]),_:2},1032,["props"]),e(t,{key:"email",props:s},{default:o(()=>[v(k(s.row.email),1)]),_:2},1032,["props"]),e(t,{key:"rol",props:s},{default:o(()=>[s.row.roles&&s.row.roles.length>0?(f(),g("div",le,k(s.row.roles[0].name),1)):(f(),g("div",ie,"Sin rol"))]),_:2},1032,["props"]),e(t,{key:"accion",props:s},{default:o(()=>[e(j,{push:""},{default:o(()=>[e(c,{size:"sm",color:"secondary",push:"",glossy:"",icon:"restore",onClick:Q=>n(w)(s.row.id)},{default:o(()=>[e(P,null,{default:o(()=>[v(" Restaurar usuario ")]),_:1})]),_:2},1032,["onClick"]),e(c,{size:"sm",color:"negative",push:"",glossy:"",icon:"delete_forever",onClick:Q=>U(s.row.id)},{default:o(()=>[e(P,null,{default:o(()=>[v(" Forzar eliminaci\xF3n ")]),_:1})]),_:2},1032,["onClick"])]),_:2},1024)]),_:2},1032,["props"])]),_:2},1032,["props"])]),_:1},8,["rows","columns","loading","selected"])]))}}),ne={class:"flex justify-between items-center"},ue=V("div",{class:"fontsize-15 text-weight-light"},"Usuarios",-1),de=V("div",{class:"fontsize-15 text-weight-light"},"Usuarios eliminados",-1),Ye=$({__name:"ListarUsuario",setup(z){const a=S(),i=()=>{a.push({name:"crear-usuario"})},u=I(),p=[{label:"Usuarios",icon:"people"}];return(y,h)=>(f(),F(L,{padding:""},{default:o(()=>[e(M,{pages:p,titlePage:"Lista de usuarios"}),e(B,null,{default:o(()=>[e(C,null,{default:o(()=>[V("div",ne,[ue,e(c,{label:"Nuevo",icon:"add_circle_outline",color:"secondary",size:"md",padding:"xs",onClick:i})])]),_:1}),e(C,null,{default:o(()=>[e(ee)]),_:1})]),_:1}),n(u)==="admin"?(f(),F(B,{key:0,class:"q-mt-md"},{default:o(()=>[e(C,null,{default:o(()=>[de]),_:1}),e(C,null,{default:o(()=>[e(te)]),_:1})]),_:1})):A("",!0)]),_:1}))}});export{Ye as default};