import{Q as f}from"./QPage.bd9db12d.js";import{v as g,aq as y,q as o,z as i,t as k,d as v,u as r,s as P,aa as q}from"./index.16fafb50.js";import{_ as z}from"./BreadcrumbNav.24a9f6cf.js";import{_ as C}from"./LoaderSpinner.196fa089.js";import{u as x}from"./useVerPeriodo.aaf9762f.js";import{a as E}from"./useActualizarRecurso.56cb937e.js";import{u as Q}from"./useQueryClient.esm.ad4fb503.js";import{_ as S}from"./FormPeriodo.275db6ff.js";import"./useRecursoIndividual.f202693b.js";import"./documentosApi.d4af84c5.js";import"./axios.a596eead.js";import"./useQuery.esm.48506497.js";import"./utils.esm.429db25b.js";import"./useMutation.esm.3aac1ad5.js";import"./mutation.esm.54ea4acf.js";import"./QCard.9550f461.js";import"./use-dark.fd3c0586.js";import"./QBanner.f76ac382.js";import"./QInput.ec90feeb.js";import"./use-key-composition.749118dd.js";import"./uid.42677368.js";import"./focus-manager.05708ea9.js";import"./use-form.e491c393.js";import"./QDate.75e05ac0.js";import"./use-cache.b0833c75.js";import"./date.eb8942c3.js";import"./format.2bc25e5f.js";import"./QPopupProxy.2db034ac.js";import"./QDialog.82b87909.js";import"./use-prevent-scroll.175dc396.js";import"./focusout.5c99f0fb.js";import"./QMenu.ab6378a2.js";import"./selection.fb3d903a.js";import"./QToggle.31e3c23d.js";import"./use-checkbox.abf6af25.js";import"./QForm.5f43623c.js";import"./ClosePopup.159f4ab9.js";import"./errorUtils.9be85d5d.js";const h=()=>(Q().invalidateQueries({queryKey:["periodo-activo"],exact:!1}),E("/periodos","listar-periodo")),A={key:2},fr=g({__name:"EditarPeriodo",setup(a){const p=y(),{id:s=""}=p.params,{resource:t,isLoading:m,error:n}=x(s+""),{actalizarRecurso:c,isLoadingActualizar:d,errorServer:u}=h(),l=e=>{c(e)},_=[{label:"Periodos",icon:"date_range",to:"listar-periodo"},{label:"Editar periodo",icon:"add_circle_outline"}];return(e,B)=>(o(),i(f,{padding:""},{default:k(()=>[v(z,{pages:_,titlePage:"Editar periodo"}),r(m)?(o(),i(C,{key:0})):r(t)?(o(),i(S,{key:1,periodo:r(t),loading:r(d),errorServer:r(u),onGuardar:l},null,8,["periodo","loading","errorServer"])):(o(),P("div",A,q(r(n)),1))]),_:1}))}});export{fr as default};
