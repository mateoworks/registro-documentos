import{Q as h}from"./QPage.bd9db12d.js";import{v as m,aM as x,q as s,z as i,t as d,A as e,d as n,ao as g,B as P,aa as a,_ as y,C,D as b,aq as k,u as r,s as I}from"./index.16fafb50.js";import{_ as V}from"./BreadcrumbNav.24a9f6cf.js";import{u as Q}from"./useVerPeriodo.aaf9762f.js";import{_ as B}from"./LoaderSpinner.196fa089.js";import{Q as S,a as u}from"./QCard.9550f461.js";import"./useRecursoIndividual.f202693b.js";import"./documentosApi.d4af84c5.js";import"./axios.a596eead.js";import"./useQuery.esm.48506497.js";import"./useQueryClient.esm.ad4fb503.js";import"./utils.esm.429db25b.js";import"./use-dark.fd3c0586.js";const c=o=>(C("data-v-2b84442e"),o=o(),b(),o),w={class:"row"},$={class:"col-xs-12 col-md-6"},q={class:"fontsize-14 text-center text-weight-light flex items-center"},N={class:"flex justify-star items-center"},z=c(()=>e("td",null,"Inicio del periodo:",-1)),A=c(()=>e("td",null,"T\xE9rmino del periodo:",-1)),D=c(()=>e("td",null,"Periodo activo:",-1)),E=m({__name:"CardPeriodo",props:{periodo:{}},setup(o){const t=x(o,"periodo");return(l,p)=>(s(),i(S,null,{default:d(()=>[e("div",w,[e("div",$,[n(u,null,{default:d(()=>[e("div",q,[n(g,{name:"date_range",class:"q-mr-xs"}),P(" "+a(t.value.nombre),1)])]),_:1}),n(u,null,{default:d(()=>[e("div",N,[e("table",null,[e("tr",null,[z,e("td",null,a(t.value.fecha_inicio),1)]),e("tr",null,[A,e("td",null,a(t.value.fecha_termino),1)]),e("tr",null,[D,e("td",null,a(t.value.activo===1?"Activo":"Inactivo"),1)])])])]),_:1})])])]),_:1}))}});var R=y(E,[["__scopeId","data-v-2b84442e"]]);const T={key:2},oe=m({__name:"VerPeriodo",setup(o){const _=k(),{id:t=""}=_.params,{resource:l,isLoading:p,error:f}=Q(t+""),v=[{label:"Periodos",icon:"date_range",to:"listar-periodo"},{label:"Ver periodo",icon:"visibility"}];return(j,L)=>(s(),i(h,{padding:""},{default:d(()=>[n(V,{pages:v,titlePage:"Ver periodo"}),r(p)?(s(),i(B,{key:0})):r(l)?(s(),i(R,{key:1,periodo:r(l)},null,8,["periodo"])):(s(),I("div",T,a(r(f)),1))]),_:1}))}});export{oe as default};
